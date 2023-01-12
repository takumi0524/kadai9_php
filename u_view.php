<?php
// ログイン認証処理
session_start();
//funcs.phpで作成したログイン認証チェック関数を呼び出したい
include("funcs.php");
logincheck();
// ログイン認証処理終わり


// 1.GETでid値を取得
$id = $_GET["id"];
// echo $id;
// exit;

//2.DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=kadai_php2;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
  }

//3.SELECT * FROM kadai_php2_piano where id =:id
$sql = "SELECT * FROM kadai_php2_piano where id =:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4.データ表示
$view="";
if($status==false) {
    //execute (SQL実行時にエラーがある場合)  
    $error = $stmt->errorinfo();
    exit("ErrorQuery:".$error[2]);
} else {
    //1データのみ抽出の場合はwhileループで取り出さない
    $row = $stmt->fetch();
    //$row["id"], $row["name"]...
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>データ更新</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <form method="post" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>演奏曲アンケート</legend>
                <label>名前　　　　　　　　　　　:<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
                <label>メールアドレス　　　　　　:<input type="text" name="mail" value="<?=$row["mail"]?>"></label><br>
                <label>年齢　　　　　　　　　　　:<input type="text" name="age" value="<?=$row["age"]?>"></label><br>
                <label>作曲家　　　　　　　　　　:<input type="text" name="composer" value="<?=$row["composer"]?>"></label><br>
                <label>曲名　　　　　　　　　　　:<input type="text" name="songtitle" value="<?=$row["songtitle"]?>"></label><br>
                <!-- <label>譜読期間　　　　　　　　　:<input type="text" name="learningterm" value="<?=$row["learningterm"]?>"></label><br> -->
                <label>譜読期間　　　　　　　　　:<input type="text" list="learningterm" name="learningterm" value="<?=$row["learningterm"]?>"></label><br>
                <datalist id="learningterm">
                    <option value="1週間以内">
                    <option value="2週間以内">
                    <option value="1か月以内">
                    <option value="2か月以内">
                    <option value="3か月以内">
                    <option value="6か月以内">
                    <option value="1年以内">
                </datalist>
                <!-- <label>必要度数　　　　　　　　　:<input type="text" name="degree" value="<?=$row["degree"]?>"></label><br> -->
                <label>必要度数　　　　　　　　　:<input type="text" list="degree" name="degree" value="<?=$row["degree"]?>" size="5"></label><br>
                <datalist id="degree">
                    <option value="3度">
                    <option value="4度">
                    <option value="5度">
                    <option value="6度">
                    <option value="7度">
                    <option value="8度">
                    <option value="9度">
                    <option value="10度">
                    <option value="11度">
                    <option value="12度">
                </datalist>
                <!-- <label>演奏時間（リピート含）　　:<input type="text" name="playingtime" value="<?=$row["playingtime"]?>"></label><br> -->
                <label>演奏時間（リピート含）　　:<input type="text" list="playingtime" name="playingtime" value="<?=$row["playingtime"]?>" size="7"><br>
                <datalist id="playingtime">
                    <option value="1分以内">
                    <option value="2分以内">
                    <option value="3分以内">
                    <option value="4分以内">
                    <option value="5分以内">
                    <option value="6分以内">
                    <option value="7分以内">
                    <option value="8分以内">
                    <option value="9分以内">
                    <option value="10分以上">
                </datalist>
                <!-- <label>体感難易度　　　　　　　　:<input type="text" name="level" value="<?=$row["level"]?>"></label><br> -->
                <label>体感難易度　　　　　　　　:<input type="text" list="level" name="level" value="<?=$row["level"]?>" size="5"></label><br>
                <datalist id="level">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                    <option value="4">
                    <option value="5">
                    <option value="6">
                    <option value="7">
                    <option value="8">
                    <option value="9">
                    <option value="10">
                </datalist>
                <label>曲のアピールポイント／感想:<input type="text" name="appealpoint" value="<?=$row["appealpoint"]?>" size="60"></label><br>
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>        
</body>
</html>