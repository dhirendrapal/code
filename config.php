<?php
//Check script is running command line or browser.
if(php_sapi_name() == "cli") {
	define('DS', '\\');
}
else
{
	define('DS', '/');
}

//Defines a named constant at runtime.
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASSWORD', '');
define('BINARYFILELOCATION', 'D:/xampp/mysql/data/'); //Define binary file location
define('INCREMENTALDIR', 'incremental');
define('BINARYLOGBASENAME', 'mysql-bin.'); //define binary log file base name
$DocumentRoot = __DIR__;
$backupdir = "backup";
$sourcedir = "source";

//Set defaul time zone
date_default_timezone_set("Asia/Bangkok");

//Project folder location and database name which need backup 
$config = array(
		'project1' => array(
						'source'    => 'D:'.DS.'xampp'.DS.'htdocs'.DS.'code'.DS,
						'database'    => 'cdcol'
					),
		'project2' => array(
						'source'    => 'D:'.DS.'xampp'.DS.'htdocs'.DS.'dhiru'.DS,
						'database'    => 'zfcms'
					),
		'project3' => array(
						'source'    => 'D:'.DS.'xampp'.DS.'htdocs'.DS.'vision'.DS,
						'database'    => 'vision'
					)                        
	);
?>
