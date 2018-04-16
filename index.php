<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

$view = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_STRING);
$viewFile = 'views/' . $view . '.php';

$script = filter_input(INPUT_GET, 'script', FILTER_SANITIZE_STRING);
$scriptFile = 'scripts/' . $script . '.php';

if (file_exists($viewFile)) {
    require_once $viewFile;
} else if (file_exists($scriptFile)) {
    require_once $scriptFile;
}

