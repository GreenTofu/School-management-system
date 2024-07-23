<?php
$new_teacher = [
    "email" => "",
    "email_err" => false,
    "password" => "",
    "password_err" => false,
    "Fname" => "",
    "Lname" => "",
    "DoB" => "",
    "phone_num" =>"",
    "gender" => "",
];

function getTeachers(){
    global $conn;
    $role = 1;
    $sql = "SELECT *, u.date_created as date
            FROM users u 
            JOIN accounts a ON u.id = a.acc_id JOIN classes c ON c.teacher_id = u.id 
            WHERE u.role = ? and u.id
            ORDER BY u.id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $role);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getTotalTeachers(){
    global $conn;
    $role = 1;
    $sql = "SELECT *
            FROM users u 
            JOIN accounts a ON u.id = a.acc_id 
            WHERE u.role = ? and u.id
            ORDER BY u.id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $role);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getTeacherEmail($teacher_email){
    global $conn;
    $sql = "SELECT * from accounts WHERE email = ?";
    $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $teacher_email);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0) {
         return $result->fetch_assoc();
      } else {
         return 0;
      }
}

function reorderTable2(){
    global $conn;
    $sql = "ALTER TABLE accounts ORDER BY acc_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql2 = "ALTER TABLE users ORDER BY id ASC";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
}

function addNewTeacher($new_teacher){
    global $conn;
    $teacher = [
        "email" => $new_teacher['email'],
        "password" => password_hash($new_teacher['password'],PASSWORD_DEFAULT),
        "Fname" => $new_teacher['Fname'],
        "Lname" => $new_teacher['Lname'],
        "DoB" => $new_teacher['DoB'],
        "phone_num" =>$new_teacher['phone_num'],
        "gender" => $new_teacher['gender'],
        "image" => "",
        "role" => 1
    ];
    $sql = "INSERT INTO accounts (email, password) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $teacher['email'], $teacher['password']);
    $stmt->execute();

    if($stmt->affected_rows == 1){
        $last_id = $stmt->insert_id;
        $sql2 = "INSERT INTO users (id, Fname, Lname, DoB, gender, phone_num, role, image) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("isssisis",$last_id,$teacher['Fname'],$teacher['Lname'],$teacher['DoB'],$teacher['gender'],$teacher['phone_num'],$teacher['role'], $teacher['image']);
        $stmt2->execute();
    }
    reorderTable2();
}
//=========================>$_POST
function validateNewTeacher($teacher, &$new_teacher){
    $numTeacher = (count($teacher) - 1) / 7;
    for ($i = 0; $i < $numTeacher; $i++){
        $temp =$i + 1;
        $new_teacher['email'] = filter_var($teacher['email' . $temp],FILTER_SANITIZE_EMAIL);
        $new_teacher['password'] = htmlspecialchars($teacher['password' . $temp]);
        $new_teacher['Fname'] = htmlspecialchars($teacher['Fname' . $temp]);
        $new_teacher['Lname'] = htmlspecialchars($teacher['Lname' . $temp]);
        // $new_teacher['classname'] = htmlspecialchars($teacher['class_name' . $temp]);
        // $new_teacher['section'] = htmlspecialchars($teacher['section' . $temp]);
        $new_teacher['DoB'] = $teacher['DoB' . $temp];
        $new_teacher['phone_num'] = htmlspecialchars($teacher['phoneNum' . $temp]);
        $new_teacher['gender'] = $teacher['gender' . $temp];

        //input & email validation & check if email is exists in db
        $email = getTeacherEmail($new_teacher['email']);
        if(!empty($email) || !filter_var($new_teacher['email'],FILTER_SANITIZE_EMAIL)){
            $new_teacher['email_err'] = true;
            var_dump("email false");
        }
        //check pw > 5 chars
        if(strlen($new_teacher['password']) < 5){
            $new_teacher['password_err'] = true;
            var_dump("password false");
        }
        //if there's err => alert | else => log in
        if(array_search(true, $new_teacher, true)){
            var_dump("There was an error with your submission!");
        }else{
            addNewTeacher($new_teacher);
        }
    }
    header("Location: manageTeacher.php");
}

function editTeacher($teacher_id){
    global $conn;
    $sql = "UPDATE users SET Fname = ?, Lname = ?, DoB = ?, gender = ?, phone_num = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi",$teacher_id['Fname'], $teacher_id['Lname'], $teacher_id['DoB'], $teacher_id['gender'], $teacher_id['phoneNum'], $teacher_id['teacher_id']);
    $stmt->execute();

    header("Location: manageTeacher.php");
}

function deleteTeacher($data){
    global $conn;
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$data['delete']);
    $stmt->execute();

    $sql = "DELETE FROM accounts WHERE acc_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$data['delete']);
    $stmt->execute();

    $sql = "UPDATE classes SET teacher_id = ? WHERE teacher_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii",$data['teacher_id'], $data['delete']);
    $stmt->execute();
}