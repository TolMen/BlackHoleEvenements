<section class="main-container">
    <div class="article-wrapper container">
        <form id="formArt" method="POST" action="../../control/ActualiteControl/updateArtControl.php?articleID=<?= $articleID ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <div class="article-header text-start">
                        <input type="text" id="title" name="title" value="<?= htmlspecialchars($articleAncien['title']); ?>" class="form-control form-control-art form-control-lg fw-bold" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 order-last order-lg-first">
                    <div class="article-content">
                        <div class="editor">
                            <div class="editorQuill" id="editor"><?= $articleAncien['content']; ?></div>
                            <input type="hidden" id="hidden-content" name="content">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 order-first order-lg-last">
                    <div class="article-image-desktop sticky-top z-0">
                        <div class="link mb-3">
                            <a href="#" class="btn btn-outline-dark btn-sm active">Modifier</a>
                            <input type="submit" name="updateArticle" value="Valider" class="btn btn-outline-dark btn-sm">
                            <a href="actualite.php" class="btn btn-outline-dark btn-sm">Retour</a>
                        </div>
                        <div class="position-relative mb-3 image-container">
                            <div class="image-wrapper-edit">
                                <img src="../../../public/assets/img/imgActu/<?= htmlspecialchars($imageUrl) ?>" alt="Image de l'article" class="img-fluid rounded shadow editable-image" id="preview-img">
                                <label for="imageUpload" class="edit-icon">
                                    <i class="fas fa-pencil-alt"></i>
                                </label>
                            </div>
                            <input type="file" id="imageUpload" name="image" accept="image/*" class="d-none" onchange="previewImage(this)">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>