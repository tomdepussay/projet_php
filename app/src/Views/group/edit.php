<h2><?= $group->getName() ?></h2>

<h3>Gérer le groupe</h3>

<form action="/groupes/<?= $group->getIdGroup() ?>/gerer" method="POST">
    <table>
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($group->getUsers() as $user): ?>
                <tr>
                    <td>
                        <?= $user->getFirstname() ?> <?= $user->getLastname() ?>
                    </td>
                    <td>
                        <?= $user->getStatus() ?>
                    </td>
                    <td>
                        <?php if($user->getIdStatus() != 1): ?>
                            <button type="submit" name="deleteUser" value="<?= $user->getIdUser() ?>">
                                Supprimer
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

<form action="/groupes/<?= $group->getIdGroup() ?>/gerer" method="post">
    <h3>Ajouter un utilisateur</h2>

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $_POST["email"] ?? "" ?>">
        <p class="error"><?= $error["email"] ?? "" ?></p>
    </div>

    <input type="submit" value="Ajouter un utilisateur" name="submit">
</form>

<form action="/groupes/<?= $group->getIdGroup() ?>/gerer" method="POST">
    <h3>Supprimer le groupe</h3>
    <button type="submit" name="deleteGroup">
        Supprimer le groupe
    </button>
</form>