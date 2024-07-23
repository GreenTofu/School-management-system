<?php
include "../inc/head.php";
include "../func/teacherHandler.php";

$teachers = getTeachers();
$totals = getTotalTeachers();
if(isset($_POST['delete'])){
    deleteTeacher($_POST);
}
if(isset($_POST['edit'])){
    editTeacher($_POST);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Manage Teacher</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Manage Teacher</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded">
        <div class="d-flex justify-content-between">
            <h5 class="text-center">Manage Teacher</h5>
            <a class="text-decoration-none" href="#">View All Teachers</a>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Teacher Name</th>
                    <th scope="col">Teacher Email</th>
                    <th scope="col">Teacher's Class</th>
                    <th scope="col">Admission Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($teachers as $teacher) { ?>
                <tr>
                    <th><?php echo $i?></th>
                    <td><?php echo $teacher['Fname'] . " " . $teacher['Lname']?></td>
                    <td><?php echo $teacher['email']?></td>
                    <td><?php echo $teacher['class_name'] . $teacher['section']?></td>
                    <td><?php echo $teacher['date']?></td>
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
                                <h1 class="modal-title fs-5" id="editModalLabel<?=$i?>">Edit
                                    <?=$teacher['Fname'] . " " . $teacher['Lname'] . " "?> Information</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="manageTeacher.php" method="post">
                                    <div class="form-group">
                                        <label for="Fname">Teacher's First Name</label>
                                        <input type="text" name="Fname"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$teacher['Fname']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="Lname">Teacher's Last Name</label>
                                        <input type="text" name="Lname"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$teacher['Lname']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNum">Teacher's Phone Number</label>
                                        <input type="text" name="phoneNum"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$teacher['phone_num']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="DoB">Teacher's Date of Birth</label>
                                        <input type="date" name="DoB"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=substr($teacher['DoB'],0,10)?>">
                                    </div>
                                    <?php if($teacher['gender'] == 0):?>
                                    <div class="form-check">
                                        <div class="d-flex justify-content-around mr-3">
                                            <div class="col-md-2">
                                                <input class="form-check-input" type="radio" name="gender" value="0"
                                                    id="gender1" checked>
                                                <label class="form-check-label" for="gender1">Male</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-check-input" type="radio" name="gender" value="1"
                                                    id="gender2">
                                                <label class="form-check-label" for="gender2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else:?>
                                    <div class="form-check mb-3">
                                        <div class="d-flex justify-content-around mr-3">
                                            <div class="col-md-2">
                                                <input class="form-check-input" type="radio" name="gender" value="0"
                                                    id="gender1">
                                                <label class="form-check-label" for="gender1">Male</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-check-input" type="radio" name="gender" value="1"
                                                    id="gender2" checked>
                                                <label class="form-check-label" for="gender2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <input type="hidden" name="teacher_id" value="<?=$teacher['id']?>">
                                    <div class="modal-footer">
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
                                    <?=$teacher['Fname'] . " " . $teacher['Lname'] . " "?> Information</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="manageTeacher.php" method="post">
                                    <h5>Before remove teacher <?=$teacher['Fname'] . " " . $teacher['Lname']?> you have
                                        to choose new teacher for class
                                        <?php echo $teacher['class_name'] . $teacher['section']?></h5>
                                    <div class="form-group">
                                        <label for="class_id mr-2">Available Teacher</label>
                                        <select name="teacher_id" require="true">
                                            <?php foreach($totals as $total ):?>
                                            <option value="<?=$total['id']?>">
                                                <?=$total['Fname'] . " " . $total['Lname']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input type="hidden" name="delete" value="<?=$teacher['id']?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
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
                                    <?=$teacher['Fname'] . " " . $teacher['Lname'] . " "?> Information</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group">
                                        <label for="email<?=$i?>">Teacher's Email</label>
                                        <input type="email" name="email<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$teacher['email']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Fname<?=$i?>">Teacher's First Name</label>
                                        <input type="text" name="Fname<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$teacher['Fname']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Lname<?=$i?>">Teacher's Last Name</label>
                                        <input type="text" name="Lname<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$teacher['Lname']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNum<?=$i?>">Teacher's Phone Number</label>
                                        <input type="text" name="phoneNum<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$teacher['phone_num']?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="DoB<?=$i?>">Teacher's Date of Birth</label>
                                        <input type="text" name="DoB<?=$i?>"
                                            class="form-control border border-primary font-weight-bold bg-white"
                                            value="<?=$teacher['DoB']?>" readonly required>
                                    </div>
                                    <?php if($teacher['gender'] == 0):?>
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