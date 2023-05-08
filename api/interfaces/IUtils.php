<?php


interface IUtils {
  /**
   * Get body of the request.
   *
   * @return array<string, mixed>
   */
  static public function get_request_body();

  /**
   * Check if given `date` is in given `format`
   * @param string $date
   * @param string $format { default: 'Y-m-d' }
   */
  static public function validate_date_format($date, $format = 'Y-m-d');
}
