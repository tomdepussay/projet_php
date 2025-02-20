<a class="back" href="/">Retour</a>

<h1 class="title">Mes groupes</h1>
<h2 class="subtitle">Liste des groupes</h2>

<?php if(count($groups)): ?>
<ul class="grouplist">
    <?php foreach($groups as $group): ?>
    <li>
        <a class="button button--icon button--icon-dark-blue" href="/groupes/<?= $group->getIdGroup() ?>">
            <span><?= $group->getName() ?></span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
<h3 class="headline">Vous n'avez pas de groupe</h3>
<?php endif; ?>
<a class="button button--icon button--icon-green" href="/groupes/creer">
    <img src="/public/medias/plus.png" class="button--icon-image" />
    <span>Créer un groupe</span>
</a>