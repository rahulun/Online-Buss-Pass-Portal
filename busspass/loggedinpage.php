<?php

	session_start();
	if(array_key_exists("id",$_COOKIE)){
		$_SESSION['id'] = $_COOKIE['id'];
	}
	if(array_key_exists("id",$_SESSION)){
		echo "Logged In! <a href = 'mywebpage.php?logout=1'>Log out</a></p>";
	}else{
		header("Loation: mywebpage.php");
	}
	
	include("h.php");
	
	
?>

<nav class="navbar navbar-light bg-faded navbar-fixed-top " style="background-color: 2F2B2B">
  

  <a class="navbar-brand" style="color: grey" href="#">Check In!</a>

    <div class="pull-xs-right">
      <a href ='mywebpage.php?logout=1'>
        <button class="btn btn-primary-outline fa fa-thumbs-up" type="submit"><span style="color:white">Logout</span></button></a>
    </div>

</nav></br>

<?php

$link = mysqli_connect("localhost", "root", "", "busspass");

if(mysqli_connect_error()) {
	
	die("There was an error connecting to the database");
	
}

$query = "SELECT `user`, `father`, `dob`, `phone`, `source`, `destination`, `busid`, `valid`, `charges` from customer WHERE `id` = '".$_SESSION['id']."' " ;
?>
<html>
<head>
	<title>Displaying MySQL Data in HTML Table</title>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
		
		#color{
			
			
			background-color: white;
			border-style: inset;
			
			margin-right:1000px;
			
			background-image: url('in.jpg');
}
			
			
		}
		
		
	</style>
</head>
<body>
	<h1>See Your Buss Pass Info below: </h1>
	<table class="data-table">
		
		<thead>
			<tr>
				<th>user</th>
				<th>Father name</th>
				<th>dob</th>
				<th>phone</th>
				<th>source</th>
				<th>Destination</th>
				<th>Bus Id</th>
				<th>Valid</th>
				<th>Charges in Rs.</th>

				
			</tr>
		</thead>
		<tbody>
		<?php
		if($result = mysqli_query($link, $query)){
		while ($row = mysqli_fetch_array($result))
		{
			
			echo '<tr>
					
					<td>'.$row['user'].'</td>
					<td>'.$row['father'].'</td>
					<td>'.$row['dob'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['source'].'</td>
					<td>'.$row['destination'].'</td>
					<td>'.$row['busid'].'</td>
					<td>'.$row['valid'].'</td>
					<td>'.$row['charges'].'</td>

					
				</tr><br><br>
				
				<div id="color">
				
				<strong style="font-size:20px; color:black;"><p >Name :  <span style="font-size:25px;" >'.$row['user'].'</span></p></strong>
				<strong style="font-size:20px;  color:black;"><p >Father name :  <span  style="font-size:25px;">'.$row['father'].'</span></p></strong>
				<strong style="font-size:20px;  color:black;"><p >Date of birth :  <span  style="font-size:25px;">'.$row['dob'].'</span></p></strong>
				<strong style="font-size:20px;  color:black;"><p >Phone no. :  <span  style="font-size:25px;">'.$row['phone'].'</span></p></strong>
				<strong style="font-size:20px;  color:black;"><p >Source city :  <span  style="font-size:25px;">'.$row['source'].'</span></p></strong>
				<strong style="font-size:20px;  color:black;"><p >Destination city :  <span  style="font-size:25px;">'.$row['destination'].'</span></p></strong>
				<strong style="font-size:20px;  color:black;"><p >bussid :  <span  style="font-size:25px;">'.$row['busid'].'</span></p></strong>
				<strong style="font-size:20px;  color:black;"><p >Expiry date :  <span  style="font-size:25px;">'.$row['valid'].'</span></p></strong>
				<strong style="font-size:20px;  color:black;"><p >Fees :  <span  style="font-size:25px;">'.$row['charges'].'</span></p></strong>
				</div>
				
				
				
				';

		}}?>
		</tbody>
		
	</table>
</body>
</html>


<?php

	include("footer.php");
?>
