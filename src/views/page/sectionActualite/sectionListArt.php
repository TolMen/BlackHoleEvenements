<section class="listArt-section container py-5">
    <h1 class="section-title">Actualités</h1>
    <hr class="title-separator">

    <?php if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] === "admin") { ?>
        <a href="<?= url('/admin/actualites/nouvelle') ?>" class="btn-custom">Ajouter un article</a>
    <?php } ?>

    <div class="row g-4">
        <?php foreach ($articles as $article) {
            $imageUrl = $articleImages[$article['id']] ?? null;
            $dateArticle = !empty($article['updated_at']) ? $article['updated_at'] : $article['created_at'];
        ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="<?= article_url((int) $article['id'], $article['title']) ?>" class="readArt" title="Lire l'article">
                    <div class="article-card">
                        <div class="image_contenu">
                            <img src="<?= e(article_image_url($imageUrl)) ?>"
                                alt="Illustration de l'article : <?= e($article['title']) ?>"
                                loading="lazy" decoding="async">
                            <?php if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] === "admin") { ?>
                                <a href="<?= url('/admin/actualites/' . (int) $article['id'] . '/supprimer') ?>"
                                    class="delete-badge" title="Supprimer l'article" rel="nofollow"
                                    onclick="return confirm('Supprimer définitivement cet article ?');">
                                    <i class="fa-solid fa-trash" style="color: red;"></i>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="content">
                            <h2><?= e($article['title']) ?></h2>
                            <span class="date">
                                <time datetime="<?= e(date('Y-m-d', strtotime($dateArticle))) ?>">
                                    <?= date("d/m/Y à H:i", strtotime($dateArticle)) ?>
                                </time>
                                - 👁️ <?= (int) $article['views'] ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</section>
