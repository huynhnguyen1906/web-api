<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../utility.php";

$response = getResponseFormat();

try {
    if (filter_input(INPUT_SERVER, "REQUEST_METHOD") !== "POST") {
        throw new Exception("許可されていないリクエストメソッド", 405);
    }
    if (filter_input(INPUT_SERVER, "CONTENT_TYPE") !== "application/json") {
        // エラー処理
    }

    $request = file_get_contents("php://input");
    $request = json_decode($request);

    $db = new PDO(DB_DSN, DB_USER, DB_PASS);

    $params = [];

    if (!empty($request->name)) {
        $params["name"] = $request->name;
    } else {
        throw new Exception("商品名は必須です", 400);
    }

    if (isset($request->price)) {
        $params["price"] = json_encode($request->price);
    } else {
        $params["price"] = json_encode(["s" => "", "m" => "", "l" => ""]);
    }

    if (isset($request->topping)) {
        $params["topping"] = json_encode($request->topping);
    } else {
        $params["topping"] = json_encode([]);
    }

    if (isset($request->description)) {
        $params["description"] = $request->description;
    } else {
        $params["description"] = "";
    }

    if (isset($request->image)) {
        $params["image"] = $request->image;
    }

    if (isset($request->calorie)) {
        $params["calorie"] = $request->calorie;
    }
    
    if (isset($request->allergy)) {
        $params["allergy"] = json_encode($request->allergy);
    }

    $columns = [];
    $labels = [];
    foreach ($params as $key => $value) {
        $columns[] = $key;
        $labels[] = ":$key";
    }
    $columns = implode(",", $columns);
    $labels = implode(",", $labels);

    $sql = "INSERT INTO webapi_products({$columns}) VALUES ({$labels})";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    
} catch (Exception $error) {
    $response["statusCode"] = $error->getCode();
    $response["message"] = $error->getMessage();
    $response["status"] = false;
}

http_response_code($response["statusCode"]);

header("Content-Type:application/json; charset=UTF-8");

print json_encode($response);
    