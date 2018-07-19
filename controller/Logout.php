<?php

namespace QuickMVC\Controller;

use Database;
use QuickMVC\Controller;
use QuickMVC\Template;

class Logout extends Controller {

    public function handle(Template $template) {
        if (isset($_SESSION['username'])) {
            unset($_SESSION['username']);
            $template->assign('logout-successful', true);
        }
    }
}