# 2019.2.13 授業内容


## 耳より情報
- PHPのフレームワークを覚えておくと得かも
	1. Laravel
	2. CodeIgniter
	3. FuelPHP
	4. CakePHP, etc....

## MariaDBの続き

### 条件を付けて検索する WHEREの続き

#### 範囲 BETWEEN

BETWEENは値の班員を指定して検索することができる

- `WHERE フィールド名 BETWEEN 値 AND 値;`

```
MariaDB [lesson]> SELECT * FROM goods WHERE id BETWEEN 2 AND 5;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  2 | ポテトチップバターし |   120 |
|  3 | カフェ'チョコ        |   150 |
|  5 | チョコパン           |   240 |
+----+----------------------+-------+
3 rows in set (0.05 sec)
```

#### 条件を組み合わせる AND/OR/NOT

|論理演算子|内容|
|-|-|
|AND|複数の条件を全て満たすレコードの検索|
|OR|複数の条件のどれかを満たすレコードの検索|
|NOT|条件を反転させる|


- idが2以上、かつpriceが200未満↓

```
MariaDB [lesson]> SELECT * FROM goods WHERE id>=2 AND price<200;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  2 | ポテトチップバターし |   120 |
|  3 | カフェ'チョコ        |   150 |
|  7 | たまねぎ             |     0 |
|  9 |                      |     0 |
+----+----------------------+-------+
4 rows in set (0.07 sec)
```


- idが2未満、もしくはpriceが2000以上↓

```
MariaDB [lesson]> SELECT * FROM goods WHERE id<2 or price>=2000;
+----+------------+-------+
| id | item       | price |
+----+------------+-------+
|  1 | おいしい水 |   190 |
|  6 | 米         |  2000 |
|  8 | NULL       | 30000 |
+----+------------+-------+
3 rows in set (0.00 sec)
```

##### 同じフィールドに対して複数の値を指定する

- `SELECT * FROM goods WHERE id=1 or id=2 or id=6;` ⇒ これだと煩わしいため以下の記述が可能
↓
- `SELECT * FROM goods WHERE id IN(1, 2, 6);` ⇒ id1か2か6を検索

```
MariaDB [lesson]> SELECT * FROM goods WHERE id IN(1, 2, 6);
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  1 | おいしい水           |   190 |
|  2 | ポテトチップバターし |   120 |
|  6 | 米                   |  2000 |
+----+----------------------+-------+
3 rows in set (0.01 sec)
```

##### 条件を反転させる
- `WHERE NOT 条件;`：指定したレコード以外検索

```
MariaDB [lesson]> SELECT * FROM goods WHERE NOT id IN(1, 2, 6);
+----+---------------+-------+
| id | item          | price |
+----+---------------+-------+
|  3 | カフェ'チョコ |   150 |
|  5 | チョコパン    |   240 |
|  7 | たまねぎ      |     0 |
|  8 | NULL          | 30000 |
|  9 |               |     0 |
+----+---------------+-------+
5 rows in set (0.00 sec)
```


##### 部分一致検索 LIKE
- 部分一致検索はキーワード検索とも呼ばれ、指定したキーワードを含んだレコードが検索される
	- `WHERE フィールド名 LIKE 部分一致検索;`
	- **任意の文字列をあらわす「%」**

- 前方一致
	- 「'キーワード%'」で前方一致検索ができる

```
MariaDB [lesson]> SELECT * FROM customer WHERE name LIKE '木村%';
+----+------------+---------+
| id | name       | address |
+----+------------+---------+
|  3 | 木村大五郎 | 北海道  |
|  5 | 木村太郎   | 大阪府  |
+----+------------+---------+
2 rows in set (0.02 sec)
```
- 後方一致
	- 「'%キーワード'」で後方一致検索ができる

```
MariaDB [lesson]> SELECT * FROM customer WHERE address LIKE '%県';
+----+------------------+----------+
| id | name             | address  |
+----+------------------+----------+
|  2 | Shaquille O'Neal | 栃木県   |
|  6 | 佐々木美樹       | 和歌山県 |
+----+------------------+----------+
2 rows in set (0.00 sec)
```

