<section class="main-container">
    <div class="article-wrapper container">
        <div class="row">
            <div class="col-12">
                <div class="article-header text-center">
                    <h1 class="article-title"><?= e($article['title']) ?></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 order-last order-lg-first">
                <div class="article-content">
                    <?= $article['content']; ?>
                </div>
            </div>

            <div class="col-lg-4 order-first order-lg-last">
                <div class="article-image-desktop sticky-top z-0">
                    <div class="link mb-3">
                        <a href="#" class="btn btn-outline-dark btn-sm active">Lire</a>
                        <?php if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] == "admin") { ?>
                            <a href="<?= url('/admin/actualites/' . (int) $article['id'] . '/modifier') ?>" class="btn btn-outline-dark btn-sm">Modifier</a>
                        <?php } ?>
                        <a href="<?= url('/actualites') ?>" class="btn btn-outline-dark btn-sm">Retour</a>
                    </div>
                    <div class="image-wrapper-view">
                        <img src="<?= e(article_image_url($imageUrl)) ?>" alt="Illustration de l'article : <?= e($article['title']) ?>" class="img-fluid rounded shadow article-image-view">
                    </div>
                    <div class="article-meta mt-3">
                        <p>📅 Le : <strong><time datetime="<?= e(date('Y-m-d', strtotime($dateToShow))) ?>"><?= date("d/m/Y à H:i", strtotime($dateToShow)) ?></time></strong></p>
                        <p>📝 Auteur : <strong>Black Hole Evènements</strong></p>
                        <p>👁️ Vues : <strong><?= intval($article['views']); ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>