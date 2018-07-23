<?php

namespace QuickMVC\Controller;

use Database;
use QuickMVC\Controller;
use QuickMVC\Template;

class Login extends Controller {
    public function handle(Template $template) {
        // if login form was filled
        if (!empty($_POST['username']) && !empty($_POST['password'])) {

            if ($this->checkLogin($_POST['username'], $_POST['password'])) {
                $template->assign('login-successful', true);
                $_SESSION['username'] = $_POST['username'];
            } else {
                $template->assign('login-successful', false);
            }

        } else {
            $template->assign('show-form', true);
        }
    }

    private function checkLogin(string $username, string $password): bool {

        $result = Database::query('SELECT password FROM users WHERE username = \'' . $username . '\';');

        if ($result) {
            return password_verify($password, $result[0]['password']);
        } else {
            return false;
        }
    }
}