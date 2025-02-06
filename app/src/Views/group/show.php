<h2><?= $group->getName() ?></h2>

<?php $id_user = $auth->user()->getIdUser(); ?>

<?php if($group->canPost($id_user)): ?>
    <a href="/groupes/<?= $group->getIdGroup() ?>/ajouter">Ajouter une photo</a>
<?php endif; ?>

<?php if($group->canEdit($id_user)): ?>
    <a href="/groupes/<?= $group->getIdGroup() ?>/gerer">Gérer le groupe</a>
<?php endif; ?>