<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//1.POSTでid,name,email...を取得
$id = $_POST['id'];
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

//2.DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=kadai_php2;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
  }

//3.UPDATE kadai_php2_piano SET...;

$sql = 'UPDATE kadai_php2_piano 
SET name=:name, 
mail=:mail, 
age=:age, 
composer=:composer, 
songtitle=:songtitle, 
learningterm=:learningterm, 
degree=:degree, 
playingtime=:playingtime, 
level=:level, 
appealpoint=:appealpoint 
WHERE id =:id';

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':name',         $name,         PDO::PARAM_STR);
$stmt->bindValue(':mail',         $mail,         PDO::PARAM_STR);
$stmt->bindValue(':age',          $age,          PDO::PARAM_INT);
$stmt->bindValue(':composer',     $composer,     PDO::PARAM_STR);
$stmt->bindValue(':songtitle',    $songtitle,    PDO::PARAM_STR);
$stmt->bindValue(':learningterm', $learningterm, PDO::PARAM_STR);
$stmt->bindValue(':degree',       $degree,       PDO::PARAM_STR);
$stmt->bindValue(':playingtime',  $playingtime,  PDO::PARAM_STR);
$stmt->bindValue(':level',        $level,        PDO::PARAM_INT);
$stmt->bindValue(':appealpoint',  $appealpoint,  PDO::PARAM_STR);
$stmt->bindValue(':id',           $id,           PDO::PARAM_INT);//更新したいidを渡す
$status = $stmt->execute();

//4.データ登録処理後
if($status==false) {
    //execute (SQL実行時にエラーがある場合)  
    $error = $stmt->errorinfo();
    exit("ErrorQuery:".$error[2]);
} else {
    //select.phpへリダイレクト
    header("Location: select.php");
}
?>