<?php

interface IApiCore {
  /**
   * Get data from request and save to database
   * @return string Response as json-encoded string
   */
  static public function save_data();

  /**
   * Get filtered data.
   */
  static public function get_data();
}
