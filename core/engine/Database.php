<?php

namespace Core\Engine;

use Core\Interface\Database as InterfaceDatabase;
use Core\Interface\Facades as InterfaceFacades;

abstract class Database implements InterfaceDatabase, InterfaceFacades {
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