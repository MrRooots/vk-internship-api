<?php


abstract class IRouter {
  /**
   * Request method
   * @var string
   */
  protected $_method;

  /**
   * Request route
   * @var string
   */
  protected $_route;

  protected $ROUTES = array(
    'GET' => array(
      'filter' => 'ApiCore::get_data',
    ),
    'POST' => array(
      'save' => 'ApiCore::save_data',
    )
  );

  abstract protected function _check_request();

  abstract protected function get_routes();

  abstract public function handle_request();
}
