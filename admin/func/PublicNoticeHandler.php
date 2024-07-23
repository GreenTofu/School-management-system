<?php
    function getPublicNotices(){
        global $conn;
        $sql = "SELECT *, pn.date_created as date, u.Fname, u.Lname
                FROM public_notices pn JOIN users u ON pn.acc_id = u.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function addPublicNotice($acc_id, $noticeTitle, $noticeMessage){
        global $conn;
        $sql = "INSERT INTO public_notices (acc_id, notice_title, notice_body) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $acc_id, $noticeTitle, $noticeMessage);
        $stmt->execute();
    }

    function validatePublicNotice($data){
        $acc_id = $_SESSION['user_id'];
        $noticeTitle = $data['noticeTitle'];
        $noticeMessage = $data['noticeMessage'];

        addPublicNotice($acc_id, $noticeTitle, $noticeMessage);
        header("LOCATION: managePublicNotice.php");
    }

    function deletePublicNotice($notice_id){
        global $conn;
        $sql = "DELETE FROM public_notices WHERE notice_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$notice_id);
        $stmt->execute();

        header("Location: managePublicNotice.php");
    }

    function editPublicNotice($notice){
        global $conn;
        $sql = "UPDATE public_notices SET notice_title = ?, notice_body = ? WHERE notice_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi",$notice['notice_title'], $notice['notice_body'], $notice['notice_id']);
        $stmt->execute();

        header("Location: managePublicNotice.php");
    }
?>