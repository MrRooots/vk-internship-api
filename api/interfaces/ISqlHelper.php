<?php


interface ISqlHelper {

  /**
   * Get single [or first] value from query result
   * @param $query
   * @return mixed|null
   */
  static public function get_value($query);

  /**
   * Get single [or first] row from query results.
   * @param string $query
   * @return array<string, mixed>
   */
  static public function get_row($query);

  /**
   * @param string $query
   * @return array<array<string, mixed>>
   */
  static public function get_all_rows($query);

  /**
   * Execute given `query`
   * @param string $query
   * @return void
   */
  static public function execute_query($query);

  /**
   * Get the id of last `insert` operation
   * @return int
   */
  static public function get_last_insert_id();
}
