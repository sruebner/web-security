<?php

function getProductColumnName($column) : string {
    $names = [
        'name' => 'Produktname',
        'description' => 'Beschreibung',
        'image' => 'Bild'
    ];

    return array_key_exists($column, $names) ? $names[$column] : $column;
}

function getProductTable(array $products) : string {
    $html = '';

    if (!empty($products)) {
        $html .= '<table class="products">';

        $html .= '<tr>';
        foreach (array_keys($products[0]) as $columnName) {
            if ($columnName != 'id') {
                $html .= '<th>' . getProductColumnName($columnName) . '</th>';
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