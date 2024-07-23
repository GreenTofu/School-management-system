<?php
include "../inc/head.php";
include "../func/noticeHandler.php";
include "../func/memberHandler.php";

$students = getStudentsByClassID($_SESSION['class']);
$notices = getClassNoticesByClassID($_SESSION['class']);
$assignments = getAssignmentByClassID($_SESSION['class']);
?>

<div class="container text-center my-5 ml-2 flex-shrink-1 p-3">
    <?php if(empty($_SESSION['class'])):?>
    <div class="row bg-white p-3 rounded justify-content-center">
        <h4 class="text-center"> You have not attended in any class</h4>
        <h4 class="text-center"> Enroll class to see newest news</h4>
        <a href="enroll.php" class="btn btn-outline-primary text-center mt-3 text-center"
            style="width: 150px;">Enroll</a>
    </div>
    <?php else:?>
    <div class="row bg-white p-3 rounded-top">
        <div class="col-md-12">
            <div class="align-items-baseline  border-bottom d-flex justify-content-between">
                <h5>Report Summary</h5>
                <div class="d-flex align-items-baseline">
                    <p>Refresh Report</p>
                    <button type="button" class="btn"><i class="fa-solid fa-arrows-rotate"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row bg-white pb-3 rounded-bottom">
        <div class="col-lg-4 col-md-12">
            <div
                class="card rounded-0 border-0 border-end flex-row justify-content-between p-3">
                <div>
                    <p class="fw-semibold">Total Members:<span class="ml-2 fw-semibold"><?=count($students)?></span></p>
                    <a href="members.php" class="my-color">View Class</a>
                </div>
                <div>
                    <i class="ml-2 fa-solid fa-house-chimney fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card rounded-0 border-0 flex-row border-end justify-content-between p-3">
                <div>
                    <p class="fw-semibold">Total Assignments:<span class="ml-2 fw-semibold"><?=count($assignments)?></span></p>
                    <a href="class.php" class="my-color">Total Assignments</a>
                </div>
                <div>
                    <i class="fa-solid fa-file ml-2 fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card rounded-0 border-0 flex-row justify-content-between p-3">
                <div>
                    <p class="fw-semibold">Total Notice:<span class="ml-2 fw-semibold"><?=count($notices)?></span></p>
                    <a href="notice.php" class="my-color">View Class Notice</a>
                </div>
                <div>
                    <i class="ml-2 fa-solid fa-file fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>

<?php
include "../inc/footer.php";
?>