<?php
    function getStudentByClassNameAndSection($class_name, $section){
        global $conn;
        $sql = "SELECT *, cs.attend_day as date, u.DoB as date
                FROM users u JOIN classroom_student cs ON u.id = cs.student_id join classes c on cs.classroom_id = c.class_id join accounts a on a.acc_id = u.id
                WHERE c.class_name = ? AND c.section = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $class_name, $section);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function removeStudent($student_id){
        global $conn;
        $sql = "DELETE FROM classroom_student WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$student_id);
        $stmt->execute();

        header("Location: viewClass.php");
    }
?>