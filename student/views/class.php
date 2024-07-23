<?php
include "../inc/head.php";
include "../func/classHandler.php";
$class_id = $_SESSION['class'];
$student_id = $_SESSION['user_id'];
$class = getClass($class_id);
$homeworks = getHomeworks($class_id);
$limit = 5;
$limitStudent = get5Students($class_id, $limit);
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(isset($_POST['leave'])){
    removeStudent($class_id, $student_id);
}
?>
<div class="container text-center my-5 ml-2 flex-shrink-1 p-3">
    <div class="row bg-white p-3 rounded">
        <div class="col-md-12">
            <div class="align-items-baseline border-bottom border-dark d-flex justify-content-between">
                <h5>Class <?=$class['class_name'] . $class['section']?></h5>
                <div class="d-flex align-items-baseline">
                    <p>Refresh</p>
                    <a href="class.php" class="text-decoration-none ml-2"><i class="fa-solid fa-arrows-rotate"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3 row bg-white rounded text-left">
        <div class=" d-flex rounded-top border-bottom border-dark justify-content-around bg-secondary bg-gradient">
            <h5 class="pt-3 mb-3"><a href="notice.php" class="text-decoration-none fs-5 font-weight-bold"
                style="color:#061540"><i class="fa-solid fa-bullhorn mr-2"></i>Announcement</a></h5>
            <h5 class="mb-3 pt-3"><a href="members.php" class="text-decoration-none fs-5 font-weight-bold"
                style="color:#061540"><i class="fa-solid fa-users mr-2"></i>Members</a></h5>
        </div>
        <div class="text-center border-bottom border-dark bg-secondary bg-gradient">
            <h6 class="font-weight-bold fs-4 pt-3 mb-3">Assignments</h6>
        </div>
        <?php if(empty(($homeworks))):?>
            <div class="p-3 mt-3 mb-3 bg-white rounded-bottom justify-content-center">
                <h4 class="text-center text-danger">No avalable assignment</h4>
            </div>
        <?php else:?>
            <?php for ($i=0; $i < count($homeworks) - 1; $i++) :?>
            <div class="d-flex border-bottom border-dark mt-3 align-content-center">
                <div class="icon fs-5 mt-2 ml-3 mr-2">
                    <i class="fa-solid fa-file-pen"></i>
                </div>
                <div class="assignInfo">
                    <a href="assignment.php?n=<?=$homeworks[$i]['hw_id']?>"
                        class="text-decoration-underline text-dark fs-5"><?=$homeworks[$i]['hw_title']?></a>
                    <p class="text-dark" style="font-size: 13px;"><span class="font-weight-bold">Due
                        </span><?= date("d F Y h:i A",strtotime($homeworks[$i]['due']))?></p>
                </div>
            </div>
            <?php endfor;?>
            <?php $lastHomework = end($homeworks)?>
            <div class="d-flex rounded-bottom mt-3 align-content-center">
                <div class="icon fs-5 mt-2 ml-3 mr-2">
                    <i class="fa-solid fa-file-pen"></i>
                </div>
                <div class="assignInfo">
                    <a href="assignment.php?n=<?=$lastHomework['hw_id']?>"
                        class="text-decoration-underline text-dark fs-5"><?=$lastHomework['hw_title']?></a>
                    <p class="text-dark" style="font-size: 13px;"><span class="font-weight-bold">Due
                        </span><?= date("d F Y h:i A",strtotime($lastHomework['due']))?></p>
                </div>
            </div>
        <?php endif;?>
    </div>
    <div class="leaveClass text-end mt-3">
        <form action="class.php" method="post">
            <input type="hidden" name="class_id" value="<?=$class_id?>">
            <button type="submit" name="leave" class="btn btn-danger" style="width:200px">Leave Class</button>
        </form>
    </div>
</div>
<?php
include "../inc/footer.php";
?>