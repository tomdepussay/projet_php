<section class="connect connect--content">
    <h2 class="title">Zoomade</h2>
    <p class="description">Toutes vos photos, partout, tout le temps.</p>
    <form action="/connexion" method="POST" class="connect connect--form">
        <input type="email" id="email" placeholder="Adresse mail" required class="input">
        <input type="password" name="password" id="password" placeholder="Mot de passe" required class="input">
        <?php if(isset($error["global"])): ?>
        <p class="error"><?= $error["global"] ?></p>
        <?php endif; ?>
        <button type="submit" value="Se connecter" name="submit" class="button button--primary">Se connecter</button>
    </form>
    <a class="forgot" href="/mot-de-passe-oublie">Mot de passe oublié ?</a>
    <p class="signin">Vous êtes nouveaux ? <a href="/inscription">S'inscrire</a></p>
</section>