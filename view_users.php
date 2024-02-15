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

// Assuming you have a database connection
// Replace these with your actual database credentials

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}    

$selectSubmissionsQuery = "SELECT sa.assignment_id, sa.title, sa.description, sa.file_path, sa.grade, u.matricnumber, u.id
                            FROM submit_assignment sa
                            JOIN user u ON sa.user_id = u.id";
$submissionsResult = $mysqli->query($selectSubmissionsQuery);

// Retrieve user submissions and matriculation number
// $userId = $_SESSION['user_id'];
// $selectQuery = "SELECT us.assignment_id, a.title AS assignment_title, us.file_path, u.matricnumber, us.grade
//                 FROM submit_assignment us
//                 JOIN assignments a ON us.assignment_id = a.id
//                 JOIN user u ON us.user_id = u.id
//                 WHERE us.user_id = '$userId'";
// $result = $mysqli->query($selectQuery);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css"> <!--css file link in bootstrap folder-->
    <title>Smart Online Assignment Submission System - Admin Dashboard</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;
    }
    .table {
        margin-top: 50px;
    }
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

    .assignment-list {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
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

    tr:hover {
        background-color: #f5f5f5;
    }

    button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #45a049;
    }

    .page-links {
        margin-top: 20px;
    }

</style>
<script>
    function gradeAssignment(assignmentId, userId) {
        // Get the grade input from the user (you may want to use a prompt or input field)
        var grade = prompt("Enter grade for Assignment ID " + assignmentId + ":");
        // Perform an AJAX request to submit the grade to the server
        // This is a basic example, and you may want to use a library like jQuery or fetch API for better control

        // Assuming you have a server-side script to handle the grade submission (add_grade.php)
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_grade.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response from the server
                alert(xhr.responseText);
            }
        };
        xhr.send("assignment_id=" + assignmentId + "&grade=" + grade + "&user_id=" + userId);
    }
</script>
<body>
<?php
// Include the header file
include('header.php');
?>  
<header class="mycd__intro">
    <h1>List of Assignment Submitted</h1>
</header>
    
<section class="assignment-list">
    <?php
    if ($submissionsResult->num_rows > 0) {
        // Display the list of assignments
        echo "<table>";
        echo "<tr><th>Assignment Title</th><th>Matriculation Number</th><th>Assignment Answer</th><th>File Path</th><th>Grade</th><th>Actions</th></tr>";
        while ($submissionRow = $submissionsResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$submissionRow['title']}</td>";
            echo "<td>{$submissionRow['matricnumber']}</td>";
            echo "<td>{$submissionRow['description']}</td>";
            echo "<td>{$submissionRow['file_path']}</td>";
            echo "<td>{$submissionRow['grade']}</td>";
            echo "<td><button onclick='gradeAssignment({$submissionRow['assignment_id']}, {$submissionRow['id']})'>Add Grade</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No assignments submitted.";
    }
    ?>

</section>
<footer class="cd__credit">
    <div class="page-links">
        <input type="button" value = "Click to Add Assignment" onclick="window.location.href='admin_create_assignment.php'"/>
        <br/><br/>
        <a href="logout.php">Logout</a>
    </div>
</footer>
    
</body>
</html>

<?php

// Close the connection
$mysqli->close();
?>