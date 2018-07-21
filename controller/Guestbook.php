<?php

namespace QuickMVC\Controller;

use Database;
use DateTime;
use QuickMVC\Controller;
use QuickMVC\Template;

class Guestbook extends Controller {
    public function handle(Template $template) {
        // if guestbook form was filled
        if (!empty($_POST['name']) && !empty($_POST['text'])) {
            Database::query('INSERT INTO guestbook (name, text) VALUES (\'' . $_POST['name'] . '\', \'' . addslashes($_POST['text']) . '\');');
        }

        $entries = Database::query('SELECT * FROM guestbook ORDER BY date DESC LIMIT 10;');

        $template->assign('guestbook-entries', $this->getEntrieTable($entries));
    }

    private function getEntrieTable(array $entries): string {
        $html = '<hr>';

        foreach ($entries as $entry) {
            $date = new DateTime($entry['date']);
            $html .= '<p><strong>Autor</strong>: ' . $entry['name'] . ' <strong>Datum</strong>: ' . $date->format('j.n.Y G:i') . '</p>';
            $html .= '<p><em>' . stripslashes($entry['text']) . '</em></p>';
            $html .= '<hr>';
        }

        return $html;
    }
}