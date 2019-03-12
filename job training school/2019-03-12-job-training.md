# 2019.3.12 企業実習

## Java のつづき

### 文法の補足
#### mainメソッドの位置づけ
- mainメソッドはオブジェクトではない

	- mainメソッドはstatic（静的な）修飾子が付いたstaticメソッド
		- static 最初から準備されているといった意味に近い
			- main, Math, Arrayなど準備されているものをリスト化されてメモリ上ですぐに使える状態なる
		- static キーワードが付いている→オブジェクトに含まれない（メンバにならない）
	- Java言語では最初にmainメソッドを実行することになっているので、これですぐに実行できる
	- mainメソッドがstaticメソッドでなければならないのは、このように実行開始前に準備されている必要があるから
	- staticメソッドはプログラム実行開始の直前に実体化され、プログラムが終了するまでそのまま存在し続ける
- リスト化されたstaticメソッドから、同じクラス内にある非staticメソッドにはアクセスできない
	- 非staticメソッドはオブジェクトにしてから使用する必要があるため
	

- staticの付いた変数も同様の動きになる
- 例）
	- Testクラスで、、public static int number = 0;　を定義
		- 他の複数のクラスからTest.number = 20;　などとしてアクセスできて変更できてしまう
		- static変数を使う場合はfinal(定数)にすることが多い
		- static変数はほぼ使わない、最終手段

#### 複数のクラスを含むJavaファイル
- **Java言語では、public修飾子を付けたクラスがあれば、ソースファイル名はそのクラスと同じ名前にしなければならない**
	- この制約のために、複数のクラスを同じソースファイルに書いた場合はpublic修飾子を付けることができるクラスは1つだけに限られる


#### import文
- Java言語ではクラスはパッケージに分けて作成する
	- そのためパッケージ間で同じ名前のクラスが存在する可能性が出てくる
	- そこでプログラムの中で他のクラスを利用するときは、名前が衝突しないよういするためにパッケージ名を含めてしていすることになる
- パッケージ名を含めて指定するには**完全修飾名**を使う



##### staticインポート
- これまで　Input.getDoubleと指定していたがimportすればクラス名を省略できる
- 例） 
	- `import static lib.Input.getDouble;`
	- `double hankei = getDouble("半径");`

## ポリモーフィズム
#### 代入とキャスト

- 型は違っても同じ種類に属す形がある。例えばint型とdouble型はどちらも数値方いおう同じ種類の型
	- 次のように自動変換が可能
		- double data = 20;
		int number = (double)15.3;

- **オブジェクトでは継承関係にある型同士が同じ種類の型です**

#### スーパークラス型へ代入
- サブクラスのオブジェクトはスーパークラスの型に代入できる！
- `Member member = new Student(118, "田中宏", A711);`
	- Member　→　スーパークラス、　Student　→　サブクラス

- オブジェクトは代入によって内容が変わることはない
	- Student型の入りきらない部分はアクセスできない領域としてそのまま残っている
- サブクラスのオブジェクトをスーパークラス型の変数に代入できる
- オブジェクトは代入によって変化しないおで、サブクラスの拡張部分は存在している
- スーパークラス型の変数では、サブクラスで拡張したメンバにはアクセスできない

```java
// スーパークラス
package sample18_01;

public class Member {
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


// サブクラス

package sample18_01;

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

}

// 実行するクラス

package sample18_01;

public class Exec {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		Member member = new Student(118, "田中宏", "A711");	// スーパークラス型変数への代入
		System.out.println(member.getId() + "/" + member.getName());　//　Memberクラスの中のメソッドを呼び出している

		member.discount();	// discount()はstudentクラスにしかいないためアクセス不可。エラーとなる

	}

}
```

#### サブクラス型への代入
- スーパークラスのオブジェクトは、サブクラス型の変数に代入できない


#### キャストによる強制的な代入とinstanceof演算子

- スーパークラスのオブジェクトをキャストすればコンパイルエラーにならずサブクラス型へ代入できる
	- `Student student = (Student)(new Member("田中宏"));`
- これはサブクラス型へのキャストなので**ダウンキャスト**という
	- ダウンキャストは危険な操作なので避けねばならない
	- しかし下記の場合はOK

```java
Member member = new Student(...); // これはOK
Student stu = member; // コンパイルエラー
Student stu = (Student)member;	// 元々Studentなので、この流れ、やり方ならOK


##### instanceof演算子
- instanceof演算子は変数の中にあるオブジェクトの型を調べることができる
	- member instanceof Student
		- 変数memberの中のオブジェクトがStudent型か、Student型のサブクラスの時にtrue, そうでなけれfalseになる

```java

Object obj = new Member(118, "田中宏");
System.out.println(obj instanceof Object);  // Object型かそのサブクラス型　　結果：true
System.out.println(obj instanceof Member);　// Member型かそのサブクラス型　　結果：true
System.out.println(obj instanceof Student); // Student型かそのサブクラス型　　結果：false


