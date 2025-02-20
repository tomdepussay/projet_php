<a class="back" href="/photos/<?= $picture->getUrl() ?>">Retour</a>

<h1 class="title">Photo</h1>
<h2 class="subtitle">Modifier la photo</h2>

<form class="edit-photo" action="/photos/<?= $picture->getUrl() ?>/modifier" method="POST">
    <textarea class="textarea" rows="5" cols="30" placeholder="Description" id="description" name="description"
        resize="none" required><?= $description ?? $picture->getDescription() ?></textarea>
    <div class="checkbox-label">
        <input type="checkbox" class="checkbox" name="public" id="public" <?= $picture->getPublicAccess() ? "checked" : "" ?>>
        <label class="label label--input-desc" for="public">Rendre la photo publique</label>
    </div>
    <input class="button button--primary button-left" type="submit" value="Modifier la photo" name="submit">
</form>
<form action="/photos/<?= $picture->getUrl() ?>/supprimer" method="POST">
    <button type="submit" value="Supprimer la photo" name="submit"
        class="button button--icon button--icon-red button-left">
        <img src=" /public/medias/trash.png" class="button--icon-image" />
        <span>Supprimer la photo</span>
    </button>
</form>