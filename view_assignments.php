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
    $userId = $_SESSION['user_id'];

    // Fetch submitted assignments and grades for the current user
    $selectAssignmentsQuery = "SELECT a.title, s.grade FROM assignments a
                              JOIN submit_assignment s ON a.id = s.assignment_id
                              WHERE s.user_id = '$userId'";
    $assignmentsResult = $mysqli->query($selectAssignmentsQuery);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.ico">
        <title>Smart Online Assignment Submission System - View Submitted Assignments</title>
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
                padding: 10px;
                text-align: center;
            }

            .assignment-list {
                margin: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #333;
                color: #fff;
            }
        </style>
    </head>
    <body>

        <header>
            <h1>Submitted Assignments</h1>
        </header>

        <section class="assignment-list">
            <?php
            if ($assignmentsResult->num_rows > 0) {
                // Display the list of submitted assignments and grades
                echo "<table>";
                echo "<tr><th>Assignment Title</th><th>Grade</th></tr>";
                while ($assignmentRow = $assignmentsResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$assignmentRow['title']}</td>";
                    echo "<td>{$assignmentRow['grade']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No assignments submitted.";
            }
            ?>
        </section>

    </body>
    </html>