- 部分一致
	- 「'%キーワード%'」で部分一致検索ができる
	- キーワードの前後に0文字以上の任意の文字列があるレコードが検索対象

```
MariaDB [lesson]> SELECT * FROM customer WHERE name LIKE '%木%';
+----+------------+----------+
| id | name       | address  |
+----+------------+----------+
|  3 | 木村大五郎 | 北海道   |
|  5 | 木村太郎   | 大阪府   |
|  6 | 佐々木美樹 | 和歌山県 |
+----+------------+----------+
3 rows in set (0.00 sec)
```

##### 任意の1文字をあらわす「_(アンダースコア)」
- 「木村_郎」は「木村太郎」や「木村次郎」にはマッチする
- 「木村大五郎」にはマッチしない

```
MariaDB [lesson]> SELECT * FROM customer WHERE name LIKE '木村_郎';
+----+----------+---------+
| id | name     | address |
+----+----------+---------+
|  5 | 木村太郎 | 大阪府  |
+----+----------+---------+
1 row in set (0.00 sec)
```


###### 「%」や「_」を含む文字列を検索
- 「%」や「_」を含む文字列を検索する場合はエスケープ文字「\」を使う
	-「\%」と書けば「%」を検索可能

**正規表現による検索はDB側では基本使用しない。PHP側で登録前に処理するのが通例。  
DBの正規表現での日本語検索が弱いため。**


##### 検索件数の制限 LIMIT
- 検索結果

```
MariaDB [lesson]> SELECT * FROM goods LIMIT 5;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  1 | おいしい水           |   190 |
|  2 | ポテトチップバターし |   120 |
|  3 | カフェ'チョコ        |   150 |
|  5 | チョコパン           |   240 |
|  6 | 米                   |  2000 |
+----+----------------------+-------+
5 rows in set (0.00 sec)
```


- 検索結果をGoogleみたいに複数ページにわたって検索結果を出力したい
	- 1ページに10件表示するとして
		- 1ページ目：SELECT * FROM goods LIMIT 0,10; ⇒ 0から始めて10件分
		- 2ページ目：SELECT * FROM goods LIMIT 10,10; ⇒ 10から始めて10件分
		- 3ページ目：SELECT * FROM goods LIMIT 20,10; ⇒ 20から始めて10件分



#### 並べ替え ORDER BY
- ORDER BY を使うことによって検索結果の並べ替えが可能。
- ランキング表示や最新表示の検索などに活躍
	- ORDER BY フィールド名;
	- 以下はpriceの低い順

```
MariaDB [lesson]> SELECT * FROM goods ORDER BY price;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  7 | たまねぎ             |     0 |
|  9 |                      |     0 |
|  2 | ポテトチップバターし |   120 |
|  3 | カフェ'チョコ        |   150 |
|  1 | おいしい水           |   190 |
|  5 | チョコパン           |   240 |
|  6 | 米                   |  2000 |
|  8 | NULL                 | 30000 |
+----+----------------------+-------+
8 rows in set (0.00 sec)
```

- 降順にしたい場合「DESC」をつける

```
MariaDB [lesson]> SELECT * FROM goods ORDER BY price DESC;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  8 | NULL                 | 30000 |
|  6 | 米                   |  2000 |
|  5 | チョコパン           |   240 |
|  1 | おいしい水           |   190 |
|  3 | カフェ'チョコ        |   150 |
|  2 | ポテトチップバターし |   120 |
|  7 | たまねぎ             |     0 |
|  9 |                      |     0 |
+----+----------------------+-------+
8 rows in set (0.00 sec)
```

■問題：価格が500円以下の商品を安い順に表示

```
MariaDB [lesson]> SELECT * FROM goods WHERE price<=500 ORDER BY price;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  7 | たまねぎ             |     0 |
|  9 |                      |     0 |
|  2 | ポテトチップバターし |   120 |
|  3 | カフェ'チョコ        |   150 |
|  1 | おいしい水           |   190 |
|  5 | チョコパン           |   240 |
+----+----------------------+-------+
6 rows in set (0.00 sec)
```

