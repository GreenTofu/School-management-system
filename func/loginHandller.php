<?php
//  $new_user = [
//     "email" => "",
//     "email_err" => false,
//     "email_matching" => 0,
//     "password" => "",
//     "password_err" => false,
//     "password_confirm" => "",
//     "password_confirm_err"=> false
//  ];

 $edit_user = [
   "email" => "",
   "edit_email_err" => false,
   "password" => "",
   "edit_password_err" => false,
   "password_confirm" => "",
   "edit_password_confirm_err"=> false
 ];
 // login user arr to store login data and errors
 $login_user = [
    "email" => "",
    "email_err" => false,
    "password" => "",
    "password_err" => false
 ];

 function getUserAccount($user) {
   global $conn;
   $sql = "SELECT * from accounts a join users u on a.acc_id = u.id where email = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $user);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows > 0) {
      return $result->fetch_assoc();
   } else {
      return 0;
   }
 }

 function saveLoginDate($user){
   global $conn;
   date_default_timezone_set('Asia/Ho_Chi_Minh');
   $date = date('Y-m-d h:i:s');
   $sql = "UPDATE users SET last_login_date = ? WHERE id = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("si",$date, $user);
   $stmt->execute();
 }

 function loginUser($account) {
   $_SESSION['email'] = $account['email'];
   $_SESSION['user_id'] = $account['acc_id'];
   $_SESSION['Fname'] = $account['Fname'];
   $_SESSION['Lname'] = $account['Lname'];
   $_SESSION['image'] = $account['image'];
   $_SESSION['gender'] = $account['gender'];
   $_SESSION['phone_num'] = $account['phone_num'];
   $_SESSION['role'] = $account['role'];
   $_SESSION['logged_in'] = true;
   $_SESSION['msg'] = "Logged in successfully";
   $_SESSION['msg_class'] = "success";
   $_SESSION['class'] = "None";
   $_SESSION['classSection'] = "None";

   if($_SESSION['role'] == 1){
      $temp = getClassById();
      $_SESSION['class'] = $temp['class_name'];
      $_SESSION['classSection'] = $temp['section'];
   }

   saveLoginDate($account['id']);
   if($_SESSION['role'] == 0){
      header("Location: ../admin/views/index.php");
   }
   elseif($_SESSION['role'] == 1){
      header("Location: ../teacher/views/index.php");
   }
   elseif($_SESSION['role'] == 2){
      global $conn;
      $sql = "SELECT * FROM classroom_student WHERE student_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $_SESSION['user_id']);
      $stmt->execute();
      $result = $stmt->get_result();
      $class = $result->fetch_assoc();
      // var_dump($result->fetch_assoc());
      if(empty($result)){
         $_SESSION['class'] = "";
      }else{
         $_SESSION['class'] = $class['classroom_id'];
      }
      // var_dump($_SESSION);
      header("Location: ../student/views/index.php");
   }
 }

 function validateLogin($user, &$login_user) {
    $login_user['email'] = htmlspecialchars($user['email']);
    $login_user['password'] = $user['password'];
    // var_dump($login_user['email']);
    $user = getUserAccount($login_user['email']);
    if(empty($user)) {
        //setMsg
        // setMsg("email not found!", "danger", null);
        $login_user['username_err'] = true;
    } else {
        if(password_verify($login_user['password'],$user['password'])) {
            loginUser($user);
            // var_dump("Hi u are on the right track!");
        } else {
            $login_user['password_err'] = true;
            var_dump("Incorrect password!");
            //setMsg
            // setMsg("Incorrect password!", "danger", null);
        }
    }
}

 function checkValid($field, $arr) {
    $key = $field . "_err"; // email + _err => $new_user['username_err']
    if($arr[$key]) {
       echo "is-invalid";
    }
 }

 function getUserById() {
   global $conn;
   $sql = "SELECT * FROM users WHERE user_id = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $_SESSION['user_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   return $result->fetch_assoc();
 }

 function getClassById() {
   global $conn;
   $sql = "SELECT * FROM classes WHERE teacher_id = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $_SESSION['user_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   return $result->fetch_assoc();
 }