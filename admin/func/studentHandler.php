<?php
$new_student = [
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

function getTotalStudents(){
    global $conn;
    $sql = "SELECT * 
            FROM users u 
            JOIN accounts a ON u.id = a.acc_id
            WHERE u.role = 2 and u.id
            ORDER BY u.id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getUnJoinClassStudent(){
    global $conn;
    $sql = "SELECT * 
            FROM users u 
            JOIN accounts a ON u.id = a.acc_id
            WHERE u.role = 2 and u.id NOT IN (SELECT student_id FROM classroom_student)
            ORDER BY u.id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getStudentEmail($student_email){
    global $conn;
    $sql = "SELECT * from accounts WHERE email = ?";
    $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $student_email);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0) {
         return $result->fetch_assoc();
      } else {
         return 0;
      }
}

function getClasses(){
    global $conn;
    $sql = "SELECT * FROM classes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getStudentByClass($class_id){
    global $conn;
    $sql = "SELECT *, u.date_created as date
            FROM users u
            JOIN accounts a ON u.id = a.acc_id 
            JOIN classroom_student cs ON u.id = cs.student_id 
            JOIN classes c ON cs.classroom_id = c.class_id 
            WHERE u.role = 2 and c.class_id = ?
            ORDER BY u.id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getStudentsByClass(){
    global $conn;
    $sql = "SELECT *, u.date_created as date
            FROM users u
            JOIN accounts a ON u.id = a.acc_id 
            JOIN classroom_student cs ON u.id = cs.student_id 
            JOIN classes c ON cs.classroom_id = c.class_id 
            WHERE u.role = 2
            ORDER BY u.id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function reorderTable(){
    global $conn;
    $sql = "ALTER TABLE accounts ORDER BY acc_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql2 = "ALTER TABLE users ORDER BY id ASC";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();

    $sql3 = "ALTER TABLE classroom_student ORDER BY classroom_id ASC";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();
}

function addNewStudent($new_student){
    global $conn;
    $student = [
        "email" => $new_student['email'],
        "password" => password_hash($new_student['password'],PASSWORD_DEFAULT),
        "Fname" => $new_student['Fname'],
        "Lname" => $new_student['Lname'],
        "DoB" => $new_student['DoB'],
        "phone_num" =>$new_student['phone_num'],
        "gender" => $new_student['gender'],
        "image" => "",
        "role" => 2
    ];
    $sql = "INSERT INTO accounts (email, password) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $student['email'], $student['password']);
    $stmt->execute();

    if($stmt->affected_rows == 1){
        $last_id = $stmt->insert_id;
        // var_dump($last_id);
        // var_dump($student);
        $sql2 = "INSERT INTO users (id, Fname, Lname, DoB, gender, phone_num, role, image) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("isssisis",$last_id,$student['Fname'],$student['Lname'],$student['DoB'],$student['gender'],$student['phone_num'],$student['role'], $student['image']);
        $stmt2->execute();
        // header("Location: manageStudent.php");
    }
    reorderTable();
}
//=========================>$_POST
function validateNewStudent($student, &$new_student){
    $numStudent = (count($student) - 1) / 7;
    for ($i = 0; $i < $numStudent; $i++){
        $temp =$i + 1;
        $new_student['email'] = filter_var($student['email' . $temp],FILTER_SANITIZE_EMAIL);
        $new_student['password'] = htmlspecialchars($student['password' . $temp]);
        $new_student['Fname'] = htmlspecialchars($student['Fname' . $temp]);
        $new_student['Lname'] = htmlspecialchars($student['Lname' . $temp]);
        $new_student['DoB'] = $student['DoB' . $temp];
        $new_student['phone_num'] = htmlspecialchars($student['phoneNum' . $temp]);
        $new_student['gender'] = $student['gender' . $temp];

        //input & email validation & check if email is exists in db
        $email = getStudentEmail($new_student['email']);
        if(!empty($email) || !filter_var($new_student['email'],FILTER_SANITIZE_EMAIL)){
            $new_student['email_err'] = true;
            var_dump("email false");
        }
        //check pw > 5 chars
        if(strlen($new_student['password']) < 5){
            $new_student['password_err'] = true;
            var_dump("password false");
        }
        //if there's err => alert | else => log in
        if(array_search(true, $new_student, true)){
            var_dump("There was an error with your submission!");
        }else{
            addNewStudent($new_student);
        }
    }
    header("Location: manageStudent.php");
}

function deleteHaveClassStudent($student_id){
    // var_dump($student_id);
    global $conn;
    //delete img in folder(if has)
    $sql0 = "SELECT * FROM users WHERE id = ?";
    $stmt0 = $conn->prepare($sql0);
    $stmt0->bind_param("i",$student_id['delete']);
    $stmt0->execute();
    $result = $stmt0->get_result();
    $temp = $result->fetch_assoc();
    // var_dump($temp);
    if(!empty($temp['image'])){
        unlink($temp['image']);
        // var_dump("true");
    }
    //delete in accounts table
    $sql = "DELETE FROM accounts WHERE acc_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$student_id['delete']);
    $stmt->execute();
    //delete in users table
    $sql2 = "DELETE FROM users WHERE id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i",$student_id['delete']);
    $stmt2->execute();
    //delete in classroom_student table
    $sql3 = "DELETE FROM classroom_student WHERE classroom_id = ? AND student_id = ?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param("ii",$student_id['classroom_id'], $student_id['delete']);
    $stmt3->execute();

    header("Location: manageStudent.php");
}

function editStudent($student_id){
    global $conn;
    $sql = "UPDATE users SET Fname = ?, Lname = ?, DoB = ?, gender = ?, phone_num = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi",$student_id['Fname'], $student_id['Lname'], $student_id['DoB'], $student_id['gender'], $student_id['phoneNum'], $student_id['student_id']);
    $stmt->execute();

    header("Location: manageStudent.php");
}

function deleteUnclassStudent($student_id){
    global $conn;
    //delete img in folder(if has)
    $sql0 = "SELECT * FROM users WHERE id = ?";
    $stmt0 = $conn->prepare($sql0);
    $stmt0->bind_param("i",$student_id);
    $stmt0->execute();
    $result = $stmt0->get_result();
    $temp = $result->fetch_assoc();
    // var_dump($temp);
    if(!empty($temp['image'])){
        unlink($temp['image']);
        // var_dump("true");
    }
    //delete in accounts table
    $sql = "DELETE FROM accounts WHERE acc_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$student_id);
    $stmt->execute();
    //delete in users table
    $sql2 = "DELETE FROM users WHERE id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i",$student_id);
    $stmt2->execute();

    header("Location: manageStudent.php");
}