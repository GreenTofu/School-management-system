<?php
include "../inc/head.php";
include "../func/studentHandler.php";

$student = getStudent($_SESSION['user_id']);

if(isset($_POST['update'])){
    updateStudent($_POST);
}
if(isset($_FILES['image'])){
    validateFile($_FILES['image'], $_POST['id']);
}
?>
<style>
.upload .round {
    position: absolute;
    bottom: 5px;
    left: 85px;
    background: #00B4FF;
    width: 32px;
    height: 32px;
    line-height: 33px;
    text-align: center;
    border-radius: 50%;
    overflow: hidden;
}

.upload .round input[type="file"] {
    position: absolute;
    transform: scale(2);
    opacity: 0;
}

input[type=file]::-webkit-file-upload-button {
    cursor: pointer;
}
</style>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Student Profile</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Student profile</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded">
        <h5 class="text-center">Student Profile</h5>
        <div class="upload position-relative">
            <?php if($student['image'] == ""):?>
            <img src="../../images/user.png" alt="hugenerd" width="120" height="120" class="rounded-circle" style="border: 4px solid #00b4ff;">
            <?php else: ?>
            <img src="<?=$student['image']?>" alt="hugenerd" width="120" height="120" class="rounded-circle" style="border: 4px solid #00b4ff;">
            <?php endif; ?>
            <div class="round">
                <form action="student.php" id="form" enctype="multipart/form-data" method="post">
                    <input type="file" name="image" id="image" onchange="this.form.submit()">
                    <input type="hidden" name="id" value="<?=$student['id']?>">
                    <i class="fa-solid fa-camera"></i>
                    <!-- <button type="submit" name="pic" class="btn btn-outline-success">Update</button> -->
                </form>
            </div>
        </div>
        <form action="student.php" method="post">
            <div class="mt-3 text-dark">
                <div class="form-group">
                    <label for="Fname">Student first name</label>
                    <input type="text" name="Fname" class="form-control rounded-0" value="<?=$student['Fname']?>">
                </div>
                <div class="form-group">
                    <label for="Lname">Student last name</label>
                    <input type="text" name="Lname" class="form-control rounded-0" value="<?=$student['Lname']?>">
                </div>
                <div class="form-group">
                    <label for="DoB">Student Date of Birth</label>
                    <input type="date" name="DoB" class="form-control rounded-0"
                        value="<?=substr($student['DoB'],0,10)?>">
                </div>
                <div class="form-group">
                    <label for="phoneNum">Contact number</label>
                    <input type="text" name="phoneNum" class="form-control rounded-0" value="<?=$student['phone_num']?>">
                </div>
                <div class="form-group">
                    <label for="register">Student Registration Date</label>
                    <input type="text" name="register" class="form-control rounded-0"
                        value="<?=$student['date_created']?>" readonly required>
                </div>
                <?php if($student['gender'] == 0):?>
                <div class="form-check">
                    <div class="d-flex justify-content-around mr-3">
                        <div class="col-md-2">
                            <input class="form-check-input" type="radio" name="gender" value="0" id="gender1" checked>
                            <label class="form-check-label" for="gender1">Male</label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input" type="radio" name="gender" value="1" id="gender2">
                            <label class="form-check-label" for="gender2">Female</label>
                        </div>
                    </div>
                </div>
                <?php else:?>
                <div class="form-check mb-3">
                    <div class="d-flex justify-content-around mr-3">
                        <div class="col-md-2">
                            <input class="form-check-input" type="radio" name="gender" value="0" id="gender1">
                            <label class="form-check-label" for="gender1">Male</label>
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input" type="radio" name="gender" value="1" id="gender2" checked>
                            <label class="form-check-label" for="gender2">Female</label>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <input type="hidden" name="id" value="<?=$student['id']?>">
                <div class="d-flex justify-content-center">
                    <button type="submit" name="update" class="btn btn-outline-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include "../inc/footer.php";
?>