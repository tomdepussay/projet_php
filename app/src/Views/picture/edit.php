<a href="/photos/<?= $picture->getUrl() ?>">Retour</a>

<h2>Photo</h2>

<h3>Modifier la photo</h3>

<?php include("img.php"); ?>

<form action="/photos/<?= $picture->getUrl() ?>/modifier" method="POST">

    <div>
        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= $description ?? $picture->getDescription() ?></textarea>
    </div>

    <div>
        <input type="checkbox" name="public" id="public" <?= $picture->getPublicAccess() ? "checked" : "" ?>>
        <label for="public">Rendre la photo publique</label>
    </div>

    <input type="submit" value="Modifier la photo" name="submit">
</form>

<form action="/photos/<?= $picture->getUrl() ?>/supprimer" method="POST">
    <input type="submit" value="Supprimer la photo" name="submit">
</form>