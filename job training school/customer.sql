#データベース領域の選択
USE lesson;
#テーブルの削除
DROP TABLE IF EXISTS customer;
#テーブルの作成
CREATE TABLE customer (
id INT AUTO_INCREMENT PRIMARY KEY,
name CHAR(20) NOT NULL,
address TEXT NOT NULL
);
#レコードの追加
INSERT INTO customer (name, address) VALUES ('鈴木一郎', '東京都');
INSERT INTO customer (name, address) VALUES ('Shaquille O\'Neal', '栃木県');
INSERT INTO customer (name, address) VALUES ('田中大五郎', '北海道');
INSERT INTO customer (name, address) VALUES ('西島洋介', '千葉県');
INSERT INTO customer (name, address) VALUES ('木村太郎', '沖縄県');
INSERT INTO customer (name, address) VALUES ('佐々木美樹', '和歌山県');

#レコードの変更
UPDATE customer SET name='木村大五郎' WHERE id=3;
UPDATE customer SET address='大阪府' WHERE id=5;
UPDATE customer SET name='イチロー', address='シアトル' WHERE id=1;

#レコードの削除
DELETE FROM customer WHERE id=4;