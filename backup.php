<?php
include_once "recursiveZip.php"; //Include recursiveZip file which is utlity to create zipfile

class Backup {
	private $config;
	private $DocumentRoot;
	private $backupdir;
	private $sourcedir;
    
    Public function __construct($config,$DocumentRoot,$backupdir,$sourcedir)
    {
        $this->config = $config;
        $this->DocumentRoot = $DocumentRoot;
        $this->backupdir = $backupdir;
        $this->sourcedir = $sourcedir;
    }

	//Function create backup of source file in zip
    public function getSourceBackup()
    {   
        $z = new recursiveZip();
        $key_cfg = array_keys($this->config);

        foreach($key_cfg as $kcfg)
        { 
            $dbname = $this->config[$kcfg]['database'];
            $this->createDir($this->backupdir.DS.$kcfg);        

            //Destination folder where we create Zip file.
            $dst = $this->DocumentRoot.DS.$this->backupdir.DS.$kcfg.DS;
           
            //Create zip file for source
            $src = $this->config[$kcfg]['source'];

            $srcfile = $kcfg. "_".$this->sourcedir."_" . date("dmY").".zip";
            $src_name = $z->compress($src,$dst);
            rename($src_name, $dst.$srcfile);
        }
    }
    
	//Function create backup of database in zip
    public function getDbBackup()
    {
        $z = new recursiveZip();
        $key_cfg = array_keys($this->config);

        foreach($key_cfg as $kcfg)
        { 
            $dbname = $this->config[$kcfg]['database'];
            $dumpfile = $kcfg. "_sql_" . date("dmY") . ".sql";
           
            $this->createDir($this->backupdir.DS.$kcfg);
            // -p'.DBPASSWORD.'
			//mysql command to take backup of database [dump]
            $command = 'mysqldump -R -e '.$dbname.' --user '.DBUSER.' > '.$this->DocumentRoot.DS.$this->backupdir.DS.$kcfg.DS.$dumpfile;
            system($command);
           
            //Destination folder where we create Zip file.
            $dst = $this->DocumentRoot.DS.$this->backupdir.DS.$kcfg.DS;
           
            //Source file or directory to be compressed.
            $sql_src= $this->DocumentRoot.DS.$this->backupdir.DS.$kcfg.DS.$dumpfile;

            //Create zip file for database dump
            $dbfile = $z->compress($sql_src,$dst);
            $srcdbfile = $kcfg. "_sql_" . date("dmY").".zip";

            rename($dbfile, $dst.$srcdbfile);
			//remove souce mysqldump file
            unlink($sql_src);
        }
    }
    
    public function getIncrementalBackup()
    {
        $link = $this->connectDBServer();

        //Get latest binary log file
        $command = 'SHOW MASTER STATUS';
        $qry = mysql_query($command);
        $rec = mysql_fetch_row($qry);

        $number = (int)(preg_replace("/[^0-9]/", '', $rec[0]));

        $Incremental_source_dir = INCREMENTALDIR.'_'. date("dmY");

        $createdSrcDir = $this->createDir($this->sourcedir.DS.$Incremental_source_dir);

        for($i=$number; $i>0;$i--)
        {  
            $filename = BINARYLOGBASENAME . sprintf("%06d", $i);
            $file_loc = BINARYFILELOCATION.$filename;
           
            $current_date = date('d-m-Y');
            if(file_exists($file_loc) && (date("d-m-Y", filemtime($file_loc))==$current_date))
            {
                //copy binary log files from mysql data directory to document root source directory
                copy($file_loc, $this->DocumentRoot.DS.$this->sourcedir.DS.$Incremental_source_dir.DS.$filename);        
            }    
        } 
        
        //Create zip file for incremental backup
        $z = new recursiveZip();
        $createdBkpDir = $this->createDir($this->backupdir.DS.INCREMENTALDIR);
        $src_name = $z->compress($this->DocumentRoot.DS.$this->sourcedir.DS.$Incremental_source_dir,$this->DocumentRoot.DS.$this->backupdir.DS.INCREMENTALDIR.DS);

        //Remove binary log files from source incremental folder
        for($j=$number; $j>0;$j--)
        {  
            $filename = BINARYLOGBASENAME . sprintf("%06d", $j);
            $file_loc = $this->DocumentRoot.DS.$this->sourcedir.DS.$Incremental_source_dir.DS.$filename;

            if(file_exists($file_loc))
            {
                unlink($file_loc);
               
            }
           
        }
        $this->removeDir($this->sourcedir.DS.$Incremental_source_dir);
    }
    
    private function createDir($path)
    { 
        //make directory in source folder if not exists.
        if(!is_dir($this->DocumentRoot.DS.$path))
        {
			return mkdir($this->DocumentRoot.DS.$path);
        }
        else
        {
			return false;
        }
    }
    
    private function removeDir($path)
    { 
        //make directory in source folder if not exists.
        if(is_dir($this->DocumentRoot.DS.$path))
        {
            if(rmdir($this->DocumentRoot.DS.$path))
            {
              return true;
            }    
        }
        else
        {
            return false;
        }
    }

    
    private function connectDBServer()
    {
        try {
            //Connect to database server
            $conn = mysql_connect(DBHOST, DBUSER, DBPASSWORD);
            return $conn;
        }
        catch (Exception $e) {
            die($e->getMessage());
    }
    
    }
    
    private function compress($src,$dst)
    {
        define( 'DS', DIRECTORY_SEPARATOR );
        $programFilesPath = getenv( 'ProgramFiles' );
        $zipPath          = $programFilesPath . DS . '7-Zip' . DS;
        if( !is_dir( $zipPath ) ) {
            // Invalid Path
            $zipPath = str_ireplace( ' (x86)', '', $zipPath );
            if( empty( $zipPath ) || !is_dir( $zipPath ) ) {
                die( 'ERROR: 7-Zip is not installed on the system. Please install it first. It\'s a Freeware!' );
            }
        }
        echo system( '"'.$zipPath.'7z" u ".$dst." ".$src." -x!*.svn' );
    }
}
?>