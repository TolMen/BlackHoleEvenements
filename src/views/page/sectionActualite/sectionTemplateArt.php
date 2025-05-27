<section class="main-container">
    <div class="article-wrapper container">
        <div class="row">
            <div class="col-12">
                <div class="article-header text-center">
                    <h1 class="article-title"><?= htmlspecialchars($article['title']); ?></h1>
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
                            <a href="actualite.php?articleID=<?php echo $article['id']; ?>&type=update" class="btn btn-outline-dark btn-sm">Modifier</a>
                        <?php } ?>
                        <a href="actualite.php" class="btn btn-outline-dark btn-sm">Retour</a>
                    </div>
                    <div class="image-wrapper-view">
                        <img src="../../../public/assets/img/imgActu/<?= htmlspecialchars($imageUrl) ?>" alt="Image de l'article" class="img-fluid rounded shadow article-image-view">
                    </div>
                    <div class="article-meta mt-3">
                        <p>📅 Le : <strong><?= date("d/m/Y à H:i", strtotime($dateToShow)); ?></strong></p>
                        <p>📝 Auteur : <strong>Black Hole Evènements</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>