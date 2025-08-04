<?php

use controller\ProductController;

return $routes = [
    ["GET", "products", [ProductController::class, "index"]],
    ["GET", "products/{id}", [ProductController::class, "show"]],
    ["POST", "products", [ProductController::class, "store"]],
];