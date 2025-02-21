<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . " - Zoomade" : "Zoomade" ?></title>
    <link rel="stylesheet" href="./../../../public/css/main.css">
    <script src="./../../../public/js/app.js"></script>
    <meta name="description" content="<?= isset($description) ? $description : "Zoomade" ?>">
</head>

<body <?php if($auth->isLogged()): ?> class="logged" <?php endif; ?> <header>
    <!--   <h1>
            <a href="/">Site</a>
        </h1> -->
    <?php if($auth->isLogged()): ?>
    <header class="navigation--header">
        <nav class="navigation">
            <ul class="navigation--list">
                <li><a class="navigation--title" href="/">Zoomade</a></li>
                <li><a href="/" class="menulink">
                        <img class="menulink-image" src="/public/medias/home.png" />
                        Accueil
                    </a>
                </li>
                <li><a href="/groupes" class="menulink">
                        <img class="menulink-image" src="/public/medias/group.png" />
                        Mes groupes
                    </a></li>
                <li><a href="/design" class="menulink">
                        <img class="menulink-image" src="/public/medias/palette.png" />
                        Design Guide
                    </a></li>
                <li><a href="/deconnexion" class="menulink">
                        <img class="menulink-image" src="/public/medias/logout.png" />
                        Déconnexion
                    </a></li>
            </ul>
        </nav>
    </header>
    <main class="main--logged">
        <?php include $this->v; ?>


    </main>
    <?php else: ?>
    <main>
        <?php include $this->v; ?>


    </main>
    <?php endif; ?>
</body>

</html>