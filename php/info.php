<?php
	function info($query, $array = null){
		include ("connection.php");

		try{
			$connection; $recordSet; $row; $table;

			$connection = new PDO("mysql:host=$host; dbname=$database", $user, $password);
			$table = array();

			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$connection->exec("SET CHARACTER SET utf8");
			$recordSet = $connection->prepare($query);
			$recordSet->execute($array);

			while($row = $recordSet->fetch(PDO::FETCH_ASSOC)){
				array_push($table, $row);
			}

			$recordSet->closeCursor();
			return $table;

		}catch(Exception $e){
			die ('Error: ' . $e->GetMessage());

		}finally{
			$connection = null;
		}
	}
?>