- さらに検索結果から3件表示

```
MariaDB [lesson]> SELECT * FROM goods WHERE price<=500 ORDER BY price LIMIT 3;
+----+----------------------+-------+
| id | item                 | price |
+----+----------------------+-------+
|  9 |                      |     0 |
|  7 | たまねぎ             |     0 |
|  2 | ポテトチップバターし |   120 |
+----+----------------------+-------+
3 rows in set (0.00 sec)
```

#### 計算や集計
- 合計値の出力（SUM）
	- `SELECT SUM(合計値を出力するフィールド名) FROM テーブル名;`
	- priceの合計値取得は以下

```
MariaDB [lesson]> SELECT SUM(price) FROM goods;
+------------+
| SUM(price) |
+------------+
|      32700 |
+------------+
1 row in set (0.00 sec)
```

#### 該当件数を取り出す(COUNT)
- SELECT COUNT(該当件数を出力するフィールド名) FROM テーブル名;
	- **中身がNULL値をもつレコードはカウントされない**

```
MariaDB [lesson]> SELECT COUNT(id) FROM goods;
+-----------+
| COUNT(id) |
+-----------+
|         8 |
+-----------+
1 row in set (0.00 sec)
```


#### フィールドに別名をつける(AS)
- 「AS」を使うとフィールド名を一時的に別名に変更できる
	- フィールド名が変更されたわけではない
	- `SELECT フィールド名 AS 別名 FROM テーブル名;`

```
MariaDB [lesson]> SELECT COUNT(id) AS total FROM goods;
+-------+
| total |
+-------+
|     8 |
+-------+
1 row in set (0.00 sec)
```

##### データのグループ化(GROPU BY)
以下はたまねぎをまとめて表示している

```
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
| 10 | たまねぎ             |     0 |
| 11 | たまねぎ             |     0 |
| 12 | たまねぎ             |     0 |
| 13 | たまねぎ             |     0 |
+----+----------------------+-------+
11 rows in set (0.00 sec)

MariaDB [lesson]> SELECT item, COUNT(item) FROM goods GROUP BY item;
+----------------------+-------------+
| item                 | COUNT(item) |
+----------------------+-------------+
| NULL                 |           0 |
| おいしい水           |           1 |
| たまねぎ             |           5 |
| カフェ'チョコ        |           1 |
| チョコパン           |           1 |
| ポテトチップバターし |           1 |
| 米                   |           1 |
+----------------------+-------------+
7 rows in set (0.00 sec)
```

#### テーブルの構成を変更する ALTER TABLE
- フィールドの追加
	- ALTER TABLE テーブル名 ADD フィールド名 型 DEFAULT 値;
	- 以下はstockフィールドを追加

```
MariaDB [lesson]> ALTER TABLE goods ADD stock INT DEFAULT 0;
Query OK, 0 rows affected (0.23 sec)
Records: 0  Duplicates: 0  Warnings: 0

MariaDB [lesson]> SHOW COLUMNS FROM goods;
+-------+----------+------+-----+---------+----------------+
| Field | Type     | Null | Key | Default | Extra          |
+-------+----------+------+-----+---------+----------------+
| id    | int(11)  | NO   | PRI | NULL    | auto_increment |
| item  | char(10) | YES  |     | NULL    |                |
| price | int(11)  | YES  |     | 0       |                |
| stock | int(11)  | YES  |     | 0       |                |
+-------+----------+------+-----+---------+----------------+
4 rows in set (0.01 sec)

MariaDB [lesson]> SELECT * FROM goods;
+----+----------------------+-------+-------+
| id | item                 | price | stock |
+----+----------------------+-------+-------+
|  1 | おいしい水           |   190 |     0 |
|  2 | ポテトチップバターし |   120 |     0 |
|  3 | カフェ'チョコ        |   150 |     0 |
|  5 | チョコパン           |   240 |     0 |
|  6 | 米                   |  2000 |     0 |
|  7 | たまねぎ             |     0 |     0 |
|  8 | NULL                 | 30000 |     0 |
| 10 | たまねぎ             |     0 |     0 |
| 11 | たまねぎ             |     0 |     0 |
| 12 | たまねぎ             |     0 |     0 |
| 13 | たまねぎ             |     0 |     0 |
+----+----------------------+-------+-------+
11 rows in set (0.00 sec)
```

