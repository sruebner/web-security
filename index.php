<?php

use \QuickTemplates\Template;

require_once 'config/config.php';
require_once 'include/functions.php';
require_once 'QuickTemplates/load.php';


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
