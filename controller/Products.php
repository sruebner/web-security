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
            $result = Database::query('SELECT name, description, price FROM products WHERE name LIKE \'%' . $_POST['search_query'] . '%\';');

            if ($result) {
                $template->assign('product-table', $this->getProductTable($result));
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
                        if ($key == 'price') {
                            $html .= '<td>' . number_format($column / 100.0, 2, ',', '.') . '€</td>';
                        } else {
                            $html .= '<td>' . $column . '</td>';
                        }

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
            'price' => 'Preis'
        ];

        return array_key_exists($column, $names) ? $names[$column] : $column;
    }
}