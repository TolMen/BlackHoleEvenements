<?php

// Bibliothèque GD trouver sur internet

class ImageService
{
    public static function compressAndResizeImage($source, $destination, $maxWidth, $maxHeight, $quality)
    {
        // Obtenir les informations de l'image
        $info = getimagesize($source);
        if (!$info) {
            return false; // L'image est invalide
        }

        list($width, $height) = $info;
        $mime = $info['mime'];

        // Charger l'image source
        $image = self::createImageFromSource($source, $mime);
        if (!$image) {
            return false;
        }

        // Redimensionner l'image si nécessaire
        list($newWidth, $newHeight) = self::calculateNewSize($width, $height, $maxWidth, $maxHeight);
        $imageResized = imagecreatetruecolor($newWidth, $newHeight);

        // Gérer la transparence pour les PNG
        if ($mime === 'image/png') {
            imagealphablending($imageResized, false);
            imagesavealpha($imageResized, true);
        }

        // Redimensionner l'image
        imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Enregistrer l'image compressée
        $success = self::saveCompressedImage($imageResized, $destination, $mime, $quality);

        // Libérer la mémoire
        imagedestroy($image);
        imagedestroy($imageResized);

        return $success;
    }

    /**
     * Génère un thumbnail recadré aux dimensions exactes spécifiées.
     * Le recadrage est centré pour conserver la partie la plus intéressante de l'image.
     * Le thumbnail est toujours sauvegardé en JPEG pour minimiser le poids.
     *
     * @param string $source       Chemin du fichier source (tmp ou définitif)
     * @param string $destination  Chemin de sauvegarde du thumbnail
     * @param int    $thumbWidth   Largeur cible en pixels
     * @param int    $thumbHeight  Hauteur cible en pixels
     * @param int    $quality      Qualité JPEG (0-100), défaut 80
     * @return bool
     */
    public static function generateThumbnail($source, $destination, $thumbWidth, $thumbHeight, $quality = 80)
    {
        $info = getimagesize($source);
        if (!$info) {
            return false;
        }

        list($width, $height) = $info;
        $mime = $info['mime'];

        $image = self::createImageFromSource($source, $mime);
        if (!$image) {
            return false;
        }

        // Calculer le recadrage centré pour respecter le ratio cible
        $srcRatio = $width / $height;
        $dstRatio = $thumbWidth / $thumbHeight;

        if ($srcRatio > $dstRatio) {
            // Image source plus large → recadrer les côtés
            $cropHeight = $height;
            $cropWidth  = (int)round($height * $dstRatio);
            $srcX = (int)round(($width - $cropWidth) / 2);
            $srcY = 0;
        } else {
            // Image source plus haute → recadrer haut/bas
            $cropWidth  = $width;
            $cropHeight = (int)round($width / $dstRatio);
            $srcX = 0;
            $srcY = (int)round(($height - $cropHeight) / 2);
        }

        // Créer le canvas du thumbnail
        $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);

        // Rééchantillonnage de haute qualité
        imagecopyresampled(
            $thumb,
            $image,
            0,
            0,
            $srcX,
            $srcY,
            $thumbWidth,
            $thumbHeight,
            $cropWidth,
            $cropHeight
        );

        // Sauvegarder en JPEG (meilleur rapport qualité/poids pour les photos)
        $success = imagejpeg($thumb, $destination, $quality);

        // Libérer la mémoire
        imagedestroy($image);
        imagedestroy($thumb);

        return $success;
    }

    private static function createImageFromSource($source, $mime)
    {
        switch ($mime) {
            case 'image/jpeg':
                return imagecreatefromjpeg($source);
            case 'image/png':
                return imagecreatefrompng($source);
            case 'image/gif':
                return imagecreatefromgif($source);
            default:
                return false;
        }
    }

    private static function saveCompressedImage($image, $destination, $mime, $quality)
    {
        switch ($mime) {
            case 'image/jpeg':
                return imagejpeg($image, $destination, $quality);
            case 'image/png':
                return imagepng($image, $destination, $quality / 10);
            case 'image/gif':
                return imagegif($image, $destination);
            default:
                return false;
        }
    }

    private static function calculateNewSize($width, $height, $maxWidth, $maxHeight)
    {
        if ($width > $maxWidth || $height > $maxHeight) {
            $ratio = min($maxWidth / $width, $maxHeight / $height);
            return [round($width * $ratio), round($height * $ratio)];
        }
        return [$width, $height];
    }
}
