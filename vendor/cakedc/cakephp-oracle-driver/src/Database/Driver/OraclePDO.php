<?php
/**
 * Copyright 2015 - 2016, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2015 - 2016, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace CakeDC\OracleDriver\Database\Driver;

use Cake\Database\Driver;
use PDO;

class OraclePDO extends OracleBase {

    /**
     * @inheritdoc
     */
    protected function _connect($database, array $config) {
        $config['flags'] += [
            // PDO::ATTR_CASE => PDO::CASE_LOWER, // @todo move to config setting
            PDO::NULL_EMPTY_STRING => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => empty($config['persistent']) ? false : $config['persistent'],
            PDO::ATTR_ORACLE_NULLS => true,
        ];

        $database = 'oci:dbname=' . $database;
        parent::_connect($database, $config);
    }

    /**
     * Returns whether php is able to use this driver for connecting to database
     *
     * @return bool true if it is valid to use this driver
     */
    public function enabled() {
          return (class_exists('PDO') && in_array('oci', \PDO::getAvailableDrivers(), true));
    }

}