#### フィールドのデータ型の変更(MODIFY)
- `ALTER TABLE テーブル名 MODIFY フィールド名 新しい型;`
	- 以下はitemフィールドの文字数を20文字へ変更

```
MariaDB [lesson]> ALTER TABLE goods MODIFY item CHAR(20);
Query OK, 11 rows affected (0.30 sec)
Records: 11  Duplicates: 0  Warnings: 0

MariaDB [lesson]> UPDATE goods SET item='ポテトチップバターしょうゆ味' WHERE id=2;
Query OK, 1 row affected (0.03 sec)
Rows matched: 1  Changed: 1  Warnings: 0

MariaDB [lesson]> SELECT * FROM goods;
+----+------------------------------+-------+-------+---------+
| id | item                         | price | stock | KEYWORD |
+----+------------------------------+-------+-------+---------+
|  1 | おいしい水                   |   190 |     0 | NULL    |
|  2 | ポテトチップバターしょうゆ味 |   120 |     0 | NULL    |
|  3 | カフェ'チョコ                |   150 |     0 | NULL    |
|  5 | チョコパン                   |   240 |     0 | NULL    |
|  6 | 米                           |  2000 |     0 | NULL    |
|  7 | たまねぎ                     |     0 |     0 | NULL    |
|  8 | NULL                         | 30000 |     0 | NULL    |
| 10 | たまねぎ                     |     0 |     0 | NULL    |
| 11 | たまねぎ                     |     0 |     0 | NULL    |
| 12 | たまねぎ                     |     0 |     0 | NULL    |
| 13 | たまねぎ                     |     0 |     0 | NULL    |
+----+------------------------------+-------+-------+---------+
11 rows in set (0.00 sec)

```

###### 255字以上の値を管理したい場合
CAHRA型は最大255文字までしか保持できないので、それ以上の長さの文字列を保持したいときは  
VARCAHR型、またはTEXT型に変更する

■特徴として
- CAHRA型は検索が早い。文字列の箱の長さを指定するため
- VARCAHAR型は箱の長さを決めないため検索は遅いが、最近はサーバーのスペックが上がっているので問題なし
- TEX型は通常検索対象にはしない。長い文字列を保存できるため



- フィールド名とデータ型の変更(CHANGE)

```
MariaDB [lesson]> ALTER TABLE goods CHANGE item item_name VARCHAR(255);
Query OK, 11 rows affected (0.27 sec)
Records: 11  Duplicates: 0  Warnings: 0

MariaDB [lesson]> SELECT * FROM goods;
+----+------------------------------+-------+-------+---------+
| id | item_name                    | price | stock | keyword |
+----+------------------------------+-------+-------+---------+
|  1 | おいしい水                   |   190 |     0 | NULL    |
|  2 | ポテトチップバターしょうゆ味 |   120 |     0 | NULL    |
|  3 | カフェ'チョコ                |   150 |     0 | NULL    |
|  5 | チョコパン                   |   240 |     0 | NULL    |
|  6 | 米                           |  2000 |     0 | NULL    |
|  7 | たまねぎ                     |     0 |     0 | NULL    |
|  8 | NULL                         | 30000 |     0 | NULL    |
| 10 | たまねぎ                     |     0 |     0 | NULL    |
| 11 | たまねぎ                     |     0 |     0 | NULL    |
| 12 | たまねぎ                     |     0 |     0 | NULL    |
| 13 | たまねぎ                     |     0 |     0 | NULL    |
+----+------------------------------+-------+-------+---------+
11 rows in set (0.00 sec)

```
- フィールドの削除

