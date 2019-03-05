# 2019.3.04 企業実習

## Java Mathクラスの続き
- Math.pow(2, 8) //べき乗の計算　aのb乗
- Math.random() // 乱数を生成　引数不要

```java
package sample;

public class Sample05_02 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		double a = 30.51;
		double b = 2.68;
		System.out.println(Math.round(a/b));
		System.out.println(Math.pow(a, b));
		System.out.println(Math.min(a, b));
		System.out.println(Math.sqrt(a) + Math.sqrt(b));
		System.out.println(Math.random());
		System.out.println(Math.random());


	}

}
```

#### javaでサイコロ作るとき

- 乱数の生成　randomメソッドは0～0.59999・・を作る
- 乱数を6倍にする
- 乱数をキャストで0～5の整数にする
- それに1を足す

```
//短く書くとこれ
int a = (int)(Math.random() * 6) + 1;
System.out.println(a);
```

### inputクラス
- 標準入力待ちしてくれるクラス。本の著者が作った
- インポート
	- import lib.Input;

```java
package sample;
import lib.Input;
public class Sample05_03 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		double x = Input.getDouble();
		double s = Math.pow(x,  2);
		System.out.println("正方形の面積" + s);

		String c = Input.getString();
		System.out.println(c);

	}

}
```


- b～a+bまでの数字をランダムに出す

```java
package sample;

import lib.Input;

public class random {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		int a = Input.getInt();
		int b = Input.getInt();
		int c = (int)(Math.random() * a) + b + 1;
		System.out.println(c);



	}

}
```

### Stringクラス
- クラスには二種類ある
	- Input,Matnはクラスメソッド
	- Stirngはインスタンスメソッド
- 数値だと==で等しいか比較できるが、文字列の比較はString.equalsを使う必要がある

- 例

```
String x = "おやすみ"
"おはよう".equals(x);
// もしくは
x.equals("おはよう");
```

```java
package sample;

public class Sample05_06 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		String ss = "abAB日本語ａｂＡＢ";

		int len = ss.length();		//長さ　結果：11
		int pos = ss.indexOf('日');	//日の出現位置　結果：4
		char ch = ss.charAt(4);		//先頭から四番目の文字　結果：日
		String str = ss.toLowerCase();	//小文字変換　結果：abAB日本語ａｂＡＢ⇒abab日本語ａｂａｂ

		System.out.println("長さ=" + len);
		System.out.println("\'日\'は "+ pos + "番目");
		System.out.println("4番目の文字列は  " + ch);
		System.out.println(ss + "⇒" + str);

	}
```

```java

public class Sample05_4_4 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		String str1 = "http://localhost:8080/index.html"; 
		String str2 = str1.replace("localhost", "k-webs.jp");	//str1の文字列　localhost ⇒ k-webs.jpへ変換
		String str3 = str2.substring(7, 21);	//str2の文字列7番目から20番目まで出力
		String str4 = str3.toUpperCase();	//str3の文字列を大文字へ変換
		System.out.println("str1=" + str1);
		System.out.println("str2=" + str2);
		System.out.println("str3=" + str3);
		System.out.println("str4=" + str4);


	}

}
```

### 配列
- 配列の作り方
	- 型[] 名前 = {a, b, c};
- int[] n = {5, 12, 8, 9};
- String[] s = {"春", "夏", "秋", "冬"};

### for文
- phpとほぼほぼ一緒

```java
package sample;

public class Sample06_02_02 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		for(int i = 0; i < 5; i++){
			System.out.println("a\t");

		}
		for(int i = 0; i<3; i++){
			double r = Math.random();
			System.out.println(r);
		}

	}

}
```

- for内の処理文が一つの場合{}を省略できる

```java
package sample;

public class sample07_06 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		int[] data = {10, 20, 30, 40, 50, 60};
		for(int i= 0; i < data.length; i++)
			System.out.print(data[i] + "\t");

	}

}
```

#### プログラム構造を図(SPD)で表す
- SPD
	- Structured Programming Diagram


### 配列の要素数を返すlength

```java
package sample;

public class Sample07_01 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		int[] data = {10, 20, 30, 40, 50, 60};
		System.out.println("dataの要素数=" + data.length);

		for(int i =0 ; i<data.length; i++){	//lengthで配列の個数文for文を回せる
		System.out.print(data[i] + "\t");
	}

}
```

### 拡張for文
- 拡張for文は、カウンタ変数を使わないfor文
- 先頭から順に配列のすべての要素にアクセスするのが特徴

```java
for(型 変数:配列){
	繰り返し実行したい処理
}
int[] number = {10, 20, 30, 40, 50};
for(int n : number){
	System.out.print(n + "\t");

}
//結果：10	20	30	40	50
```

```java
		String[] str = {"abc", "def", "ghi"};
		String ss = "";
		for(int i = 0; i<str.length; i++){
			ss += str[i]
		}
		System.out.println(ss);

		//上を拡張for文で書くと↓

		String[] str = {"abc", "def", "ghi"};
		String ss = "";
		for(String str1: str){
			ss += str1;
		}
		System.out.println(ss);
	}

}

