<?php

namespace QuickMVC;

abstract class Controller
{
    public const CONTROLLER_DIR = 'controller' . DIRECTORY_SEPARATOR;

    private static $sessionStarted = false;
    private $sessionInitiatedByThisObject = false;

    public function __construct() {
        if (!self::$sessionStarted) {
            session_start();
            self::$sessionStarted = true;
            $this->sessionInitiatedByThisObject = true;
        }
    }

    public function __destruct() {
        if (self::$sessionStarted && $this->sessionInitiatedByThisObject) {
            session_write_close();
            self::$sessionStarted = false;
            $this->sessionInitiatedByThisObject = false;
        }
    }

    public abstract function handle(Template $template);
}