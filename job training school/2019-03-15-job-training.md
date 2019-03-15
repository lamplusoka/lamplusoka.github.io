# 2019.3.15 企業実習

## Java のつづき

### コレクション
- データ集積・処理を行うクラス群
- よく使うのArrayList　と　HashMap、たまにHashSet。あとはほとんど見ない。
- List系
	- ArrayList:配列を扱う
		- 配列に追加ができる
	- LinkedList:配列を扱う。挿入・削除が高速

- Set系
	- HashSet:値の重複を許さない順不同の要素集合を扱う
	- TreeSet値の重複を許さないソートされた要素の集合を扱う

- Map系
	- HashMap:キーと値の組からなる要素の集合を扱う。PHPでいう連想配列、Pythonでいう辞書
	- TreeMap:キーと値の組からなる要素の集合を扱う。キーでソートされている。

```java
// ArrayList

package test;

import java.util.ArrayList;
import java.util.List;

public class ArrayListtest {

	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		List<String> list = new ArrayList<>();
		list.add("AAA");
		list.add("BBB");
		list.add("CCC");
		for(int i = 0; i < list.size(); i++){
			System.out.println(list.get(i));
		}	
	}
}

// 結果 
// AAA
// BBB
// CCC
```

```java
///HashSet

		Set<String> set = new HashSet<>();
		set.add("AAA");
		set.add("BBB");
		set.add("CCC");
		set.add("AAA");			// 重複した値は無視される
		Iterator it = set.iterator();  // Iterator:イテレーター、回すよという意味
		while(it.hasNext()){
			System.out.println(it.next());
		}
		}
}
// 結果 順不同　重複した値は出さない
// BBB
// AAA
// CCC


```

```java
//HashMap


Map<String, String> map = new HashMap<>();
		map.put("Name", "Tanaka");		//重複したキーは登録できない、上書きされる
		map.put("Age", "26");
		System.out.println("Name = " + map.get("Name"));
		System.out.println("Age = " + map.get("Age"));

		for(String key: map.keySet()){		//要素をすべて取り出す方法
			System.out.println("val:" + map.get(key));
		}

		}
}

// 結果
//Name = Tanaka
//Age = 26
//val:Tanaka
//val:26
```


#### ジェネリックについて
- List<String> list = new ArrayList<>(); →<>の部分について

- 以下は単なる箱（Box）を表すクラス。コンストラクタで何かのオブジェクトを受け取ったら、それを内部的にObject型のoに保持しておき、getメソッドが呼ばれたときにそれを返すだけ。

```java
package Box;

public class Box {
	Object o;

	public Box(Object o){
		this.o = o;
	}

	public Object get(){
		return o;
	}

}
```

- 以下を利用するプログラムを考える

```java
Box b = new Box(123);
Interger i = (Integer)b.get();
System.out.println(i);
```

- Boxのコンストラクタで123という数字を渡し、それをgetメソッドで取り出し、IntegerにキャストしてInteger型の変数にセットし出力している。この実行結果は以下。  
`123`  
確かに123という数字が出力された。  

- Integer
	- int型のラッパークラス　Wrap：包む
	- Integerクラス、int型を内包、int型のスーパークラス
	- Interger.parseInt(文字列);→文字列をint型に変換
	- Doubleも同じくDouble.parseDouble("100");

ではもう一つの利用例を下で見てみる  

```java
Box b = new Box("Hello");
String s = (String)b.get();
System.out.println(s)
```

- 上記はBoxのコンストラクタで"Hello"という文字列を渡し、それをgetメソッドで取り出すときにStringにキャストして変数にセットし、それを出力しているこれを実行すると以下。
`Hello`

- 最初の例ではBoxクラスは123という整数を扱い、二つ目の例では"Hello"という文字列を扱うことができる。この箱(Box)クラスは、いろいろな型のオブジェクトを保存するための「箱」として使うことができる。では次の例を見てみる。


```java
Box b = new Box(123);
String s = (String)b.get();
System.out.println(s);
```
- この例はコンストラクタで123を渡しているが、それを取り出すときにStringにキャストしている。コンパイルは成功するが、実行すると例外エラーが出てくる。Integerオブジェクトはそのまま直接キャストしてStringにはできないからこのような例外が発生する。
- 上記のコードはintを直接Stringにキャストするという誤ったコードを書いている。これはコンパイル時に誤りを検知できた方がよい。コードに不具合があるのにコンパイルはでき、実行時に例外が発生するのでは安定したコードを書くのは難しくなる。

- 各型用の箱を定義するのは大変。
- そこでジェネリックの登場。ジェネリックでは型を汎用化する。Boxクラスを書き直してみる

```java
package Box<T>;		// Tは型

public class Box {
	T o;		// oは変数名

	public Box(T o){
		this.o = o;
	}

	public Object get(){
		return o;
	}

}
```
- 今までObject型としていた箇所がTで置き換えられ、クラス名に<T>という指定が追加されている。
- class Box<T>とすることで、「このBoxクラスは型Tに対するクラスですよ」と定義していることになる。
- Interger用のIntegerBox、String用のStringBox・・・、などと型違いで同様のクラスを複数定義する代わりに、ジェネリックを使ってBoxを定義しておけば、それぞれBox<Integer>、Box<String>のようにそれぞれの方用のBoxクラスを用意することが可能となる。

- これを使うコードは以下となる

```java
Box<Integer> b = new Box<Integer>(new Integer(123)); //右側のIntegerを略してnew Box(123);と書ける
Integer i = b.get();
System.out.println(i);
```
- このBoxはそれぞれの型専用のBoxになるため、キャストする必要もなくなり、IntのBoxにStringを入れてしまうというような誤りはコンパイル時に検出できることになる 



// うるう年の判定
				



