<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Shop of Many Things</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="resources/stylesheets/normalize.css">
        <link rel="stylesheet" href="resources/stylesheets/style.css">
    </head>
    <body>
        <header>
            Shop of Many Things
        </header>
        <nav>
            <a href="index.php?page=home">Startseite</a>
            <a href="index.php?page=products">Produktsuche</a>
            <?php
            // change to if logged in
            if (false) {
                echo '<a href="index.php?page=profile">Benutzerprofil</a> <a href="index.php?page=logout">Abmelden</a>';
            } else {
                echo '<a href="index.php?page=login">Anmelden</a>';
            }
            ?>
        </nav>
        <main>
            <?php
            if (!empty($_GET['page'])) {
                if (file_exists('pages' . DIRECTORY_SEPARATOR . $_GET['page'] . '.php')) {
                    include 'pages' . DIRECTORY_SEPARATOR . $_GET['page'] . '.php';
                } else {
                    echo '<h1>Page not found!</h1>';
                }
            } else {
                if (file_exists('pages' . DIRECTORY_SEPARATOR . 'home.php')) {
                    include 'pages' . DIRECTORY_SEPARATOR . 'home.php';
                } else {
                    echo '<h1>Page not found!</h1>';
                }
            }
            ?>
        </main>
    </body>
</html>
