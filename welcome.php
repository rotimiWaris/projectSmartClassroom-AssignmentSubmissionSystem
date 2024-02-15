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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Smart Online Assignment Submission System - Student's Dashboard</title>
    <style>
        body{
            background:#eee;
        }

        .card{
            border:none;

            position:relative;
            overflow:hidden;
            border-radius:8px;
            cursor:pointer;
        }

        .card:before{
            
            content:"";
            position:absolute;
            left:0;
            top:0;
            width:4px;
            height:100%;
            background-color:#E1BEE7;
            transform:scaleY(1);
            transition:all 0.5s;
            transform-origin: bottom
        }

        .card:after{
            
            content:"";
            position:absolute;
            left:0;
            top:0;
            width:4px;
            height:100%;
            background-color:#8E24AA;
            transform:scaleY(0);
            transition:all 0.5s;
            transform-origin: bottom
        }

        .card:hover::after{
            transform:scaleY(1);
        }


        .fonts{
            font-size:11px;
        }

        .social-list{
            display:flex;
            list-style:none;
            justify-content:center;
            padding:0;
        }

        .social-list li{
            padding:10px;
            color:#8E24AA;
            font-size:19px;
        }


        .buttons button:nth-child(1){
            border:1px solid #8E24AA !important;
            color:#8E24AA;
            height:40px;
        }

        .buttons button:nth-child(1):hover{
            border:1px solid #8E24AA !important;
            color:#fff;
            height:40px;
            background-color:#8E24AA;
        }

        .buttons button:nth-child(2){
            border:1px solid #8E24AA !important;
            background-color:#8E24AA;
            color:#fff;
                height:40px;
        }

        .user-info {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            max-width: 400px;
        }

        .user-info h2 {
            color: #333;
        }

        .user-info p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>

<body>

<header class="cd__intro">

<?php
// Include the header file
include('header.php');
?>  

    <div class="row d-flex justify-content-center">
        
                    
        <div class="py-4">
                <div class="text-center mt-3">
                    <h5 class="mt-2 mb-0">Welcome <?= htmlspecialchars($user["name"]) ?>!</h5>
                    <span>Welcome to your dashboard.</span>
                    
                    <?php if (!empty($user['matricnumber'])) : ?>
                        <br><br>
                    <div class="user-info">
                        <h2>User Profile</h2>
                        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                        <p><strong>Matriculation Number:</strong> <?php echo $user['matricnumber']; ?></p>
                        <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
                        <p><strong>Date of Birth:</strong> <?php echo $user['dob']; ?></p>
                        <p><strong>Faculty:</strong> <?php echo $user['faculty']; ?></p>
                        <p><strong>Department:</strong> <?php echo $user['department']; ?></p>
                    </div>                    
                    <?php else: ?>
                    <div class="px-4 mt-1">
                    <br>
                        <p class="fonts">You need to update your profile before you can be able to submit assignments. Navigate with the button below. </p>
                    
                    </div>
                    <?php endif; ?>
                    
                    <div class="buttons">
                        <button class="btn btn-outline-primary px-4" onclick="window.location.href='updateprofile.php'">Update Profile</button>
                        <button class="btn btn-primary px-4 ms-3" onclick="window.location.href='assignment_list.php'">View Assignments</button>
                        <?php if (!empty($user['matricnumber'])) : ?>
                            <br><br>
                        <button class="btn btn-secondary px-4 ms-3" onclick="window.location.href='view_assignments.php'">View Submitted Assignments</button>
                        <?php endif; ?>
                    </div>
                    
        </div>
                      
    </div>
</header>
<a href="logout.php">Logout here</a>
<!-- <footer class="cd__credit">
    <h1> </h1>

    <br/><br/><br/><center><br>
    <form>
    <input type="button" value = "Click here to submit your issues"  STYLE="background-color:#66ffff"/>
    </form>
    </center>
</footer> -->
</body>

</html>

