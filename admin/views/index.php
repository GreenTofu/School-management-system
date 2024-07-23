<?php
include "../inc/head.php";
include "../func/studentHandler.php";
include "../func/teacherHandler.php";
include "../func/ClassNoticeHandler.php";
include "../func/PublicNoticeHandler.php";

$class = getClasses();
$student = getTotalStudents();
$teacher = getTotalTeachers();
$classNotice = getClassNotices();
$publicNotice = getPublicNotices();
?>

<div class="container text-center my-5 ml-2 flex-shrink-1 p-3">
    <div class="row bg-white p-3">
        <div class="col-md-12">
            <div class="align-items-baseline border-bottom d-flex justify-content-between">
                <h5>Report Summary</h5>
                <div class="d-flex align-items-baseline">
                    <p>Update Report</p>
                    <button type="button" class="btn"><i class="fa-solid fa-arrows-rotate"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row bg-white pb-3">
        <div class="col-lg-3 col-md-6">
            <div class="card rounded-0 border-0 flex-row justify-content-between p-3">
                <div>
                    <p class="fw-semibold">Total Class:<span class="ml-2 fw-semibold"><?=count($class)?></span></p>
                    <a href="manageClass.php" class="my-color">View Classes</a>
                </div>
                <div>
                    <i class="ml-2 fa-solid fa-house-chimney fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card rounded-0 border-0 flex-row justify-content-between p-3">
                <div>
                    <p class="fw-semibold">Total Students:<span class="ml-2 fw-semibold"><?=count($student)
                    ?></span></p>
                    <a href="manageStudent.php" class="my-color">View Students</a>
                </div>
                <div>
                    <i class="ml-2 fa-solid fa-user fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card rounded-0 border-0 flex-row justify-content-between p-3">
                <div>
                    <p class="fw-semibold">Total Teacher:<span class="ml-2 fw-semibold"><?=count($teacher)
                    ?></span></p>
                    <a href="manageTeacher.php" class="my-color">View Teacher</a>
                </div>
                <div>
                <i class="fa-solid fa-chalkboard-user ml-2 fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card rounded-0 border-0 flex-row justify-content-between p-3">
                <div>
                    <p class="fw-semibold">Total Class Notice:<span class="ml-2 fw-semibold"><?=count($classNotice)
                    ?></span></p>
                    <a href="manageClassNotice.php" class="my-color">View Class Notice</a>
                </div>
                <div>
                    <i class="ml-2 fa-solid fa-file fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card rounded-0 border-0 flex-row justify-content-between p-3">
                <div>
                    <p class="fw-semibold">Total Public Notice:<span class="ml-2 fw-semibold"><?=count($publicNotice)
                    ?></span></p>
                    <a href="managePublicNotice.php" class="my-color">View Public Notice</a>
                </div>
                <div>
                    <i class="ml-2 fa-solid fa-passport fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../inc/footer.php";
?>