<?php

if (!empty($_POST['search_query'])) {
    $db = new PDO($mysql['dsn'], $mysql['user'], $mysql['password']);
    $statement = $db->query('SELECT * FROM products WHERE name LIKE \'%' . $_POST['search_query'] . '%\';');
    if ($statement->execute()) {
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo getProductTable($products);
    }
    exit();
}

?>

<div class="form">
    <form method="post" action="index.php?page=products">
        <input type="text" name="search_query">
        <button type="submit" name="search_submit">Suchen</button>
    </form>
</div>
