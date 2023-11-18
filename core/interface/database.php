<?php

namespace Core\Interface;

interface Database {
    /**
	 * Connection to database
	 *
	 * @access public
	 * @static
     * @return \PDO
	 */
    public static function connection(): \PDO;
}