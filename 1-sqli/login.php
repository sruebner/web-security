<?php

require_once '../config/config.php';

$username = $_GET['username'];
$password = $_GET['password'];

$db = new PDO($mysql['dsn'], $mysql['user'], $mysql['password']);

$result = $db->query("SELECT * FROM users WHERE username = '$username'");
//$statement = $db->prepare("SELECT * FROM users WHERE username = ?");
//$statement->bindValue(1, $username);
//$statement->execute();
//$result = $statement;

$text = '<span class="text-danger">Login failed!</span>';

if ($result && $result->rowCount() == 1) {
    $user = $result->fetch();

    if ($password == $user['password']) {
        $text = '<span class="text-success">You are logged in as ' . $username . '!</span>';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/css/style.css">

    <script src="../resources/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container pt-5 text-center h1">
        <?= $text ?>
    </div>
</body>
</html>
