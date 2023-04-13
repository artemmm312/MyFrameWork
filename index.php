<?php

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__);
require_once __DIR__ . "/Fw/init.php";

	$test = Fw\Core\Config::get('db/host');
var_dump($test);
