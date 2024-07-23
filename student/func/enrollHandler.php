<?php  
function getClasses(){
    global $conn;
    $sql = "SELECT *, c.date_created as date
            FROM classes c JOIN users u ON c.teacher_id = u.id
            ORDER BY c.class_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
}

function enrollClass($class_id, $student_id) {
    global $conn;
    $sql = "INSERT INTO classroom_student (classroom_id, student_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $class_id, $student_id);
    $stmt->execute();
    $_SESSION['class'] = $class_id;

    header("Location: index.php");
}
?>