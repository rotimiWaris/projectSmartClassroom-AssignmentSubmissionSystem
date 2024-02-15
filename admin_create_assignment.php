<?php
session_start();

if (isset($_SESSION["admin_id"])) {
    
    $mysqli = require __DIR__ . "/database/db_conection.php";
    
    $sql = "SELECT * FROM admin
            WHERE id = {$_SESSION["admin_id"]}";
            
    $result = $mysqli->query($sql);
    
    $admin = $result->fetch_assoc();
}
else {
    header ("Location: admin_login.php");
}  

$connect= new mysqli("localhost","root","","signup_db") or die("ERROR:could not connect to the database!!!");
 
if (isset($_POST['createAssignment'])) {
    // Handle form submission

    // Sanitize input data
    $assignmentTitle = mysqli_real_escape_string($connect, $_POST['assignmentTitle']);
    $assignmentDescription = mysqli_real_escape_string($connect, $_POST['assignmentDescription']);

	$insertQuery = "INSERT INTO assignments (title, description) VALUES ('$assignmentTitle', '$assignmentDescription')";
	if ($connect->query($insertQuery) === TRUE) {
		echo "<script type='text/javascript'>alert('Assignment created successfully!');</script>";
		echo '<script>window.location.href = "view_users.php";</script>';
	} else {
		echo "Error: " . $connect->error;
	}
}

// Close the connection
$connect->close();
?>

<head>
	<title>Smart Online Assignment Submission System - Create Assignment</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
			margin: 0;
			padding: 0;
		}

		header {
			background-color: #333;
			color: #fff;
			text-align: center;
			padding: 10px;
		}

		.admin-create-assignment {
			max-width: 600px;
			margin: 20px auto;
			background-color: #fff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		h2 {
			color: #333;
		}

		form {
			display: flex;
			flex-direction: column;
		}

		label {
			margin-bottom: 8px;
		}

		input, textarea {
			padding: 10px;
			margin-bottom: 16px;
			border: 1px solid #ddd;
			border-radius: 4px;
		}

		button {
			background-color: #333;
			color: #fff;
			padding: 10px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			transition: background-color 0.3s;
		}

		button:hover {
			background-color: #555;
		}
	</style>
</head>


<style>
input,textarea{width:250px}
textarea{height:200px}
input[type=submit]{width:150px}
</style>




<!-- <form method="post">
<table  style="float:left;margin-left:13%" width="200" border="1">
 
  <tr>
    <td>Email</td>
    <td><input type="email" name="e" placeholder="email" /></td>
  </tr>
 
  
  <tr>
    <td>Message</td>
    <td><textarea placeholder="contents"  name="a"></textarea></td>
  </tr>
  <tr>
    <td colspan="2">
		<input type="submit" value="Save" name="save"/>
		<input type="submit" value="Display" name="disp"/>
	</td>
  </tr>
  
</table>
</form> -->

<section class="admin-create-assignment">
	<h2>Assignment Details</h2>

	<form action="admin_create_assignment.php" method="post" enctype="multipart/form-data">
		<label for="assignmentTitle">Assignment Title:</label>
		<input type="text" id="assignmentTitle" name="assignmentTitle" required>

		<label for="assignmentDescription">Assignment Description:</label>
		<textarea id="assignmentDescription" name="assignmentDescription" rows="4" required></textarea>

		<button type="submit" name="createAssignment">Create Assignment</button>
	</form>
</section>


<?php 
if(isset($disp))
{
	$query="select * from assignments";
	$result=$connect->query($query);
	echo "<table width='60%' border=1>";
	echo "<tr><th>Email</th><th>Message</th></tr>";
	while($row=$result->fetch_array())
		{
		echo "<tr>";
		echo "<td>".$row['email']."</td>";
		echo "<td>".$row['message']."</td>";
		echo "</tr>";
		}
	echo "</table>";	
}