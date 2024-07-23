<?php
$edit_student = [
    "id" =>"",
    "current_password" => "",
    "password_err" => false,
    "new_password" => "",
    "confirm_new_password" => "",
    "confirm_new_password_err" => false
];

function getStudent($id){
    global $conn;
    $sql = "SELECT * FROM users u JOIN accounts a ON u.id = a.acc_id WHERE u.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        return $result->fetch_assoc();
     } else {
        return 0;
     }
}

function updateStudent($id){
    global $conn;
    $sql = "UPDATE users SET Fname = ?, Lname = ?, DoB = ?, gender = ?, phone_num = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi",$id['Fname'], $id['Lname'], $id['DoB'], $id['gender'], $id['phoneNum'], $id['id']);
    $stmt->execute();
    // $_SESSION['id']
    $_SESSION['Fname'] = $id['Fname'];
   $_SESSION['Lname'] = $id['Lname'];
    header("Location: student.php");
}
function changeStudentPassword($password){
    $edit_teacher = [
        "new_password" => password_hash($password['new_password'], PASSWORD_DEFAULT),
        "id" => $password['id']
    ];
    global $conn;
    $sql = "UPDATE accounts SET password = ? WHERE acc_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si",$edit_teacher['new_password'], $edit_teacher['id']);
    $stmt->execute();

    header("Location: setting.php");
}
//=======================>$_POST
function validatePassword($student, &$edit_student){
    $edit_student['current_password'] = $student['currentPassword'];
    $edit_student['new_password'] = $student['newPassword'];
    $edit_student['confirm_new_password'] = $student['confirmPassword'];
    $edit_student['id'] = $student['id'];
    $StudentUser = getStudent($student['id']);
    //check current password = password in db or not
    if(!password_verify($edit_student['current_password'],$StudentUser['password'])){
        var_dump("Current password wrong!");
        $edit_student['password_err'] = true;
    }
    //check new password = confirm new password or not
    if($edit_student['new_password'] != $edit_student['confirm_new_password']){
        $edit_student['confirm_new_password_err'] = true;
        var_dump("Not same password!");
    }
    if(array_search(true, $edit_student, true)){
        var_dump("There's someting wrong!");
    }else{
        changeStudentPassword($edit_student);
    }
}

function validateFile($file, $id) {
    // validate file
    $errors = [];
    if($file['error'] === 0) {
        // check size is less than 5mb
        if($file['size'] > 5000000) {
            $errors['size'] = "File is too large!";
        }
        // check file ext is allowed
        $allowed_ext = ["png", "jpg", "jpeg", "gif"];
        $file_ext = explode("/", $file['type']);
        $file_ext = end($file_ext);
        if(!in_array(strtolower($file_ext), $allowed_ext)) {
            $errors['type'] = "Only images may be uploaded!";
        }
        // if there are no errors, rename file and move it
        if(empty($errors)) {
            // rename file
            $new_name = uniqid("itec_") . "." . $file_ext;
            $dest = "../../images/" . $new_name;
            // move to images/
            if(move_uploaded_file($file['tmp_name'], $dest)) {
                changeProfilePic($dest, $id);
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function changeProfilePic($file,$id){
    global $conn;
    $sql = "UPDATE users SET image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $file, $id);
    $stmt->execute();
    $_SESSION['image'] = $file;
    header("Location: student.php");
}