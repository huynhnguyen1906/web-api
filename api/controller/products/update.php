<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../utility.php";

$response = getResponseFormat();

try {
    if (filter_input(INPUT_SERVER, "REQUEST_METHOD") !== "PUT") {
        throw new Exception("サポートされていないメソッド", 405);
    }

    if (filter_input(INPUT_SERVER, "CONTENT_TYPE") !== "application/json") {
        throw new Exception("リクエストデータはJSONフォーマットのみ対応しています", 400);
    }

    $request = file_get_contents("php://input");
    $request = json_decode($request);
    
    if (empty($request->id)) {
        throw new Exception("送信データに不備があります", 400);
    }

    $db = new PDO(DB_DSN, DB_USER, DB_PASS);

    $columns = [];
    $values = [];
    
    foreach ($request as $key => $value) {
        if ($key !== "id") {
            $columns[] = "$key = :$key";
            $values[$key] = $value;
        }
    }
    $values["id"] = $request->id;
    $columns = implode(",", $columns);

    $sql = "UPDATE " . TB_PRODUCTS . " SET {$columns} WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute($values);

} catch (PDOException $error) {
    print "<br>" . $stmt->queryString . "<br>";
    
} catch (Exception $error) {
    print $error->getMessage();
}