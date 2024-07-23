<?php
    function getStudentsByClassID($class_id){
        global $conn;
        $sql = "SELECT *
                FROM users u join classroom_student cs on u.id = cs.student_id join accounts a on a.acc_id = u.id
                WHERE cs.classroom_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function getClassByClassID($class_id){
        global $conn;
        $sql = "SELECT c.*
                FROM classes c
                WHERE c.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_assoc();
    }
?>