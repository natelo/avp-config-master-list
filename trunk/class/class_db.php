<?php
/*
 * DB class
 * 
 * File that handles DB.
 * 
 */

class db {	
	
	private $db;
	
	# Construct
	public function mysql()
	{		
		$this->db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Epic fail');			
		mysql_select_db(DB_DATABASE) or die("DB fail..");		
	}	
	
	# Clean sql
	public function clean($str) {
		return mysql_real_escape_string($str);
	}
	
	# Free memory
	public function free_memory($var) {
		mysql_free_result($var);
	} 
	
	# Escape output to avoid html errors..
	public function clean_output($str) {
		return htmlspecialchars($str);
	} 
	
	# Disconnect from the database 
	public function __destruct() {
		@mysql_close($this->db);
	}
}