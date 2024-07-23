<?php
    
    function getClasses(){
        global $conn;
        $sql = "SELECT *, c.date_created as date
                FROM classes c join users u ON c.teacher_id = u.id
                ORDER BY c.class_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function addClass($class_name, $section, $homeTeacher_id){
        global $conn;
        $sql = "INSERT INTO classes (class_name, section, teacher_id) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $class_name, $section, $homeTeacher_id);
        $stmt->execute();
    }

    function validateClass($data){
        $homeTeacher_id = $data['homeTeacher_id'];
        $class_name = $data['class_name'];
        $section = $data['section'];
        $role_techer = 1;

        //Get teacher_id existed in database
        global $conn;
        $sql = "SELECT u.id
                FROM users u
                WHERE u.id = ? AND u.role = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $homeTeacher_id, $role_techer);
        $stmt->execute();
        $results = $stmt->get_result();
        $check_teacherExist = $results->fetch_assoc();

        //Get class_name and section existed in database
        $sql = "SELECT c.class_name, c.section
                FROM classes c
                WHERE c.class_name = ? AND c.section = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $class_name, $section);
        $stmt->execute();
        $results = $stmt->get_result();
        $check_classExist = $results->fetch_all(MYSQLI_ASSOC);

        if($check_teacherExist == null){
            var_dump("Incorrect teacher id");
        }
        elseif($check_classExist != null){
            var_dump("Existed class name and section");
        }
        else{
            addClass($data['class_name'], $data['section'], $data['homeTeacher_id']);
            header("LOCATION: manageClass.php");
        }
    }

    function deleteClass($class_id){
        global $conn;
        //delete classes
        $sql = "DELETE FROM classes WHERE class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$class_id);
        $stmt->execute();
        //delete in classroom_student
        $sql = "DELETE FROM classroom_student WHERE classroom_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$class_id);
        $stmt->execute();

        header("Location: manageClass.php");
    }

    function editClass($class){
        $role_techer = 1;
        $check = [
            "err" => false
        ];
        //Get teacher_id existed in database
        global $conn;
        $sql = "SELECT u.id
                FROM users u
                WHERE u.id = ? AND u.role = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $class['teacher_id'], $role_techer);
        $stmt->execute();
        $results = $stmt->get_result();
        $check_teacherExist = $results->fetch_assoc();
        if(empty($check_teacherExist)){
            var_dump("teacher_id not exists");
            $check['err'] = true;
        }

        //Get class_name and section existed in database
        $sql = "SELECT c.class_name, c.section
                FROM classes c
                WHERE c.class_name = ? AND c.section = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $class['classname'], $class['classSection']);
        $stmt->execute();
        $results = $stmt->get_result();
        $check_classExist = $results->fetch_all(MYSQLI_ASSOC);
        if(!empty($check_classExist)){
            // var_dump("Class existed!");
            $check['err'] = true;
        }
        if(array_search(true, $check, true)){
            var_dump("Error!");
        }else{
            //classes
        $sql = "UPDATE classes SET class_name = ?,section = ?, teacher_id = ? WHERE class_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $class['classname'], $class['classSection'], $class['teacher_id'], $class['class_id']);
        $stmt->execute();

        header("Location: manageClass.php");
        }
    }
?>