```

#### オーバーライド
- サブクラスでは、メソッドを追加する以外に継承したメソッドの機能を変更することができる
- 機能の変更は継承しただけでは役に立たない状態のメソッドやあるいは変更しあければコンパイルエラーになるメソッドに対しておこなう
	- このためにスーパークラスでは抽象クラスという特別な仕掛けを使う場合がある
	- スーパークラスで大まかな仕組みを作っておいて、機能の詳細はサブクラスで仕上げる、という場合に使う方法
- まさしくフレームワーク
	- 起動（正しく動作）するために必要最低限の処理を埋める

- 継承したメソッドの機能を変えるには、同じ名前のメソッドを作って、処理内容だけを変える
- メソッドのアクセス修飾子、戻り値、引数を変更しない、原則同じにすることが要件

##### toStringメソッド
- オーバライドの練習に適したメソッド
- objectクラスから継承している
- オブジェクトのフィールド変数の値などを文字列にして返すメソッド
	- System.out.println(member.toString); とすると「sample18_03.Member@15db9742」といったオブジェクトのフィールド変数の値などを文字列で返す
	- System.out.println(member); →　toStirng()は省略できる！member.toStringと同じ

```java
package sample18_04;

public class Member {
	private int id;
	private String name;
	public Member(int id, String name){
		this.id = id;
		this.name = name;
	}
	@Override		// オーバーライドするメソッドにはこのように書く
	public String toString(){
		return "Member [id =" + id + ", name =" + name + "]";
	}
```
- オーバーライドの規則
1. 引数の型、数、並び順を変更しない
2. 原則として戻り値型を変更しない、ただし戻り値型がオブジェクトの場合は、サブクラス型に変えても良い
3. アクセス修飾子はより公開範囲の広いものにだけ変更してよい

- @Overrideアノテーションの効果
	- @Overrideアノテーションはそれを付けたメソッドがオーバーライドメソッドであることをコンパイラに通知するアノテーション
	- 省略しても問題ないがこれがあると正しいオーバーライドかチェックしてくれる


### ポリモーフィズム
- カプセル化、継承に続くオブジェクト指向の三大要素の一つ

- まずオーバーライドメソッドの特質について理解
	- オブジェクトを異なる型の変数に代入しても、起動するオーバーライドメソッドは変わらない
	- 例) Object obj = new member(118, "田中宏");として
	- Memberクラスで以下のオーバーライドをしていた場合
	- System.out.println(obj.toString)とすると、オーバーライドメソッドが実行される

```java
	@Override
	public String toString(){
		return "Member [id =" + id + ", name =" + name + "]";
	}
```

- ポリモーフィズムとは
1. 同じ型の変数でも、どんなオブジェクトが入っているかを動作が変わってしまうこと
2. 同じ型の変数でも、違う方のオブジェクトを入れることで様々な機能に変身させられる
- 例）多言語挨拶システム

```java
//------- スーパークラス---------

package sample18_06;

public class Greeting {
	public String language(){
		return null;
	}
	public String message(){
		return null;
	}

}


//---------日本語のサブクラス----------

package sample18_06;

public class JapaneseGreeting extends Greeting{
	@Override
	public String language(){
		return "Japanese";
	}

	@Override
	public String message(){
		return "こんにちは";
	}

}

//---------イタリア語のサブクラス----------
package sample18_06;

public class ItalianGreeting extends Greeting{
	@Override
	public String language(){
		return "Italian";
	}

	@Override
	public String message() {
		return "Ciao";
	}


}

//--------------- 多言語を実行するrunクラス

package sample18_06;

public class Talker {
	public void run(Greeting gr){
		System.out.println(gr.language());
		System.out.println(gr.message());
	}

}


//------------実行するクラス
package sample18_06;

public class Exec {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		Talker talker = new Talker();		// Takerオブジェクトを作成
		talker.run(new JapaneseGreeting());	// 日本語挨拶を実行する
		talker.run(new ItalianGreeting());	// イタリア語挨拶を実行する

	}

}
```
これが単純な汎用システムの原型。**フレームワーク**の考え方


### 抽象クラス、インターフェース
- 抽象クラス
	- スーパークラスはサブクラスにメソッドをオーバーライドしてもらう必要がある
	- 抽象クラスはその時使うスーパークラスを作成するためのクラス
		- オーバーライドしてほしいメソッドを抽象メソッドという
- 抽象クラスの特質
	1. 普通のクラスとの違いはabstractを付けることだけである
	2. インスタンスを作れない


```java
public String language(){
	return null;
}

// 上記を抽象メソッド形式で書く

public abstract String language(); //abstractを付ける。{}は不要


// 抽象クラスを書く場合
public abstract class Greeting{ //　クラスにabstractがなくてメソッドにabstractがあるとエラーになる。逆は大丈夫。

}

```

- メソッドでabstractを書く位置に注意
	- メソッドの戻り位置より先に書かないとコンパイルエラーになる
	- public abstract String str();  // 〇
	- abstract public String str();  // 〇
	- public String str abstract();  // × 

- サブクラスで、抽象メソッドをオーバーライドしたくない場合、自分自身を抽象クラスにすれば抽象メソッドをそのまま残すことができる
- そのままではインスタンスが作れないので、他のクラスがさらに継承して抽象メソッドを実装する必要がある

