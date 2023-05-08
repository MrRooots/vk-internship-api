<?php

require_once dirname(__FILE__) . '/../interfaces/IResponseGenerator.php';


class ResponseGenerator implements IResponseGenerator {
  static private $RESPONSE_ERRORS = array(
    '200' => '200 OK',
    '201' => '201 Created',
    '400' => '400 Bad Request',
    '404' => '404 Not Found',
    '405' => '405 Method Not Allowed',
    '500' => '500 Internal Server Error',
  );

  static public function generate_successful_response($code, array $data) {
    $error = self::$RESPONSE_ERRORS["$code"];
    header("HTTP/0.1 $error");

    return json_encode(array_merge(
      array('success' => 1),
      $data
    ));
  }

  static public function generate_error_response($code, $description) {
    $error = self::$RESPONSE_ERRORS["$code"];
    header("HTTP/0.1 $error");

    return json_encode(array(
      'success' => 0,
      'error' => self::$RESPONSE_ERRORS["$code"],
      'description' => $description,
    ));
  }
}
