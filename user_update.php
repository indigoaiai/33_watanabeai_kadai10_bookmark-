<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得


$id = $_POST["id"];
$bookname = $_POST['bookname'];
$bookurl = $_POST['bookurl'];
$bookcomment = $_POST['bookcomment'];
$price = $_POST['price'];
$genre = $_POST['genre'];

//2. DB接続します
require_once('func.php');
$pdo = db_conn();

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
$stmt = $pdo->prepare( "UPDATE gs_bm_table SET bookname = :bookname, bookurl = :bookurl, bookcomment = :bookcomment, price = :price, genre = :genre,registerdate = sysdate() WHERE id = :id;" );  

// 4. バインド変数を用意
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookcomment', $bookcomment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price', $price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':genre', $genre, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
//     //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
//     //以下を関数化
    sql_error($stmt);
} else {
    redirect('user_select.php');
}
  