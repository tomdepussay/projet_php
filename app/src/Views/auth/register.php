<form action="/inscription" method="POST">
    <h2>S'inscrire</h2>

    <div>
        <div>
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" value="<?= $credentials["firstname"] ?>" required>
            <?php if(isset($error["firstname"])): ?>
                <p><?= $error["firstname"] ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" value="<?= $credentials["lastname"] ?>" required>
            <?php if(isset($error["lastname"])): ?>
                <p><?= $error["lastname"] ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $credentials["email"] ?>" required>
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
    <div>
        <label for="passwordConfirm">Confirmer le mot de passe</label>
        <input type="password" name="passwordConfirm" id="passwordConfirm" required>
        <?php if(isset($error["passwordConfirm"])): ?>
            <p><?= $error["passwordConfirm"] ?></p>
        <?php endif; ?>
    </div>

    <?php if(isset($error["global"])): ?>
        <p><?= $error["global"] ?></p>
    <?php endif; ?>

    <input type="submit" value="S'inscrire" name="submit">

    <a href="/connexion">Se connecter</a>
</form>