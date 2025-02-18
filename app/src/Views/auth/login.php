<section class="login login--content">
    <h2 class="title">Zoomade</h2>
    <p class="description">Toutes vos photos, partout, tout le temps.</p>
    <form action="/connexion" method="POST" class="login login--form">
        <input type="email" name="email" id="email" placeholder="Adresse mail" required class="input">
        <input type="password" name="password" id="password" placeholder="Mot de passe" required class="input">
        <?php if(isset($error["global"])): ?>
        <p><?= $error["global"] ?></p>
    <?php endif; ?>

    <input type="submit" value="Se connecter" name="submit">

    <a href="/inscription">S'inscrire</a>

    <a href="/recuperation">Mot de passe oublié ?</a>
</form>