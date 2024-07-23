<?php
// function getStudentInformation($student_id){
//     global $conn;
//     $sql = "SELECT *, u.date_created as date
//             FROM users u JOIN accounts a ON u.id = a.acc_id
//             JOIN classroom_student cs ON cs.student_id = u.id
//             JOIN classes c ON c.class_id = cs.classroom_id
//             WHERE u.id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("i", $student_id);
//     $result = $stmt->get_result();
//     return $result->fetch_assoc();
// }

function getClass($class_id){
    global $conn;
    $sql = "SELECT *,c.date_created as date
            FROM classes c JOIN users u ON c.teacher_id = u.id
            WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return $result->fetch_assoc();
    }else{
        return 0; 
    }
}

function getHomeworks($class_id){
    global $conn;
    $sql = "SELECT * FROM homework WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function getHomework($hw_id){
    global $conn;
    $sql = "SELECT * FROM homework WHERE hw_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $hw_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return $result->fetch_assoc();
    }else{
        return 0;
    }
}

function get5Students($class_id, $limit){
    global $conn;
    $sql = "SELECT * FROM users u JOIN classroom_student cs ON u.id = cs.student_id WHERE cs.classroom_id = ? LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $class_id, $limit);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function removeStudent($class_id, $student_id){
    global $conn;
    $sql = "DELETE FROM classroom_student WHERE classroom_id = ? AND student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $class_id, $student_id);
    $stmt->execute();
    
    $_SESSION['class'] = null;
    header("Location: index.php");
}

function submitFile($file, $hw_id, $student_id){
    $errors = [];
    // $file = $fileData['file'];
    // var_dump($file);
    if(!empty($file)){
        if($file['error'] == 0){
            if($file['size'] > 5000000){
                $errors['size'] = "File is to large";
            }
            $allowed_ext = ["png", "jpg", "jpeg", "pdf", "x-zip-compressed"];
            $file_ext = explode("/", $file['type']);
            $file_ext = end($file_ext);
            if(!in_array(strtolower($file_ext), $allowed_ext)) {
                $errors['type'] = "Extension is not allow";
            }
            if(empty($errors)){
                $dest = "../../files/" . $file['name'];
                if(move_uploaded_file($file['tmp_name'], $dest)){
                    global $conn;
                    $sql = "INSERT INTO submissions(student_id, hw_id, file_url, size, type) VALUES (?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iisis", $student_id, $hw_id, $file['name'], $file['size'], $file['type']);
                    $stmt->execute();
                    header("Location: assignment.php?n=" . $hw_id);
                } else{
                    return false;
                }
            } else {
                return false;
            }
        } else{
            return false;
        }
    } else{
        return false;
    }
}

function getSubmission($student_id, $hw_id){
    global $conn;
    $sql = "SELECT * FROM submissions WHERE student_id = ? AND hw_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $student_id, $hw_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return $result->fetch_assoc();
    }else{
        return 0;
    }
}

function changeSubFile($file, $student_id, $hw_id){
    global $conn;
    $sql = "SELECT * FROM submissions WHERE student_id = ? AND hw_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $student_id, $hw_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $temp = $result->fetch_assoc();
    $dest = "../../files/" . $temp['file_url']; 
    unlink($dest);

    $sql = "DELETE FROM submissions WHERE student_id = ? AND hw_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $student_id, $hw_id);
    $stmt->execute();

    $filename = "../../files/" . $file['name'];
    if(move_uploaded_file($file['tmp_name'], $filename)){
        $sql = "INSERT INTO submissions(student_id, hw_id, file_url, size, type) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisis", $student_id, $hw_id, $file['name'], $file['size'], $file['type']);
        $stmt->execute();
        header("Location: assignment.php?n=" . $hw_id);
    }
}
?>