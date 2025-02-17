<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . " - Template" : "Template" ?></title>
    <link rel="stylesheet" href="./../../../public/css/main.css">
    <script src="./../../../public/js/app.js"></script>
    <meta name="description" content="<?= isset($description) ? $description : "Template" ?>">
</head>

<body>
    <!--  <header>
        <h1>
            <a href="/">Site</a>
        </h1>
        <nav>
            <ul>
                <li><a href="/design">Design Guide</a></li>
                <?php if($auth->isLogged()): ?>
                <li><a href="/groupes">Groupes</a></li>
                <li><a href="/deconnexion">Se déconnecter</a></li>
                <?php else: ?>
                <li><a href="/connexion">Se connecter</a></li>
                <li><a href="/inscription">S'enregistrer</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header> -->
    <main>
        <?php include $this->v; ?>


    </main>
</body>

</html>