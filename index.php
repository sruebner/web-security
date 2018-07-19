<?php

use QuickMVC\Template;

require_once 'include/setup.php';

if (!empty($_GET['page'])) {
    $template = new Template($_GET['page']);
} else {
    $template = new Template('home');
}

try {
    $template->display();
} catch (RuntimeException $ex) {
    echo '<h1>Seite nicht gefunden!</h1>';
}
