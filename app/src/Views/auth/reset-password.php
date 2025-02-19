<form action="/recuperation?token=<?= $token ?>" method="POST">
    <h2>Récupération du mot de passe</h2>

    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label for="passwordConfirm">Confirmer le mot de passe :</label>
        <input type="password" name="passwordConfirm" id="passwordConfirm" required>
    </div>

    <?php if(isset($error["global"])): ?>
        <p><?= $error["global"] ?></p>
    <?php endif; ?>

    <input type="submit" value="Envoyer" name="submit">

</form>