<?php
include "../inc/head.php";
include "../func/ClassNoticeHandler.php";

if(isset($_POST['noticeTitle'])) { 
    $route = 0;
    validateClassNotice($_POST);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Add Class Notice</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Add Class Notice</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded">
        <h5 class="text-center">Add Class Notice</h5>
        <form action="addClassNotice.php" method="post" enctype="multipart/form-data">
            <div class="mt-3 text-dark">
                <div class="form-group">
                    <label for="noticeTitle">Notice Title</label>
                    <input type="text" name="noticeTitle" class="form-control rounded-0" placeholder="Add Notice Title...">
                </div>
                <div class="input-group">
                    <div class="form-group mr-5">
                        <label for="class_name">Grade</label>
                        <select  name="class_name" class="form-control rounded-0" required='true'>
                            <option value="">Choose Grade</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <select  name="section" class="form-control rounded-0" required='true'>
                            <option value="">Choose Section</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="noticeMessage">Notice Message</label>
                    <textarea class="form-control rounded-0" name="noticeMessage" rows="3" placeholder="Add Notice Message..."></textarea>
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