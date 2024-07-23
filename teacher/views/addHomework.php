<?php
include "../inc/head.php";
include "../func/homeworkHandler.php";

if(isset($_POST['homeworkTitle'])){
    $route = 0;
    validateHomework($_POST);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Add Homework</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Add Homework</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded">
        <h5 class="text-center">Add Homework</h5>
        <form action="addHomework.php" method="post" enctype="multipart/form-data">
            <div class="mt-3 text-dark">
                <div class="form-group">
                    <label for="homeworkTitle">Homework Title</label>
                    <input type="text" name="homeworkTitle" class="form-control rounded-0" placeholder="Add Homework Title...">
                </div>
                <div class="form-group">
                    <label for="homeworkDes">Homework Description</label>
                    <textarea class="form-control rounded-0" name="homeworkDes" rows="3" placeholder="Add Homework Description..."></textarea>
                </div>
                <div class="form-group">
                    <label for="deadline">Due</label>
                    <input type="datetime-local" name="deadline" class="form-control rounded-0">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-success">Add</button>
                </div>    
            </div>
        </form>
    </div>
</div>

<?php
include "../inc/footer.php";
?>