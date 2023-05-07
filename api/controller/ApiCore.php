<?php

require_once dirname(__FILE__) . '/ApiRepository.php';
require_once dirname(__FILE__) . '/../interfaces/IApiCore.php';
require_once dirname(__FILE__) . '/../utils/ResponseGenerator.php';

class ApiCore implements IApiCore {
  static public function save_data() {
    $json = json_decode(file_get_contents('php://input'), true);
    $data = array(
      'event_name' => strtolower($json['event_name']),
      'created_at' => $json['created_at'] ?: date('Y-m-d H:i:s'),
      'user_authenticated' => $json['user_authenticated'],
      'user_ip' => $json['user_ip'] ?: $_SERVER['REMOTE_ADDR'],
    );

    // Validate input data
    if (in_array(null, array_values($data), true)) {
      return ResponseGenerator::generate_400_response(
        "Request [event_name: string] and [user_authenticated: bool] params are required"
      );
    }

    return ResponseGenerator::generate_200_response(array(
      'event' => ApiRepository::save_data($data)->to_json(),
    ));
  }

  static public function get_data() {
    return ResponseGenerator::generate_200_response(array(
      'events' => array_map(function (EventModel $user) {
        return $user->to_json();
      }, ApiRepository::get_records()),
    ));
  }
}
