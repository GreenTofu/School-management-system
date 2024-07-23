<?php
include "../inc/head.php";
include "../func/studentHandler.php";

if(isset($_POST['getInformation'])){
    validateNewStudent($_POST, $new_student);
    // $test = test();
    // var_dump($_POST);
}
?>

<div class="my-3 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Add Class</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Add Student</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded border-info">
        <form action="addStudent.php" method="post">
            <div class="container student-info-area">
                <div class="content-area">
                    <!-- create student account -->
                    <h3 class="font-weight-bold"><i class="fa-solid fa-file-pen mr-2"></i>Login Details</h3>
                    <div class="card mt-3 mb-3 text-dark border border-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email1">Student's Email</label>
                                <input type="email" name="email1" class="form-control border border-primary" placeholder="Enter student email...">
                            </div>
                            <div class="form-group">
                                <label for="password1">Student's Password</label>
                                <input type="password" name="password1" class="form-control border border-primary" placeholder="Enter student password...">
                            </div>
                        </div>
                    </div>
                    <!-- create student info -->
                    <h3 class="font-weight-bold"><i class="fa-solid fa-circle-info mr-2"></i></i>Information Details</h3>
                    <div class="card mt-3 text-dark border border-primary">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="form-group col-md-5">
                                    <label for="Fname1">First name</label>
                                    <input type="text" name="Fname1" class="form-control border border-primary border border-primary" placeholder="Enter student first name...">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="Lname1">Last name</label>
                                    <input type="text" name="Lname1" class="form-control border border-primary" placeholder="Enter student last name...">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="phoneNum1">Phone number</label>
                                    <input type="text" name="phoneNum1" class="form-control border border-primary" placeholder="Enter student phone number...">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="DoB1">Date of Birth</label>
                                    <input type="date" name="DoB1" class="form-control border border-primary">
                                </div>
                                <div class="form-check col-md-3">
                                    <div class="d-flex justify-content-around mr-3">
                                        <div class="col-md-2">
                                            <input class="form-check-input" type="radio" name="gender1" id="gender1" value="0">
                                            <label class="form-check-label" for="gender1">Male</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-check-input" type="radio" name="gender1" id="gender2" value="1">
                                            <label class="form-check-label" for="gender2">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="add-btn btn btn-outline-success mt-3 rounded btn-md"> <i class="fa-solid fa-plus" aria-hidden="true"></i></button>
                <button type="button" class="delete-btn btn btn-outline-danger mt-3 rounded btn-md"> <i class="fa-solid fa-minus" aria-hidden="true"></i></button>
            </div>
            <input type="hidden" name="getInformation">
            <button type="submit" class="btn btn-outline-success mt-3" style="width: 150px;">Add Student</button>
        </form>
    </div>
</div>

<script src="../js/main.js"></script>
<?php
include "../inc/footer.php";
?>