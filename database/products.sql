# --------------
# 商品テーブル
# --------------

# テーブルの削除
DROP TABLE IF EXISTS webapi_products;

# テーブルの作成
CREATE TABLE webapi_products(

    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, # ID
    name        VARCHAR(255) NOT NULL,                   # 名前
    price       JSON,                                    # 料金
    topping     JSON,                                    # トッピング
    description TEXT,                                    # 説明
    image       VARCHAR(255),                            # 写真
    calorie     INT UNSIGNED,                            # カロリー
    allergy     JSON,                                    # アレルギー

    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,      # 作成日時
    updated_at  DATETIME DEFAULT CURRENT_TIMESTAMP
                            ON UPDATE CURRENT_TIMESTAMP  # 更新日時

) ENGINE = INNODB;

# テーブルのオートインクリメントを初期化
ALTER TABLE webapi_products AUTO_INCREMENT = 1;

# テストデータ
INSERT INTO webapi_products(
    name, price, topping, description, image, calorie, allergy
)
VALUES
(
    "シーフードスペシャル",
    '{
        "s": "1390",
        "m": "1690",
        "l": "2040"
    }',
    '[
        "エビ",
        "イカ",
        "オニオン",
        "ピーマン",
        "トマトソース"
    ]',
    "新鮮なエビとイカを贅沢に使い、オニオンとピーマンがアクセント。海の幸を存分に味わえるピザです。",
    "product02.png",
    155,
    '[
        "小麦",
        "乳",
        "大豆",
        "魚介類"
    ]'
),
(
    "ベジタリアンミックス",
    '{
        "s": "1190",
        "m": "1490",
        "l": "1840"
    }',
    '[
        "パプリカ",
        "ズッキーニ",
        "マッシュルーム",
        "オリーブ",
        "トマトソース"
    ]',
    "色とりどりの野菜をふんだんに使い、ヘルシーでさっぱりとした味わい。野菜好きにおすすめ。",
    "product03.png",
    132,
    '[
        "小麦",
        "乳",
        "大豆"
    ]'
),
(
    "テリヤキチキン",
    '{
        "s": "990",
        "m": "1290",
        "l": "1640"
    }',
    '[
        "照り焼きチキン",
        "コーン",
        "マヨネーズ",
        "オニオン",
        "トマトソース"
    ]',
    "甘辛い照り焼きチキンとコーンの甘みが絶妙。マヨネーズが全体をまろやかにまとめます。",
    "product04.png",
    168,
    '[
        "小麦",
        "卵",
        "乳",
        "大豆",
        "鶏肉"
    ]'
),
(
    "クワトロチーズ",
    '{
        "s": "1490",
        "m": "1790",
        "l": "2140"
    }',
    '[
        "モッツァレラ",
        "ゴルゴンゾーラ",
        "チェダー",
        "パルメザン",
        "トマトソース"
    ]',
    "4種類のチーズが織りなす濃厚な味わい。チーズ好きにはたまらない贅沢な一枚。",
    "product05.png",
    190,
    '[
        "小麦",
        "乳",
        "大豆"
    ]'
),
(
    "スパイシーペパロニ",
    '{
        "s": "1090",
        "m": "1390",
        "l": "1740"
    }',
    '[
        "ペパロニ",
        "ハラペーニョ",
        "オニオン",
        "トマトソース"
    ]',
    "ピリッと辛いハラペーニョとペパロニがクセになる。刺激的な味を楽しみたい方におすすめ。",
    "product01.png",
    158,
    '[
        "小麦",
        "乳",
        "大豆",
        "豚肉"
    ]'
);
