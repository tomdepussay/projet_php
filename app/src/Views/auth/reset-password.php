<form action="/recuperation?token=<?= $token ?>" method="POST">
    <h1 class="title">Récupération du mot de passe</h1>

    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label for="passwordConfirm">Confirmer le mot de passe :</label>
        <input type="password" name="passwordConfirm" id="passwordConfirm" required>
    </div>

    <?php if(isset($error["global"])): ?>
    <p class="error"><?= $error["global"] ?></p>
    <?php endif; ?>

    <input type="submit" value="Envoyer" name="submit">
    <button type="submit" name="submit" class="button button--primary">Envoyer</button>

</form>