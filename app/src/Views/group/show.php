<a href="/groupes">Retour</a>

<h2><?= $group->getName() ?></h2>

<?php $id_user = $auth->user()->getIdUser(); ?>

<?php if($group->canPost($id_user)): ?>
    <a href="/groupes/<?= $group->getIdGroup() ?>/ajouter">Ajouter une photo</a>
<?php endif; ?>

<?php if($group->canEdit($id_user)): ?>
    <a href="/groupes/<?= $group->getIdGroup() ?>/gerer">Gérer le groupe</a>
<?php endif; ?>

<h3>Photos du groupe</h3>

<?php if($pictures && count($pictures) > 0): ?>
    <?php foreach($pictures as $picture): ?>
        <a href="/photos/<?= $picture->getUrl() ?>">
            <img src="<?= $picture->getLink() ?>" alt="<?= $picture->getDescription() ?>" width="100" height="100" />
        </a>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune photo pour le moment</p>
<?php endif; ?>