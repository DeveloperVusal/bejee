<?php

namespace Core\Facades\Database;

use Core\Engine\Database as BaseDatabase;

final class MariaDB extends BaseDatabase {

    public static function __constructStatic(): void
	{
		self::connect_handle();
	}

    protected static function connect_handle(): \PDO
    {
        try {
			$dsn = 'mysql:host='.env('DB_HOST').';port='.env('DB_PORT').';dbname='.env('DB_DATABASE');
			self::$dbn = new \PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'));

			return self::$dbn;
		} catch (\PDOException $e) {
			throw new \Exception($e->getMessage());
		}
    }

    public static function connection(): \PDO
	{
		return self::connect_handle();
	}
}