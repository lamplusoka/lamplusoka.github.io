# 2019.3.01 企業実習

### Javaが浸透した背景
- オブジェクト指向が出来るようになった初期の言語
- そのためオブジェクト（部品）を分けて開発が可能となった
    - つまりグループ分けして作業が可能 

#### COBOLが残っている理由
- 数字に強い
- 一切数字を落とさない、丸め込まない
- そのため銀行系などに使われている

### Eclipse
- preiadesの中に入っているツール
- 無料、エラーを出してくれる
- preidadesはeclipseの日本化ツールを同梱している
    - pleadesのサイトにいってJavaのフルパッケージをインストールするだけ
    - 企業実習はバージョンIndigo3.7を使用。安定しているため
    
- プロジェクトとパッケージ
    - プロジェクト作成→パッケージ作成→プログラム作成の順
- プロジェクトの作成
    - ファイル→新規→Javaプロジェクト→名前を付けて完了
- 新規Javaクラスは大文字からスタート
    - public static void mainにチェックを付けて完了
    - チェックを付けることによりデフォルトで「public static void main」が挿入されたJavaファイルができる
    - mainにctr+spaceｓで「public static void main」が挿入できる
- パッケージ名やクラス名を修正する際は右クリックから「リファクタリング」すること
    
## Java
- Java言語は命令語をメソッドという
- 具体的な値をリテラルという

```java
package sample; // パッケージ文

public class Sample01_01 { // クラス宣言

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// 「public static void main(String[] args)」がメインメソッド、プログラム始まりますよの意味
		// これはお決まりで覚える
		// TODO 自動生成されたメソッド・スタブ
		// 命令文はメソッドの中に記述（mainはメインメソッドの中）
		System.out.println("Hello World.");
		System.out.print("Hello ladys.");
		// printlnの「ln」は改行の意味。printで改行なし
		// 命令語の先頭は必ず大文字

		// System.out.printlnのショートカット「syso→ctr+スペース」
		System.out.println("eclips");
		System.err.println("エラーです");
		// エラー表示をさせるメソッド、標準エラー出力。ショートカット「syse」
		/**
		 * 実行のショートカットはJavadocと呼ばれるこめんとアウト文
		 */
		// {}で囲まれた範囲をブロック
		// ctrl+fキーで自動フォーマット、インデントなどを揃えてくれる

	}

}
```

### データ型
- よく使うやつ
- 整数型
    - int(+-20億位),long(すごい桁数)
- 浮動小数点型
    - double
- 文字型
    - char
        - 一文字、シングルコーテーションで囲む 'あ'
- 真偽(倫理)型
    - boolean
- 文字列型
    - string
        - 複数文字、ダブルクォーテーションで囲む "あ"、" "(スペース)、""(空文字)も文字列型
        
```java
		System.out.println('あ');
		System.out.println('\u3042');
        int num = 'あ';
		System.out.println(num);

/** 出力結果
*あ
*あ
*12354
*/
```
- 上記の例、文字は裏で数字を持っているということ

- エスケープ文字
    - \n 改行
    - \t タブ
    - \" ダブルクォーテーション、などなどよく使う
    - 例）`System.out.println("わたしは\"おはよう\"といった");`
    
#### 変数
- 型 変数名;
    - int num;
- もしくは 型 変数名 = 10;
    - int num = 10;
    - 同じ変数名の宣言は不可
    - 型が違う場合も同じ変数名の宣言は不可
- 異なる型の変数を同時に宣言はできない
    - `int a, double b;` → これはNG
- 同じ変数名に再代入する場合は 変数名;
- 変数名の大文字小文字の区別がされる
    - 使える記号は_（アンダーバー）と$（ドルマーク）　の二つのみ
- 予約語
    - Java言語の中でキーワードとして予約されている単語。そのために変数には使えない

- まとめ
    - クラス名の先頭文字は大文字
        - `public class Sample03_03 {`
    - パッケージ名、変数名、メソッド名は小文字
    
```java
package sample;

public class Sample03_04 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		int number = 10;
		number = number + 1;
		// 右辺のnmber(10)に1を足してnumberに代入するからnumberは11となる
		int n, m, p;
		//同じ型の複数の変数を同時に宣言する
		int n = 10;
		//宣言時に初期化
		int n=10, m, p;
		//複数の宣言で一部の変数のみ初期化する
		int a = 10;
		int b = a+5, c;
		//こんな宣言もあり
        

	}
```

#### 自動型変換
- double x = 15 // 15.0に自動型変換されて代入される
- double x = 3.5;
　double y = x+2; // 2は2.0に自動型変換されて計算に使われる
- 整数型の値は、浮動小数型に自動変換できる
- 浮動小数型は、整数型に自動変換できない

#### キャスト演算子
サイズが小さい型から大きい型へ変換する場合、単に代入を行うだけで自動的に型の変換が行われていましたが、  
型の変換を明示的に行う場合にはキャスト演算子を使います。  
キャスト演算子の書式は次の通りです。
- 受け取る変数型 変数名 = (変換先の型)キャストの対象
    - int number = (int)10.5;  //numberには10がセットされる
    - float x = (float)1.234;  //xには1.2354fがセットされる
    - `float num = 5.5;
    int x = (int)num;`のような使い方。xには5が代入される
    - 上記のように大きい型を小さい方へ変更すると情報(0.5)が無くなるため、プログラマーの責任でキャストする

- 数値を文字列に、文字列を数値にはキャストで変換できない
```java
String str = (String)100;  //これはエラーになる
String str2 = ""+100; //これは文字列になる

int num = (int)"100"; //これはエラーになる
int num2 = Integer.parseInt("10000"); // これは数値になる
```

- boolean型はキャストできない
    - booleanから他の型、他の型からboolean両方ともできない
- String型にString型ではない変数を連結すると、どんな型もString型になる

#### 複合代入演算子
- a += x  →　a = a + x と同じ
- 初期化に注意,下記はエラーになる。aには予め0などの数値を代入しておく必要がある
```java
int a;
 a +=5 ;
```    

### 基本ライブラリの利用
PHPやJavaScriptと同じ考え方
```java
public class Sample05_01 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		double x = Math.sqrt(2.0);  //クラス名.メソッド名という形で使用
		System.out.println("2.0の平方根=" + x);

	}
```
##### sqrtメソッドのAPI
- Mathクラス
    - public static double sqrt(double a)
- public
    - 利用に制限がないことを示す
- static
    - sqrtがクラスメソッドであることを表す
- double
    - 引数の型
- a
    - 仮引数
