<main class="main-container">
    <h2 class="section-title">Messagerie</h2>
    <hr class="title-separator">

    <section class="container">
        <div class="row g-4">
            <?php foreach ($messages as $message) { ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="message-card show-popup <?= !$message['is_read'] ? 'unread' : '' ?>"
                        data-id="<?= $message['id'] ?>"
                        data-nom="<?= htmlspecialchars($message['name']) ?>"
                        data-email="<?= htmlspecialchars($message['email']) ?>"
                        data-objet="<?= htmlspecialchars($message['subject']) ?>"
                        data-message="<?= htmlspecialchars($message['message']) ?>"
                        data-read="<?= $message['is_read'] ? '1' : '0' ?>"
                        data-date="<?= date('d/m/Y H:i', strtotime($message['submitted_at'])) ?>">

                        <a href="../../model/AdminModel/deleteMessagerieModel.php?id=<?= $message['id'] ?>"
                            class="delete-badge"
                            title="Supprimer le message"
                            onclick="event.stopPropagation();">
                            <i class="fa-solid fa-trash" style="color: red;"></i>
                        </a>

                        <div class="content">
                            <h3><?= htmlspecialchars($message['subject']) ?></h3>
                            <p><strong>De :</strong> <?= htmlspecialchars($message['name']) ?></p>
                            <p class="text-muted"><small><?= date('d/m/Y H:i', strtotime($message['submitted_at'])) ?></small></p>
                            <p class="status <?= !$message['is_read'] ? 'text-danger' : 'text-success' ?>">
                                <small><?= $message['is_read'] ? 'Lu' : 'Non lu' ?></small>
                            </p>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<div id="popup" class="popup">
    <div class="popup-content">
        <p id="popup-message"></p>
        <button id="closePopup" class="btn btn-success mark-as-read" data-id="<?= $message['id'] ?>" data-bs-dismiss="modal">
            Fermer
        </button>
    </div>
</div>
