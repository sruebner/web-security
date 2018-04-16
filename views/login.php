<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Duckbook - Login</title>

    <script src="resources/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-grid.min.css">

    <link rel="stylesheet" href="resources/css/style.css">

</head>
<body>
    <div class="container">
        <h1>Willkommen bei Duckbook - Bitte melden Sie sich an</h1>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="username">Benutzername</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername eingeben">
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Passwort eingeben">
            </div>
            <button type="submit" class="btn btn-primary">Anmelden</button>
        </form>
    </div>
</body>
</html>