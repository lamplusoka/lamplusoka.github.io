# 2019.3.06 企業実習

### エンジニア業界について
- 製造2割
- 資料作成、ミーティング　4割
- テスト 4割

## Java メソッド
- メソッド
	- 自前のもの
	- 部品
		- 一つの機能もしくは機能群
	- 誰でもいつでも使える汎用部品
	- 1人で作るような小規模では特にメリットなし
- 定義と使用の違い
	- まず使用のイメージを持つのが大事
- どこまでの機能を持たせるか（設計段階）
	- 他の部品との兼ね合いがメソッドの非常に難しいところ
- どんなプログラムでも最初に実行されるメソッドはmainメソッドと決まっている
- 簡単なメソッド以下
- **メソッドの定義は変えちゃダメ！！**みんな共有なのに変えるとごちゃごちゃになるから

```
package Sample;

public class Sample12_01 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		System.out.println("start");
		display();
		System.out.println("end");
		}
	public static void display(){	// mainメソッドとdisplayメソッドは別個、mainの中には書けない、mainと並列
		System.out.println("こんにちは");
		return;
	}

}
```
- メソッド最後の「return」 は省略可能
- 「**void**」は戻り値なしという意味
	- なので上記は戻り値ないので変数に入れる等は不要。実行するのみ
- staticがついているところからついていないメソッドを呼び出すのは不可。逆はOK
- メソッドからの戻り値が返ってくることを「リターンする」などという
- 以下、もう一個簡単なやつ

```java
package Sample;

public class Sample12_1 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		dispRandom();


	}
	public static void dispRandom(){
		System.out.println(Math.random());
		return;

	}

}
```

#### 引数のあるメソッド
- メソッド側で型指定して仮引数を定義
	- 下記のようにintでくるかもしれないが、受け皿を広げてdoubleで受けるなどがある
	- 下記でメッソドに渡す値10だった場合(int型)は自動でdoubleに変換される

```java

	public static void main(String[] args) {
	dispBmi(1.75, 70.0);
	}
	public static void dispBmi(double height, double weight){
		double bmi = weight / math.pow(height, 2)
		System.out.println(Math.random());
		return;

	}
```

#### 値を返すメソッド
- 戻り値があるメソッドはvoidではなく、戻り値の型を指定する。指定した型で値がリターンされるように書く必要がある
	- 下記はdouble型で値をリターンする
- 返す値の型に応じて、適切な戻り値型をメソッドに書く
- voidは「値を返さない」という意味のキーワードとなる
- 補足
	- voidメソッドでもreturnを入れられる
	　-  ifで分岐してreturnし、処理を終わらせることができる


```java
package Sample;

public class Sample12_03 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		System.out.println("BMIを計算");
		double val = getBmi(1.75, 64.0);
		System.out.println("BMIは" + val + "です");
		System.out.println("***END***");


	}
	public static double getBmi(double height, double weight){

		double bmi = weight / Math.pow(height, 2);
		return bmi;
		// return weight / Math.pow(height, 2);もあり
	}

}


package Sample;
import lib.Input;
public class Sample12_4_3 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		int zeigaku = getTax(Input.getInt("単価"), Input.getDouble("税率"));
		System.out.println("税額=" + zeigaku);

	}
	public static int getTax(int tanka, double ritu){
		int tax_price = (int)(tanka * ritu);　// int型とdouble型をかけると結果はdouble(強い型)になる
		return tax_price;
	}

}

#### メソッドのオーバーロード
同じ名前のメソッドをいくつか作成できれば便利なケースがある。  
Java言語では同じ名前のメソッドでも引数構成(引数の数、型、並び順)が違えばいくつでも同名のメソッドが作成可能。
- 下記はjavaでエラーにならない

```java
	public static int getTax(int tanka, double ritu){
		int tax_price = (int)(tanka * ritu);
		return tax_price;
	}
	public static int getTax(int tanka){
		int tax_price = (int)(tanka);
		return tax_price;
	}
```

#### 複数のメソッドを持つクラス
- メッソドの要点三つ読み解く
	- 引数は何か、いくつか
	- なんの処理をしているのか
	- 戻り値はなにか


```java
package Sample;
import lib.Input;
public class Sample12_6_5 {

	public static void main(String[] args){
		dispTitle();
		String name  = Input.getString();
		int    score = Input.getInt();
		String grade = toGrade(score);
		dispResult(name, score, grade);
		}

		public static void dispTitle(){
			System.out.println("■■ 点数から評価の変換■■");
		}

		public static String toGrade(int score){
		String grade;
		if(score >= 90){
			grade = "AA";
		}else if(score >= 80){
			grade = "A";
		}else if(score >= 70){
			grade = "B";
		}else if(score >= 60){
			grade = "C";
		}else{
			grade = "D";
		}
		return grade;
		}

		public static void dispResult(String name,int score, String grade){
			System.out.println(name + "さんの成績は" + grade + "("+ score +")です");
		}
}
```

```java
package Sample;

import lib.Input;

public class Sample12_05 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ

		int kosu = Input.getInt("個数");
		int tanka = Input.getInt("単価");
		int sougaku = kosu * tanka;
		double ritu = nebikiRitu(kosu);
		print(sougaku, ritu);


	}
	public static double nebikiRitu(int kosu){
		double nebikiritu = 0;
		if(kosu < 100){
			nebikiritu = 0;
		}else if(kosu < 500) {
			nebikiritu = 0.05;
		}else if(kosu >= 500){
			nebikiritu = 0.1;
		}
		return nebikiritu;
	}

	public static void print(int sougaku, double ritu){
		System.out.println("販売額=" + sougaku + "円");
		int nebiki = (int)(sougaku * ritu);
		System.out.println("値引き=" + nebiki + "円");
		System.out.println("売　上=" + (sougaku - nebiki) + "円");
	}
}
```
