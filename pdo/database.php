<?php
/**
 * データベース接続情報文字列定数群
 * DB_DSN 			データベース接続文字列：データベースに接続するための汎用接続情報
 * DB_URL 			接続先データベースのURL表記：DNSのURL表現
 * DB_USER 			データベース接続ユーザ
 * DB_PASSWORD　データベース接続パスワード 
 */
if (!defined("DB_DSN")) define("DB_DSN", "mysql:host=localhost; dbname=reviewdb");
if (!defined("DB_URL")) define("DB_URL", "mysql://localhost:3306/reviredb");
if (!defined("DB_USER")) define("DB_USER", "reviewdb_admin");
if (!defined("DB_PASSWORD")) define("DB_PASSWORD", "admin123");

/**
 * データベースに接続する。
 * @return PDO データベース接続に成功した場合はデータベース接続オブジェクト、それ以外はnull
 * @throw PDOException
 */
function connectDatabase() {
	// データベースに接続
	$pdo = null;
	try {
		// データベース接続オブジェクトを取得
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'");
		// PDOの呼び出し
		$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, $options);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e->getMessage();
	} finally {
		return $pdo;
	}
}

/**
 * データベースの接続を破棄する（切断する）。
 * @prem PDO データベース接続オブジェクト
 */
function disconnectDatabase(PDO $pdo):void {
	if (!is_null($pdo)) {
		unset($pdo);
	}
}

?>