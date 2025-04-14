<?php

// DB connection

$db = new PDO('mysql:host=localhost;dbname=ndhuynh', 'ndhuynh', 'eccMyAdmin');

$sql = "SELECT * FROM webapi_products";
$stmt = $db->prepare($sql);

$stmt->execute();

// Fetch all products
$products = [];
while ($row = $stmt->fetchObject()) {
    
    $products[] = $row;
}


// Set the content type to JSON
header('Content-Type: application/json; charset=utf-8');
// Set the response code to 200 OK
http_response_code(200);


print json_encode($products, JSON_PRETTY_PRINT);