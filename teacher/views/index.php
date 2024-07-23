<?php
include "../inc/head.php";
include "../func/ClassNoticeHandler.php";
include "../func/homeworkHandler.php";
include "../func/viewClassHandler.php";

$class_name = $_SESSION['class'];
$section = $_SESSION['classSection'];

$classNotice = getClassNoticesByClassNameAndSection($class_name, $section);
$homework = getHomeworkByClassNameAndSection($class_name, $section);
?>

<div class="container text-center my-5 ml-2 flex-shrink-1 p-3">
    <div class="row bg-white p-3 rounded-top">
        <div class="col-md-12">
            <div class="align-items-baseline border-bottom d-flex justify-content-between">
                <h5>Report Summary</h5>
                <div class="d-flex align-items-baseline">
                    <p>Update Report</p>
                    <a href="index.php" class="btn"><i class="fa-solid fa-arrows-rotate"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row bg-white pb-3 rounded-bottom">
        <div class="col-lg-6 col-md-6">
            <div class="card rounded-0 border-0 border-end flex-row justify-content-evenly p-3">
                <div>
                    <p class="fw-semibold">Total Class Notice<span class="ml-2 fw-semibold"><?=count($classNotice)?></span></p>
                    <a href="manageClassNotice.php" class="my-color">View Class Notices</a>
                </div>
                <div>
                    <i class="ml-2 fa-solid fa-scroll fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card rounded-0 border-0 border-end flex-row justify-content-evenly p-3">
                <div>
                    <p class="fw-semibold">Total Homework<span class="ml-2 fw-semibold"><?=count($homework)?></span></p>
                    <a href="manageHomework.php" class="my-color">View Homeworks</a>
                </div>
                <div>
                    <i class="ml-2 fa-solid fa-file-zipper fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../inc/footer.php";
?>