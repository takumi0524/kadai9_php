<?php
session_start();
//funcs.phpで作成したログイン認証チェック関数を呼び出したい
include("funcs.php");
logincheck();
?>

<html>

<head>
    <meta charset="utf-8">
    <title>演奏曲アンケート 改</title>
</head>

<body>
    <p>演奏曲アンケート</p>
    <p></p>
    <form action="insert.php" method="post">
        お名前　　　　　　　　: <input type="text" name="name" size="20"><br>
        メールアドレス　　　　: <input type="text" name="mail" size="40"><br>
        年齢（演奏時）　　　　: <input type="text" name="age" size="1">歳<br>
        作曲家　　　　　　　　: <input type="text" name="composer" size="20"><br>
        曲名　　　　　　　　　: <input type="text" name="songtitle" size="40"><br>
        <!-- 以下、2回目の課題で更新したもの -->
        <!-- 譜読期間: <input type="text" name="learningterm"><br> -->
        譜読期間　　　　　　　: <input type="text" list="learningterm" name="learningterm"><br>
            <datalist id="learningterm">
                <option value="1週間以内">
                <option value="2週間以内">
                <option value="1か月以内">
                <option value="2か月以内">
                <option value="3か月以内">
                <option value="6か月以内">
                <option value="1年以内">
            </datalist>
        <!-- 必要度数: <input type="text" name="degree"><br> -->
        必要度数　　　　　　　: <input type="text" list="degree" name="degree" size="5"><br>
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
        <!-- 演奏時間　　　　　　　: <input type="text" name="playingtime"><br> -->
        演奏時間（リピート含）: <input type="text" list="playingtime" name="playingtime" size="7"><br>
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
        <!-- 体感難易度　　　　　　: <input type="text" name="level"><br> -->
        体感難易度　　　　　　: <input type="text" list="level" name="level" size="5"><br>
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
        <!-- アピールポイント・感想: <input type="text" name="appealpoint" cols="40" rows="4" ><br> -->
        アピールポイント・感想:<br><textarea name="appealpoint" rows="4" cols="60"></textarea><br>
        <input type="submit" value="送信">

        <!-- <input type="submit" value="表示"> ⇒表示ボタンで今までに投稿-->
    </form>
</body>

</html>
