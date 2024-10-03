<?php
define('HOST', 'localhost');  
define('USER', 'root');  
define('PASS', '');  
define('DB', 'survey'); 

class db{
  
public $con; 
public function __construct(){

    if (!isset($this->con)) {
        $this->con = new mysqli(HOST,USER,PASS,DB);
        if (!$this->con) {
            echo 'Cannot connect to database server';
            exit;
        }      
    }    
    return $this->con;
}
}
?>