<?php

require_once dirname(__FILE__) . '/../enums/AuthenticationStatus.php';
require_once dirname(__FILE__) . '/EventEntity.php';


/**
 * Class UserModel
 */
class EventModel extends EventEntity {
  /**
   * @param array $data
   */
  public function __construct($data) {
    $this->_id = $data['id'];
    $this->_event_name = $data['event_name'];
    $this->_created_at = $data['created_at'];
    $this->_user_status = $data['user_status'];
    $this->_user_ip = $data['user_ip'];
  }

  /**
   * Build associative __array__ from current model.
   * @return array<string, mixed>
   */
  public function to_json() {
    return array(
      'id' => $this->_id,
      'event_name' => $this->_event_name,
      'created_at' => $this->_created_at,
      'user_status' => AuthenticationStatus::get_status(
        $this->_user_status
      ),
      'user_ip' => long2ip($this->_user_ip),
    );
  }
}
