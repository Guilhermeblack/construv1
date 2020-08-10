<?php

class DB{
	//database configuration
	private $dbHost     = "localhost";
	private $dbUsername = "furlan_constru";
	private $dbPassword = "&_^jWJLeebh]";
	private $dbName     = "furlan_constru";
	private $imgTbl     = 'tour_empreendimento';
	 
	function __construct(){
		if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
	}
	function getRows(){
		$idempreendimento   = $_GET["idempreendimento"];
		$query = $this->db->query("SELECT * FROM tour_empreendimento WHERE empreendimento_id =".$idempreendimento." ORDER BY ordem ASC");
		if($query->num_rows > 0){
			while($row = $query->fetch_assoc()){
				$result[] = $row;
			}
		}else{
			$result = FALSE;
		}
		return $result;
	}
	
	function updateOrder($id_array){
		$count = 1;
		foreach ($id_array as $id){
			$update = $this->db->query("UPDATE tour_empreendimento SET ordem = $count WHERE idtour_empreendimento = $id");
			$count ++;	
		}
		return TRUE;
	}
}
?>