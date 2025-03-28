<?php

use Flame\Foundation\App;

require dirname(__DIR__).'/bootstrap/app.php';

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Origin: *');
header('X-Powered-By: ');

App::run();
