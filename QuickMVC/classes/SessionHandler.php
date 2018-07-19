<?php

namespace QuickMVC;


use Database;
use PDO;
use SessionHandlerInterface;

class SessionHandler implements SessionHandlerInterface {

    /** @var PDO */
    private $db;

    public function open($save_path, $name) {
        $this->db = Database::getConnection();
        return true;
    }

    public function close() {
        unset($this->db);
        return true;
    }

    public function destroy($session_id) {
        return boolval($this->db->query('DELETE FROM sessions WHERE id = \'' . $session_id . '\';'));
    }

    public function gc($maxlifetime) {
        return boolval($this->db->query('DELETE FROM sessions WHERE creation_date < DATE_SUB(NOW(), INTERVAL ' . $maxlifetime . ' SECOND) '));
    }

    public function read($session_id) {
        $data = '';
        $result = $this->db->query('SELECT data FROM sessions WHERE id = \'' . $session_id . '\';');
        if ($result && $result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $data = $row['data'];
            $this->db->query('UPDATE sessions SET created_date = NOW() WHERE id = \'' . $session_id . '\';');
        } else {
            $this->db->query('INSERT INTO sessions (id, data) VALUES (\'' . $session_id . '\', \'\')');
        }
        return $data;
    }

    public function write($session_id, $session_data) {
        return boolval($this->db->query('REPLACE INTO sessions (id, data) VALUES (\'' . $session_id . '\', \'' . $session_data . '\');'));
    }
}