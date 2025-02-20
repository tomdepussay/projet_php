<a class="back" href="/groupes/<?= $group->getIdGroup() ?>">Retour</a>

<h1 class="title">Ajouter une photo</h1>
<form class="create-photo" action=" /groupes/<?= $group->getIdGroup() ?>/ajouter" method="POST"
    enctype="multipart/form-data">

    <div>
        <input type="file" name="picture" id="picture" required accept="image/*" />
        <?php if(isset($error["picture"])): ?>
        <p class="error"><?= $error["picture"] ?></p>
        <?php endif; ?>
    </div>

    <div>
        <textarea class="textarea" rows="5" cols="30" placeholder="Description de votre image" id="description"
            name="description" resize="none"><?= $description ?? "" ?></textarea>
        <?php if(isset($error["description"])): ?>
        <p class="error"><?= $error["description"] ?></p>
        <?php endif; ?>
    </div>

    <?php if(isset($error["global"])): ?>
    <p class="error"><?= $error["global"] ?></p>
    <?php endif; ?>
    <input class="button button--primary" type="submit" value="Ajouter" name="submit">
</form>