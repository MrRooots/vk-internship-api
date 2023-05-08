<?php

require_once dirname(__FILE__) . '/../utils/SqlHelper.php';
require_once dirname(__FILE__) . '/../models/EventModel.php';
require_once dirname(__FILE__) . '/../interfaces/IApiRepository.php';


class ApiRepository implements IApiRepository {
  static public function get_records_where($event_name, $start, $end, $aggregate_by) {
    $users = array();

    $data = SqlHelper::get_all_rows("
      select $aggregate_by, count($aggregate_by) as count from events
      where event_name = '$event_name' 
        and date(created_at) between '$start' and '$end'
      group by $aggregate_by
    ");

    foreach ($data as $user_data) {
      if ($aggregate_by == 'user_ip') {
        $key = long2ip($user_data[$aggregate_by]);
      } else if ($aggregate_by == 'user_status') {
        $key = AuthenticationStatus::get_status((int)$user_data[$aggregate_by]);
      } else {
        $key = $user_data[$aggregate_by];
      }

      $users[$key] = $user_data['count'];
    }

    return $users;
  }

  static public function save_data(array $data) {
    $auth = (int)$data['user_status'];

    SqlHelper::execute_query("
      insert into events(event_name, created_at, user_ip, user_status) 
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
