<?php
session_start();

$mysqli = require __DIR__ . "/database/db_conection.php";

if(isset($_POST['admin_login']))//this will tell us what to do if some data has been post through form with button.
{
    $admin_name=$_POST['admin_name'];
    $admin_pass=$_POST['admin_pass'];

    $admin_query="select * from admin where admin_name='$admin_name' AND admin_pass='$admin_pass'";

    $run_query=mysqli_query($mysqli,$admin_query);

    $admin = $run_query->fetch_assoc();

    if(mysqli_num_rows($run_query)>0)
    {
        session_start();
            
        session_regenerate_id();
        
        $_SESSION["admin_id"] = $admin["id"];

        echo "<script>window.open('view_users.php','_self')</script>";
    }
    else {echo"<script>alert('Admin Details are incorrect..!')</script>";}

}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title>Smart Online Assignment Submission System - Admin Login</title>
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
            <div class="panel-body">
                <form role="form" method="post" action="admin_login.php">
                    <fieldset>
                        <div class="form-group"  >
                            <input class="form-control" placeholder="Name" name="admin_name" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="admin_pass" type="password" value="">
                        </div>


                        <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="admin_login" >


                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


</body>

</html>
