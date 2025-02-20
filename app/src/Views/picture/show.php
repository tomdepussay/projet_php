<?php 
require_once __DIR__ . '/../../helpers/get_image_path.php';
$filename = $picture->getUrl();
$imagePath = getImagePath($filename);
?>
<?php if($back != ""): ?>
<a class="back" href="<?= $back ?>">Retour</a>
<?php endif; ?>


<h1 class="title">Photo</h1>
<h2 class="subtitle">Dans <?= $group->getName() ?></h2>

<div class="show-photo">
    <img class="picture--big" src="<?= $imagePath ?>" alt="<?= $picture->getDescription() ?>" />
    <section class="show-photo--infos">
        <?php if ($picture->getDescription()): ?>
        <p class="show-photo--infos-desc"><?= $picture->getDescription() ?></p>
        <?php endif; ?>
        <p>Photo de <b><?= $user->getFirstname() ?> <?= $user->getLastname() ?></b>
        </p>

        <p>Publiée le <?= $picture->getCreatedAt() ?></p>

        <form action=" /photos/<?= $picture->getUrl() ?>" method="POST">
            <div class="show-photo--infos-likes mb-3">
                <?php if($auth->user()->pictureIsLike($picture->getIdPicture())): ?>
                <button class="button button--like" type="submit" name="unlike" value="<?= $picture->getIdPicture() ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ef0000"
                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                    </svg>
                </button>
                <?php else: ?>
                <button class="button button--like" type="submit" name="like" value="<?= $picture->getIdPicture() ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ffffff" class="bi bi-heart"
                        viewBox="0 0 16 16">
                        <path
                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                    </svg>
                </button>
                <?php endif; ?>
                <span><?= $picture->getLikes() ?> like<?= $picture->getLikes() > 1 ? "s" : "" ?></span>
            </div>
        </form>

        <h3 class="headline headline-left">Commentaires</h3>
        <?php if($comments && count($comments) > 0): ?>
        <ul class="show-photo--infos-comments mb-3">
            <?php foreach($comments as $comment): ?>
            <li class="show-photo--infos-comments-comment mt-2 mb-2">
                <b><?= $comment->getUser()->getFirstname() ?> <?= $comment->getUser()->getLastname() ?></b>
                <span><?= $comment->getContent() ?></span>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>Aucun commentaire pour le moment</p>
        <?php endif; ?>

        <div class="show-photo--infos-actions">
            <?php if($picture->getPublicAccess() || $group->canPost($auth->user()->getIdUser())): ?>
            <a href="/photos/<?= $picture->getUrl() ?>/commenter"
                class="button button--icon button--icon-teal button-left">
                <img src="/public/medias/plus.png" class="button--icon-image" />
                <span>Commenter</span>
            </a>
            <?php endif; ?>
            <?php if($picture->canEdit($auth->user()->getIdUser())): ?>
            <!--  <a href="/photos/<?= $picture->getUrl() ?>/modifier">Modifier la photo</a> -->
            <a href="/photos/<?= $picture->getUrl() ?>/modifier"
                class="button button--icon button--icon-dark-blue button-left">
                <img src="/public/medias/settings.png" class="button--icon-image" />
                <span>Modifier la photo</span>
            </a>
            <?php endif; ?>
        </div>
    </section>