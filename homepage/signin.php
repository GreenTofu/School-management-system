<?php 
include "../func/db.php";
include "../func/loginHandller.php";
if(isset($_POST['login'])){
   if(isset($_POST['login'])){
    validateLogin($_POST,$login_user);
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signin.css">
</head>
<body class="text-center" style="background-color: #f5f5f5; background: none;">
    <main class="form-signin w-100 m-auto">
        <form action="signin.php" method="post">
          <img class="mb-4" src="icon/user.png" alt="" width="60" height="60">
          <h1 class="h3 mb-3 fw-normal">Please Log in</h1>
      
          <div class="form-floating">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
            <div class="invalid-feedback">
              Email invalid
              </div>
          </div>
          <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
            <div class="invalid-feedback">
              Password invalid!
              </div>
          </div>
      
          <div class="checkbox mb-3">
            <a href="index.php"> Return Home</a>
          </div>
          <button class="w-100 btn btn-lg btn-secondary" name="login" type="submit">Log in</button>
          <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
        </form>
      </main>
</body>
</html>