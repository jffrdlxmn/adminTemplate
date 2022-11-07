<?php
 class Connect extends  PDO
 {
    private $host = '192.168.2.109';
	private $username = "cvsurosario";
	private $dbname = "cvsudatabase123qwe";
	private $password = "cVsu_ccat123!";
	private $connect;
		
	public function __construct(){
		if(!isset($this->db)){
			// Connect to the database
			try{
				$connect = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
				$connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db = $connect;
			}
			catch(PDOException $e)
			{
				die("Failed to connect with MySQL: " . $e->getMessage());
				
			}
		}
		else{
			 header("location:views/balance/accessDenied.php"); 
		}

	}

}
    


?>