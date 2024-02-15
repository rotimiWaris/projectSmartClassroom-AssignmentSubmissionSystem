<!DOCTYPE html>
<html>
<head lang="en">
    <title>Smart Online Assignment Submission System - SignUp</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation.js" defer></script>
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
 
<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="login-panel panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Registration</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="registration.php" id="signup" novalidate>
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Username" id="name" name="name" type="text" autofocus>
                        </div>

                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" id="email" name="email" type="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" id="password" name="pass" type="password" value="">
                        </div>


                        <input class="btn btn-lg btn-success btn-block" type="submit" value="SignUp" name="register" >

                    </fieldset>
                </form>
                <br>
                <p style="text-align: center;"><b>Already registered ?</b> <br></b><a href="login.php">Login here</a></p><!--for centered text-->
            </div>
        </div>
    </div>
</div>

</body>

</html>