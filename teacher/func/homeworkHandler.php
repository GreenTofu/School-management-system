<?php
    function getHomeworkByClassNameAndSection($class_name, $section){
        global $conn;
        $sql = "SELECT *, hw.due as date, hw.date_created as date
                FROM homework hw join classes c on hw.class_id = c.class_id JOIN users u ON u.id = hw.teacher_id
                WHERE c.class_name = ? AND c.section = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $class_name, $section);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function getHomeworkByHwID($hwID){
        global $conn;
        $sql = "SELECT *
                FROM submissions s join homework hw on s.hw_id = hw.hw_id JOIN users u ON u.id = s.student_id
                WHERE s.hw_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $hwID);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function getSubmissionBySubID($SubID){
        global $conn;
        $sql = "SELECT *
                FROM submissions s
                WHERE s.sub_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $SubID);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_assoc();
    }

    function gradingSubmission($mark, $SubID){
        global $conn;
        $sql = "UPDATE submissions
                SET grade = ?
                WHERE sub_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $mark, $SubID);
        $stmt->execute();

        header("Location: viewFile.php?n=". $SubID);
    }

    function addHomework($acc_id, $class_id, $hwTitle, $hwDes, $hwDue){
        global $conn;
        $sql = "INSERT INTO homework (teacher_id, class_id, hw_title, hw_description, due) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisss", $acc_id, $class_id, $hwTitle, $hwDes, $hwDue);
        $stmt->execute();
    }

    function validateHomework($data){
        $acc_id = $_SESSION['user_id'];
        $hwTitle = $data['homeworkTitle'];
        $hwDes = $data['homeworkDes'];
        $due = $data['deadline'];
        $className = $_SESSION['class'];
        $section = $_SESSION['classSection'];

        global $conn;
        $sql = "SELECT c.class_id
                FROM classes c
                WHERE c.class_name = ? AND c.section = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $className, $section);
        $stmt->execute();
        $results = $stmt->get_result();
        $class_data = $results->fetch_assoc();
        if($class_data == null){
            var_dump("Class don't exitst in database");
        }
        else{
            addHomework($acc_id, $class_data['class_id'], $hwTitle, $hwDes, $due);
            header("LOCATION: manageHomework.php");
        }
    }

    function deleteHomework($hw_id){
        global $conn;
        $sql = "DELETE FROM homework WHERE hw_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$hw_id);
        $stmt->execute();

        header("Location: manageHomework.php");
    }

    function editHomework($homework){
        var_dump($homework);
        global $conn;
        $sql = "UPDATE homework SET hw_title = ?, hw_description = ?, due = ? WHERE hw_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $homework['hw_title'], $homework['hw_description'], $homework['deadline'], $homework['hw_id']);
        $stmt->execute();

        header("Location: manageHomework.php");
    }


?>