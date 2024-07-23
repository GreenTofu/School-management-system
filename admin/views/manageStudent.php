<?php
include "../inc/head.php";
include "../func/studentHandler.php";


$classes = getClasses();
$unclassStudents = getUnJoinClassStudent();
if(isset($_POST['classes'])){
    if($_POST['classes'] == "all"){
        $students = getStudentsByClass();
    } else{
        $students = getStudentByClass($_POST['classes']);
    }
}else{
    $students = getStudentsByClass();
}
if(isset($_POST['delete'])){
    deleteHaveClassStudent($_POST);
}
if(isset($_POST['delete2'])){
    deleteUnclassStudent($_POST['delete2']);
    // var_dump($_POST['delete2']);
}
if(isset($_POST['edit'])){
    var_dump($_POST);
    editStudent($_POST);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Manage Student</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Manage Student</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded">
        <div class="d-flex justify-content-between pb-4">
            <div class="col-md-3">
                <h5 class="font-weight-bold">Manage Student</h5>
            </div>
            <div class="col-md-6">
                <form action="manageStudent.php" method="post">
                    <div class="d-flex input-group">
                        <label class="input-group-text" for="classes"><i class="fa-solid fa-eye mr-2"></i>View by
                            class</label>
                        <select class="form-select" name="classes" id="classes">
                            <option value="all" aria-selected="selected">All</option>
                            <?php for($i = 0; $i < count($classes); $i++):?>
                            <option value="<?=$classes[$i]['class_id']?>">
                                <?=$classes[$i]['class_name'] . $classes[$i]['section']?></option>
                            <?php endfor?>
                        </select>
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Student Class</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student Email</th>
                    <th scope="col">Admission Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php for($i = 0; $i < count($students); $i++):?>
            <tbody>
                <tr>
                    <th scope="row"><?=$i + 1?></th>
                    <td><?=$students[$i]['class_name'] . $students[$i]['section']?></td>
                    <td><?=$students[$i]['Fname'] . " " . $students[$i]['Lname']?></td>
                    <td><?=$students[$i]['email']?></td>
                    <td><?=$students[$i]['date']?></td>
                    <td><a class="text-decoration-none text-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal<?=$i+1?>"><i class="fa-solid fa-pen"></i></a> ||
                        <a class="text-decoration-none text-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?=$i+1?>"><i class="fa-solid fa-eraser"></i></a> ||
                        <a class="text-decoration-none text-info" data-bs-toggle="modal"
                            data-bs-target="#viewModal<?=$i+1?>"><i class="fa-solid fa-file-invoice"></i></a>
                    </td>
                </tr>
            </tbody>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?=$i+1?>" tabindex="-1" aria-labelledby="editModalLabel<?=$i+1?>"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel<?=$i+1?>">Edit
                                <?=$students[$i]['Fname'] . " " . $students[$i]['Lname'] . " "?> Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="manageStudent.php" method="post">
                                <div class="form-group">
                                    <label for="Fname">Student's First Name</label>
                                    <input type="text" name="Fname"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$students[$i]['Fname']?>">
                                </div>
                                <div class="form-group">
                                    <label for="Lname">Student's Last Name</label>
                                    <input type="text" name="Lname"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$students[$i]['Lname']?>">
                                </div>
                                <div class="form-group">
                                    <label for="phoneNum">Student's Phone Number</label>
                                    <input type="text" name="phoneNum"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$students[$i]['phone_num']?>">
                                </div>
                                <div class="form-group">
                                    <label for="DoB">Student's Date of Birth</label>
                                    <input type="date" name="DoB"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=substr($students[$i]['DoB'],0,10)?>">
                                </div>
                                <?php if($students[$i]['gender'] == 0):?>
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
                                <input type="hidden" name="student_id" value="<?=$students[$i]['id']?>">
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
            <div class="modal fade" id="deleteModal<?=$i+1?>" tabindex="-1" aria-labelledby="deleteModalLabel<?=$i+1?>"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel<?=$i+1?>">Delete
                                <?=$students[$i]['Fname'] . " " . $students[$i]['Lname'] . " "?> Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Do you want to delete <?=$students[$i]['Fname'] . " " . $students[$i]['Lname']?>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="manageStudent.php" method="post">
                                <input type="hidden" name="delete" value="<?=$students[$i]['id']?>">
                                <input type="hidden" name="classroom_id" value="<?=$students[$i]['classroom_id']?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Modal -->
            <div class="modal fade" id="viewModal<?=$i+1?>" tabindex="-1" aria-labelledby="viewModalLabel<?=$i+1?>"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewModalLabel<?=$i+1?>">View
                                <?=$students[$i]['Fname'] . " " . $students[$i]['Lname'] . " "?> Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="email<?=$i?>">Student's Email</label>
                                    <input type="email" name="email<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$students[$i]['email']?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="Fname<?=$i?>">Student's First Name</label>
                                    <input type="text" name="Fname<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$students[$i]['Fname']?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="Lname<?=$i?>">Student's Last Name</label>
                                    <input type="text" name="Lname<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$students[$i]['Lname']?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="phoneNum<?=$i?>">Student's Phone Number</label>
                                    <input type="text" name="phoneNum<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$students[$i]['phone_num']?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="DoB<?=$i?>">Student's Date of Birth</label>
                                    <input type="text" name="DoB<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$students[$i]['DoB']?>" readonly required>
                                </div>
                                <?php if($students[$i]['gender'] == 0):?>
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
            <?php endfor;?>
        </table>

        <hr class=" border-primary border-3 opacity-75 border mt-4 mb-3">
        <h5 class="font-weight-bold mb-3">Have not joined class students</h5>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student Email</th>
                    <th scope="col">Admission Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php for($i = 0; $i < count($unclassStudents); $i++):?>
            <tbody>
                <tr>
                    <th scope="row"><?=$i + 1?></th>
                    <td><?=$unclassStudents[$i]['Fname'] . " " . $unclassStudents[$i]['Lname']?></td>
                    <td><?=$unclassStudents[$i]['email']?></td>
                    <td><?=$unclassStudents[$i]['date_created']?></td>
                    <td><a class="text-decoration-none text-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal2_<?=$i+1?>"><i class="fa-solid fa-pen"></i></a> ||
                        <a class="text-decoration-none text-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal2_<?=$i+1?>"><i class="fa-solid fa-eraser"></i></a> ||
                        <a class="text-decoration-none text-info" data-bs-toggle="modal"
                            data-bs-target="#viewModal2_<?=$i+1?>"><i class="fa-solid fa-file-invoice"></i></a>
                    </td>
                </tr>
            </tbody>
            <!-- Edit Modal -->
            <div class="modal fade" id="editModal2_<?=$i+1?>" tabindex="-1" aria-labelledby="editModalLabel2_<?=$i+1?>"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel2_<?=$i+1?>">Edit
                                <?=$unclassStudents[$i]['Fname'] . " " . $unclassStudents[$i]['Lname'] . " "?> Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="manageStudent.php" method="post">
                                <div class="form-group">
                                    <label for="Fname">Student's First Name</label>
                                    <input type="text" name="Fname"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$unclassStudents[$i]['Fname']?>">
                                </div>
                                <div class="form-group">
                                    <label for="Lname">Student's Last Name</label>
                                    <input type="text" name="Lname"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$unclassStudents[$i]['Lname']?>">
                                </div>
                                <div class="form-group">
                                    <label for="phoneNum">Student's Phone Number</label>
                                    <input type="text" name="phoneNum"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$unclassStudents[$i]['phone_num']?>">
                                </div>
                                <div class="form-group">
                                    <label for="DoB">Student's Date of Birth</label>
                                    <input type="date" name="DoB"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=substr($unclassStudents[$i]['DoB'],0,10)?>">
                                </div>
                                <?php if($unclassStudents[$i]['gender'] == 0):?>
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
                                <input type="hidden" name="student_id" value="<?=$unclassStudents[$i]['id']?>">
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
            <div class="modal fade" id="deleteModal2_<?=$i+1?>" tabindex="-1" aria-labelledby="deleteModalLabel2_<?=$i+1?>"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel2_<?=$i+1?>">Delete
                                <?=$unclassStudents[$i]['Fname'] . " " . $unclassStudents[$i]['Lname'] . " "?> Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Do you want to delete <?=$unclassStudents[$i]['Fname'] . " " . $unclassStudents[$i]['Lname']?>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="manageStudent.php" method="post">
                                <input type="hidden" name="delete2" value="<?=$unclassStudents[$i]['id']?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Modal -->
            <div class="modal fade" id="viewModal2_<?=$i+1?>" tabindex="-1" aria-labelledby="viewModalLabel2_<?=$i+1?>"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewModalLabel2_<?=$i+1?>">View
                                <?=$unclassStudents[$i]['Fname'] . " " . $unclassStudents[$i]['Lname'] . " "?>
                                Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="email<?=$i?>">Student's Email</label>
                                    <input type="email" name="email<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$unclassStudents[$i]['email']?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="Fname<?=$i?>">Student's First Name</label>
                                    <input type="text" name="Fname<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$unclassStudents[$i]['Fname']?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="Lname<?=$i?>">Student's Last Name</label>
                                    <input type="text" name="Lname<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$unclassStudents[$i]['Lname']?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="phoneNum<?=$i?>">Student's Phone Number</label>
                                    <input type="text" name="phoneNum<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$unclassStudents[$i]['phone_num']?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="DoB<?=$i?>">Student's Date of Birth</label>
                                    <input type="text" name="DoB<?=$i?>"
                                        class="form-control border border-primary font-weight-bold bg-white"
                                        value="<?=$unclassStudents[$i]['DoB']?>" readonly required>
                                </div>
                                <?php if($unclassStudents[$i]['gender'] == 0):?>
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
            <?php endfor;?>
        </table>
    </div>
</div>

<script src="../js/main.js"></script>
<?php
include "../inc/footer.php";
?>