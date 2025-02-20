<a class="back" href="/groupes">Retour</a>

<h1 class="title">Créer un nouveau groupe</h1>
<form action="/groupes/creer" method="POST">
    <div class="input-label">
        <input class="input" name="name" placeholder="Nom du groupe" type="text" required
            value="<?= isset($name) ? $name : "" ?>" />
        <label class="label label--input-error" for="name"><?php if(isset($error["name"])): ?>
            <?php endif; ?></label>
    </div>
    <?php if(isset($error["global"])): ?>
    <p class="error"><?= $error["global"] ?></p>
    <?php endif; ?>

    <button type="submit" name="submit" class="button button--primary">Créer
    </button>
</form>