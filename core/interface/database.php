<?php

namespace Core\Interface;

interface Database {
    /**
	 * Construct method for facade classes
	 *
	 * @access public
	 * @static
     * @return void
	 */
    public static function __constructStatic(): void;
    /**
	 * Connection to database
	 *
	 * @access public
	 * @static
     * @return \PDO
	 */
    public static function connection(): \PDO;
}