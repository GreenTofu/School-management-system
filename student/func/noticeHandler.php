<?php
    function getClassNoticesByClassID($class_id){
        global $conn;
        $sql = "SELECT *, cn.date_created as date
                FROM class_notices cn join classes c on cn.class_id = c.class_id join users u on u.id = cn.acc_id
                WHERE c.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function getAssignmentByClassID($class_id){
        global $conn;
        $sql = "SELECT *
                FROM homework hw
                WHERE hw.class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }
?>