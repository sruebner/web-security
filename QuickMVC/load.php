<?php

spl_autoload_register(function ($class) {
    $prefix = 'QuickMVC\\';
    $controllerPrefix = 'QuickMVC\\Controller\\';
    $prefixLength = strlen($prefix);
    $controllerPrefixLength = strlen($controllerPrefix);
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR;
    $controllerBaseDir = 'controller' . DIRECTORY_SEPARATOR;

    // check if the class uses prefix
    if (substr($class, 0, $prefixLength) != $prefix) {
        return;
    }

    // check if the class is a controller class and assemble class file path
    if (substr($class, 0, $controllerPrefixLength) == $controllerPrefix) {
        $classFile = $controllerBaseDir . str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $controllerPrefixLength)) . '.php';
    } else {
        $classFile = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $prefixLength)) . '.php';
    }

    // require class file if it exists
    if (file_exists($classFile)) {
        require $classFile;
    }
});