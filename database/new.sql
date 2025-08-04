SELECT * FROM webapi_products WHERE JSON_CONTAINS(topping, '"エビ"');

SELECT * FROM webapi_products WHERE JSON_CONTAINS(topping, '"ズッキーニ"');

SELECT * FROM webapi_products WHERE JSON_CONTAINS(topping, :topping);