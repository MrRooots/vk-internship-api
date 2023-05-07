<?php

require_once dirname(__FILE__) . '/../utils/SqlHelper.php';
require_once dirname(__FILE__) . '/../models/EventModel.php';

class ApiRepository {
  static public function get_records() {
    $users = array();
    $data = SqlHelper::get_all_rows("
      select * from events
    ");

    foreach ($data as $user_data) {
      $users[] = new EventModel($user_data);
    }

    return $users;
  }

  /**
   * @return EventModel
   */
  static public function save_data(array $data) {
    $auth = (int)$data['user_authenticated'];

    SqlHelper::execute_query("
      insert into events(event_name, created_at, user_ip, user_authenticated) 
      value (
        '${data['event_name']}', 
        '${data['created_at']}', 
        inet_aton('{$data['user_ip']}'), 
        $auth
      )
    ");

    $id = SqlHelper::get_last_insert_id();
    return new EventModel(SqlHelper::get_row("
      select * 
      from events 
      where id = $id
    "));
  }
}
