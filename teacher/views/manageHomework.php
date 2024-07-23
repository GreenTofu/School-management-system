<?php
include "../inc/head.php";
include "../func/homeworkHandler.php";

$class_name = $_SESSION['class'];
$section = $_SESSION['classSection'];

$homeworks = getHomeworkByClassNameAndSection($class_name, $section);
if(isset($_POST['delete'])){
    deleteHomework($_POST['delete']);
}
if(isset($_POST['edit'])){
    editHomework($_POST);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Manage Homework</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Manage Homework</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded">
        <div class="d-flex justify-content-between">
            <h5 class="text-center">Manage Homework For Class <?php echo $class_name?><?php echo $section?></h5>
            <a class="text-decoration-none" href="#">View All Homeworks</a>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Homework Title</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($homeworks as $homework) { ?>
                <tr>
                    <th><?php echo $i?></th>
                    <td><a href="viewHomework.php?n=<?=$homework['hw_id']?>"><?php echo $homework['hw_title']?></a></td>
                    <td><?php echo $homework['date_created']?></td>
                    <td><?php echo $homework['due']?></td>
                    <td><a class="text-decoration-none text-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal<?=$i?>"><i class="fa-solid fa-pen"></i></a> ||
                        <a class="text-decoration-none text-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?=$i?>"><i class="fa-solid fa-eraser"></i></a> ||
                        <a class="text-decoration-none text-info" data-bs-toggle="modal"
                            data-bs-target="#viewModal<?=$i?>"><i class="fa-solid fa-file-invoice"></i></a>
                    </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?=$i?>" tabindex="-1" aria-labelledby="editModalLabel<?=$i?>"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel<?=$i?>">Change
                                    "<?=$homework['hw_title']?>"
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="manageHomework.php" method="post">
                                    <div class="form-group">
                                        <label for="hw_title">Homework title</label>
                                        <input type="text" name="hw_title"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$homework['hw_title']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="hw_description">Homework body</label>
                                        <input type="text" name="hw_description"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$homework['hw_description']?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="deadline">Due</label>
                                        <input value="<?=$homework['due']?>" type="datetime-local" name="deadline" class="form-control rounded-0">
                                    </div>

                                    <div class="modal-footer">
                                        <input type="hidden" name="hw_id" value="<?=$homework['hw_id']?>">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal<?=$i?>" tabindex="-1" aria-labelledby="deleteModalLabel<?=$i?>"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteModalLabel<?=$i?>">Delete homework
                                    "<?=$homework['hw_title']?>"
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Do you want to delete this homework?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="manageHomework.php" method="post">
                                    <input type="hidden" name="delete" value="<?=$homework['hw_id']?>">
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- View Modal -->
                <div class="modal fade" id="viewModal<?=$i?>" tabindex="-1" aria-labelledby="viewModalLabel<?=$i?>"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="viewModalLabel<?=$i?>"><?=$homework['hw_title']?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group">
                                        <h5 class="overflow-scroll"><?=$homework['hw_description']?></h5>
                                        <hr>
                                        <div class="form-group mt-2">
                                            <div class="d-flex gap-3">
                                                <div class="creator">
                                                    <label for="creator<?=$i?>">Creator</label>
                                                    <input type="text" name="creator<?=$i?>"
                                                        class="form-control border border-primary font-weight-bold bg-white"
                                                        value="<?=$homework['Fname'] . " " . $homework['Lname']?>" readonly
                                                        required>
                                                </div>
                                                <div class="date">
                                                    <label for="CreatedDay<?=$i?>">Created day</label>
                                                    <input type="date" name="CreatedDay<?=$i?>"
                                                        class="form-control border border-primary font-weight-bold bg-white"
                                                        value="<?=substr($homework['date_created'],0,10)?>" readonly required>
                                                </div>
                                                <div class="date">
                                                    <label for="DueDay<?=$i?>">Due day</label>
                                                    <input type="date" name="DueDay<?=$i?>"
                                                        class="form-control border border-primary font-weight-bold bg-white"
                                                        value="<?=substr($homework['due'],0,10)?>" readonly required>
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