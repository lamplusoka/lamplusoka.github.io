# 2019.3.14 企業実習

## Java のつづき

### 二次元配列の使い方
- for 文と拡張for文で二次元配列を回す場合

```java
package test;

public class Exec {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
	
	int[][] nums = {{1, 2, 3}, {10, 20, 30}, {100, 200, 300}};//二次元配列でだから！

		for(int i = 0; i < nums.length; i++){
			for(int j = 0; j < nums[i].length; j++){
				System.out.println(nums[i][j]);
			}
		}


		// 拡張for文
		for(int[] n : nums){
			for(int m : n){
			System.out.println(m);

		}
	}
}


}
```

### フィールドの隠蔽
- 実務では使わない。試験に出るレベル
- サブクラスでスーパークラスと同じ名前のフィールド変数を定義できる。すると1つのオブジェクトの中に同名の変数が2つあることになる
- 以下が例）変数name が二つ定義されている

```java
package test;

class Person {
	String name = "田中宏";
}

class Friend extends Person{
	String name = "ひろちゃん";

}

package test;
public class Exec{
	public static void main(String[] args) {

		Friend friend = new Friend();
		System.out.println(friend.name);

		Person person = friend;
		System.out.println(person.name);

	}

}

```
- 結果
	- ひろちゃん
	- 田中宏
- 結論→サブクラスで定義した方が優先される。スーパークラスのnameは存在するがフィールドが隠蔽されている
	- 型をスーパークラスのPersonにすることでサブクラスのname=ひろちゃんがアクセスできなくなり、田中宏が出力される
- サブクラスでスーパーを付けると子から親へアクセスできる
	- サブクラスPersonに親のnameを返すようにメソッド追加
	- Execでそのメソッド呼ぶ

```java
class Friend extends Person{
	String name = "ひろちゃん";
	String name_origin(){
		return super.name;	// superで親呼んでるよ
	}

}

public class Exec{
public static void main(String[] args) {
		Friend friend = new Friend();
		System.out.println(friend.name_origin());	//親呼んでるメソッド呼ぶよ
		Person person = friend;
		System.out.println(person.name);

	}
```
- 結果
	- 田中宏
	- 田中宏

### 例外
- 例外
	- 実行時例外
		- ヌルポなど、レベルが低いやらかしたやつ
	- 実行する前から予測できる例外
	- 例外が発生すると、その内容に応じた例がクラスがnew される仕組み
		- 例)ヌルポ発生！→　new NullPointerException(); → 発生元に例外がスローされる(投げられる)仕組み
- try - catch 構文

```java
package error;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.Properties;

import javax.security.auth.login.Configuration;

public class Exception {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		Properties configuration = new Properties();			//  下までファイルを読み込む際の定型文
		File file = new File("resource/message.prosperties");
		try{
			InputStream inputStream = new FileInputStream(file); // FileInputStreamは例外が発生する可能性があるからtry/catch文を書けとeclipseが教えてくれる
			configuration.load(inputStream);
			inputStream.close();

		}catch (IOException e){  //例外が発生したらcatchに行く
			e.printStackTrace(); //エラーの中身を出力するメソッド  処理は落ちていない そのため継続処理可能
		}

	}

}
```

- try - catch - finally 構文

```java
package error;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.Properties;

import javax.security.auth.login.Configuration;

public class Exception {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO 自動生成されたメソッド・スタブ
		Properties configuration = new Properties();			//  下までファイルを読み込む際の定型文
		File file = new File("resource/message.prosperties");
		try{
			InputStream inputStream = new FileInputStream(file); // FileInputStreamは例外が発生する可能性があるからtry/catch文を書けとeclipseが教えてくれる
			configuration.load(inputStream);
			inputStream.close();

		}catch (IOException e){  //例外が発生したらcatchに行く
			System.out.println("ファイルの読み込みに失敗しました");
			e.printStackTrace(); //エラーの中身を出力するメソッド  処理は落ちていない そのため継続処理可能
		}finaly{
			System.out.println("An error has occured.(ErrorCode:" + errCode + ")");
			//

	}
}
}
```
