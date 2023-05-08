<?php

interface IApiRepository {
  /**
   * Get filtered records
   * @param string $event_name
   * @param string $start
   * @param string $end
   * @param string $aggregate_by
   * @return array<string, mixed>
   */
  static public function get_records_where($event_name, $start, $end, $aggregate_by);

  /**
   * Save given `data` to database
   * @param array $data
   * @return EventModel
   */
  static public function save_data(array $data);
}
