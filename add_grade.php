<?php
// Assuming you have a database connection
// Replace these with your actual database credentials
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $assignmentId = $_POST['assignment_id'];
    $grade = $_POST['grade'];
    $userId = $_POST['user_id']; // Assuming you're passing the user's ID from the form

    // Validate and sanitize the input as needed
    $assignmentId = mysqli_real_escape_string($mysqli, $assignmentId);
    $grade = mysqli_real_escape_string($mysqli, $grade);
    $userId = mysqli_real_escape_string($mysqli, $userId);

    // Perform the database update
    $updateGradeQuery = "UPDATE submit_assignment SET grade = '$grade' WHERE user_id = '$userId' AND assignment_id = '$assignmentId'";

    if ($mysqli->query($updateGradeQuery) === TRUE) {
        echo "<script>alert('Grade added successfully!')</script>";
		echo "<script>window.location.href = 'view_users.php'</script>";
    } else {
        echo "Error adding grade: " . $mysqli->error;
    }
} else {
    echo "Invalid request.";
}

// Close the connection
$mysqli->close();
?>
