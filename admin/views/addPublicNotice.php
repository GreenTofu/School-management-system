<?php
include "../inc/head.php";
include "../func/PublicNoticeHandler.php";

if(isset($_POST['noticeTitle'])) {
    validatePublicNotice($_POST);
}
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Add Public Notice</h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Add Public Notice</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded">
        <h5 class="text-center">Add Public Notice</h5>
        <form action="addPublicNotice.php" method="post" enctype="multipart/form-data">
            <div class="mt-3 text-dark">
                <div class="form-group">
                    <label for="noticeTitle">Notice Public Title</label>
                    <input type="text" name="noticeTitle" class="form-control rounded-0" placeholder="Add Notice Public Title...">
                </div>

                <div class="form-group">
                    <label for="noticeMessage">Notice Public Message</label>
                    <textarea class="form-control rounded-0" name="noticeMessage" rows="3" placeholder="Add Notice Public Message..."></textarea>
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