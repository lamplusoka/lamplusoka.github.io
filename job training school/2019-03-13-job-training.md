# 2019.3.13 企業実習

## Java のつづき

### インターフェース
- ソフトウェア・インタフェースはAPI(Application Programming Interface)と呼ばれる
- インターフェースとは、クラスに含まれるメソッドの具体的な処理内容を記述せず、変数とメソッドの型のみを定義したもの
	- 書き方を縛るために設計者がインターフェースを作る→必ずこう書けやといった感じにする。使用頻度は低い
- インターフェースはクラスではないが、作成するファイルの拡張子は.javaとなり、コンパイルすると.classファイルができる

#### インターフェースの作り方
- interfaceというキーワードを使う
- インターフェースの宣言
	- interface インターフェース名{} 
- アクセス修飾子はpublicかデフォルトにする
	- protectedやprivateは不可
- インターフェース名の(interfaceの前に)「abstract」が省略されている
	- メソッド名の前の「public abstract」が省略されている
	- メソッド名の最後に「;」を付ける。{}は付けない


```java

package sample19_02;

public interface Responsible { // public abstract interface Responsibleと同じ  どれも public abstractを省略可
	String info();		// クラス名、バージョンなどを返す public abstract abstract String info(); と同じ
	String exp();		//クラスの説明文を返す  (public abstract) String exp();と同じ
}

```

- インターフェースの実装
	- class クラス名 implements インターフェース名{}
- インターフェースにある抽象メソッドを正しくオーバーライドしないとコンパイルエラーになる
- メソッドは必ずpublicにする



```java
package sample19_02;

public class Member implements Responsible{	// interfaceのクラスを引き継ぐ場合は「implements」と書く
	private int id;
	private String name;
	public Member(int id, String name){
		this.id = id;
		this.name = name;
	}


	@Override
	public String info(){		//クラス名、バージョンなどを返す
		return "Member ver1.0";
	}

	@Override
	public String exp(){		// クラスの説明文を返す
		return "フィットネスクラブの一般会員クラス";
	}

}
```
##### インターフェイスの定義と実装パターン
- インターフェイスは他のインターフェイスを継承できる
	- extends を使う
	- 例） `public interface Printable extends Responsible, Sortable`
		- Printable インターフェースはRespnsibleインターフェースとSortableインターフェース両方に  
定義してあるメソッドをそのまま取り込んで自分のメソッドとする
- クラス継承と同時にインターフェースの実装を指定できる
	- 例） `class JapaneseGretting extends Greeting implements Responsible`
	- Greetingクラスを継承してRespnsibleインターフェース実装を同時に宣言
- クラスも複数のインターフェイスを同時に実装できる
	- 例） `class JapaneseGretting extend Greeting implements Responsible, Sortable, Computable`
	- 複数のインタフェースをカンマで区切って指定できる

### インターフェースのポリモーフィズムの利用
- インタフェース型
	- Respnsibleインターフェースを作ったらResponsible型が使えるようになり、Responsible型はインターフェース型となる
- インターフェース型は参照型の一種
	- `Responsible res = new Member(118, "田中宏")`;
	- インターフェース型にオブジェクトの代入ができるが、代入できるのはインタフェースを実装したクラスのみ

- インターフェース

```java
package sample19_02;

public interface Responsible { // public abstract interface Responsibleと同じ  どれも public abstractを省略可
	String info();		// クラス名、バージョンなどを返す public abstract abstract String info(); と同じ
	String exp();		//クラスの説明文を返す  (public abstract) String exp();と同じ
}
``` 

#### インターフェースのポリモーフィズムの練習

- 練習1

