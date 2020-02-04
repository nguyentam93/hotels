<?php
/**
 * 【注意！】このプログラムを実行する前に、必ずsql/init_reviewdb.sqlを実行しておくこと！
 */
// データベース接続情報
$dsn = "mysql:host=localhost;dbname=reviewdb";
$user = "reviewdb_admin";
$password = "admin123";

// データベースに接続
$pdo = null;
try {
	// データベース接続オブジェクトを取得
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'");
	// PDOの呼び出し
	$pdo = new PDO($dsn, $user, $password, $options);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	/*
	【PDO例外での表示】
		・DNSに誤りがある場合
    SQLSTATE[HY000] [1044] Access denied for user 'reviewdb_admin'@'localhost' to database 'reviewd'

		・ユーザー認証に問題がある（ユーザIDまたはパスワードに誤りがある）場合
    SQLSTATE[HY000] [1045] Access denied for user 'reviewdb_admi'@'localhost' (using password: YES)

		・データベース自体に問題がある（データベースが停止しているなど）場合：「sudo service mysql stop」してから確認する。確認後は「sudo service mysql start」で起動しておくこと！
    SQLSTATE[HY000] [2002] No such file or directory

	*/
	echo $e->getMessage();
}
?>