<h1 class="title">Bienvenue <?= $auth->user()->getFirstname() ?> !</h1>
<h2 class="subtitle">Mes photos</h2>

<?php if($pictures && count($pictures) > 0): ?>
<?php foreach($pictures as $picture): ?>
<a href="/photos/<?= $picture->getUrl() ?>">
    <img src="<?= $picture->getLink() ?>" alt="<?= $picture->getDescription() ?>" width="100" height="100" />
</a>
<?php endforeach; ?>
<?php else: ?>
<h3 class="headline">Aucune photo pour le moment</h3>
<?php endif; ?>