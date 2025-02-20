<section class="login login--content">
    <h1 class="title mb-0">Zoomade</h1>
    <p class="description">Toutes vos photos, partout, tout le temps.</p>
    <form action="/connexion" method="POST" class="login login--form">
        <input type="email" name="email" id="email" placeholder="Adresse mail" required class="input">
        <input type="password" name="password" id="password" placeholder="Mot de passe" required class="input">
        <?php if(isset($error["global"])): ?>
        <p class="error"><?= $error["global"] ?></p>
        <?php endif; ?>
        <button type="submit" value="Se connecter" name="submit" class="button button--primary">Se connecter</button>
    </form>
    <a class="forgot" href="/recuperation">Mot de passe oublié ?</a>
    <p class="signin">Vous êtes nouveaux ? <a href="/inscription">S'inscrire</a></p>
</section>