<?php

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database/db_conection.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

if (isset($_SESSION["admin_id"])) {
    
  $mysqli = require __DIR__ . "/database/db_conection.php";
  
  $sql = "SELECT * FROM admin
          WHERE id = {$_SESSION["admin_id"]}";
          
  $result = $mysqli->query($sql);
  
  $admin = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="CodePel">
      <link rel="icon" href="img/favicon.ico">
      <link href="css2/bootstrap-responsive.css" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
      <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
   </head>
   <body>
<nav id="navbar" class="">
  <div class="nav-wrapper">
    <!-- Navbar Logo -->
    <div class="logo">
      <!-- Logo Placeholder for Illustration -->
      <a href="index.php"><img width="100px" height="auto" src="img/about.jpg"></a>
    </div>

    <!-- Navbar Links -->
    <ul id="menu">
      <li><a href="index.php">Home</a></li>
      <?php if (isset($admin)): ?>
		<li><a href="view_users.php">Administrator Dashboard</a></li>
      <?php else: ?>
        <li><a href="admin_login.php">Administrator</a></li>
      <?php endif; ?>
      <?php if (isset($user)): ?>
        <li><a href="welcome.php">Student Dashboard</a></li>
      <?php else: ?>
        <li><a href="signup.php">Signup</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>


<!-- Menu Icon -->
<div class="menuIcon">
  <span class="icon icon-bars"></span>
  <span class="icon icon-bars overlay"></span>
</div>


<div class="overlay-menu">
  <ul id="menu">
        <li><a href="index.php">Home</a></li>
      <?php if (isset($admin)): ?>
		<li><a href="view_users.php">Administrator</a></li>
      <?php else: ?>
        <li><a href="admin_login.php">Administrator</a></li>
      <?php endif; ?>
      <?php if (isset($user)): ?>
        <li><a href="welcome.php">Student</a></li>
      <?php else: ?>
        <li><a href="registration.html">Signup</a></li>
      <?php endif; ?>
    </ul>
</div>

      
      <script src="js/script.js"></script>
      
   </body>
</html>