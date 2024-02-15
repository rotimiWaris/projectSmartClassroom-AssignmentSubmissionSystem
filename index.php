<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Smart Online Assignment Submission System - Home</title>
<style>
  
  .explanation-board {
    padding: 20px;
    background-color: #fff;
}

.explanation-board h2 {
    color: #333;
    border-bottom: 2px solid #333;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.explanation-board p {
    margin-bottom: 15px;
    color: #666;
}

.explanation-board .list-container {
    margin-bottom: 15px;
    color: #666;
}

.explanation-board ul,
.explanation-board ol {
    margin-left: 30px;
}

.explanation-board ol {
    list-style-type: decimal;
}

.explanation-board li {
    line-height: 1.6;
}
</style>
</head>

<body>
<header class="cd__intro">
    <h1>Smart Online Assignment Submission System </h1>
</header>


<?php
// Include the header file
include('header.php');
?>  

<?php if (isset($user)): ?>
  <main class="cd__main">
  <h2>Welcome <?= htmlspecialchars($user["name"]) ?></h2>
  <div class="cd__action">
        <p><a class="cd__btn" href="assignment_list.php">See All Assignments &raquo;</a></p>
  </div>
  </main>
<?php endif; ?>

  <footer class="cd__credit">
    <section class="explanation-board">
    <!-- <div class="board">
            <div class="announcement">Navigation</div>
              <div class="content">
              <ul class="list">
                   <?php if (isset($admin)): ?>
                      <li><a href="view_users.php"  class="list-item">Administrator</a></li>
                    <?php else: ?>
                      <li><a href="admin_login.php"  class="list-item">Administrator</a></li>
                    <?php endif; ?>
                      <li><a href="#fee.html" class="list-item">Course Fees</a></li>
                      <li><a href="#traing.html" class="list-item">Training</a></li>
                      <li><a href="#results.html" class="list-item">Results</a></li>
                      <li><a href="#calender.html" class="list-item">Academic Calender</a></li>
              </ul>            
          
              </div>
            </div>
        </div> -->
        <div class="board">
          <h2>What is Smart Assignment Submission System?</h2>
          <p>The Smart Online Assignment Submission System is a web-based platform designed to streamline the process of submitting and managing assignments. It leverages modern technologies to provide a convenient and efficient solution for both students and educators.</p>

          <h2>Key Features:</h2>
          
          <ul>
              <li><strong>Online Submission:</strong> Students can submit assignments online, eliminating the need for physical submissions.</li>
              <li><strong>Automated Grading:</strong> The system supports automated grading, saving time for educators and providing quick feedback to students.</li>
              <li><strong>Document Management:</strong> Organize and manage assignment documents securely within the platform.</li>
              <li><strong>Deadline Reminders:</strong> Automated notifications ensure that students are reminded of upcoming assignment deadlines.</li>
          </ul>
          <br>

          <h2>How it Works:</h2>
          <ol>
              <li>Students log in to the system using their credentials.</li>
              <li>They submit assignments by uploading relevant documents.</li>
              <li>Educators access and review submitted assignments through a user-friendly interface.</li>
              <li>The system automates the grading process based on predefined criteria.</li>
              <li>Students receive feedback and grades promptly.</li>
          </ol>
        </div>
      </section>
</footer>
</div>
<!-- /container -->
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/bootstrap-transition.js"></script>
<script src="js/bootstrap-carousel.js"></script>
<script src="js/bootstrap-alert.js"></script>
<script src="js/bootstrap-modal.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-scrollspy.js"></script>
<script src="js/bootstrap-tab.js"></script>
<script src="js/bootstrap-tooltip.js"></script>
<script src="js/bootstrap-popover.js"></script>
<script src="js/bootstrap-button.js"></script>
<script src="js/bootstrap-collapse.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/jquery.smooth-scroll.min.js"></script>
<script src="js/lightbox.js"></script>
<script>
$('.carousel').carousel({
  interval: 2000
})
</script>
</body>
</html>
