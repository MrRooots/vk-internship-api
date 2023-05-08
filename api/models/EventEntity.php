<?php


abstract class EventEntity {
  /**
   * Event identifier
   * @var int
   */
  protected $_id;

  /**
   * Event name
   * @var string
   */
  protected $_event_name;

  /**
   * Event creation date
   * @var string
   */
  protected $_created_at;

  /**
   * User authentication status { 0 == 'unauthenticated' | 1 == 'authenticated' }
   * @var int
   */
  protected $_user_status;

  /**
   * User ip
   * @var string
   */
  protected $_user_ip;

  /**
   * @return int
   */
  public function get_id() {
    return $this->_id;
  }

  /**
   * @return string
   */
  public function get_event_name() {
    return $this->_event_name;
  }

  /**
   * @return string
   */
  public function get_user_ip() {
    return $this->_user_ip;
  }

  /**
   * @return string
   */
  public function get_creation_date() {
    return $this->_created_at;
  }

  /**
   * @return int
   */
  public function get_user_status() {
    return $this->_user_status;
  }
}
