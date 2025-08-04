<?php
namespace controller;

use model\Model;
use PDO;
use models\product;

class ProductController {
    protected $message = "";

    public function index() {
        $_Product = new Product;
        $products = $_Product->find();
        print json_encode($products);
    }

    public function show($id) {
        $_Product = new Product;
        $product = $_Product->findById($id);
        print json_encode($product);
    }

    public function store() {
        $request = json_decode(file_get_contents("php://input"));
        if (isset($request->name)) {
            $params["name"] = $request->name;
        }
        $params["price"]       = isset($request->price) ? json_encode($request->price) : null;
        $params["topping"]     = isset($request->topping) ? json_encode($request->topping) : null;
        $params["allergy"]     = isset($request->allergy) ? json_encode($request->allergy) : null;
        $params["description"] = isset($request->description) ? $request->description : null;
        $params["image"]       = isset($request->image) ? $request->image : null;
        $params["calorie"]     = isset($request->calorie) ? $request->calorie : null;
        $_Product = new Product;
        $_Product->save($params);
        print json_encode([]);
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage(string $message): void {
        $this->message = $message;
    }
}