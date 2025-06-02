<div class="container py-4">
    <div class="mt-3">
        <h2 class="section-title">Statistiques</h2>
        <hr class="title-separator" />
        <div class="d-flex justify-content-between flex-wrap">
            <div class="stat-item text-center flex-grow-1">
                <h3 id="monthVisitors"><?= $monthVisitorCount ?></h3>
                <p>Visiteurs du mois</p>
                <i class="fas fa-calendar-alt fa-2x"></i>
            </div>

            <div class="stat-item text-center flex-grow-1">
                <h3 id="yearVisitors"><?= $totalVisitorCountYear ?></h3>
                <p>Cumul des visiteurs cette année</p>
                <i class="fas fa-chart-line fa-2x"></i>
            </div>

            <div class="stat-item text-center flex-grow-1">
                <h3 id="unreadMessages"><?= $unReadMessage ?></h3>
                <p>Messages non lus</p>
                <i class="fas fa-envelope fa-2x"></i>
            </div>
        </div>
    </div>

    <div class="stat-history mt-5 chart-container">
        <h3 class="section-title">Historique des visiteurs (mensuel)</h3>
        <hr class="title-separator" />
        <canvas id="visitorHistoryChart"></canvas>
    </div>

    <div class="mt-5 mb-5">
        <h2 class="section-title">Informations</h2>
        <hr class="title-separator" />
        <form>
            <div class="row align-items-end g-3">
                <div class="col-md-3">
                    <label for="login" class="form-label">Identifiant</label>
                    <input type="text" class="form-control" id="login" placeholder="Laisser vide pour ne pas changer">
                </div>

                <div class="col-md-3">
                    <label for="password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="password" placeholder="Laisser vide pour ne pas changer">
                </div>

                <div class="col-md-3">
                    <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="password_confirm" placeholder="Laisser vide pour ne pas changer">
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn-custom w-100">
                        <i class="fas fa-save me-2"></i> Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>