<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST');

require_once dirname(__FILE__) . '/api/config/DBConnect.php';
require_once dirname(__FILE__) . '/api/controller/Router.php';
