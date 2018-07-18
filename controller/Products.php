<?php

namespace QuickTemplates\Controller;


use QuickTemplates\Controller;
use QuickTemplates\Template;
use PDO;

class Products extends Controller
{
    public function handle(Template $template)
    {
        global $mysql;

        // if a search query was entered
        if (!empty($_POST['search_query'])) {

            // create db connection
            $db = new PDO($mysql['dsn'], $mysql['user'], $mysql['password']);

            // select statement
            $statement = $db->query('SELECT * FROM products WHERE name LIKE \'%' . $_POST['search_query'] . '%\';');
            if ($statement->execute()) {
                $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                $template->assign('product-table', $this->getProductTable($products));
            }
        }
    }

    private function getProductTable(array $products) : string {
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

    private function getProductColumnName($column) : string {
        $names = [
            'name' => 'Produktname',
            'description' => 'Beschreibung',
            'image' => 'Bild'
        ];

        return array_key_exists($column, $names) ? $names[$column] : $column;
    }
}