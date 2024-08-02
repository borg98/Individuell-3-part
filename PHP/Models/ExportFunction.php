<?php

class ExportFunction {
    public function csv($products){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="products.csv"');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Product ID', 'Product Name', 'Product Price']);
        foreach($products as $product) {
            fputcsv($output, [$product->id, $product->name, $product->price]);
        }
        fclose($output);
        exit();
    }

    public function xml($products){
        header('Content-Type: application/xml');
        header('Content-Disposition: attachment; filename="products.xml"');
        $xml = new SimpleXMLElement('<products/>');
        foreach($products as $product) {
            $productElement = $xml->addChild('product');
            $productElement->addChild('id', $product->id);
            $productElement->addChild('name', $product->name);
            $productElement->addChild('price', $product->price);
            $productElement->addChild('img', $product->img);
        }
        echo $xml->asXML();
        exit();
    }
}
