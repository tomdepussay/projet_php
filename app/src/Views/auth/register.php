<section class="register register--content">
    <h2 class="title">Inscription</h2>
    <p class="description">C'est le début de l'aventure</p>
    <form action="/inscription" method="POST" class="register register--form">
        <div class="input-label">
            <input class="input" name="lastname" placeholder="Nom" type="text" />
            <label class="label label--input-error" for="lastname">
                <?php if(isset($error["lastname"])): ?><?= $error["lastname"] ?><?php endif; ?>
            </label>
        </div>
        <div class="input-label">
            <input class="input" name="firstname" placeholder="Prénom" type="text" />
            <label class="label label--input-error" for="firstname">
                <?php if(isset($error["firstname"])): ?><?= $error["firstname"] ?><?php endif; ?>
            </label>
        </div>
        <div class="input-label">
            <input class="input" name="email" placeholder="Adresse mail" type="email" />
            <label class="label label--input-error" for="email">
                <?php if(isset($error["email"])): ?><?= $error["email"] ?><?php endif; ?>
            </label>
        </div>
        <div class="input-label">
            <input class="input" name="password" placeholder="Mot de passe" type="password" />
            <label class="label label--input-error" for="password">
                <?php if(isset($error["password"])): ?><?= $error["password"] ?><?php endif; ?>
            </label>
        </div>
        <div class="input-label">
            <input class="input" name="passwordConfirm" placeholder="Confirmer le mot de passe" type="password" />
            <label class="label label--input-error" for="passwordConfirm">
                <?php if(isset($error["passwordConfirm"])): ?><?= $error["passwordConfirm"] ?><?php endif; ?>
            </label>
        </div>
        <?php if(isset($error["global"])): ?>
        <p><?= $error["global"] ?></p>
        <?php endif; ?>

        <button type="submit" value="S'inscrire" name="submit" class="button button--primary">S'inscrire</button>
    </form>
    <p class="signin">Déjà inscrit ? <a href="/connexion">Se connecter</a></p>
</section>