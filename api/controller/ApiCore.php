<?php

require_once dirname(__FILE__) . '/ApiRepository.php';
require_once dirname(__FILE__) . '/../interfaces/IApiCore.php';
require_once dirname(__FILE__) . '/../utils/ResponseGenerator.php';
require_once dirname(__FILE__) . '/../utils/Utils.php';

class ApiCore implements IApiCore {
  static private function _validate_request($event_name, $start, $end, $aggregate_by) {
    $aggregations = array('user_ip', 'event_name', 'user_authenticated');

    if (!($event_name and $start and $end and $aggregate_by)) {
      return ResponseGenerator::generate_400_response(
        "Request [event_name: string], [start: date('Y-m-d')], [end: date('Y-m-d')] and [aggregate_by: string { user_ip, event_name, user_authenticated }] params are required"
      );
    } else if (!(Utils::validate_date_format($start) and Utils::validate_date_format($end))) {
      return ResponseGenerator::generate_400_response(
        "Request [start: date('Y-m-d')] or/and [end: date('Y-m-d')] params format are invalid"
      );
    } else if (!in_array($aggregate_by, $aggregations)) {
      return ResponseGenerator::generate_400_response(
        "Request [aggregate_by: string { user_ip, event_name, user_authenticated }] value is invalid"
      );
    }

    return true;
  }

  static public function save_data() {
    $json = Utils::get_request_body();
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
    $event_name = strtolower($_REQUEST['event_name']);
    $start = $_REQUEST['start'];
    $end = $_REQUEST['end'];
    $aggregate_by = $_REQUEST['aggregate_by'];

    // Validate input
    $validation_result = self::_validate_request($event_name, $start, $end, $aggregate_by);
    if ($validation_result !== true) {
      return $validation_result;
    }

    return ResponseGenerator::generate_200_response(array(
      'event_name' => $event_name,
      'start_date' => $start,
      'end_date' => $end,
      'aggregation' => $aggregate_by,
      'statistic' => array(
        "count_by_$aggregate_by" => ApiRepository::get_records_where(
          $event_name, $start, $end, $aggregate_by
        )
      ),
    ));
  }
}
