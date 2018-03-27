<?php
	function updateDatabase($query, $array = null){
		include ("connection.php");

		try{
			$connection = new PDO("mysql:host=$host; dbname=$database", $user, $password);
			$table = array();

			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$connection->exec("SET CHARACTER SET utf8");
			$recordSet = $connection->prepare($query);
			$recordSet->execute($array);
			$recordSet->closeCursor();

			return $recordSet->rowCount();

		}catch(Exception $e){
			die ('Error: ' . $e->GetMessage());

		}finally{
			$connection = null;
		}
	}
?>