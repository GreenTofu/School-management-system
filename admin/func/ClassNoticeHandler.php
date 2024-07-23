<?php
    function getClassNotices(){
        global $conn;
        $sql = "SELECT *, cn.date_created as date
                FROM class_notices cn join classes c on cn.class_id = c.class_id JOIN users u ON u.id = cn.acc_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function addClassNotice($acc_id, $class_id, $noticeTitle, $noticeMessage){
        global $conn;
        $sql = "INSERT INTO class_notices (acc_id, class_id, notice_title, notice_body) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $acc_id, $class_id['class_id'], $noticeTitle, $noticeMessage);
        $stmt->execute();
    }

    function validateClassNotice($data){
        $acc_id = $_SESSION['user_id'];
        $noticeTitle = $data['noticeTitle'];
        $noticeMessage = $data['noticeMessage'];
        $className = $data['class_name'];
        $section = $data['section'];

        global $conn;
        $sql = "SELECT c.class_id
                FROM classes c
                WHERE c.class_name = ? AND c.section = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $className, $section);
        $stmt->execute();
        $results = $stmt->get_result();
        $class_id = $results->fetch_assoc();
        if($class_id == null){
            var_dump("Class don't exitst in database");
        }
        else{
            addClassNotice($acc_id, $class_id, $noticeTitle, $noticeMessage);
            header("LOCATION: manageClassNotice.php");
        }
    }

    function deleteClassNotice($notice_id){
        global $conn;
        $sql = "DELETE FROM class_notices WHERE notice_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$notice_id);
        $stmt->execute();

        header("Location: manageClassNotice.php");
    }

    function editClassNotice($notice){
        global $conn;
        $sql = "SELECT c.class_id
                FROM classes c
                WHERE c.class_name = ? AND c.section = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $notice['class_name'], $notice['section']);
        $stmt->execute();
        $results = $stmt->get_result();
        $class_id = $results->fetch_assoc();
        // var_dump($class_id);
        if($class_id == null){
            var_dump("Class don't exitst in database");
        }else{
           //update class_notices
        $sql = "UPDATE class_notices SET notice_title = ?, notice_body = ?, class_id = ? WHERE notice_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $notice['noticeTitle'], $notice['noticeMessage'], $class_id['class_id'] ,$notice['notice_id']);
        $stmt->execute();

        header("Location: manageClassNotice.php");
        }
    }
?>