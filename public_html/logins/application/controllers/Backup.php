<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Backup extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper("file","url");
    }
    public function index(){
	    $tables = '*';
	    $db = new mysqli($this->db->hostname,$this->db->username,$this->db->password,$this->db->database); 

	    //get all of the tables
	    if($tables == '*'){
	        $tables = array();
	        $result = $db->query("SHOW TABLES");
	        while($row = $result->fetch_row()){
	            $tables[] = $row[0];
	        }
	    }else{
	        $tables = is_array($tables)?$tables:explode(',',$tables);
	    }

	    //loop through the tables
	    foreach($tables as $table){
	        $result = $db->query("SELECT * FROM $table");
	        $numColumns = $result->field_count;

	        $return .= "DROP TABLE $table;";

	        $result2 = $db->query("SHOW CREATE TABLE $table");
	        $row2 = $result2->fetch_row();

	        $return .= "\n\n".$row2[1].";\n\n";

	        for($i = 0; $i < $numColumns; $i++){
	            while($row = $result->fetch_row()){
	                $return .= "INSERT INTO $table VALUES(";
	                for($j=0; $j < $numColumns; $j++){
	                    $row[$j] = addslashes($row[$j]);
	                    $row[$j] = ereg_replace("\n","\\n",$row[$j]);
	                    if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
	                    if ($j < ($numColumns-1)) { $return.= ','; }
	                }
	                $return .= ");\n";
	            }
	        }

	        $return .= "\n\n\n";
	    }

	    //save file
	    //unlink('/usr/www/users/einteajaxm/login/'.$this->session->userdata['sql_backup_file']);
	    foreach (glob("/usr/www/users/einteajaxm/login/db-backup-*.sql") as $filename) {
		    unlink($filename);
		}
	    $file_name = 'db-backup-'.time().'.sql';
	    $this->session->userdata['sql_backup_file'] = $file_name;
	    $handle = fopen($file_name,'w+');
	    fwrite($handle,$return);
	    fclose($handle);
	    echo 'Your Database Backup Completed.<br>';
	    echo anchor(prep_url(base_url().$file_name), 'Export', 'target="_blank"');
	    exit;
	}
}