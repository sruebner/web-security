<?php

use QuickMVC\SessionHandler;

require_once 'QuickMVC/load.php';
require_once 'include/Database.php';

session_set_save_handler(new SessionHandler());