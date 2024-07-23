<?php
include "../inc/head.php";
include "../func/viewClassHandler.php";

$class_name = $_SESSION['class'];
$section = $_SESSION['classSection'];

$students = getStudentByClassNameAndSection($class_name, $section);
// var_dump($students);
if(isset($_POST['delete'])){
    removeStudent($_POST['delete']);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Class: <?php echo $class_name?><?php echo $section?></h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Class</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded">
        <div class="d-flex justify-content-between">
            <h5 class="text-center">List Students Of Class <?php echo $class_name?><?php echo $section?></h5>
            <a class="text-decoration-none" href="#">View All Students</a>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($students as $student) { ?>
                <tr>
                    <th><?php echo $i?></th>
                    <td><?php echo $student['Fname']?> <?php echo $student['Lname']?></td>
                    <td><?php echo $student['email']?></td>
                    <?php if($student['gender'] == 0):?>
                        <td>Male</td>
                    <?php else:?>
                        <td>Female</td>
                    <?php endif;?>
                    <td><?=substr($student['DoB'],0,10)?></td>
                    <td>
                        <a class="text-decoration-none text-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?=$i?>"><i class="fa-solid fa-eraser"></i></a> ||
                        <a class="text-decoration-none text-info" data-bs-toggle="modal"
                            data-bs-target="#viewModal<?=$i?>"><i class="fa-solid fa-file-invoice"></i></a>
                    </td>
                </tr>
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal<?=$i?>" tabindex="-1" aria-labelledby="deleteModalLabel<?=$i?>"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteModalLabel<?=$i?>">Remove
                                    "<?php echo $student['Fname']?> <?php echo $student['Lname']?>" from class <?=$student['class_name']?><?=$student['section']?>
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Do you want to remove this student?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="viewClass.php" method="post">
                                    <input type="hidden" name="delete" value="<?=$student['id']?>">
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- View Modal -->
                <div class="modal fade" id="viewModal<?=$i?>" tabindex="-1" aria-labelledby="viewModalLabel<?=$i?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="viewModalLabel<?=$i+1?>">View
                                    <?=$student['Fname'] . " " . $student['Lname'] . " "?> Information</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group">
                                        <label for="email<?=$i?>">Student's Email</label>
                                        <input type="email" name="email<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$student['email']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id<?=$i?>">Student's ID</label>
                                        <input type="text" name="id<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$student['id']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Fname<?=$i?>">Student's First Name</label>
                                        <input type="text" name="Fname<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$student['Fname']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Lname<?=$i?>">Student's Last Name</label>
                                        <input type="text" name="Lname<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$student['Lname']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNum<?=$i?>">Student's Phone Number</label>
                                        <input type="text" name="phoneNum<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$student['phone_num']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="DoB<?=$i?>">Student's Date of Birth</label>
                                        <input type="text" name="DoB<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=substr($student['DoB'],0,10)?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="enrollDate<?=$i?>">Enroll Date</label>
                                        <input type="text" name="enrollDate<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=substr($student['attend_day'],0,10)?>" readonly required>
                                    </div>
                                    <?php if($student['gender'] == 0):?>
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