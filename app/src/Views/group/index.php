<h2>Groupes</h2>

<a href="/groupes/creer">Créer un groupe</a>

<?php if(count($groups)): ?>
    <ul>
        <?php foreach($groups as $group): ?>
            <li>
                <a href="/groupes/<?= $group->getIdGroup() ?>"><?= $group->getName() ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Vous n'avez aucun groupe.</p>
<?php endif; ?>