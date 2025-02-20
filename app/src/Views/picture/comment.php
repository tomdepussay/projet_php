<a class="back" href="/photos/<?= $picture->getUrl() ?>">Retour</a>

<h1 class="title">Photo</h1>
<h2 class="subtitle">Commenter la photo</h2>
<form action="/photos/<?= $picture->getUrl() ?>/commenter" method="POST">

    <div>
        <!--  <textarea id="comment" name="comment" required><?= $comment ?? "" ?></textarea> -->
        <textarea class="textarea" rows="5" cols="30" placeholder="Ecrivez votre commentaire" id="comment"
            name="comment" resize="none" required><?= $comment ?? "" ?></textarea>
        <?php if(isset($error["comment"])): ?>
        <p class="error"><?= $error["comment"] ?></p>
        <?php endif; ?>
    </div>
    <input class="button button--primary" type="submit" value="Commenter" name="submit">
</form>