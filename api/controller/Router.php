<?php

require_once dirname(__FILE__) . '/ApiCore.php';
require_once dirname(__FILE__) . '/../models/EventModel.php';
require_once dirname(__FILE__) . '/../utils/ResponseGenerator.php';
require_once dirname(__FILE__) . '/../interfaces/IRouter.php';


class Router extends IRouter {
  /**
   * @param string $method
   * @param string $route
   */
  public function __construct($method, $route) {
    $this->_method = $method;
    $this->_route = $route;
  }

  protected function get_routes() {
    $routes = array();
    foreach ($this->ROUTES as $ROUTE) {
      foreach (array_keys($ROUTE) as $array_value) {
        if (!in_array("/$array_value", $routes)) {
          $routes[] = "/$array_value";
        }
      }
    }

    return $routes;
  }

  protected function _check_request() {
    if ($this->ROUTES[$this->_method]) {
      if (in_array($this->_route, array_keys($this->ROUTES[$this->_method]))) {
        return true;
      }

      foreach ($this->ROUTES as $ROUTE) {
        if (in_array($this->_route, array_keys($ROUTE))) {
          return ResponseGenerator::generate_error_response(500,
            "Method [$this->_method] not allowed for [/$this->_route] route"
          );
        }
      }

      $routes = '[' . implode(', ', self::get_routes()) . ']';
      return ResponseGenerator::generate_error_response(400,
        "Route [/$this->_route] not found\nPossible routes: $routes"
      );
    }

    return ResponseGenerator::generate_error_response(405,
      "Method [$this->_method] not allowed"
    );
  }

  public function handle_request() {
    $check_result = self::_check_request();
    if ($check_result !== true) {
      return $check_result;
    }

    try {
      return call_user_func($this->ROUTES[$this->_method][$this->_route]);
    } catch (Exception $exception) {
      return ResponseGenerator::generate_error_response(500,
        'Unhandled exception'
      );
    }
  }
}

$router = new Router(
  $_SERVER['REQUEST_METHOD'],
  $_REQUEST['route']
);

echo $router->handle_request();