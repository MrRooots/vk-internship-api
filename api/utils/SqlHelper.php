<?php

require_once dirname(__FILE__) . '/../config/DBConnect.php';

class SqlHelper {
  static public function get_value($query) {
    $result = mysql_query($query);

    if ($result) {
      $row = mysql_fetch_row($result);
      return $row[0];
    } else {
      return null;
    }
  }

  static public function get_row($query) {
    return mysql_fetch_assoc(
      mysql_query($query)
    );
  }

  static public function get_all_rows($query) {
    $result = mysql_query($query);
    $n = mysql_num_rows($result);
    $data = array();

    for ($i = 0; $i < $n; $i++) {
      $row = mysql_fetch_assoc($result);
      $data[] = $row;
    }

    return $data;
  }

  static public function execute_query($query) {
    return mysql_query($query);
  }

  static public function get_last_insert_id() {
    return mysql_insert_id();
  }
}
