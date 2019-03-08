# 2019.3.08 企業実習

## Java オブジェクト

### コンストラクタのオーバーロード
- コンストラクタはクラスのメンバじゃない
	- コンストラクタはオブジェクトの中に含まれないため

```java
public class Dice {
	int val;
	String color;

	public Dice(int val, String color){
		this.val = val;
		this.color = color;
	}
	
	public Dice(){
		val = 1;
		color = "黒";
	}

//上記のコンストラクタの状態で、以下を実行した場合
Dice dice1 = new Dice(6, "白");
Dice dice2 = new Dice();

//結果
dice1 = 6, 白
dice2 = 1, 黒　//既定値が入る
```

#### コンストラクタの簡単化
下記のコンストラクタのオーバーロードを簡略化して書く方法がある

```java
public class Dice {
	int val;
	String color;

	public Dice(int val, String color){  // 色と目数を入力させるコンストラクタ
		this.val = val;
		this.color = color;
	}
	
	
	public Dice(String color){　// 色だけを入力させるコンストラクタ
		this.val = 1;
		color = "color";
	}

	public Dice(){		// 指定のないコンストラクタ、既定値が入る
		val = 1;
		color = "黒";
	}
```

簡略化する書き方

```java
public class Dice {
	int val;
	String color;

	public Dice(int val, String color){  // 色と目数を入力させるコンストラクタ
		this.val = val;
		this.color = color;
	}
	
	
	public Dice(String color){　// 色だけを入力させるコンストラクタ
		this(1, color);		//ほんとはDice(1, color)で上のコンストラクタを呼びだし（オーバーロード）ている
	}

	public Dice(){		// 指定のないコンストラクタ、既定値が入る
		this(1, "黒");
	}
```
- この**thisは　→　このクラスの**という意味
- thisは必ず一行目に書く




### カプセル化
- どんなに慎重に設計したクラスでも後になって修正が必要になることが必ずある
- 外部のクラスに公開するメンバと非公開にするメンバ分けをする
- データ隠蔽のため専用のメソッド（アクセサメソッド）を用意する
	- ゲッターメソッド　「取得用」	
	- セッターメソッド　「設定用」
		- メソッド名はget～、set～が暗黙の決まり、規約
- 変数前に**private**修飾子を付ける
- eclipseのソースメニュー→getterおよびsetterの生成からゲッター、セッターメソッドを作成できる


```java

package sample14_05;

public class Dice {
	private int val;		//privateでアクセスできなくする
	private String color;		//privateでアクセスできなくする
	
	public Dice(int val, String color){
		this.val = val;
		this.color = color;
	}
	
	public Dice(){
		this(1, "白");
	}
	
	public void play(){
		 val = (int)(Math.random() * 6) + 1;
	}
	
	//ここから下がデータ隠蔽によるカプセル化。---------------------------------------------------

	public int getVal(){		//	valのゲッター。valの値を呼び出すときに使う
		return val;
	}
	
	public void setVal(int val){		//	valのセッター。valの値を設定するときに使う
		this.val = val;
	}
	
	public String getColor(){		//	colorのゲッター。colorの値を呼び出すときに使う
		return color;
	}
	
	public void setColor(String color){		//	colorのセッター。colorの値を設定するときに使う
		this.color = color;
	}
}
```

- アクセスメソッドの書式

```
	public int getVal(){		// ゲッター
		return val;		// valの値を返す
	}
	
	public void setVal(int val){		//　vセッター。
		this.val = val;			//　valに引数の値をセットする
	}
```

- 重要
	- thisはメソッドでも使える
	- thisはコンストラクタとインスタンスメソッドで使うことができる

#### まとめ
1. フィールド変数にprivate修飾子を付けて、外部からは利用できなくする
2. public修飾子を付けたアクセスメソッド（ゲッターとセッター）を作成する


### アクセス修飾子
- アクセス修飾子はpiblic、デフォルトアクセス、privateの三つでクラス、コンスタント、フィールド変数、メソッドなどにつけることができる
	- ローカル変数には付与不可
	- private
		- 同一クラス内に定義されたメソッドコンストラクタからだけアクセスできる
	- デフォルトアクセス
		- 同一クラス内に定義されたメソッドやコンストラクタからアクセスできるほか  
他のクラスのソースコードが同じパッケージ内にあればそのメソッドやコンストラクタからアクセスできる
	- public
		- 自由にアクセスできる。条件なし

### eclipse のリファクタリング
eclipseのリファクタリング機能で
- プロジェクト名
- パッケージ名
- クラス名
- 変数名
を変えると、関連しているソースコードの名前も変更してくれる



#### 整理
- コンストラクタ
	- デフォルトコンストラクタを定義すれば、既定値が入る


### 参照
- オブジェクトの実態はヒープ領域にいる
- Dice dice = new Dice()をすると、変数diceには実際にはオブジェクトが入っているわけではなく、  
ヒープ上にいるオブジェクトへのリンク情報（キー）が入っているのみ。だから軽い。
- 以下のようにオブジェクトを出力するとキーを参照できる

```java
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		Dice dice = new Dice();
		System.out.println(dice);
　
	}
// 出力結果：sample14_05.Dice@1690726
```

- 上記で`Dice dice2 = dice;`すると同じキーを参照することになる。この方法はコピーなる。ほぼ使わない。
- 以下でdice1でオブジェクトを操作すると、dice2の出力結果も同じとなる


```java
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		Dice dice1 = new Dice();
		Dice dice2 = dice1;
		dice1.play();
		System.out.println(dice1.getVal());
		System.out.println(dice2.getVal());
	}

}
```

#### nullはどこにもリンクしてない参照
- nullはどんなオブジェクトにもリンクしていない参照
	- 参照先がなくなる、つまりオブジェクトもなくなる
- 以下でオブジェクトdice1 に null を代入。ヌルポが出る

```java
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		Dice dice1 = new Dice();
		Dice dice2 = dice1;
		dice1.play();
		System.out.println(dice1.getVal());
		System.out.println(dice2.getVal());

		dice1 = null;
		System.out.println(dice1.getVal());
	}
```
- 上記の結果  
6  
6  
Exception in thread "main" java.lang.NullPointerException  
	at sample.Dice_dice.main(Dice_dice.java:18)  

- これが**初期化**、初期化で使う
	- nullはコンパイルエラーにはならいが実行時例外を起こす

##### 宣言しただけの変数は空
- 宣言しただけの変数には基本データ型も参照型も何も値が入っていない状態。
	- これを初期化されていない変数という
	- 初期化されていない変数を使って何かしようとするとコンパイルエラーになる
	- nullが入っていれ初期化済みとなるためばコンパイルエラーにならない


