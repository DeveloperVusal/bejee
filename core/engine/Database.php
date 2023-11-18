<?php

namespace Core\Engine;

use Core\Interface\Database as InterfaceDatabase;

abstract class Database implements InterfaceDatabase {
    /**
	 * PDO instance
	 * 
	 * @var \PDO
	 * @access protected
	 * @static
	 */
	protected static \PDO $dbn;

    /**
	 * Handle connection to databse
	 * 
	 * @access protected
	 * @static
	 * @throws \Exception
	 * @return \PDO
	 */
	abstract protected static function connect_handle(): \PDO|string;
}