```
MariaDB [lesson]> ALTER TABLE goods DROP keyword;
Query OK, 0 rows affected (0.19 sec)
Records: 0  Duplicates: 0  Warnings: 0

MariaDB [lesson]> SELECT * FROM goods;
+----+------------------------------+-------+-------+
| id | item                         | price | stock |
+----+------------------------------+-------+-------+
|  1 | おいしい水                   |   190 |     0 |
|  2 | ポテトチップバターしょうゆ味 |   120 |     0 |
|  3 | カフェ'チョコ                |   150 |     0 |
|  5 | チョコパン                   |   240 |     0 |
|  6 | 米                           |  2000 |     0 |
|  7 | たまねぎ                     |     0 |     0 |
|  8 | NULL                         | 30000 |     0 |
| 10 | たまねぎ                     |     0 |     0 |
| 11 | たまねぎ                     |     0 |     0 |
| 12 | たまねぎ                     |     0 |     0 |
| 13 | たまねぎ                     |     0 |     0 |
+----+------------------------------+-------+-------+
11 rows in set (0.00 sec)


```

- テーブル名の変更(RENAME AS)

```
MariaDB [lesson]> ALTER TABLE goods RENAME AS commodity;
Query OK, 0 rows affected (0.09 sec)

MariaDB [lesson]> SHOW TABLES;
+------------------+
| Tables_in_lesson |
+------------------+
| commodity        |
| customer         |
| trader           |
+------------------+
3 rows in set (0.00 sec)
```

### リレーション
- 例えばitemが複数あったとして、仕入元のメーカーは2、3社の場合、仕入元のフィールドを追加しても  
重複した値がフィールドにいくつも入ることとなる。
- そういった重複を避け、仕入元業者のテーブルを作成し、テーブルとテーブルを結びつける

1. makerフィールドを作成

```
MariaDB [lesson]> ALTER TABLE commodity ADD maker INT;
MariaDB [lesson]> SELECT * FROM commodity;
+----+----------------------+-------+-------+
| id | item                 | price | maker |
+----+----------------------+-------+-------+
|  1 | おいしい水           |   190 |  NULL |
|  2 | ポテトチップバターし |   120 |  NULL |
|  3 | カフェ'チョコ        |   150 |  NULL |
|  5 | チョコパン           |   240 |  NULL |
|  6 | 米                   |  2000 |  NULL |
|  7 | たまねぎ             |     0 |  NULL |
|  8 | NULL                 |  9800 |  NULL |
+----+----------------------+-------+-------+
7 rows in set (0.00 sec)

MariaDB [lesson]> SELECT * FROM trader;
+----+--------------+---------+--------------+
| id | company      | address | tel          |
+----+--------------+---------+--------------+
|  1 | 東京パン     | 東京都  | 03-0000-0000 |
|  2 | 宇都宮米店   | 栃木県  | 028-111-1111 |
|  3 | 札幌農場     | 北海道  | 011-222-2222 |
|  4 | 浦安製菓     | 千葉県  | 047-XXX-3333 |
|  5 | ハイサイパン | 沖縄県  | 098-444-XXXX |
|  6 | 出雲ファーム | 島根県  | 0853-55-5555 |
+----+--------------+---------+--------------+
6 rows in set (0.03 sec)
```
2. makerフィールドにメーカーのid番号を追加

```
MariaDB [lesson]> UPDATE commodity SET maker=3 WHERE id=1;
Query OK, 0 rows affected (0.04 sec)
Rows matched: 1  Changed: 0  Warnings: 0

MariaDB [lesson]> UPDATE commodity SET maker=4 WHERE id=2;
Query OK, 0 rows affected (0.02 sec)
Rows matched: 1  Changed: 0  Warnings: 0
.
.
.

MariaDB [lesson]> SELECT * FROM commodity;
+----+----------------------+-------+-------+
| id | item                 | price | maker |
+----+----------------------+-------+-------+
|  1 | おいしい水           |   190 |     3 |
|  2 | ポテトチップバターし |   120 |     4 |
|  3 | カフェ'チョコ        |   150 |     4 |
|  5 | チョコパン           |   240 |     1 |
|  6 | 米                   |  2000 |     2 |
|  7 | たまねぎ             |     0 |  NULL |
|  8 | NULL                 |  9800 |  NULL |
+----+----------------------+-------+-------+
7 rows in set (0.00 sec)

```
3. テーブルを結合する
- 書式1
	- `SELECT フィールド名 FROM テーブル名1 JOIN テーブル名2 ON テーブル1の照合用フィールド名 = テーブル2の照合用フィールド名;`


