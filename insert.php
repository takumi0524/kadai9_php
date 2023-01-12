<?php

// 0.おまじない(なかったらエラー)
if(
  !isset($_POST['name']) || $_POST['name']==""||
  !isset($_POST['mail']) || $_POST['mail']==""||
  !isset($_POST['age']) || $_POST['age']==""||
  !isset($_POST['composer']) || $_POST['composer']==""||
  !isset($_POST['songtitle']) || $_POST['songtitle']==""||
  !isset($_POST['learningterm']) || $_POST['learningterm']==""||
  !isset($_POST['degree']) || $_POST['degree']==""||
  !isset($_POST['playingtime']) || $_POST['playingtime']==""||
  !isset($_POST['level']) || $_POST['level']==""||
  !isset($_POST['appealpoint']) || $_POST['appealpoint']==""
){
  exit('ParamError');
}


/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
$name = $_POST['name'];
$mail = $_POST['mail'];
$age = $_POST['age'];
$composer = $_POST['composer'];
$songtitle = $_POST['songtitle'];
$learningterm = $_POST['learningterm'];
$degree = $_POST['degree'];
$playingtime = $_POST['playingtime'];
$level = $_POST['level'];
$appealpoint = $_POST['appealpoint'];

//2. DB接続
try {
  //ID:'root', Password: ''
  $pdo = new PDO('mysql:dbname=kadai_php2; charset=utf8; host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO kadai_php2_piano(id, name, mail, age, composer, songtitle, learningterm, degree, playingtime, level, appealpoint, indate)VALUES(NULL, :name, :mail, :age, :composer, :songtitle, :learningterm, :degree, :playingtime, :level, :appealpoint, sysdate())");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

// $stmt->bindValue('NULL', *****, ****************);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_INT);
$stmt->bindValue(':composer', $composer, PDO::PARAM_STR);
$stmt->bindValue(':songtitle', $songtitle, PDO::PARAM_STR);
$stmt->bindValue(':learningterm', $learningterm, PDO::PARAM_STR);
$stmt->bindValue(':degree', $degree, PDO::PARAM_STR);
$stmt->bindValue(':playingtime', $playingtime, PDO::PARAM_STR);
$stmt->bindValue(':level', $level, PDO::PARAM_INT);
$stmt->bindValue(':appealpoint', $appealpoint, PDO::PARAM_STR);
// $stmt->bindValue(':sysdate()', *****, ****************);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit;
}
?>
