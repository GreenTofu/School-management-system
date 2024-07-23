<?php
  include "../func/db.php";
  include "../admin/func/PublicNoticeHandler.php";

  $publicNotices = getPublicNotices();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Education</title>
</head>
<body style="background-color: #f5f5f5; background: none;">
    <nav class="navbar navbar-expand-md navbar-dark bg-black ">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Education</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
            </ul>
              <button id="loginButton" class="btn btn-outline-success" type="submit">Login</button>
          </div>
        </div>
      </nav>

      <div class="p-5 m-auto text-bg-primary mb-5" style="background-image: url(images/background-2.jpeg); background-size: cover;">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Welcome to School Management System</h1>
          <p class="col-md-8 fs-4">This is a application for Education which can help student to do homework and teacher can mark there grade on this application.</p>
        </div>
      </div>
      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <!-- <svg class="bd-placeholder-img pic-2 rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%"><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
              <img src="images/pic-1.jpg" class="rounded-circle" width="140" height="140" alt="">
            <h2 class="fw-normal">Bill Gates</h2>
            <p>This is a practical application that is worth the investment microsoft spends if I still own it.</p>
            
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <!-- <svg class="bd-placeholder-img pic-2 rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
            <img src="images/pic-2.jpg" class="rounded-circle" width="140" height="140" alt="">
            <h2 class="fw-normal">Mark Zuckerberg</h2>
            <p>An absolutely amazing app for students and teachers.</p>
            
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <!-- <svg class="bd-placeholder-img pic-3 rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
            <img src="images/pic-3.jpg" class="rounded-circle" width="140" height="140" alt="">
            <h2 class="fw-normal">Elon Musk</h2>
            <p>Now students don't need to sit down to do their homework in pencil anymore, just use technology and submit the work to the teacher. A very modern application, I think Tesla will invest in this soon.</p>
            
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    
    
        <!-- START THE FEATURETTES -->
    
        <hr class="featurette-divider">
    
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">Easily assess students<span class="text-muted"></span></h2>
            <p class="lead">Instead of sitting for hours looking at the gradebook, teachers can now see the score statistics of each student or class by the software itself. From there, you can get the most accurate statistics</p>
          </div>
          <div class="col-md-5">
            <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
            <img src="images/study-1.png" width="500" height="500" alt="">
          </div>
        </div>
    
        <hr class="featurette-divider">
    
        <div class="row featurette">
          <div class="col-md-5">
            <img src="images/study-2.jpg" alt="">
          </div>
          <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">Submit and complete assignments online <span class="text-muted"></span></h2>
            <p class="lead">Students no longer have to worry about deadlines, forgetting assignments, or paper work. Everything is technologically advanced, there will always be deadlines for submission of details, exam schedules, assignments or announcements.</p>
          </div>
        </div>
    
        <hr class="featurette-divider">
    
        <!-- /END THE FEATURETTES -->
      </div><!-- /.container -->
      <div class="testimonials" style="background: url(images/i15.jpg) no-repeat 0 0px;background-size: cover;padding: 2em 0 0 0;position: relative;text-align: center;margin-bottom: 0;min-height: 307px;">
        <div class="container">
            <div class="testimonial-nfo">
              <h3 style="color: #FFF;font-size: 40px;font-weight: 300;margin: 0;">Public Notices</h3>
              <marquee style="height:350px;" direction="up" onmouseover="this.stop();" onmouseout="this.start();">
                <?php foreach($publicNotices as $notice) { ?>
                <a style="color: #fff; text-decoration: none !important;" href="publicNotices.php" style="color:#fff;">
                  <?=$notice['notice_body']?></a>
                <hr style="margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 2px solid #eee;"><br>
                <?php } ?>
              </marquee>
            </div>
        </div>
        </div>
      <div class="b-example-divider"></div>


  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
    </ul>
    <p class="text-center text-muted">&copy; 2023 Group 3, Advance Software Engineering</p>
  </footer>
</body>
<!-- Script for login button -->
<script type="text/javascript">
document.getElementById("loginButton").onclick = function () {
        location.href = "signin.php";
    };
</script>
</html>