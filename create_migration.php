#!/usr/bin/php
<?php

define('DS', DIRECTORY_SEPARATOR);

if(isset($argv[1]) && $argv[1] != '--help' && $argv[1] != '-h'):
	$thisScript = $argv[0];
	$path = dirname($thisScript);
	$migrationName = $argv[1];
	$ext = 'sql'; // default to SQL commands

	if(isset($argv[2])):
		$ext = $argv[2];

		if($ext != "sql" && $ext != "php"):
			die("Unknown extention $ext" . PHP_EOL);
		endif;
	endif;

	date_default_timezone_set('UTC');
	$filename = $path . DS . date('Y.m.d-H.i.s') . "_" . $migrationName . ".$ext";
	$f = fopen($filename, 'w');

	if('php' === $ext):
		fwrite($f, "<?php

// Please be verbose. Use echo and end lines with \\n
// Use migration_sql(\$query) to run queries (prints and runs the query)

?>");
	endif;
	fclose($f);

	echo "Created migration $filename", PHP_EOL;

else:
	echo "Usage: $thisScript name [*sql|php]", PHP_EOL;
endif;
