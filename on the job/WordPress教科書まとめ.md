# WordPress教科書まとめ

### テーマ作成に必要なファイル
- wpの利用可能なテーマを作成するために最低限必要なファイルは
	1. index.php
		- index.phpは何も記述しなくても機能する
	2. style.css
		- テーマとしての宣言を冒頭に記述する必要がある
	3. screenshot.pngについて
		- 管理画面の外観→テーマで表示されるスクリーンショット(サムネイル)画像はscreenshot.pngとし縦660px * 880pxで作成し、index.phpと同じ階層に保存する

```css
/*
Theme Name: Pacific Malls Development
Theme URI: http://www.prime-strategy.co.jp/download/
Description: This is our original theme.
Author: Prime Strategy Co.,Ltd.
Author URI: http://www.prime-strategy.co.jp/
Version:1.0
*/
```