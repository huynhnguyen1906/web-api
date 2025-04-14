# 商品テーブル

    DROP TABLE IF EXISTS webapi_products; # 商品テーブルを削除

    CREATE TABLE IF NOT EXISTS webapi_products (
        id INT AUTO_INCREMENT PRIMARY KEY, # 商品ID
        name VARCHAR(255) NOT NULL,        # 商品名
        price JSON NOT NULL,               # 価格
        topping JSON,                      # トッピング情報
        description TEXT,                  # 商品説明
        image VARCHAR(255),                # 商品画像URL
        calorie INT,                       # カロリー
        allergy JSON,                      # アレルギー情報
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, # 作成日時
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP # 更新日時
    );

INSERT INTO webapi_products (
    name, 
    price, 
    topping, 
    description,
    image,
    calorie,
    allergy
) VALUES (
    'ドミノデラックス',
    '{
        "S": 100,
        "M": 150,
        "L": 200
    }',
    '[
        "ベバロニ",
        "ベーコン",
        "チーズ",
        "トマト",
        "オニオン",
        "ピーマン",
        "マッシュルーム"
    ]',
    'ドミノデラックスは、ベバロニ、ベーコン、チーズ、トマト、オニオン、ピーマン、マッシュルームをトッピングしたピザです。',
    "product01.png",
    250,
    '[
        "小麦",
        "乳",
        "卵",
        "大豆",
        "豚肉",
        "鶏肉"
    ]'
);