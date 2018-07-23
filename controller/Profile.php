<?php

namespace QuickMVC\Controller;

use Database;
use QuickMVC\Controller;
use QuickMVC\Template;

class Profile extends Controller {
    public function handle(Template $template) {
        // if user is logged in
        if (!empty($_SESSION['username'])) {
            $result = Database::query('SELECT is_admin FROM users WHERE username = \'' . $_SESSION['username'] . '\';');
            if ($result && $result[0]['is_admin']) {
                $template->assign('is-admin', true);
            }
        }
    }
}