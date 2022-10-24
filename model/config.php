<?php
 class Connect extends  PDO
 {
    private $host = 'localhost';
	private $username = "cvsur934_admin";
	private $dbname = "cvsur934_clinic";
	private $password = "cvsuWebsite12345!";
	private $connect;
		
	public function __construct(){
		if(!isset($this->db)){
			// Connect to the database
			try{
				$connect = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
				$connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db = $connect;
			}catch(PDOException $e){
				die("Failed to connect with MySQL: " . $e->getMessage());
			}
		}
	}

}
    


?>