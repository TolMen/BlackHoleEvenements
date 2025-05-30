<section class="listArt-section container py-5">
    <h2 class="section-title">Actualités</h2>
    <hr class="title-separator">

    <?php if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] === "admin") { ?>
        <a href="actualite.php?type=create" class="btn-custom">Ajouter un article</a>
    <?php } ?>

    <div class="row g-4">
        <?php foreach ($articles as $article) {
            $artPostModel = new PostArtModel();
            $imageData = $artPostModel->getArticleImage($bdd, $article['id']);
            $imageUrl = $imageData['url'] ?? '../../../public/assets/logo.png';
        ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="actualite.php?articleID=<?php echo $article['id']; ?>" class="readArt" title="Lire l'article">
                    <div class="article-card">
                        <div class="image_contenu">
                            <img src="../../../public/assets/img/imgActu/<?= htmlspecialchars($imageUrl) ?>" alt="Image de l'article">
                            <?php if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] == "admin") { ?>
                                <a href="../../control/ActualiteControl/deleteArtControl.php?articleID=<?php echo $article['id']; ?>" class="delete-badge" title="Supprimer l'article">
                                    <i class="fa-solid fa-trash" style="color: red;"></i>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="content">
                            <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                            <span class="date">
                                <?= empty($article['updated_at'])
                                    ? date("d/m/Y à H:i", strtotime($article['created_at']))
                                    : date("d/m/Y à H:i", strtotime($article['updated_at'])) ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</section>
