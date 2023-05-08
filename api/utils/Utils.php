<?php

require_once dirname(__FILE__) . '/../interfaces/IUtils.php';


class Utils implements IUtils {
  static public function get_request_body() {
    return json_decode(file_get_contents('php://input'), true);
  }

  static public function validate_date_format($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);

    return $d && $d->format($format) === $date;
  }
}
