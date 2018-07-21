<?php

namespace QuickMVC\Controller;

use Database;
use QuickMVC\Controller;
use QuickMVC\Template;

class Delete extends Controller {
    public function handle(Template $template) {
        // if user is logged in
        if (!empty($_SESSION['username'])) {
            $result = is_array(Database::query('DELETE FROM users WHERE username = \'' . $_SESSION['username'] . '\';'));
            unset($_SESSION['username']);
            $template->assign('deletion-successful', $result);
        } else {
            $template->assign('deletion-successful', false);
        }
    }
}