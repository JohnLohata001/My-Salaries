<?php

define('ROOT', 'http://localhost/work2024/public');
define('REAL_PATH', realpath(dirname(dirname(dirname(__FILE__)))));

define('HOST', 'localhost');
define('USER', 'root');
define('PWD', 'Lo81t1#a9g9');
define('DBNAME', 'work2024');

$conn = new mysqli(HOST, USER, PWD, DBNAME);
