<?php
include "../inc/head.php";
include "../func/teacherHandler.php";

$teacher = getTeacher($_SESSION['user_id']);

if(isset($_POST['update'])){
validatePassword($_POST, $edit_teacher);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Change Password</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Change Password</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded">
        <h5 class="text-center">Change Password</h5>
        <form action="setting.php" method="post">
            <div class="mt-3 text-dark">
                <div class="form-group">
                    <label for="currentPassword">Current password</label>
                    <input type="password" name="currentPassword" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="newPassword">New password</label>
                    <input type="password" name="newPassword" class="form-control rounded-0">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm password</label>
                    <input type="password" name="confirmPassword" class="form-control rounded-0">
                </div>
            </div>
            <input type="hidden" name="id" value="<?=$teacher['id']?>">
            <div class="d-flex justify-content-center">
                <button type="submit" name="update" class="btn btn-outline-success">Change</button>
            </div>
        </form>
    </div>
</div>

<?php
include "../inc/footer.php";
?>