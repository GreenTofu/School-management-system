<?php
include "../inc/head.php";
include "../func/ClassHandler.php";

$classes = getClasses();
// var_dump($classes);
if(isset($_POST['delete'])){
    // var_dump($classes);
    deleteClass($_POST['class_id']);
}
if(isset($_POST['edit'])){
    // var_dump($_POST);
    editClass($_POST);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Manage Class</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Manage Class</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded">
        <div class="d-flex justify-content-between">
            <h5 class="text-center">Manage Class</h5>
            <a class="text-decoration-none" href="#">View All Classes</a>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Class Name</th>
                    <th scope="col">Section</th>
                    <th scope="col">Homeroom Teacher ID</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($classes as $class) { ?>
                <tr>
                    <th><?php echo $i?></th>
                    <td><?php echo $class['class_name']?></td>
                    <td><?php echo $class['section']?></td>
                    <td><?php echo $class['teacher_id']?></td>
                    <td><?php echo $class['date']?></td>
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
                                <h1 class="modal-title fs-5" id="editModalLabel<?=$i?>">Change class
                                    <?=$class['class_name'] . $class['section'] . " "?> information</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="manageClass.php" method="post">
                                    <div class="form-group">
                                        <div class="d-flex gap-3">
                                            <div class="classname">
                                                <label for="classname">Class name</label>
                                                <input type="text" name="classname"
                                                    class="form-control border border-primary font-weight-bold bg-white"
                                                    value="<?=$class['class_name']?>">
                                            </div>
                                            <div class="classSection">
                                                <label for="classSection">Class section</label>
                                                <input type="text" name="classSection"
                                                    class="form-control border border-primary font-weight-bold bg-white"
                                                    value="<?=$class['section']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex gap-3">
                                            <div class="teacher_id">
                                                <label for="teacher_id">Teacher ID</label>
                                                <input type="text" name="teacher_id"
                                                    class="form-control border border-primary font-weight-bold bg-white"
                                                    value="<?=$class['teacher_id']?>">
                                            </div>
                                            <div class="teacher_name">
                                                <label for="teacher_name">Teacher name</label>
                                                <input type="text" name="teacher_name"
                                                    class="form-control border border-primary font-weight-bold bg-white"
                                                    value="<?=$class['Fname'] . " " . $class['Lname']?>" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="class_id" value="<?=$class['class_id']?>">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="edit">Save changes</button>
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
                                <h1 class="modal-title fs-5" id="deleteModalLabel<?=$i?>">Delete
                                    <?=$class['class_name'] . $class['section']?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete class <?=$class['class_name'] . $class['section']?>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="manageClass.php" method="post">
                                    <input type="hidden" name="class_id" value="<?=$class['class_id']?>">
                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
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
                                <h1 class="modal-title fs-5" id="viewModalLabel<?=$i?>">View
                                    <?=$class['class_name'] . $class['section'] . " "?> Class</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group">
                                        <div class="d-flex gap-3">
                                            <div class="classname">
                                                <label for="classname<?=$i?>">Class name</label>
                                                <input type="text" name="classname<?=$i?>"
                                                    class="form-control border border-primary font-weight-bold bg-white"
                                                    value="<?=$class['class_name']?>" readonly required>
                                            </div>
                                            <div class="classSection">
                                                <label for="classSection<?=$i?>">Class section</label>
                                                <input type="text" name="classSection<?=$i?>"
                                                    class="form-control border border-primary font-weight-bold bg-white"
                                                    value="<?=$class['section']?>" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex gap-3">
                                            <div class="classname">
                                                <label for="classID_<?=$i?>">Class ID</label>
                                                <input type="text" name="classID_<?=$i?>"
                                                    class="form-control border border-primary font-weight-bold bg-white"
                                                    value="<?=$class['class_id']?>" readonly required>
                                            </div>
                                            <div class="classSection">
                                                <label for="classCreatedDay<?=$i?>">Started day</label>
                                                <input type="date" name="classCreatedDay<?=$i?>"
                                                    class="form-control border border-primary font-weight-bold bg-white"
                                                    value="<?=substr($class['date'],0,10)?>" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4 class="font-weight-bold">Homeroom Teacher</h4>
                                    <div class="form-group">
                                        <label for="Fname<?=$i?>">Teacher's First Name</label>
                                        <input type="text" name="Fname<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$class['Fname']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Lname<?=$i?>">Student's Last Name</label>
                                        <input type="text" name="Lname<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$class['Lname']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNum<?=$i?>">Teacher's Phone Number</label>
                                        <input type="text" name="phoneNum<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$class['phone_num']?>" readonly required>
                                    </div>
                                    <?php if($class['gender'] == 0):?>
                                    <div class="form-check">
                                        <div class="d-flex justify-content-around mr-3">
                                            <div class="col-md-2">
                                                <input class="form-check-input" type="radio" name="gender<?=$i?>"
                                                    id="gender1" checked>
                                                <label class="form-check-label" for="gender1">Male</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-check-input" type="radio" name="gender<?=$i?>"
                                                    id="gender2" disabled>
                                                <label class="form-check-label" for="gender2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else:?>
                                    <div class="form-check">
                                        <div class="d-flex justify-content-around mr-3">
                                            <div class="col-md-2">
                                                <input class="form-check-input" type="radio" name="gender<?=$i?>"
                                                    id="gender1" disabled>
                                                <label class="form-check-label" for="gender1">Male</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-check-input" type="radio" name="gender<?=$i?>"
                                                    id="gender2" checked>
                                                <label class="form-check-label" for="gender2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif;?>
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