<?php


/**
 * Class stores available authentication statuses.
 */
class AuthenticationStatus {
  /**
   * User unauthenticated
   * @var string
   */
  const UNAUTHENTICATED = 'unauthenticated';

  /**
   * User authenticated
   * @var string
   */
  const AUTHENTICATED = 'authenticated';

  /**
   * Get available authentication statuses
   * @return array<string>
   */
  static public function values() {
    return array(self::UNAUTHENTICATED, self::AUTHENTICATED);
  }

  /**
   * Get authentication status by id
   * @return string
   */
  static public function get_status($id) {
    $statuses = self::values();

    return $statuses[$id] ?: self::UNAUTHENTICATED;
  }
}
