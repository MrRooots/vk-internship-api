<?php

require_once dirname(__FILE__) . '/ApiCore.php';
require_once dirname(__FILE__) . '/../models/EventModel.php';
require_once dirname(__FILE__) . '/../utils/ResponseGenerator.php';


class Router {
  static private $ROUTES = array(
    'GET' => array(
      'filter' => 'ApiCore::get_data',
    ),
    'POST' => array(
      'save' => 'ApiCore::save_data',
    )
  );

  static public function get_routes() {
    $routes = array();
    foreach (self::$ROUTES as $ROUTE) {
      foreach (array_keys($ROUTE) as $array_value) {
        if (!in_array("/$array_value", $routes)) {
          $routes[] = "/$array_value";
        }
      }
    }

    return $routes;
  }

  static private function _check_request($method, $route) {
    if (self::$ROUTES[$method]) {
      if (in_array($route, array_keys(self::$ROUTES[$method]))) {
        return true;
      }

      foreach (self::$ROUTES as $ROUTE) {
        if (in_array($route, array_keys($ROUTE))) {
          return ResponseGenerator::generate_405_response(
            "Method [$method] not allowed for [/$route] route"
          );
        }
      }

      $routes = '[' . implode(', ', self::get_routes()) . ']';
      return ResponseGenerator::generate_404_response(
        "Route [/$route] not found\nPossible routes: $routes"
      );
    }

    return ResponseGenerator::generate_405_response(
      "Method [$method] not allowed"
    );
  }

  static public function handle_request() {
    header('Content-Type: application/json');

    $route = $_REQUEST['route'];
    $method = $_SERVER['REQUEST_METHOD'];

    $check_result = self::_check_request($method, $route);
    if ($check_result !== true) {
      return $check_result;
    }

    try {
      return call_user_func(self::$ROUTES[$method][$route]);
    } catch (Exception $exception) {
      return json_encode(array(
        'success' => 0,
        'error' => '500 Internal Server Error',
        'description' => 'Unhandled exception'
      ));
    }
  }
}

echo Router::handle_request();