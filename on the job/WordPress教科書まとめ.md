# WordPress教科書まとめ

### テーマ作成に必要なファイル
- wpの利用可能なテーマを作成するために最低限必要なファイルは
	1. index.php
		- index.phpは何も記述しなくても機能する
	2. style.css
		- テーマとしての宣言を冒頭に記述する必要がある
	3. screenshot.pngについて
		- 管理画面の外観→テーマで表示されるスクリーンショット(サムネイル)画像はscreenshot.pngとし縦660px * 880pxで作成し、index.phpと同じ階層に保存する
- `<?php bloginfo(); ?>`
	- `bloginfo()は該当サイトの基本情報を出力するテンプレートタグ
	- `<?php bloginfo('stylesheet_url'); ?>`とすると現在有効化されているテーマディレクトリ内のstyle.cssまでのURLが出力される
	- `<?php bloginfo('template_url'); ?>` ⇒ 現在有効化のテーマディレクトリのURL出力
	- `<?php bloginfo('name'); ?>`  → サイト名称の出力
	- `<?php bloginfo('description'); ?>`  → 管理画面で設定するキャッチフレーズ出力

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

### index.phpを分割
- index.phpに以下を記述すると同階層の以下のファイルを読み込む
	- `<?php get_header(); ?>`と記述する→header.phpを読み込む
	- `<?php get_footer(); ?>` → footer.phpを読み込む
	- `<?php get_sidebar(''); ?>` →sidebar.phpを読み込む
		- `<?php get_sidebar('top'); ?>`と記述すると→sidebar-top.phpを読み込む
		- 他も一緒
	- get_template_part('header')とget_header()は同じ
- `<?php echo home_url('/'); ?>`→トップページのリンク出力
- ダッシュボード左上のメッセージは一般設定のキャッチフレーズ

### カスタムヘッダーでメインイメージの表示
- function.phpをindex.phpと同階層に新規作成
	- テンプレート内で利用する独自のテンプレートタグや関数を定義する重要なファイル