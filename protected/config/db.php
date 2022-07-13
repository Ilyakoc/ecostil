<?php
/**
 * DB connection config
 */
return array(
    'connectionString' => 'mysql:host=localhost;dbname=ecostil_prest_db',
    'username' => 'root',
    'password' => '',
//    'schemaCachingDuration' => 1000,
	'initSQLs'=>[
		"SET sql_mode=''",
		// "SET time_zone = '+7:00'"
	]
);
