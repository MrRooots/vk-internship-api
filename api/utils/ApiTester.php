<?php

class ApiTester {
  static public function get_data() {
    return file_get_contents('http://vk.entership.api.com/posts');
  }

  static public function post_data() {

  }
}

// echo '<pre>';
echo ApiTester::get_data();
// echo '</pre>';
