<?php
include "../inc/head.php";
include "../func/noticeHandler.php";
include "../func/memberHandler.php";

$classInfo = getClassByClassID($_SESSION['class']);
$class_name = $classInfo['class_name'];
$section = $classInfo['section'];
$classNotices = getClassNoticesByClassID($_SESSION['class']);
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Notice</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Notice</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded">
        <div class="d-flex justify-content-between">
            <h5 class="text-center">List Notice Of Class <?php echo $class_name?><?php echo $section?></h5>
            <a class="text-decoration-none" href="#">View All Notices</a>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Notice Title</th>
                    <th scope="col">Notice Date</th>
                    <th scope="col">Notice ID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($classNotices as $notice) { ?>
                <tr>
                    <th><?php echo $i?></th>
                    <td style="max-width:350px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?php echo $notice['notice_title']?></td>
                    <td><?=substr($notice['date'],0,10)?></td>
                    <td><?php echo $notice['notice_id']?></td>
                    <td>
                        <a class="text-decoration-none text-info" data-bs-toggle="modal"
                            data-bs-target="#viewModal<?=$i?>"><i class="fa-solid fa-file-invoice"></i></a>
                    </td>
                </tr>
                <!-- View Modal -->
                <div class="modal fade" id="viewModal<?=$i?>" tabindex="-1" aria-labelledby="viewModalLabel<?=$i?>"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 style="max-width:350px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" class="modal-title fs-5" id="viewModalLabel<?=$i?>"><?=$notice['notice_title']?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group">
                                        <h5 class="overflow-scroll"><?=$notice['notice_body']?></h5>
                                        <hr>
                                        <div class="form-group mt-2">
                                            <div class="d-flex gap-3">
                                                <div class="creator">
                                                    <label for="creator<?=$i?>">Note creator</label>
                                                    <input type="text" name="creator<?=$i?>"
                                                        class="form-control border border-primary font-weight-bold bg-white"
                                                        value="<?=$notice['Fname'] . " " . $notice['Lname']?>" readonly
                                                        required>
                                                </div>
                                                <div class="date">
                                                    <label for="CreatedDay<?=$i?>">Notice day</label>
                                                    <input type="date" name="CreatedDay<?=$i?>"
                                                        class="form-control border border-primary font-weight-bold bg-white"
                                                        value="<?=substr($notice['date'],0,10)?>" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i += 1;} ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include "../inc/footer.php";
?>