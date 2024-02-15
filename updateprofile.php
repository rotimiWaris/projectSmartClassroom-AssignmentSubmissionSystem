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

error_reporting(E_ALL);
ini_set('display_errors', 1);

$userID = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have sanitized and validated the input, if not, do so to prevent SQL injection

    $id = $_POST['id'];
    $name = $_POST['name'];
    $matricnumber = $_POST['matricno'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $faculty = $_POST['fact'];
    $department = $_POST['dept'];

    // Update user info in the database
    $query = "UPDATE user 
              SET name=?, matricnumber=?, gender=?, dob=?, faculty=?, department=? 
              WHERE id=?";
    if ($stmt = $mysqli->prepare($query)) {
        // Bind parameters
        $stmt->bind_param("ssssssi", $name, $matricnumber, $gender, $dob, $faculty, $department, $id);

        // Execute the statement
        if ($stmt->execute()) {
            $message = "<p style='color:green;'> Details updated successfully! </p>";
        } else {
            $message = "<p style='color:green;'> Details updated successfully! </p>" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $message = "<p style='color:green;'> Details updated successfully! </p>" . $mysqli->error;
    }
}

// if (count($_POST)>0) {
//     mysqli_query($mysqli, "UPDATE users set firstname='" . $_POST['fname'] . "', lastname='" . 
//                 $_POST['lname'] . "',  matricnumber='" . $_POST['matricno'] . "',  gender='" . $_POST['gender'] . "',
//                 dob='" . $_POST['dob'] . "', faculty='" . $_POST['fact'] . "', department='" . $_POST['dept'] . "'
//                 WHERE id='" . $_POST['id'] . "'");
//     $message = "<p style='color:green;'> Details updated successfully! </p>";
// }

?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Smart Online Assignment Submission System - Update Profile</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Icon -->
 <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
<!-- Main css -->
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Table Style -->
<style>
    table {
        border-collapse: separate;
        border-spacing: 0 15px;
    }
    
    #dob {
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    #dob:focus {
        border-color: #007bff;
    }

</style>
</head>

<body>
    <?php
        include('header.php');    
    ?>

    <section class="cd__intro">
    <h3 class="form-title">Smart Online Assignment Submission System</h3>
    <h4 class="form-title">Update Your Profile</h4>
    <div class="container rounded bg-white mt-5 mb-5">
            <form method="POST" action="updateprofile.php" class="register-form" id="register-form">
                <?php 
                    $result = $mysqli->query($sql);

                    if ($result) {
                        if (mysqli_num_rows($result)>0) {
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <h6 class="form-title"><?php if(isset($message)) { echo $message; } ?> </h6>
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                <div class="col-md-12">
                                    <label for="name"><i class="zmdi zmdi-account-circle"></i></label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name']; ?>" required/>
                                </div>
                                <div class="col-md-12">
                                    <label for="matricno"><i class="zmdi zmdi-n-1-square"></i></label>
                                    <input type="text" class="form-control" name="matricno" id="name" placeholder="Matric Number" required/>
                                </div>
                                <div class="col-md-12">
                                    <label for="gender"><i class="zmdi zmdi-male-female"></i></label>
                                    <select id="gender" class="form-control" name="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <label for="dob" style="float: left;">Date of Birth:</label>
                                    <input type="date" class="form-control" name="dob" id="dob" required/>
                                </div>
                                <div class="col-md-12">
                                    <label for="fact"><i class="zmdi zmdi-store"></i></label>
                                    <input type="text" class="form-control" name="fact" id="fact" placeholder="Faculty" required/>
                                </div>
                                <div class="col-md-12">
                                    <label for="dept"><i class="zmdi zmdi-accounts"></i></label>
                                    <input type="text" class="form-control" name="dept" id="dept" placeholder="Department" required/>
                                </div>
                                <div class="mt-5 text-center">
                                    <input type="submit" name="updateprofile" class="btn btn-primary profile-button" value="Update" />
                                </div>

                                <?php
                            }
                        }
                    }
                    $mysqli->close();

                ?>
                        
                    </form>
                </div>
            </div>
        </div>
        
    </section>
    <!-- JS -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script src="js/main.js"></script> -->
</body>

</html>