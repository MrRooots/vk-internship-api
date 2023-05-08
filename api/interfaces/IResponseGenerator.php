<?php

interface IResponseGenerator {
  /**
   * Generate response with codes [200, 201]
   * @param int $code
   * @param array $data
   * @return string
   */
  static public function generate_successful_response($code, array $data);

  /**
   * Generate response with codes [400, 404, 405, 500]
   * @param int $code
   * @param string $description
   * @return string
   */
  static public function generate_error_response($code, $description);
}