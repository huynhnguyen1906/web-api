# 商品テーブル

CREATE TABLE IF NOT EXISTS webapi_products (
    id INT AUTO_INCREMENT PRIMARY KEY # 商品ID
    , name VARCHAR(255) NOT NULL # 商品名
    , price INT NOT NULL # 価格
    , description TEXT # 商品説明
    , image VARCHAR(255) # 商品画像URL
    , calories INT # カロリー
    , allergy VARCHAR(255) # アレルギー情報

    , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP # 作成日時
    , updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP # 更新日時
);