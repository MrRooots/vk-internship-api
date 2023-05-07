<?php

class ResponseGenerator {
  static private $RESPONSE_ERRORS = array(
    '200' => '200 OK',
    '201' => '201 Created',
    '400' => '400 Bad Request',
    '404' => '404 Not Found',
    '405' => '405 Method Not Allowed',
    '500' => '405 Internal Server Error',
  );

  static public function generate_200_response(array $data) {
    $error = self::$RESPONSE_ERRORS['200'];
    header("HTTP/0.1 $error");

    return json_encode(array_merge(
      array('success' => 1),
      $data
    ));
  }

  static public function generate_201_response(array $data) {
    $error = self::$RESPONSE_ERRORS['201'];
    header("HTTP/0.1 $error");

    return json_encode(array_merge(
      array('success' => 1),
      $data
    ));
  }

  static public function generate_400_response($description) {
    $error = self::$RESPONSE_ERRORS['400'];
    header("HTTP/0.1 $error");

    return json_encode(array(
      'success' => 0,
      'error' => self::$RESPONSE_ERRORS['400'],
      'description' => $description,
    ));
  }

  static public function generate_404_response($description) {
    $error = self::$RESPONSE_ERRORS['404'];
    header("HTTP/0.1 $error");

    return json_encode(array(
      'success' => 0,
      'error' => self::$RESPONSE_ERRORS['404'],
      'description' => $description,
    ));
  }

  static public function generate_405_response($description) {
    $error = self::$RESPONSE_ERRORS['405'];
    header("HTTP/0.1 $error");

    return json_encode(array(
      'success' => 0,
      'error' => self::$RESPONSE_ERRORS['405'],
      'description' => $description,
    ));
  }

  static public function generate_500_response($description) {
    $error = self::$RESPONSE_ERRORS['500'];
    header("HTTP/0.1 $error");

    return json_encode(array(
      'success' => 0,
      'error' => self::$RESPONSE_ERRORS['500'],
      'description' => $description,
    ));
  }
}
