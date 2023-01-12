<?php

//最初にSESSIONを開始！！ココ大事！！
session_start();    //session関数を使用する
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

//POST値を受け取る


//1.  DB接続します
// require_once('funcs.php');
// $pdo = db_conn();
try {
    //ID:'root', Password: ''
    $pdo = new PDO('mysql:dbname=kadai_php2; charset=utf8; host=localhost','root','');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }

//2. データ登録SQL作成
// gs_user_tableに、IDとWPがあるか確認する。
// ↓ここをlidだけに変更(HASH化の一環)
// $sql = "SELECT * FROM kadai_php2_user WHERE u_id=:lid AND u_pw=:lpw";
$sql = "SELECT * FROM kadai_php2_user WHERE u_id=:lid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
// *Hash化する場合はコメントする
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false){
    $error = $stmt->errorInfo();
    exit("Queryerror:".$error[2]);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();  //1レコードだけ取得する方法

//if(password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
if( $val['id'] != '' && password_verify($lpw, $val['u_pw'])){
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION["chk_ssid"] = session_id();
    // $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["u_name"] = $val['u_name'];

    header('Location: select.php');
}else{
    //Login失敗時(Logout経由)
    header('Location: login.php');
}

exit();
