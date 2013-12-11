<?php
include "config.php"; //Include configuation file
include "backup.php"; //Include main backup file which have code to create backup of sorure and database.

//get arguments passed to the script when running from the command line.
if(!empty($argv[1]))
{
	$Action = @$argv[1];
}
elseif(!empty($_GET['argv']))
{
	$Action = $_GET['argv'];
}

//Create object of backup class
$backupobj = new Backup($config, $DocumentRoot, $backupdir, $sourcedir);

switch($Action) {
	//Backup soruce caode and database weekly.
	case 'weekly':
		$backupobj->getSourceBackup();
		$backupobj->getDbBackup();
		break;
	//Backup incremental of database daily.
	case 'incremental':    
		$backupobj->getIncrementalBackup();
		break;
	default: 
		echo "Default";
}
die;
?>