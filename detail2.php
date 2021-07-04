<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(func.phpを呼び出して)
require_once('func.php');
$pdo = db_conn();
// try {
//     //Password:MAMP='root',XAMPP=''
//     $pdo = new PDO('mysql:dbname=bm_table;charset=utf8;host=localhost','root','root');
//   } catch (PDOException $e) {
//     exit('DBConnectError:'.$e->getMessage());
//   }

//2.対象のIDを取得
$id = $_GET['id'];
echo "GET: ". $id;

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id = :id" );
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
?>
<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>bookmark</legend>
     <label>書籍名：<input type="text" name="bookname" value="<?= $result['bookname'] ?>"></label><br>
     <label>書籍url：<input type="text" name="bookurl" value="<?= $result['bookurl'] ?>"></label><br>
     <label>価格：<input type="text" name="price" value="<?= $result['price'] ?>"></label><br>
     <label>ジャンル：<input type="text" name="genre" value="<?= $result['genre'] ?>"></label><br>
     <label><textArea name="bookcomment" rows="4" cols="40"><?= $result['bookcomment'] ?></textArea></label><br>
     <input type="hidden" name="id" value ="<?= $result['id'] ?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
