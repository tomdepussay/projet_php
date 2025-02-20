<a class="back" href="/groupes/<?= $group->getIdGroup() ?>">Retour</a>

<h1 class="title"><?= $group->getName() ?></h1>
<h2 class="subtitle">Gérer le groupe</h2>

<form action="/groupes/<?= $group->getIdGroup() ?>/gerer" method="POST">
    <table class="membertable">
        <thead class="membertable--head">
            <tr class="membertable--row">
                <th>Utilisateur</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="membertable--body">
            <?php foreach($group->getUsers() as $user): ?>
            <tr class="membertable--row-small">
                <td>
                    <?= $user->getFirstname() ?> <?= $user->getLastname() ?>
                </td>
                <td>
                    <?= $user->getStatus() ?>
                </td>
                <td class="membertable--cell">
                    <?php if($user->getIdStatus() == 3): ?>
                    <button type="submit" name="promoteUser" value="<?= $user->getIdUser() ?>"
                        class="button button--sm button--sm-teal">Promouvoir</button>

                    <?php elseif($user->getIdStatus() == 2): ?>
                    <button type="submit" name="demoteUser" value="<?= $user->getIdUser() ?>"
                        class="button button--sm button--sm-dark-blue">Rétrograder</button>
                    <?php endif; ?>
                    <?php if($user->getIdStatus() != 1): ?>
                    <button type="submit" name="deleteUser" value="<?= $user->getIdUser() ?>"
                        class="button button--delete">
                        <img src="/public/medias/cross.png" /> </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

<h2 class="subtitle">Ajouter un utilisateur</h2>
<form class="adduser mb-2" action="/groupes/<?= $group->getIdGroup() ?>/gerer" method="post">
    <div class="input-label">
        <input class="input" placeholder="Adresse mail" type="email" id="email" name="email"
            value="<?= $_POST["email"] ?? "" ?>" />
        <label class="label label--input-error" for="email"><?= $error["email"] ?? "" ?></label>
    </div>
    <input type="submit" name="submit" value="Ajouter" class="button button--primary" />
</form>

<h2 class="subtitle">Supprimer le groupe</h2>
<form action="/groupes/<?= $group->getIdGroup() ?>/gerer" method="POST">
    <button type="submit" name="deleteGroup" class="button button--icon button--icon-red">
        <img src="/public/medias/trash.png" class="button--icon-image" />
        <span>Supprimer le groupe</span>
    </button>
</form>