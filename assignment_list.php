<?php
session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database/db_conection.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
} 

$connect= new mysqli("localhost","root","","signup_db") or die("ERROR:could not connect to the database!!!");
 
extract($_POST);
if(isset($save))
{
	$msg="<pre>$a</pre>";
	$query="insert into textarea values('','$e','$msg')";
	$connect->query($query);
	echo "Data saved";	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="img/favicon.ico">
	<title>Smart Online Assignment Submission System - Assignment List</title>
	<style>
		input,textarea{width:250px}
		textarea{height:200px}

		table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ddd;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        a:hover {
            color: #4caf50;
        }
	</style>
</head>

<body>
<?php
// Include the header file
include('header.php');
?>  
<section class="cd__intro">
<h2>Available Assignments</h2>
<?php
	$selectQuery = "SELECT id, title, description FROM assignments";
	$result = $connect->query($selectQuery);

	if ($result->num_rows > 0) {
		// Display the list of assignments
		echo "<table>";
        echo "<tr><th>Assignment Title</th><th>Description</th><th>Action</th></tr>";
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['description']}</td>";
			echo "<td><a href='submit_assignment.php?id={$row['id']}'>Submit</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "No assignments available.";
	}

	$connect->close();
?>
</section>


</body>
</html>