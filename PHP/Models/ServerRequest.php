<?php

class ServerRequests
{

    public function addProduct()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_ENV['API_URL']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
    }

    public function getProducts()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_ENV['API_URL']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $products = json_decode($response);

        return $products;
    }

    public function deleteProduct()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_ENV['API_URL']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
    }

    public function updateProduct()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_ENV['API_URL']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
    }
}