<?php 
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../utility.php";

$response = getResponseFormat();

try {
    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        throw new Exception("サポートされていないメソッド", 405);
    }

    $db = new PDO(DB_DSN, DB_USER, DB_PASS);

    $searchWheres = [];
    if ($topping = filter_input(INPUT_GET, "topping")) {
        $searchWheres[] = "JSON_CONTAINS(topping, :topping)";
        $searchValues["topping"] = $topping;
    }

    if ($price = filter_input(INPUT_GET, "price", FILTER_VALIDATE_INT)) {
        $searchWheres[] = "JSON_CONTAINS(price,:price,$.m) <= :price";
        $searchValues["price"] = $price;
    }

    $searchWheres = implode(" AND ", $searchWheres);
    $productTable = TB_PRODUCTS;

    if ($searchWheres) {
        $sql = "SELECT * FROM ($productTable) WHERE {$searchWheres[0]}";
    } else {
        $sql = "SELECT * FROM {$productTable}";
    }

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $products = [];
    while ($row = $stmt->fetchObject()) {
        $products[] = $row;
    }

    foreach ($products as $product) {
        if (!$product->description) {
            $topping = json_decode($product->topping);
            $product->description = implode("、", $topping);
        }
        if ($product->image) {
            $product->image = IMAGE_PATH . $product->image;
        }
    }
    $response["products"] = $products;

} catch (PDOException $e) {
    $response["statusCode"] = $e->getCode();
    $response["message"] = $e->getMessage();
    
} catch (Exception $e) {
    $response["statusCode"] = $e->getCode();
    $response["message"] = $e->getMessage();
}

http_response_code($response["statusCode"]);

header("Content-Type: application/json; charset=UTF-8");

print json_encode($response);
?>