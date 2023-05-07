<?php

require_once dirname(__FILE__) . '/Config.php';

/**
 * Database Connection manager
 */
class DBConnect {
  /**
   * Establish connection to database
   * @return void
   */
  static public function connect() {
    mysql_pconnect(
      Config::HOST,
      Config::USERNAME,
      Config::PASSWORD
    );
    mysql_select_db(Config::DATABASE);
    mysql_set_charset(Config::CHARSET);
  }
}

DBConnect::connect();