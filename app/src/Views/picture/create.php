<a href="/groupes/<?= $group->getIdGroup() ?>">Retour</a>

<form action="/groupes/<?= $group->getIdGroup() ?>/ajouter" method="POST" enctype="multipart/form-data">
    <h2>Ajouter une photo</h2>

    <div>
        <label for="picture">Photo :</label>
        <input type="file" name="picture" id="picture" required accept="image/*" />
        <?php if(isset($error["picture"])): ?>
            <p><?= $error["picture"] ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label for="name">Description :</label>
        <textarea name="description" id="description"><?= $description ?? "" ?></textarea>
        <?php if(isset($error["description"])): ?>
            <p><?= $error["description"] ?></p>
        <?php endif; ?>
    </div>

    <?php if(isset($error["global"])): ?>
        <p><?= $error["global"] ?></p>
    <?php endif; ?>

    <input type="submit" value="Ajouter la photo" name="submit">
</form>