<?php
// require config
require_once __DIR__ . '/../config.php';

// DB connection

$db = new PDO(DB_DSN, DB_USERNAME, DB_PASS);

// SQL
$sql = "SELECT * FROM " . DB_TABLE_PRODUCTS;
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