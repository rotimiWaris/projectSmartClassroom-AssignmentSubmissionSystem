<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database/db_conection.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["pass"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: welcome.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title>Smart Online Assignment Submission System - Login</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;
    }
</style>

<body>

<?php
// Include the header file
include('header.php');
?>  

<div class="container">
    <div class="row">
        <div class="login-panel panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Sign In</h3>
            </div>
            <?php if ($is_invalid): ?>
                <p style="text-align: center; color: red">Invalid login</p>
            <?php endif; ?>
            <div class="panel-body">
                <form role="form" method="post" action="login.php">
                    <fieldset>
                        <div class="form-group"  >
                            <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                        </div>


                            <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >

                        <!-- Change this to a button or input when using this as a form -->
                        <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


</body>

</html>