```java

// インターフェース：Responsible
package sample19_04;

public interface Responsible { // public abstract interface Responsibleと同じ  どれも public abstractを省略可
	String info();		// クラス名、バージョンなどを返す public abstract abstract String info(); と同じ
	String exp();		//クラスの説明文を返す  (public abstract) String exp();と同じ
}


///　インターフェースを実装したクラス：Member
package sample19_04;

public class Member implements Responsible{	// interfaceのクラスを引き継ぐ場合は「implements」と書く
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

	@Override
	public String info(){		//クラス名、バージョンなどを返す
		return "Member ver1.0";
	}

	@Override
	public String exp(){		// クラスの説明文を返す
		return "フィットネスクラブの一般会員クラス";
	}


}

// Memberを継承したサブクラス：Student　インターフェースも継承している
package sample19_04;

public class Student extends Member{
	private String studentId;
	public Student(int id, String name, String studentId){
		super(id, name);
		this.studentId = studentId;
	}
	public double discount(){
		return 0.2;
	}
	public String getStudentId(){
		return studentId;
	}

	@Override
	public String info(){
		return "Student ver1.0";
	}
	@Override
	public String exp() {
		return "フィットネスクラブの学生会員クラス";
	}
}


// インターフェースを実装したクラス：Greeting

package sample19_04;

public class Greeting implements Responsible {
	public String language(){
		return null;
	}
	public String message(){
		return null;
	}

	@Override
	public String info(){
		return "Greetingクラス ver1.0";
	}

	@Override
	public String exp(){
		return "挨拶のクラス";
	}
}


// これがユーティリティ：Information
package sample19_04;

public class Information {
	public static void header(Responsible res){
		System.out.println(res.info());
	}

	public static void body(Responsible res){
		System.out.println(res.exp());

	}

	public static void print(Responsible res){
		header(res);
		body(res);
	}


// 実行ファイル：Exec
package sample19_04;

public class Exec {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		Member member = new Member(118, "田中宏");
		Student student = new Student(120, "佐藤修", "A223");
		Greeting greeting = new Greeting();
		Information.print(member);
		Information.print(student);
		Information.print(greeting);

	}

}
```


- 練習2
	- 5つの都市の人口データから合計の人口と、平均を出力する

```java

/// インターフェイス：Computable
package sample19_3;

public interface Computable {
	String itemName();
	double value();
}


/// これがユーティリティクラス：Stat

package sample19_3;

public class Stat {
	public static String itemName(Computable com){
		return com.itemName();
	}

	public static double sum(Computable[] com){
		double total = 0;
		for(Computable num : com){
			total += num.value();
		}
		return total;
	}

	public static double avg(Computable[] com){
		return sum(com) / com.length;
	}

}


///　インターフェースを実装したクラス：City
package sample19_3;

public class City implements Computable {
	private String name;
	private double population;

	public City(String name, double population){
		this.name = name;
		this.population = population;

	}

	@Override
	public String itemName() {
		return "人口";
	}

	@Override
	public double value() {
		return population;
	}
}

/// 実行するクラス

package sample19_3;

public class Exec {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		City[] cities = {new City("A", 100),
				new City("B", 120),
				new City("C", 300),
				new City("D", 250),
				new City("E", 85),
		};

		System.out.println(Stat.itemName(cities[0]));

		System.out.println("合計=" + Stat.sum(cities));
		System.out.println("平均=" + Stat.avg(cities));
	}

}
```

### eclipseのデバッグモードの使い方
1. 右上のデバッグをクリックしてデバッグモードを開く
2. for文がわかりやすい。for文の行数をダブルクリックする→ポインタが付く
3. 上にある虫アイコンをクリックするとポインタの行で処理がとまる
4. 右上の変数をクリックすると、該当変数に何が入っているか確認できる
- ローカルでやる場合は右上の普通のJavaを選択
	- Javaの基本機能を最低限でまとめたもの
	- PC上で動くゲームやソフトを作れる
	- VM(仮想マシン)搭載の家電ならアプリ開発もできる
	- Java Standard Editionの略
	- 旧J2SE( = Java2PlatformStandardEdition)
	- 要JDKインストール
- 右上のJavaEEとは
	- JavaSE　＋　サーバサイド（拡張）機能
	- 拡張機能を使ってWebAPI開発ができる
	- Java Enterprise Edition
	- 旧J2EE
