<?php
function h($var) {
  if (is_array($var)) {
    return array_map('h', $var);
  } else {
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
  }
}
function checkInput($var) {
  if (is_array($var)) {
    return array_map('checkInput', $var);
  } else {
    if (get_magic_quotes_gpc()) {
      //get_magic_quotes_gpc():現在のmagic_quotes_gpcの値を取得する関数
      //設定がONの場合には1を、OFFの場合には0を返す
      //magic_quotes_gpc：php.iniのmagic_quotes_gpcという設定項目。"、'、￥、NULLを文字\でエスケープする。
      //デフォルトはon
      $var = stripslashes($var);
      //stripslashes()は\（バックスラッシュ）でクォートされた文字列から、クォート(エスケープ)部分を取り除いて返します。\"は"に、\'は'に、\\は\へと変換されます。
    }
    if (preg_match('/\0/', $var)) {
      die('不正な入力です。');
      //die：メッセージを出力し、現在のスクリプトを終了する
    }
    if (!mb_check_encoding($var, 'UTF-8')) {
      //mb_check_encoding(文字列, 文字コード)：文字列が、指定したエンコーディングで有効なものかどうかを調べる
      die('不正な入力です。');
    }
    return $var;
  }
}
