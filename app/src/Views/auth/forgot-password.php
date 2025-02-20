<section class="forgotpswrd forgotpswrd--content">
    <h2 class="title">Zoomade</h2>
    <p class="description">Toutes vos photos, partout, tout le temps</p>
    <form action="/recuperation" method="POST" class="forgotpswrd forgotpswrd--form">

        <div class="input-label">
            <input class="input" name="email" placeholder="Adresse mail" type="email" value="<?= $email ?>" />
            <label class="label label--input-error" for="email">
                <?php if(isset($error["email"])): ?>
                <p class="error"><?= $error["email"] ?></p>
                <?php endif; ?>
            </label>
        </div>
        <?php if(isset($error["global"])): ?>
        <p class="error"><?= $error["global"] ?></p>
        <?php endif; ?>
        <button type="submit" value="Envoyer" name="submit" class="button button--primary">Réinitialiser le mot de
            passe</button>
    </form>
    <p class="signin"><a href="/connexion">Retour</a></p>
</section>