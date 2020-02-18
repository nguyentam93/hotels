<?php
require_once("../database.php");
require_once("../classes.php");

//リクエストパラメータ取得
$add = 999999;
if(isset($_REQUEST["add"])){
    $add = $_REQUEST["add"];
}/*else{
    //echo "";
    $alert = "<script type='text/javascript'>alert('「検索結果なし」');</script>";
    echo $alert;
}*/

//データベース取得
$pdo = connectDatabase();

//実行するSQLを設定
$sql = "select * from hotels where pref like '%$add%' or city like '%$add%' or address like '%$add%';";

//SQL実行オブジェクトを取得
$pstmt = $pdo->prepare($sql);

//プレースホルダにリクエストパラメータを設定
//$pstmt->bindValue(1,$address,$address,$address);

//SQL実行
$pstmt->execute();

//結果セットを取得
$rs = $pstmt->fetchAll();
if(empty($rs[0])){
    $alert = "<script type='text/javascript'>alert('「検索結果なし」');</script>";
    echo $alert;
}
//new Hotel(1,1,1,1,1,1,1,1);
//exit(0);
//結果セットを配列に格納
$hotels = [];
foreach ($rs as $record){
    $id = intval($record["id"]);
    $name = $record["name"];
    $price = intval($record["price"]);
    $pref  = $record["pref"];
    $city = $record["city"];
    $address = $record["address"];
    $memo = strval($record["memo"]); //ここのdebug２時間かかった(･_･; nullという罠ですね
    $image = $record["image"];
//    $hotel = new Hotel(1,1,1,1,1,1,1,1);
    $hotel = new Hotel($id, $name, $price, $pref, $city, $address, $memo, $image);
    $hotels[] = $hotel;
//    echo $image;
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>ホテル検索結果一覧</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
	<link rel="stylesheet" href="../assets/css/hotels.css" />
</head>

<body>
	<header>
		<h1>ホテル検索結果一覧</h1>
		<p><a href="entry.php">検索ページに戻る</a></p>
	</header>
	<main>
		<article>
			<table>
			    <?php foreach($hotels as $hotel) { ?>
				<tr>
					<td>
						<img src="../images/<?= $hotel->getImage() ?>" width="100" />
					</td>
					<td>
						<table class="detail">
							<tr>
								<td><?= $hotel->getName() ?><br /></td>
							</tr>
							<tr>
								<td><?= $hotel->getPref() ?><?= $hotel->getCity() ?><?= $hotel->getAddress() ?></td>
							</tr>
							<tr>
								<td>宿泊料：&yen;<?= $hotel->getPrice() ?></td>
							</tr>
							<tr>
								<td><?= $hotel->getMemo() ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<?php } ?>
			</table>
		</article>
	</main>
	<footer>
		<div id="copyright">(C) 2019 The Web System Development Course</div>
	</footer>
</body>

</html>