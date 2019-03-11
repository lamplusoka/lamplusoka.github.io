# 2019.3.11 企業実習

## Java 参照のつづき

### 配列を作る

#### 要素数を指定して配列を作成する
- new 型 [要素数]
	- int[] number = new int[4];
	- 四つの箱を作成する
		- intの場合初期値は0、String型の場合はnullが入る
	- 配列はクラスではないが、作成するとlength（長さ・定数）というフィールド変数を持つ
		- lengthの値を書き換えるのは不可
		- final 型 変数名 = 10、などと入力すれば定数を作れる 
			- 定数を作る際の変数名は全て大文字にするのがしきたり
		- finalはクラス、メソッド、フィールド変数にもつけられる

- **Arrays.toString**(配列変数名)
	- 配列要素のリストを文字列にして返す
	- そのため文字列型で作成した変数に代入する
		- String list = Arrays.toString(data);
	- ただ文字列で出すだけであまり用途がない

#### オブジェクトの配列
- 作成したオブジェクトを配列で管理することができる
	- Dice dice = new Dice();でオブジェクトを複数作成したとする。Diceは型となる。
		- Dice[] dices = {dice1, dice2, dice3};　のように同じ型(オブジェクト)を入れたリストを作成可能
		- 初期リストで作成
			- Dice[] dices = {new Dice(), new Dice(), new Dice()};

- 配列を作った後で配列要素にオブジェクトを代入する
	- Dice[] dices = new Dice[3];  →　nullの箱が三つできる
		- dices[0] = new Dice();
		- dices[1] = new Dice();
		- dices[2] = new Dice();


## 継承
- 継承はオブジェクトの設計図であるクラスを再利用するための技術。
	- 既存のクラスを引き継いだ上で、さらに機能を付け加えたり、或いは市角機能を変更したりして新しいクラスを作れる

- 継承元のクラスを**スーパークラス**という
- スーパークラスを継承して作る新しいクラスは**サブクラス**(子クラス、派生クラス)という
- 例)
	- 一般会員（スーパークラス）
		- 会員番号(フィールド変数)
		- 名前	  (フィールド変数)
	- 学生会員（サブクラス）
		- 会員番号（スーパークラスから継承）
		- 名前	　（スーバークラスから継承）
		- 学生証番号(このクラスで定義したフィールド変数)
		- 学割処理　(このクラスで定義したメソッド)
- コンストラクタは継承できない
	- サブクラスのコンストラクタは最初にスーパークラスのコンストラクタを実行しなければならないと決められている
		- サブクラスの`super(id, name);` の部分
		- superはサブクラスコンストラクタの一行目に書かなければならない
- private アクセスになっているフィールド変数は継承できない
- final修飾子を使たクラスは継承できない


```java
package sample17_01;

public class Member {		//一般会員クラス（一般クラス）
	private int id;
	private String name;
	public Member(int id, String name){
		this.id = id;
		this.name = name;
	}
	public int getId() {
		return id;
	}
	public String getName() {
		return name;
	}


}


//-------学生会員クラス----------
package sample17_01;

public class Student extends Member{	//学生会員クラス（サブクラス） 
		// ↑Student→定義するサブクラス名
		// extends Member →継承するスーパークラス

	private String studentId;
	public Student(int id, String name, String studentId){
		super(id, name);
		//super　→　スーパークラスの、という意味

		this.studentId = studentId;
	}
	public double discount(){
		return 0.2;
	}
	public String getStudentId(){
		return studentId;
	}

}

//---------実行----------------
package sample17_01;

public class Exec {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		Student stuMember = new Student(118, "田中宏", "A711");
		System.out.println(stuMember.getId() + "/" +
						stuMember.getName() + "/" +
						stuMember.getStudentId());

	}

}
```
**出力結果：118/田中宏/A711**



### 継承ツリー
1. Objectクラス
	- 全てのオブジェクトが持たねばならない機能としてオブジェクトの比較や複製に関する機能、マルチスレッドに対応する機能などがある
	- このようにすべてのオブジェクトに共通する機能を持つクラスが**Objectクラス**という
	- Objectクラスのメソッド
		- toStirng() - オブジェクトの文字表現を返す
		- equals(Object obj) - オブジェクトと他のオブジェクトが等しいかどうか示す
		- etc...

### protected修飾子
1. 同じパッケージのクラスからアクセスできるようにする(デフォルトアクセスと同じ)
2. サブクラスからアクセスできるようにする
- 修飾子の使える範囲
	- private - 同一クラス内
	- デフォルト - 同一パッケージ内
	- protected - クラスから継承したサブクラス
	- public - 制限なし


```java

// スーパークラス

ackage pass17_01;

import java.util.Arrays;

public class BasicStat {
	private double[] data;
	public BasicStat(double[] data){
		this.data = data;
		Arrays.sort(data);
	}
	public double min(){
		return data[0];
	}

	public double max(){
		return data[data.length-1];
	}

	public int size(){
		return data.length;
	}

	protected double[] getData(){
		return data;
	}

}


//サブクラス

package pass17_01;

public class Stat extends BasicStat {
	public Stat(double[] data){
		super(data);
	}

	public double sum(){
		double total = 0;
		for(double num :getData()){
			total += num;
		}
		return total;
	}

	public double average(){
		double total = 0;
		for(double num :getData()){
			total += num;
		}
		return total / size();
	}

}


//実行

package pass17_01;

public class Exec {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		double[] data = {65.1, 60.3, 75.5, 70.0, 67.3};
		Stat stat = new Stat(data);
		System.out.println("最小値=" + stat.min() + "\t最大値=" + stat.max());
		System.out.println("合     計=" + stat.sum() + "\t平     均=" + stat.average());

	}

}
```
■結果  
最小値=60.3	最大値=75.5  
合  計=338.2	平  均=67.64  
