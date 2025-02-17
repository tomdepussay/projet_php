<h2>Bienvenue <?= $auth->user()->getFirstname() ?> !</h2>

<h3>Mes photos</h3>

<?php if($pictures && count($pictures) > 0): ?>
<?php foreach($pictures as $picture): ?>
<a href="/photos/<?= $picture->getUrl() ?>">
    <img src="<?= $picture->getLink() ?>" alt="<?= $picture->getDescription() ?>" width="100" height="100" />
</a>
<?php endforeach; ?>
<?php else: ?>
<p>Aucune photo pour le moment</p>
<?php endif; ?>