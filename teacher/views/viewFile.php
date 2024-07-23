<?php
include "../inc/head.php";
include "../func/homeworkHandler.php";

$sub_id = $_GET['n'];
$submission = getSubmissionBySubID($sub_id);
// var_dump($submission);

if(isset($_POST["grading"])){
    // var_dump("true");
    gradingSubmission($_POST['grading'], $sub_id);
}
?>
<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>View File</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="viewHomework.php?n=<?=$submission['hw_id']?>">View Homework</a>
                    <p class="ml-1 text-muted">/ View File</p>
                </div>
            </div>
        </div>
    </div>
    <div class=" bg-white p-3 rounded">
        <div class="submissionStatus">
            <div class="submit-preview">
                <?php if(current(explode("/", $submission['type'])) == "application"):?>
                    <embed src="../../files/<?=$submission['file_url']?>" type="<?=$submission['type']?>" width="100%" height="550px">
                <?php elseif(current(explode("/", $submission['type'])) == "image"):?>
                    <img src="../../files/<?=$submission['file_url']?>">
                <?php else:?>
                        
                <?php endif;?>
            </div>
        </div>
        <div class="gradingSubmission">
            <form action="viewFile.php?n=<?=$sub_id?>" method="post">
                <div class="mt-3 text-dark">
                    <div class="form-group">
                        <label for="noticeTitle" class="font-weight-bold">Grading</label>
                        <?php if(!empty($submission['grade'])):?>
                            <input type="number" name="grading" class="form-control rounded-0 font-weight-bold text-dark" onchange="this.form.submit()" value="<?=$submission['grade']?>">
                        <?php else:?>
                            <input type="number" name="grading" class="form-control rounded-0 font-weight-bold" onchange="this.form.submit()" placeholder="Mark here...">
                        <?php endif;?>
                    </div>
                    <!-- <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success">Add</button>
                    </div>     -->
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "../inc/footer.php";
?>