```
MariaDB [lesson]> SELECT * FROM commodity JOIN trader ON commodity.maker = trader.id;
+----+----------------------+-------+-------+----+------------+---------+--------------+
| id | item                 | price | maker | id | company    | address | tel          |
+----+----------------------+-------+-------+----+------------+---------+--------------+
|  5 | チョコパン           |   240 |     1 |  1 | 東京パン   | 東京都  | 03-0000-0000 |
|  6 | 米                   |  2000 |     2 |  2 | 宇都宮米店 | 栃木県  | 028-111-1111 |
|  1 | おいしい水           |   190 |     3 |  3 | 札幌農場   | 北海道  | 011-222-2222 |
|  2 | ポテトチップバターし |   120 |     4 |  4 | 浦安製菓   | 千葉県  | 047-XXX-3333 |
|  3 | カフェ'チョコ        |   150 |     4 |  4 | 浦安製菓   | 千葉県  | 047-XXX-3333 |
+----+----------------------+-------+-------+----+------------+---------+--------------+
5 rows in set (0.00 sec)
```


- 書式2
	- `SELECT フィールド名 FROM テーブル名1, テーブル名2 WHERE テーブル1の照合用フィールド名 = テーブル2の照合用フィールド名;`

```
MariaDB [lesson]> SELECT * FROM commodity, trader WHERE commodity.maker = trader.id;
+----+----------------------+-------+-------+----+------------+---------+--------------+
| id | item                 | price | maker | id | company    | address | tel          |
+----+----------------------+-------+-------+----+------------+---------+--------------+
|  5 | チョコパン           |   240 |     1 |  1 | 東京パン   | 東京都  | 03-0000-0000 |
|  6 | 米                   |  2000 |     2 |  2 | 宇都宮米店 | 栃木県  | 028-111-1111 |
|  1 | おいしい水           |   190 |     3 |  3 | 札幌農場   | 北海道  | 011-222-2222 |
|  2 | ポテトチップバターし |   120 |     4 |  4 | 浦安製菓   | 千葉県  | 047-XXX-3333 |
|  3 | カフェ'チョコ        |   150 |     4 |  4 | 浦安製菓   | 千葉県  | 047-XXX-3333 |
+----+----------------------+-------+-------+----+------------+---------+--------------+
5 rows in set (0.00 sec)
```

- ※makerは両テーブルに一つしかなく重複していないため、省略は可能だが記述したほうがわかりやすい  
	- 例）MariaDB [lesson]> SELECT * FROM commodity JOIN trader ON maker = trader.id;

###### テーブル名のショートカット
- 照合用フィールドに毎回テーブル名を書くと長いSQL文になりがち。次のようにショートカットを使って短くすることができる。
	- この一文の中だけ

```
MariaDB [lesson]> SELECT * FROM commodity c, trader t WHERE c.maker = t.id;
+----+----------------------+-------+-------+----+------------+---------+--------------+
| id | item                 | price | maker | id | company    | address | tel          |
+----+----------------------+-------+-------+----+------------+---------+--------------+
|  5 | チョコパン           |   240 |     1 |  1 | 東京パン   | 東京都  | 03-0000-0000 |
|  6 | 米                   |  2000 |     2 |  2 | 宇都宮米店 | 栃木県  | 028-111-1111 |
|  1 | おいしい水           |   190 |     3 |  3 | 札幌農場   | 北海道  | 011-222-2222 |
|  2 | ポテトチップバターし |   120 |     4 |  4 | 浦安製菓   | 千葉県  | 047-XXX-3333 |
|  3 | カフェ'チョコ        |   150 |     4 |  4 | 浦安製菓   | 千葉県  | 047-XXX-3333 |
+----+----------------------+-------+-------+----+------------+---------+--------------+
5 rows in set (0.00 sec)
```


