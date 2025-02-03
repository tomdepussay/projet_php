<form action="/mot-de-passe-oublie" method="POST">
    <h2>Récupération du mot de passe</h2>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $email ?>" required>
        <?php if(isset($error["email"])): ?>
            <p><?= $error["email"] ?></p>
        <?php endif; ?>
    </div>

    <?php if(isset($error["global"])): ?>
        <p><?= $error["global"] ?></p>
    <?php endif; ?>

    <input type="submit" value="Envoyer" name="submit">

    <a href="/connexion">Se connecter</a>
</form>