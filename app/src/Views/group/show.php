<?php $id_user = $auth->user()->getIdUser(); ?>

<a class="back" href="/groupes">Retour</a>
<h1 class="title"><?= $group->getName() ?></h1>
<h2 class="subtitle">Gérer le groupe</h2>

<ul class="buttonlist">
    <?php if($group->canPost($id_user)): ?>
    <li>
        <a href="/groupes/<?= $group->getIdGroup() ?>/ajouter" class="button button--icon button--icon-green">
            <img src="/public/medias/plus.png" class="button--icon-image" />
            <span>Ajouter une photo</span>
        </a>
    </li>
    <?php endif; ?>
    <?php if($group->canEdit($id_user)): ?>
    <li>
        <a href="/groupes/<?= $group->getIdGroup() ?>/gerer" class="button button--icon button--icon-dark-blue">
            <img src="/public/medias/settings.png" class="button--icon-image" />
            <span>Gérer le groupe</span>
        </a>
    </li>
    <?php endif; ?>
</ul>

<h2 class="subtitle">Photos du groupe</h2>

<?php if($pictures && count($pictures) > 0): ?>
<ul class="picturelist">
    <?php foreach($pictures as $picture): ?>
    <li>
        <a href="/photos/<?= $picture->getUrl() ?>">
            <img src="<?= $picture->getLink() ?>" alt="<?= $picture->getDescription() ?>" width="100" height="100" />
        </a>
    </li>
    <?php endforeach; ?>

</ul>
<?php else: ?>
<h3 class="headline">Aucune photo pour le moment</h3>

<?php endif; ?>