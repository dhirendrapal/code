<?php
$DocumentRoot = __DIR__;
//$bfileloc = "C:/wamp/bin/mysql/mysql5.5.16/data/";
$bfileloc = "D:/xampp/mysql/data/";
echo $command = 'mysqlbinlog '.$bfileloc.'mysql-bin.000001 > '.$DocumentRoot.'/backup/blog1.sql';
system($command);
?>