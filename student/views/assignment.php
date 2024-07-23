<?php
include "../inc/head.php";
include "../func/classHandler.php";

$hw_id = $_GET['n'];
$student_id = $_SESSION['user_id'];
$homework = getHomework($hw_id);
// $submission = getSubmission($student_id, $hw_id);
$submission = getSubmission($student_id,$hw_id);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$currentTime = new DateTime (date('Y-m-d H:i:s'));
$due = new DateTime($homework['due']);
$diff = date_diff($currentTime, $due);


if(isset($_FILES['sub_file_1'])){
    // var_dump($_FILES['sub_file']);
    submitFile($_FILES['sub_file_1'], $hw_id, $student_id);
}
if(isset($_FILES['sub_file_2'])){
    // var_dump($_FILES['sub_file_2']);
    changeSubFile($_FILES['sub_file_2'], $student_id, $hw_id);
}
?>
<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row mr-1">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5></h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="class.php">Back to class</a>
                    <p class="ml-1 text-muted">/ Submissions</p>
                </div>
            </div>
        </div>
    </div>
    <div class=" bg-white p-3 rounded">
        <div class="hwTitle border-bottom border-dark">
            <h5 class="fs-2"><?=$homework['hw_title']?></h5>
            <p class=""><span class="font-weight-bold">| Due
                </span><?= date("D, d F Y h:i A",strtotime($homework['due']))?>
            </p>
        </div>
        <div class="hwDescrip my-3">
            <p><?=$homework['hw_description']?></p>
        </div>
        <div class="submissionStatus mt-3 pt-3">
            <h5 class="text-primary fs-4 mb-3">Submission Status</h5>
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <th>Submission status</th>
                        <?php if (empty($submission)):?>
                        <td>Have not submitted</td>
                        <?php else:?>
                        <td>Submitted</td>
                        <?php endif;?>
                    </tr>
                    <tr>
                        <th>Graded</th>
                        <?php if (empty($submission['grade'])):?>
                        <td>Have not graded</td>
                        <?php else:?>
                        <td><?=$submission['grade']?></td>
                        <?php endif;?>
                    </tr>
                    <tr>
                        <th>Due</th>
                        <td><?=date("l, d F Y h:i A",strtotime($homework['due']))?></td>
                    </tr>
                    <tr>
                        <th>Last Modified</th>
                        <?php if (empty($submission)):?>
                        <td>None</td>
                        <?php else:?>
                        <td><?=date("l, d F Y h:i A",strtotime($submission['sub_date']))?></td>
                        <?php endif;?>
                    </tr>
                    <tr>
                        <th>Time remaining</th>
                        <?php if ($currentTime > $due):?>
                        <td class="text-danger">Time to submit is over</td>
                        <?php else:?>
                        <?php if($diff->days > 1):?>
                        <td><?=$diff->days . " days " . $diff->h . " hours"?></td>
                        <?php else:?>
                        <td><?=$diff->h . "hours " . $diff->i . " minutes"?></td>
                        <?php endif;?>
                        <?php endif;?>
                    </tr>
                    <?php if (empty($submission)):?>

                    <?php else:?>
                    <tr>
                        <th>File Submission</th>
                        <td><a href="../../files/<?=$submission['file_url']?>" download><?=$submission['file_url']?></a></td>
                    </tr>
                    <?php endif;?>
                </tbody>
            </table>
            <?php if (empty($submission)):?>
                <div class="text-center pt-3">
                    <?php if($currentTime > $due):?>
                    <a href="class.php"><button type="button" class="btn btn-secondary submitBtn" style="width:200px" disable>Closed</button></a>
                    <?php elseif($currentTime < $due):?>
                    <button type="button" class="btn btn-secondary submitBtn" style="width:200px" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add submission</button>
                    <?php endif;?>
                </div>
            <?php else:?>
                <div class="submit-preview mt-4 pt-4">
                    <h4 class="font-weight-bold pb-2">File Preview</h4>
                    <?php if(current(explode("/", $submission['type'])) == "application"):?>
                        <embed src="../../files/<?=$submission['file_url']?>" type="<?=$submission['type']?>" width="100%" height="550px">
                    <?php elseif(current(explode("/", $submission['type'])) == "image"):?>
                        <img src="../../files/<?=$submission['file_url']?>" style="width: 100%;">
                    <?php else:?>
                            
                    <?php endif;?>
                    <div class="mt-2 mr-2 text-end">
                        <?php if($currentTime < $due):?>
                            <button type="button" class="btn btn-secondary submitBtn" style="width:200px" data-bs-toggle="modal"
                            data-bs-target="#changeModal">Change submission</button>
                        <?php else:?>
                            <a href="class.php"><button type="button" class="btn btn-secondary submitBtn" style="width:200px" disable>Closed</button></a>
                        <?php endif;?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Upload File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body add-modal-body" style="background: #2590eb">
                <!-- Form to upload the files -->
                <form class="upload-1" method="post" action="assignment.php?n=<?=$hw_id?>" enctype="multipart/form-data">
                <div class="wrapper-1">
                    <div class="file-upload-1">
                        <input type="file" name="sub_file_1" class="inputID-1">
                        <i class="fa fa-arrow-up myicon-1"></i>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary saveBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Change Modal -->
<div class="modal fade" id="changeModal" tabindex="-1" aria-labelledby="changeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="changeModalLabel">Upload File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body change-modal-body" style="background: #2590eb">
                <!-- Form to upload the files -->
                <form class="upload-2" method="post" action="assignment.php?n=<?=$hw_id?>" enctype="multipart/form-data">
                <div class="wrapper-2">
                    <div class="file-upload-2">
                        <input type="file" name="sub_file_2" class="inputID-2">
                        <i class="fa fa-arrow-up myicon-2"></i>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary changeSaveBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="../js/main.js"></script>
<?php
include "../inc/footer.php";
?>