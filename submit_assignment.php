<?php
session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database/db_conection.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
else {
    header ("Location: login.php");
}  

$host = "localhost";
$dbname = "signup_db";
$username = "root";
$password = "";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

if (isset($_POST['submitAssignment'])) {
    // Check if the user is logged in
		if (isset($_SESSION['user_id'])) {
			$userId = $_SESSION['user_id'];
			$selectUserQuery = "SELECT matricnumber FROM user WHERE id = '$userId'";
			$userResult = $mysqli->query($selectUserQuery);
			if ($userResult->num_rows > 0) {
				// Sanitize input data
				$assignmentId = mysqli_real_escape_string($mysqli, $_POST['assignmentId']);
				$assignmentTitle = mysqli_real_escape_string($mysqli, $_POST['assignmentTitle']);
				$assignmentDescription = mysqli_real_escape_string($mysqli, $_POST['assignmentDescription']);

				// Upload file
				$targetDirectory = "uploads/";
				$targetFile = $targetDirectory . basename($_FILES["fileUpload"]["name"]);

				if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFile)) {
					// File upload successful, insert data into database
					$insertQuery = "INSERT INTO submit_assignment (user_id, assignment_id, title, description, file_path) VALUES ('$userId', '$assignmentId', '$assignmentTitle', '$assignmentDescription', '$targetFile')";
					if ($mysqli->query($insertQuery) === TRUE) {
						echo "<script type='text/javascript'>alert('Assignment submitted successfully!');</script>";
						echo '<script>window.location.href = "welcome.php";</script>';
					} else {
						echo "Error: " . $mysqli->error;
					}
				} else {
					echo "<script type='text/javascript'>alert('Error Uploading File!');</script>";
				}
			} else {
				// Redirect to the profile update page
				header("Location: updateprofile.php");
				exit();
		} 
	} else {
		echo "User not logged in. Please log in before submitting an assignment.";
	}
}

// extract($_POST);
// if(isset($save))
// {
// 	$msg="<pre>$a</pre>";
// 	$query="insert into query values('','$e','$msg')";
// 	$connect->query($query);
// 	echo "Data saved";	
// }


// if(isset($submitAssignment))
// {
// $msg="$a";
// $query="insert into assign values('','$e','$msg')";
// $connect->query($query);
// echo "Data saved";	
// }
?>
<head>
	<link rel="icon" href="img/favicon.ico">
	<title>Smart Online Assignment Submission System - Assignment and Query</title>
	<style>
		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			margin: 0;
			padding: 0;
		}

		header {
			background-color: #333;
			color: white;
			text-align: center;
			padding: 1em;
		}

		.submission-form {
			max-width: 600px;
			margin: 20px auto;
			padding: 20px;
			border: 1px solid #ddd;
			border-radius: 8px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		h2 {
			color: #333;
			border-bottom: 2px solid #333;
			padding-bottom: 10px;
			margin-bottom: 20px;
		}

		form {
			display: flex;
			flex-direction: column;
		}

		label {
			margin-bottom: 8px;
		}

		input,
		textarea,
		button {
			margin-bottom: 15px;
			padding: 10px;
		}

		textarea {
			resize: vertical; /* Allow vertical resizing of textarea */
		}

		button {
			background-color: #333;
			color: white;
			cursor: pointer;
			border: none;
			border-radius: 4px;
		}
	</style>
</head>


<style>
input,textarea{width:250px}
textarea{height:200px}
input[type=submit]{width:150px}
</style>


<header>
    <h1>Assignment Submission</h1>
</header>

<?php
// Get assignment details based on the assignment ID passed through the URL
$assignmentId = isset($_GET['id']) ? $_GET['id'] : null;
if ($assignmentId) {
	$selectAssignmentQuery = "SELECT id, title, description FROM assignments WHERE id = $assignmentId";
	$result = $mysqli->query($selectAssignmentQuery);

	if ($result->num_rows > 0) {
		// Display assignment details and submission form
		$assignment = $result->fetch_assoc();
		echo "<h2>{$assignment['title']}</h2>";
		echo "<p>{$assignment['description']}</p>";

		// Display a form for submitting the assignment
		echo "<section class='submission-form'>";
		echo "<form action='submit_assignment.php' method='post' enctype='multipart/form-data'>";
		echo "<input type='hidden' name='assignmentId' value='{$assignment['id']}'>";
		echo "<input type='hidden' name='assignmentTitle' value='{$assignment['title']}'>";
		echo "<label for='assignmentDescription'>Assignment Answers:</label>";
		echo "<textarea id='assignmentDescription' name='assignmentDescription' rows='4' required></textarea>";
		echo "<label for='fileUpload'>Upload Your Assignment File:</label>";
		echo "<input type='file' id='fileUpload' name='fileUpload' accept='.pdf, .doc, .docx'>";
		echo "<button type='submit' name='submitAssignment'>Submit Assignment</button>";
		echo "</section>";
		echo "</form>";
	} else {
		echo "Assignment not found.";
	}
} else {
	echo "Invalid assignment ID.";
}

// Close the connection
$mysqli->close();

// 	<h2>Submit Your Assignment</h2>

// 	<form action="process_submission.php" method="post" enctype="multipart/form-data">
// 		<label for="assignmentTitle">Assignment Title:</label>
// 		<input type="text" id="assignmentTitle" name="assignmentTitle" required>

// 		<label for=""></label>
// 		<textarea id="assignmentDescription" name="assignmentDescription" rows="4" required></textarea>

// 		<label for="fileUpload">Upload Your File:</label>
// 		<input type="file" id="fileUpload" name="fileUpload" accept=".pdf, .doc, .docx">

// 		<button type="submit" name="submitAssignment">Submit Assignment</button>
// 	</form>
// </section>
?>
<!-- <table  style="float:left;margin-left:13%; margin-top:50%" width="200" border="1">
 
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
		<input type="submit" value="Submit Query" name="save"/>
		<input type="submit" value="Submit assignment" name="sa"/>
		<input type="submit" value="Display Assignments" name="disp"/>
		<input type="submit" value="Display Query Reply" name="disp2"/>
	</td>
  </tr>
  
</table> -->
<!-- </form> -->


<?php 
// if(isset($disp))
// {
// 	$query="select * from textarea";
// 	$result=$connect->query($query);
// 	echo "<table width='60%' border=1>";
// 	echo "<tr><th>Email</th><th>Message</th></tr>";
// 	while($row=$result->fetch_array())
// 		{
// 		echo "<tr>";
// 		echo "<td>".$row['email']."</td>";
// 		echo "<td>".$row['message']."</td>";
// 		echo "</tr>";
// 		}
// 	echo "</table>";	
// }

// if(isset($disp2))
// {
// 	$query="select * from textarea2
// 	";
// 	$result=$connect->query($query);
// 	echo "<table width='60%' border=1>";
// 	echo "<tr><th>Email</th><th>Message</th></tr>";
// 	while($row=$result->fetch_array())
// 		{
// 		echo "<tr>";
// 		echo "<td>".$row['email']."</td>";
// 		echo "<td>".$row['message']."</td>";
// 		echo "</tr>";
// 		}
// 	echo "</table>";	
// }
?>