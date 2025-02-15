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
        <header>
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
        </header>
        <main>
            <?php include $this->v; ?>
            <h2 class="subtitle">Button</h2>
            <h3 class="headline">Variante 1</h3>
            <button class="button button--primary">S'inscrire</button>
            <br>
            <br>
            <h3 class="headline">Variante 2 (small)</h3>
            <button class="button button--sm button--sm-teal">Ecriture</button>
            <br>
            <br>
            <button class="button button--sm button--sm-dark-blue">Lecture</button>
            <br>
            <br>
            <h2 class="subtitle">Button with icon</h2>
            <h3 class="headline">Variante 1</h3>
            <button class="button button--icon button--icon-green">
                <img src="/public/medias/plus.png" class="button--icon-image"/>
                <span>Ajouter une photo</span>
            </button>
            <br>
            <br>
            <h3 class="headline">Variante 2</h3>
            <button class="button button--icon button--icon-dark-blue">
                <img src="/public/medias/settings.png" class="button--icon-image"/>
                <span>Gérer le groupe</span>
            </button>
            <br>
            <br>
            <h3 class="headline">Variante 3</h3>
            <button class="button button--icon button--icon-red">
                <img src="/public/medias/trash.png" class="button--icon-image"/>
                <span>Supprimer la photo</span>
            </button>
            <br>
            <br>
            <h2 class="subtitle">Input</h2>
            <h3 class="headline">Variante classique</h3>
            <div class="input-label">
                <input class="input" name="input1" placeholder="Adresse mail" type="text"/>
                <label class="label label--input-error" for="input1">Adresse mail non valide</label>
            </div>
            <br>
            <h3 class="headline">Variante avec copie</h3>
            <div class="input-label input-label--button">
                <input class="input" value="https://lien-vers-mon-image" readonly name="input2" placeholder="Adresse mail" type="text"/>
                <button class="input-label-button">
                    <img src="/public/medias/copy.png" />
                </button>
            </div>
            <br>
            <br>
            <h2 class="subtitle">Textarea</h2>
            <textarea class="textarea" rows="5" cols="30" placeholder="Description" name="textarea1" resize="none"></textarea>
            <br>
            <br>
            <h2 class="subtitle">Checkbox</h2>
            <h3 class="headline">Not checked</h3>
            <div class="checkbox-label">
                <input type="checkbox" class="checkbox" name="checkbox">
                <label class="label label--input-desc" for="checkbox">Rendre la photo publique</label>
            </div>
            <br>
            <h3 class="headline">Checked</h3>
            <div class="checkbox-label">
                <input type="checkbox" class="checkbox" name="checkbox" checked>
                <label class="label label--input-desc" for="checkbox">Rendre la photo publique</label>
            </div>
            <br>
            <br>
            <h2 class="subtitle">Menu link</h2>
            <a href="#" class="menulink">
                <img class="menulink-image" src="/public/medias/user.png"/>
                Profil
            </a>
            <br>
            <br>
            <h2 class="subtitle">Page title</h2>
            <h1 class="title">Bienvenue $prénom !</h1>
            <br>
            <h2 class="subtitle">Page subtitle</h2>
            <h2 class="subtitle">Mes photos</h2>
            <br>
            <br>
            <h2 class="subtitle">Headline</h2>
            <h3 class="headline">Administrateur</h3>
            <br>
            <br>
            <h2 class="subtitle">Sub headline</h2>
            <h4 class="subheadline">Lorem ipsum</h4>
            <br>
            <br>
            
        </main>
    </body>
</html>
