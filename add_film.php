<!--	Author: 	Noah Taylor
		Date:		Nov 13, 2022
		File:		hw8
-->

<html>
<head>
	<title>View Customers</title>
	
</head>
<body>
	<?php
		$title = $_POST["title"];
		$description = $_POST["description"];
		$ry = $_POST["release_year"];
		$li = $_POST["language_id"];
		$rd = $_POST["rental_duration"];
		$rr = $_POST["rental_rate"];
		$length = $_POST["length"];
		$rc = $_POST["replacement_cost"];
		$rating = $_POST["rating"];
		$sf = $_POST["special_features"];
		
		$server = "localhost";
		$user = "root";
		$pw = null;
		$db = "sakila";
		
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		try
		{
			$mysqli = new mysqli($server, $user, $pw, $db);
			$mysqli->set_charset("utf8mb4");
		}
		catch(Exception $e)
		{
			error_log($e->getMessage());
			exit('Error connecting to database');
		}
		
		try
		{
			$stmt = $mysqli ->prepare("INSERT INTO sakila.film (title,description,release_year,language_id,rental_duration,rental_rate,
			length,replacement_cost,rating,special_features) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
			$stmt->bind_param("ssiiididss",$title, $description, $ry, $li, $rd, $rr, $length, $rc, $rating, $sf);
			$stmt->execute();
			$stmt->close();
			print("<h1> Success</h1>");
		}
		catch(Exception $e)
		{
			print($e);
			die('Film could not be added');
		}
		/*$connect = mysqli_connect($server, $user, $pw, $db);
		
		if(!$connect) 
		{
			die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
		}
		
		$userQuery = "INSERT INTO sakila.film (title,description,release_year,language_id,rental_duration,rental_rate,
		length,replacement_cost,rating,special_features) VALUES (".$title.", ".$description.", ".$ry.", ".$li.", ".$rd.", ".$rr.",
		".$length.", ".$rc.", ".$rating.", ".$sf.")";
		
		$result = mysqli_query($connect, $userQuery);

		if (!$result) 
		{
			die("Could not successfully run query ($userQuery) from $db: " .mysqli_error($connect) );
		}
		else
		{
			print("Success");
		}*/
	?>
	<form action="manager.html">
		<input type = "submit" value="Home"/>
	</form>
</body>
</html>