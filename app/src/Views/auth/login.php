<form action="/connexion" method="POST">
    <h2>Se connecter</h2>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <?php if(isset($error["email"])): ?>
            <p><?= $error["email"] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
        <?php if(isset($error["password"])): ?>
            <p><?= $error["password"] ?></p>
        <?php endif; ?>
    </div>

    <?php if(isset($error["global"])): ?>
        <p><?= $error["global"] ?></p>
    <?php endif; ?>

    <input type="submit" value="Se connecter" name="submit">

    <a href="/inscription">S'inscrire</a>

    <a href="/mot-de-passe-oublie">Mot de passe oublié ?</a>
</form>