<?php

namespace QuickMVC;


use Database;
use PDO;
use SessionHandlerInterface;

class SessionHandler implements SessionHandlerInterface {

    public function open($save_path, $name) {
        return true;
    }

    public function close() {
        return true;
    }

    public function destroy($session_id) {
        return is_array(Database::query('DELETE FROM sessions WHERE id = \'' . $session_id . '\';'));
    }

    public function gc($maxlifetime) {
        return is_array(Database::query('DELETE FROM sessions WHERE creation_date < DATE_SUB(NOW(), INTERVAL ' . $maxlifetime . ' SECOND) '));
    }

    public function read($session_id) {
        $data = '';
        $selectResult = Database::query('SELECT data FROM sessions WHERE id = \'' . $session_id . '\';');
        if (count($selectResult) > 0) {
            $data = $selectResult[0]['data'];
            Database::query('UPDATE sessions SET created_date = NOW() WHERE id = \'' . $session_id . '\';');
        } else {
            Database::query('INSERT INTO sessions (id, data) VALUES (\'' . $session_id . '\', \'\')');
        }
        return $data;
    }

    public function write($session_id, $session_data) {
        return is_array(Database::query('REPLACE INTO sessions (id, data) VALUES (\'' . $session_id . '\', \'' . $session_data . '\');'));
    }
}