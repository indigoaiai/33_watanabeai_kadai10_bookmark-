<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(func.phpを呼び出して)
require_once('func_user.php');
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
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id = :id" );
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
    <div class="navbar-header"><a class="navbar-brand" href="user_select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name"value="<?= $result['name'] ?>"></label><br>
     <label>id：<input type="text" name="lid"value="<?= $result['lid'] ?>"></label><br>
     <label>password：<input type="text" name="lpw"value="<?= $result['lpw'] ?>"></label><br>
     <label>管理者：<input type="text" name="kanri_flg"value="<?= $result['kanri_flg'] ?>"></label><br>
     <label>出勤管理：<input type="text" name="life_flg"value="<?= $result['life_flg'] ?>"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
