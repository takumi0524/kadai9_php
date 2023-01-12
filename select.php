<?php
session_start();
//funcs.phpで作成したログイン認証チェック関数を呼び出したい
include("funcs.php");
logincheck();

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=kadai_php2;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM kadai_php2_piano");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php

  //テーブル処理
  $view .= '<table border="1"><tbody>';
  $view .= '<tr bgcolor="#b0c4de">
              <th width="40px">変更</th>
              <th width="40px">削除</th>
              <th width="60px">お名前</th>
              <th width="160px">メールアドレス</th>
              <th width="30px">年齢</th>
              <th width="100px">作曲家</th>
              <th width="160px">曲名</th>
              <th width="60px">譜読期間</th>
              <th width="50px">必要度数</th>
              <th width="50px">演奏時間</th>
              <th width="40px">難易度</th>
              <th>アピールポイント・感想</th>
            </tr>';
  $num = 1;

  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
 //テーブル中身(while文でデータ最後まで抽出)
    //行カウント
    $num += 1;

    if ($num % 2) {
      //余りがない(偶数行)のときだけ背景色を付ける
      $view .= '<tr bgcolor="#decaaf">';
    }
    else{  
      //奇数行のときは背景色を付けない
      $view .= '<tr>';
    }
        //GETデータ送信リンク作成
        $view .= '<th>';
          // $view .= "<p>";
            $view .= '<a href="u_view.php?id='.$result["id"].'">';
              $view .= "[変更]";
            $view .= '</a>';
          // $view .= "</p>";
        $view .= '</th>';

        //削除リンク
        $view .= '<th>';
        // $view .= "<p>";
        $view .= '<a href="delete.php?id='.$result["id"].'">';
        $view .= '[削除]';
        $view .= '</a>';
        // $view .= "</p>";
        $view .= '</th>';

        $view .= '<th>';
        $view .= $result['name'];
        $view .= '</th>';
        
        $view .= '<th>';
        $view .= $result['mail'];
        $view .= '</th>';
        
        $view .= '<th>';
        $view .= $result['age'];
        $view .= '</th>';
        
        $view .= '<th>';
        $view .= $result['composer'];
        $view .= '</th>';
        
        $view .= '<th>';
        $view .= $result['songtitle'];
        $view .= '</th>';

        $view .= '<th>';
        $view .= $result['learningterm'];
        $view .= '</th>';
        
        $view .= '<th>';
        $view .= $result['degree'];
        $view .= '</th>';
        
        $view .= '<th>';
        $view .= $result['playingtime'];
        $view .= '</th>';
        
        $view .= '<th>';
        $view .= $result['level'];
        $view .= '</th>';

        $view .= '<th>';
        $view .= $result['appealpoint'];
        $view .= '</th>';

      $view .= '<tr>';
      $pdo = null;

  }
  $view .= '</table></tbody>';
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>演奏曲アンケート</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:11px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">INDEX画面へ</a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>

<!-- Main[End] -->
<script>

  // クリックされたらその箇所のIDを拾って、感想と日付を表示する。
  // クリックした

  // 1.何らかの変数(仮に"a"とする)にクリックした箇所のIDを代入する(aにはIDの何かが入る)
  // 2.
  // 2.1の変数aクリックイベント


</script>

</body>
</html>
