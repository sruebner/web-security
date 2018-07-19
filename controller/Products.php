<?php

namespace QuickMVC\Controller;


use QuickMVC\Controller;
use QuickMVC\Template;
use PDO;
use Database;

class Products extends Controller
{
    public function handle(Template $template)
    {
        // if a search query was entered
        if (!empty($_POST['search_query'])) {
            $db = Database::getConnection();

            $result = $db->query('SELECT name, description, image FROM products WHERE name LIKE \'%' . $_POST['search_query'] . '%\';');

            if ($result) {
                $products = $result->fetchAll(PDO::FETCH_ASSOC);
                $template->assign('product-table', $this->getProductTable($products));
                $result->closeCursor();
            }
        }
    }

    private function getProductTable(array $products): string
    {
        $html = '';

        if (!empty($products)) {
            $html .= '<table class="products">';

            $html .= '<tr>';
            foreach (array_keys($products[0]) as $columnName) {
                if ($columnName != 'id') {
                    $html .= '<th>' . $this->getProductColumnName($columnName) . '</th>';
                }
            }
            $html .= '</tr>';

            foreach ($products as $product) {
                $html .= '<tr>';
                foreach ($product as $key => $column) {
                    if ($key != 'id') {
                        $html .= '<td>' . $column . '</td>';
                    }
                }
                $html .= '</tr>';
            }

            $html .= '</table>';
        } else {
            $html .= '<h1>Keine Produkte gefunden</h1>';
        }

        return $html;
    }

    private function getProductColumnName($column): string
    {
        $names = [
            'name' => 'Produktname',
            'description' => 'Beschreibung',
            'image' => 'Bild'
        ];

        return array_key_exists($column, $names) ? $names[$column] : $column;
    }
}