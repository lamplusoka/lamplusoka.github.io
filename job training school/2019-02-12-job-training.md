# 2019.2.12 授業内容

## MariaDB
### データベースとは
- データベースは管理人付きの情報保管庫のようなもの。
- 管理人にオーダーを出せば検索や並び替え、計算などを行い必要なデータを適切な状態で渡してくれる。
- この便利なデータベース機能を使うためには管理人にオーダーをだすための言語、SQL(Structured Query Language)を覚える必要がある。

#### MariaDBの設定
- iniファイルの編集
	- xampp\mysql\bin\my.iniを開く。[mysqld]の中の最後（157行目付近）に以下を追加
		- character-set-server=utf8
		- MySQL(MariaDB)をスタートする
			- [cp932とは](https://tmtms.hatenablog.com/entry/201805/mysql-sjis-cp932)
- root権限にパスワードを設定
	- コンソールのshellを起動
	- mysqladmin -u root passwordと入力
	- パスワードは「admin」と設定

#### MariaDBクライアントプログラムの起動
- mysql -u -ユーザ名 -p
	- -u:ユーザー名を指定するオプション
	- -p:パスワードを入力するためのオプション
	- `mysql -u root -p`

- その他の操作
	- quit:MariaDBクライアントプログラムの収量
	- \c:コマンドをキャンセル
	- ''で囲むと文字列入力となる。'の途中で改行した場合、「'」で囲むまで文字列入力が続くので注意

#### データベース領域
- MariaDBはデータベースマネージメントシステムの中に複数のデータベース領域を作成・管理できる
	- 1つのデータベースマネージメントシステムにに複数のユーザーやアプリケーションがアクセスすることを想定している
	- これによりデータの関連性が明確になる。またほかのアプリケーションで使用しているデータを誤って変更・壊してしまうことがなくなる

- データベース領域一覧の表示
	- `SHOW DATABESES;`
	- 以下はデフォルトで入っているDB

```cmd
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| phpmyadmin         |
| test               |
+--------------------+
```

- データベース領域の作成
	- `create database lesson;` ⇒ lessonというDBを作成
- データベース領域の選択
	- `USE データベース領域名`
		- `use lesson`:冒頭のMariaDB [(none)]> ⇒ MariaDB [(lesson)]>に代わる
- 現在利用しているDB領域を確認
	- ` select database();`


### テーブル
実際にデータを入れる表組のことで、Excelのようなものを想像してもらえるとわかりやすい。
- 列はデータの項目を意味し、「フィールド」や「カラム(columu)」と呼ばれる。
- 行は1件分のデータが入力されており「レコード」と呼ばれる。

#### テーブルを作成

```sql
CREATE TABLE テーブル名(
フィールド名1 フィールドの型1 属性1,
フィールド名2 フィールドの型1 属性2,
.
.
.
フィールド名x フィールドの型x 属性x,
)

MariaDB [lesson]> CREATE TABLE goods(
//「goods」という名前でテーブルを作成

    -> id INT AUTO_INCREMENT PRIMARY KEY,
//フィールド名：「id」 型：32ビット整数 属性：自動連番・主キー
	//主キー：ユニーク値でありNULL値を許さない(UNIQUE & NOT NULL)

    -> item CHAR(10),
//フィールド名：「item」 型：10文字の固定長文字列

    -> price INT DEFAULT 0
//フィールド名：「price」 型：32ビット整数 初期値：0

    -> );
Query OK, 0 rows affected (0.14 sec)

```

#### フィールドの型と属性
[フィールドの型と属性](http://ingwer-design.com/blog/mysql/post-16.html)  


- テーブル一覧の表示
	- `SHOW TABLES`

```
MariaDB [lesson]> show tables;
+------------------+
| Tables_in_lesson |
+------------------+
| goods            |
+------------------+
1 row in set (0.01 sec)
```

- フィールドの構成を調べる
	- `SHOW COLUMNS FROM テーブル名;`
	- `DESC テーブル名;`でもOK

```
MariaDB [lesson]> show columns from goods;
+-------+----------+------+-----+---------+----------------+
| Field | Type     | Null | Key | Default | Extra          |
+-------+----------+------+-----+---------+----------------+
| id    | int(11)  | NO   | PRI | NULL    | auto_increment |
| item  | char(10) | YES  |     | NULL    |                |
| price | int(11)  | YES  |     | 0       |                |
+-------+----------+------+-----+---------+----------------+
3 rows in set (0.06 sec)

MariaDB [lesson]> desc goods;
+-------+----------+------+-----+---------+----------------+
| Field | Type     | Null | Key | Default | Extra          |
+-------+----------+------+-----+---------+----------------+
| id    | int(11)  | NO   | PRI | NULL    | auto_increment |
| item  | char(10) | YES  |     | NULL    |                |
| price | int(11)  | YES  |     | 0       |                |
+-------+----------+------+-----+---------+----------------+
3 rows in set (0.02 sec)

```

**CRUDシステム**
この4つができればWebシステムとして成り立つ
- Creat
- Read
- Update
- Dlete


#### レコードを追加する
- 書式1：`INSERT INTO テーブル名
(フィールド名1、フィールド名2、・・・)VALUES(値1、値2、・・・);`

- 書式2：`INSERT INTO テーブル名
SET フィールド名1=値1、フィールド名2=値2、・・・;`


```
MariaDB [lesson]> INSERT INTO goods(item, price) VALUES('おいしい水', 190);
Query OK, 1 row affected (0.05 sec)
```

- データを取得する
	- `SELECT フィールド名1,フィールド名2, ...ROM テーブル名[WHERE 条件式];
	- `SELECT * FROM テーブル名;`

```
MariaDB [lesson]> SELECT * FROM goods;
+----+------------+-------+
| id | item       | price |
+----+------------+-------+
|  1 | おいしい水 |   190 |
+----+------------+-------+
1 row in set (0.00 sec)


MariaDB [lesson]> SELECT id, item from goods;
+----+--------------+
| id | item         |
+----+--------------+
|  1 | おいしい水   |
|  2 | ポテトチップ |
|  3 | チョコレート |
|  4 | パイナップル |
|  5 | 食パン       |
|  6 | 米           |
|  7 | たまねぎ     |
|  8 | NULL         |
|  9 |              |
+----+--------------+


MariaDB [lesson]> SELECT price, item from goods;
+-------+--------------+
| price | item         |
+-------+--------------+
|   190 | おいしい水   |
|   120 | ポテトチップ |
|   150 | チョコレート |
|   330 | パイナップル |
|   180 | 食パン       |
|  2000 | 米           |
|     0 | たまねぎ     |
| 30000 | NULL         |
|     0 |              |
+-------+--------------+

```

- WHEREで条件をつけて表示

```
MariaDB [lesson]> SELECT * FROM goods where id=3;
+----+--------------+-------+
| id | item         | price |
+----+--------------+-------+
|  3 | チョコレート |   150 |
+----+--------------+-------+
1 row in set (0.05 sec)
```


#### データを変更する
- `UPDATE テーブル名 SET フィールド名1=値1, フィールド名1=値1, ... WHERE 条件分;`

```
MariaDB [lesson]> UPDATE goods SET item='アボガド' WHERE id=4;
Query OK, 1 row affected (0.07 sec)
Rows matched: 1  Changed: 1  Warnings: 0

MariaDB [lesson]> SELECT * FROM goods;
+----+--------------+-------+
| id | item         | price |
+----+--------------+-------+
|  1 | おいしい水   |   190 |
|  2 | ポテトチップ |   120 |
|  3 | チョコレート |   150 |
|  4 | アボガド     |   330 |
|  5 | 食パン       |   180 |
|  6 | 米           |  2000 |
|  7 | たまねぎ     |     0 |
|  8 | NULL         | 30000 |
|  9 |              |     0 |
+----+--------------+-------+
9 rows in set (0.00 sec)
```

- 変更時にWariningが表示される

```
MariaDB [lesson]> UPDATE goods SET item='ポテトチップバターしょうゆ味' WHERE id=2;
Query OK, 1 row affected, 1 warning (0.04 sec)
Rows matched: 1  Changed: 1  Warnings: 1

MariaDB [lesson]> SELECT * FROM goods;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  1 | おいしい水           |   190 |
|  2 | ポテトチップバターし |   120 |
|  3 | チョコレート         |   150 |
|  4 | アボカド             |   330 |
|  5 | チョコパン           |   240 |
|  6 | 米                   |  2000 |
|  7 | たまねぎ             |     0 |
|  8 | NULL                 | 30000 |
|  9 |                      |     0 |
+----+----------------------+-------+
9 rows in set (0.00 sec)

```
itemフィールドの型が「CHAR(10)」であり、10文字を超える値をセットしようとしたため。  

- 文字列の中に「'」がある場合
	- 文字列をダブルクォート「"」で囲むか、「'」にエスケープ文字「\」をつけて「\'」とする

```
MariaDB [lesson]> update goods set item="カフェ'チョコ" where id=3;
Query OK, 1 row affected (0.01 sec)
Rows matched: 1  Changed: 1  Warnings: 0

MariaDB [lesson]> SELECT * FROM goods;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  1 | おいしい水           |   190 |
|  2 | ポテトチップバターし |   120 |
|  3 | カフェ'チョコ        |   150 |
|  4 | アボカド             |   330 |
|  5 | チョコパン           |   240 |
|  6 | 米                   |  2000 |
|  7 | たまねぎ             |     0 |
|  8 | NULL                 | 30000 |
|  9 |                      |     0 |
+----+----------------------+-------+
9 rows in set (0.00 sec)
```

#### データを削除する
- `DELETE FROM テーブル名 WHERE 条件分;`
	- 削除してもID名は前に詰めず、変更はない

```
MariaDB [lesson]> DELETE FROM goods WHERE id=4;
Query OK, 1 row affected (0.03 sec)

MariaDB [lesson]> SELECT * FROM goods;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  1 | おいしい水           |   190 |
|  2 | ポテトチップバターし |   120 |
|  3 | カフェ'チョコ        |   150 |
|  5 | チョコパン           |   240 |
|  6 | 米                   |  2000 |
|  7 | たまねぎ             |     0 |
|  8 | NULL                 | 30000 |
|  9 |                      |     0 |
+----+----------------------+-------+
8 rows in set (0.00 sec)
```

### スクリプトファイルの作成
- SQL文をテキストファイルに保存し、そのファイルをMariaDBに読み込ませて実行する方法
- これにより効率的にデータベース構築が可能
- 初期データの登録やテスト用DB領域の作り直しを簡単にできる

- コマンドプロンプト(Windows)からスクリプトファイルを読み込む場合
	- Shift-jisで作成しておく必要がある

```
#スクリプトファイルの中身
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
```


- スクリプトファイルの実行
	- `\(円マーク). ファイルパスとスクリプトファイル名`
	- `MariaDB [lesson]> \. C:\Users\ica\Desktop\customer.sql`


##### 条件を付けて検索する WHERE

■比較演算子

|演算子|使用例|意味|
|-|-|-|
|=|a = b|a と b は等しい|
|<=>|a <=> b|a と b は等しい(NULL対応)|
|<>|a <> b|a と b は等しくない|
|!=|a != b|a と b は等しくない|
|<|a < b|a は b よりも小さい|
|<=|a <= b|a は b よりも小さいか等しい|
|>|a > b|a は b よりも大きい|
|>=|a >= b|a は b よりも大きいか等しい|

- `MariaDB [lesson]> select * from goods where id <>6;` ⇒ idが6ではないもの

```
MariaDB [lesson]> select * from goods where id<>6;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  1 | おいしい水           |   190 |
|  2 | ポテトチップバターし |   120 |
|  3 | カフェ'チョコ        |   150 |
|  5 | チョコパン           |   240 |
|  7 | たまねぎ             |     0 |
|  8 | NULL                 | 30000 |
|  9 |                      |     0 |
+----+----------------------+-------+
```


[ポートフォリオ作成支援サイト](https://hackmd.io/s/HJD5PMBvM)  

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
