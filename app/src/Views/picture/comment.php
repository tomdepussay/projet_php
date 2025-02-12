<a href="/photos/<?= $picture->getUrl() ?>">Retour</a>

<h2>Photo</h2>

<h3>Ajouter un commentaire</h3>

<?php include("img.php"); ?>

<form action="/photos/<?= $picture->getUrl() ?>/commenter" method="POST">

    <div>
        <label for="comment">Commentaire :</label>
        <textarea id="comment" name="comment" required><?= $comment ?? "" ?></textarea>
        <?php if(isset($error["comment"])): ?>
            <p><?= $error["comment"] ?></p>
        <?php endif; ?>
    </div>

    <input type="submit" value="Commenter" name="submit">
</form>