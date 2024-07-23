<?php
include "../inc/head.php";
include "../func/homeworkHandler.php";

$hw_id = $_GET['n'];
$submissions = getHomeworkByHwID($hw_id);
?>
<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>List Submissions</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="manageHomework.php">Manage Homework</a>
                    <p class="ml-1 text-muted">/ List Submissions</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded">
        <div class="d-flex justify-content-between">
            <h5 class="text-center">List Submissions</h5>
            <a class="text-decoration-none" href="#">View all submissions</a>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">File submission</th>
                    <th scope="col">Submited Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($submissions as $submission) { ?>
                <tr>
                    <th><?php echo $i?></th>
                    <td><a href="viewFile.php?n=<?=$submission['sub_id']?>"><?=$submission['Fname']?> <?php echo $submission['Lname']?></a></td>
                    <td><a href="../../files/<?=$submission['file_url']?>" download><?=$submission['file_url']?></a></td>
                    <td><?php echo $submission['sub_date']?></td>
                </tr>
                <?php $i += 1;} ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include "../inc/footer.php";
?>