### テーブルの結合：外部結合 LEFT JOIN, RIGHT JOIN
- 上記の内部結合の場合、照合できないレコードは表示されない
- 外部結合を使用すると照合できなかったレコードも表示させることができる
- ほぼ左外部結合しか使わない

- 左外部結合
	- 左のテーブルを全て表示したうえで、右テーブルと結合する。

```
MariaDB [lesson]> SELECT * FROM commodity LEFT JOIN trader ON commodity.maker = trader.id;
+----+----------------------+-------+-------+------+------------+---------+--------------+
| id | item                 | price | maker | id   | company    | address | tel          |
+----+----------------------+-------+-------+------+------------+---------+--------------+
|  1 | おいしい水           |   190 |     3 |    3 | 札幌農場   | 北海道  | 011-222-2222 |
|  2 | ポテトチップバターし |   120 |     4 |    4 | 浦安製菓   | 千葉県  | 047-XXX-3333 |
|  3 | カフェ'チョコ        |   150 |     4 |    4 | 浦安製菓   | 千葉県  | 047-XXX-3333 |
|  5 | チョコパン           |   240 |     1 |    1 | 東京パン   | 東京都  | 03-0000-0000 |
|  6 | 米                   |  2000 |     2 |    2 | 宇都宮米店 | 栃木県  | 028-111-1111 |
|  7 | たまねぎ             |     0 |  NULL | NULL | NULL       | NULL    | NULL         |
|  8 | NULL                 |  9800 |  NULL | NULL | NULL       | NULL    | NULL         |
+----+----------------------+-------+-------+------+------------+---------+--------------+
7 rows in set (0.00 sec)
```

- 右外部結合
	- 出番なし。念のため出力結果↓

```
MariaDB [lesson]> SELECT * FROM commodity RIGHT JOIN trader ON commodity.maker = trader.id;
+------+----------------------+-------+-------+----+--------------+---------+--------------+
| id   | item                 | price | maker | id | company      | address | tel          |
+------+----------------------+-------+-------+----+--------------+---------+--------------+
|    1 | おいしい水           |   190 |     3 |  3 | 札幌農場     | 北海道  | 011-222-2222 |
|    2 | ポテトチップバターし |   120 |     4 |  4 | 浦安製菓     | 千葉県  | 047-XXX-3333 |
|    3 | カフェ'チョコ        |   150 |     4 |  4 | 浦安製菓     | 千葉県  | 047-XXX-3333 |
|    5 | チョコパン           |   240 |     1 |  1 | 東京パン     | 東京都  | 03-0000-0000 |
|    6 | 米                   |  2000 |     2 |  2 | 宇都宮米店   | 栃木県  | 028-111-1111 |
| NULL | NULL                 |  NULL |  NULL |  5 | ハイサイパン | 沖縄県  | 098-444-XXXX |
| NULL | NULL                 |  NULL |  NULL |  6 | 出雲ファーム | 島根県  | 0853-55-5555 |
+------+----------------------+-------+-------+----+--------------+---------+--------------+
7 rows in set (0.00 sec)
```


#### 新規ユーザーの追加（権限追加）GRANT
- `GRANT 権限1, 権限2, ON データベース領域名.テーブル名 TO ユーザ名＠ホスト名 IDENTFIED BY パスワード;`
- ユーザ名の後ろに「@localhost」とするとlocalhost上からのみ接続できる
- 「＠localhost」を省略するとlocalhost以外からそのユーザでアクセスできるようになる。

|代表的な権限|権限|実行可能コマンド|
|-|-|-|
|ALL PRIVILEGES|全ての権限||
|CREATE|データベース・テーブルの作成|CREATE DATABASE, VREATE TABLE|
|CREATE USER|ユーザ作成|CREAT USER|
|DROP|データベース・テーブルの削除|DROP DATABASE, DROP TABLE|
|SELECT|テーブルの参照|SELECT|
|INSERT|テーブルのレコード追加|INSERT|
|UPDATE|テーブルのレコード変更|UPDATE|
|DELETE|テーブルのレコード削除|DELETE|



