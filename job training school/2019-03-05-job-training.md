# 2019.3.05 企業実習

### 耳より情報
- 情報の資格で処理の流れ(アルゴリズムというより）を学ぶのもおすすめ  
- わかりやすいJava 入門編　著者：川場隆

## Javaの続き

### 条件を書くための演算子
- Stringは==で比較できない。
	- 文字列の比較はString.equalsを使う必要がある
- ただStirngで==と!=は文字列がnullかどうか調べる場合だけに使える
- $$ - かつ
- &#124;&#124; - または
- ! - ～でない

```java
Stirng str = Input.getString();
	if(str!=null && !str.equals("")){
	// null　かつ(&&)空文字でもなければ 
	//nullの入った変数に操作(メソッドなど)を行うとエラーが発生する(ヌルポ)
	//これがエラーを防ぐ方法

	//if(!str.equals("") && str!=null)だとエラーになる

}


// 入力された値がうるう年かどうか確認するプログラム
package sample;
import lib.Input;
public class Sample07_確認 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		int n = Input.getInt();
		if((n % 4 ==0 && n % 100 != 0) || n % 400 == 0){
		// $$ の方が|| より優先順位が高いので()で括らなくても大丈夫
			System.out.println(n + "年はうるう年");
		}else{
		System.out.println(n + "年はうるう年じゃない");
		}
	}

}
```


#### 条件演算子
- int n = a>0 ? 1 : 0,
	- aが0より大きければtureでnに1を代入、aが0以下ならfalseで0をnに代入

### while文
- キーボード入力を受け付ける処理をwhileに入れる決まりきった処理
	- よく使われる処理

```java
while((n=Input.getInt()) !=0){
	// 繰り返し実行処理

package sample;
import lib.Input;
public class Sample09_02 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		int number;
		while((number=Input.getInt())!=0){
		System.out.println(number + " を入力");

		}
		System.out.println("プログラム終了");
	}

package sample;
import lib.Input;
public class Sample09_03 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		String str;
		while(!(str=Input.getString()).equals("NO")){
			System.out.println(str);
		}
		System.out.println("プログラム終了");
	}

}
```

##### 変数はどこでも使える
- 例) 3と0じゃなければ入力値をループ出力

```java
package sample;

import lib.Input;

public class Sample09_02_022 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		int n;
		while((n=Input.getInt())%3 != 0 && n !=0){
			System.out.println(n);
		}

	}

}
```

#### do while文
- while文と違い、1回は実行する
- 一回の処理後に条件判定をする
- 書き方

```java
do{
	繰り返し実行したい処理
}while(条件);
```

### null対策
- .equals("文字列")ではなく==もしくは!=を使う

```java
package sample;

import lib.Input;

public class Sample09_212P {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		String str;

		while((str=Input.getString())!= null){
			System.out.println("<" + str.length() + ">" + str);
		}
		System.out.println("終了");
		}

}
```

### switch文
- phpと一緒

```java
switch(value){
case 7: 
	処理1;
	break;
case 8:
	処理2;
	break;
defaule:
	処理3;


package sample;

import lib.Input;

public class Sample11_04_263_1 {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ

		int munt = Input.getInt("数量");
		String str = Input.getString("商品コード");

		int price = 0;

		switch(str){
		case "a100":
		case "b100":
		case "c100":
			price = 100;  //まとめられる
			break;
		case "a110":
		case "b110":
		case "c110":
			price = 200;
			break;
		case "b120":
			price = 300;
			break;
		case "d100":
			price = 400;
			break;
		default:
			price = 500;
		}
		System.out.println("合計金額" + price * munt + "円");
	}

}
```

- **braekは多重ループを脱出できない**
	- break文で脱出できるのは内側の1つのループだけである
- ラベルを使って多ループを抜ける
