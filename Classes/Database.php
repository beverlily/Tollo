<?php
namespace App;

class Database
{
	// private static $user = 'delanh_notears';
	// private static $pass = ')-RvK[W,zh&XM8AqB2CU';
	// private static $dsn = 'mysql:host=198.46.191.78;dbname=delanh_tollo';

	private static $user = 'root';
	private static $dsn = 'mysql:host=localhost;dbname=bevetgub_tollo';
	private static $pass = '';
	// private static $dsn = 'mysql:host=localhost; dbname=tollo';
	private static $dbcon;

	private function __construct()
	{ }
	public static function getDb()
	{
		if (!isset(self::$dbcon)) {
			try {
				self::$dbcon = new \PDO(self::$dsn, self::$user, self::$pass);
				self::$dbcon->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				$errorMessage = $e->getMessage();
				include 'error.php';
				exit();
			}
		}
		return self::$dbcon;
	}
}
Database::getDb();
