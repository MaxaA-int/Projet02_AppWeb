<nav class="navigation-principale">
    <a href="#main" class="screen-reader-only focusable">Aller au contenu</a>
    <ul class="flex nav__list">
        <li class="nav__item">
            <a href="<?php echo $niveau ?>index.php" class="nav__link nav__link--active" aria-current="page">
                <img src="<?php echo $niveau?>assets/img/logo_app.svg" alt="Logo AppWeb"></a>
        </li>

        <div class="nav__user flex">
            <li class="nav__item">
                <button command="show-modal" commandfor="notification-dialog" class="notification__bouton">
                    <img src="<?php echo $niveau ?>assets/img/icons/notification.svg" alt="Icon de notification - Ouvrir les notifications">
                </button>

                <dialog id="notification-dialog" class="nav-dialog">
                    <div class="nav-dialog__header">
                        <h2 class="nav-dialog__title">Notifications</h2>
                        <button command="close" commandfor="notification-dialog" aria-label="Fermer la boîte de dialogue">
                            Fermer
                        </button>
                    </div>
                    <div class="nav-dialog__content">
                        <p>Vous n'avez pas de notifications pour le moment.</p>
                    </div>
                </dialog>
            </li>

            <li class="nav__item">
                <a href="<?php echo $niveau ?>pages/connexion/compte/index.php" class="nav__link">
                    <img src="<?php echo $niveau ?>assets/img/icons/compte.svg" alt="Icon du compte - Accédez à votre compte"></a>
            </li>
        </div>
    </ul>
</nav>