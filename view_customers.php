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
	//****TODO*****
	//put the customers array into a table in html
		$server = "localhost";
		$user = "root";
		$pw = null;
		$db = "sakila";
		
		$connect = mysqli_connect($server, $user, $pw, $db);
		
		if(!$connect) 
		{
			die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
		}
		
		$userQuery = "select customer.first_name, customer.last_name, address.address, city.city, address.district, address.postal_code, 
					group_concat(distinct film.title separator ';')  as 'titles'
					from customer 
					inner join address on customer.address_id = address.address_id 
					inner join city on address.city_id = city.city_id
					inner join rental on customer.customer_id = rental.customer_id
					inner join inventory on rental.inventory_id = inventory.inventory_id 
					inner join film on inventory.film_id = film.film_id
					group by concat(customer.first_name, customer.last_name) 
					order by customer.last_name";
		$result = mysqli_query($connect, $userQuery);

		if (!$result) 
		{
			die("Could not successfully run query ($userQuery) from $db: " .mysqli_error($connect) );
		}

		if (mysqli_num_rows($result) == 0) 
		{
			print("No records found with query $userQuery");
		}
		else 
		{
			//$customers = [];
			
			print("<table border = '3'><tr>");
			print("<th>First Name</th>");
			print("<th>Last Name</th>");
			print("<th>Address</th>");
			print("<th>City</th>");
			print("<th>District</th>");
			print("<th>Postal Code</th>");
			print("<th>Titles</th>");
			print("</tr>");
			
			while($row = mysqli_fetch_assoc($result))
			{
				print ("<tr><td>".$row['first_name']."</td><td>"
				.$row['last_name']."</td><td>"
				.$row['address']."</td><td>"
				.$row['city']."</td><td>"
				.$row['district']."</td><td>"
				.$row['postal_code']."</td><td>"
				.$row['titles']."</td><td></td></tr>");
				//array_push($customers, $row); 
			}
			//print("<h1>First Names</h1>");
			//print("<pre>");
			//print_r($customers);
			//print("</pre>");
		}
		
		mysqli_close($connect);
	?>
	<form action="manager.html">
		<input type = "submit" value="Go Back"/>
	</form>
</body>
</html>