<form action="/groupes/creer" method="POST">
    <h2>Créer un nouveau groupe</h2>

    <div>
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" required>
        <?php if(isset($error["name"])): ?>
            <p><?= $error["name"] ?></p>
        <?php endif; ?>
    </div>

    <?php if(isset($error["global"])): ?>
        <p><?= $error["global"] ?></p>
    <?php endif; ?>

    <input type="submit" value="Créer le groupe" name="submit">
</form>