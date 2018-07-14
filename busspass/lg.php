<?php

	session_start();
	if(array_key_exists("id",$_COOKIE)){
		$_SESSION['id'] = $_COOKIE['id'];
	}
	if(array_key_exists("id",$_SESSION)){
		echo "Logged In! <a href = 'b.php?logout=1'>Log out</a></p>";
	}else{
		header("Loation: ix.php");
	}
	
	include("h.php");
	
	
?>

<nav class="navbar navbar-light bg-faded navbar-fixed-top " style="background-color: #8FC7D3  ">
  

  

    <div class="pull-xs-right">
      <a href ='ix.php?logout=1'>
        <button class="btn btn-primary-outline fa fa-thumbs-up" type="submit"><span style="color:white">Logout</span></button></a>
    </div>

</nav></br>


<?php

$link = mysqli_connect("localhost", "root", "", "busspass");

if(mysqli_connect_error()) {
	
	die("There was an error connecting to the database");
	
}

$query = "SELECT `email`, `user`, `father`, `dob`, `phone`, `source`, `destination` from customer";
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
	</style>
</head>
<body>
	<h1>See Your Buss Pass Info below: </h1>
	<table class="data-table">
		
		<thead>
			<tr>
				<th>email</th>
				<th>user</th>
				<th>Father name</th>
				<th>dob</th>
				<th>phone</th>
				<th>source</th>
				<th>Destination</th>
				
			</tr>
		</thead>
		<tbody>
		<?php
		if($result = mysqli_query($link, $query)){
		while ($row = mysqli_fetch_array($result))
		{
			
			echo '<tr>
					
					<td>'.$row['email'].'</td>
					<td>'.$row['user'].'</td>
					<td>'.$row['father'].'</td>
					<td>'.$row['dob'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['source'].'</td>
					<td>'.$row['destination'].'</td>
					
					
				</tr>';

		}}?>
		</tbody>
		
	</table>
</body>
</html>
<br><br>

<?php
    
    include("f.php");
?>



<?php

    if (array_key_exists('num', $_POST)) {
        
        $link = mysqli_connect("localhost", "root", "", "busspass");

            if (mysqli_connect_error()) {
        
                die ("There was an error connecting to the database");
        
            } 
        
        
        if ($_POST['num'] == '') {
            
            echo "<p>num is required.</p>";
            
            
        } else {
            
            $query = "SELECT `id` FROM `customer` WHERE num = '".mysqli_real_escape_string($link, $_POST['num'])."'";
            
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) > 0) {
                
                echo "<p>That number has already been taken.</p>";
                
            } else {
                
                $query = "UPDATE customer SET busid ='".$_POST['busid']."', valid ='".$_POST['valid']."', charges ='".$_POST['charges']."'
        
      
       
       WHERE email='".$_POST['email']."'";

      


                if (mysqli_query($link, $query)) {
                    
                    echo "<p >Details has been updated";
                    
                } else {
                    
                    echo "<p>There was a problem signing you up - please try again later.</p>";
                    
                }
                
            }
            
        }
        
        
    }

    


?>

<h1 style= "color:black; font-size:50px;">Update Passenger details:</h1><br>
<form method = "post">

  <h2 style = "color:black;">Email of passenger: </h2><input name="email" type="text" placeholder="Email address" required>
    
  <h2 style = "color:black;"> Busid:</h2> <input name="busid" type="text" placeholder="Bus id" required><br><br>

    <h2 style = "color:black;">Expiry date of pass:</h2> <input name="valid" type="date" placeholder="Validity" required><br><br>

  <h2 style = "color:black;" >Charges of pass: </h2><input name="charges" type="text" placeholder="Charges" required><br><br>

  <h2 style = "color:black;" >unique no. </h2><input name="num" type="number" placeholder="admin unique number" required><br><br>
 
    <input type="submit" value = "UPDATE">

</form>