```
MariaDB [lesson]> GRANT SELECT, INSERT ON lesson.commodity TO DBWriter@localhost IDENTIFIED BY 'kakikomi';
Query OK, 0 rows affected (0.02 sec)

//DBWriterでログイン
ica@B101-21 c:\users\ica\desktop\xammp
# mysql -u DBWriter -p
Enter password: ********

MariaDB [(none)]> SHOW DATABASES;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| lesson             |
| test               |
+--------------------+
3 rows in set (0.01 sec)

MariaDB [(none)]> use lesson
Database changed
MariaDB [lesson]> show tables;
+------------------+
| Tables_in_lesson |
+------------------+
| commodity        |
+------------------+
1 row in set (0.00 sec)


```

#### ユーザ情報を表示
- SELECT * FROM mysql.user;
	- これだと横に長い結果が表示され、見づらい
	- そのためuserとhostフィールドのみ絞って表示

```
MariaDB [(none)]> SELECT user, host FROM mysql.user;
+--------------+-----------+
| user         | host      |
+--------------+-----------+
| root         | 127.0.0.1 |
| root         | ::1       |
|              | localhost |
| DBWriter     | localhost |
| LessonMaster | localhost |
| pma          | localhost |
| root         | localhost |
+--------------+-----------+
7 rows in set (0.00 sec)
```
##### ユーザの権限を表示する
- `SHOW GRANTS FOR ユーザ名@ホスト名;`

```
MariaDB [lesson]> SHOW GRANTS FOR DBWriter@localhost;
+-----------------------------------------------------------------------------------------------------------------+
| Grants for DBWriter@localhost                                                                                   |
+-----------------------------------------------------------------------------------------------------------------+
| GRANT USAGE ON *.* TO 'DBWriter'@'localhost' IDENTIFIED BY PASSWORD '*F421F70D14B5D1AB821B64221781C67E7FCD9027' |
| GRANT SELECT, INSERT ON `lesson`.`commodity` TO 'DBWriter'@'localhost'                                          |
+-----------------------------------------------------------------------------------------------------------------+
2 rows in set (0.00 sec)
```

###### ユーザ削除 DROP USER
- `DROP USER ユーザ名@ホスト名;`

```
MariaDB [lesson]> DROP USER DBWriter@localhost;
Query OK, 0 rows affected (0.03 sec)

MariaDB [lesson]> SELECT user, host FROM mysql.user;
+--------------+-----------+
| user         | host      |
+--------------+-----------+
| root         | 127.0.0.1 |
| root         | ::1       |
|              | localhost |
| LessonMaster | localhost |
| pma          | localhost |
| root         | localhost |
+--------------+-----------+
6 rows in set (0.00 sec)
```

#### phpMyAdminの設定
- phpMyAdminはMySQLサーバーをウェブブラウザで管理するためのデータベース接続クライアントツールで、PHPで実装されている。 
- xampp\phpMyAdmin\config.inc.phpの21行目
	- $cfg['Servers'][$i]['password'] = '';にパスワードを入力し上書きする
	- phpMyAdminがMySQLへ接続するときのアカウント設定となる
- http://localhost/phpmyadmin/ へアクセス


##### データベース領域のバックアップ
- phpMyadminを使ってテーブルをエクスポートしてバックアップすることができる
	- エクスポートメニュー⇒ラジオボタン「詳細 - 可能なオプションをすべて表示」を選択
		- チェックボックス：CREATE DATABASE / USE コマンドを追加するをonにするとインポート時にDBも自動追加してくれる。
		- 書き出し形式はとりあえずSQL
- lessonDB領域を削除⇒上記で書きだしたファイルをエクスポートすると復旧する


## MariaDB+PHP
- PHPとMariaDBを連携させてWebシステムを作成する。
	1. データベース領域とテーブルの作成
		- データベース名：practice
		- テーブル名：stationary, trader
	2. ユーザーを作成
		- Tanaka/Manager を作成
			- GRANT all on practice.* to Tanaka@localhost identified by 'Manager';


[ポートフォリオ作成支援サイト](https://hackmd.io/s/HJD5PMBvM)  

[jobtec](http://jobtech.jp/dl/)  
<a href="#">topへ</a>  
[ホーム](http://www.lamplus.ml/)
