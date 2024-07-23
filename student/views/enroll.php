<?php
include "../inc/head.php";
include "../func/enrollHandler.php";
$classes = getCLasses();
$student_id = $_SESSION['user_id'];
if(isset($_POST['class_id'])){
    enrollClass($_POST['class_id'], $student_id);
}
?>
<div class="container mt-5 ml-4 flex-shrink-1">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>All Class</h5>
                <div class="d-flex align-items-baseline">
                    <p class="">Year / </p>
                    <p class="ml-1 text-primary"><?=date("Y")?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded">
        <?php for ($i=0; $i < count($classes); $i++):?>
        <form action="enroll.php" method="post">
            <div class="card border-top border border-dark position-relative mb-3">
                <div class="d-flex justify-content-between">
                    <p class="font-weight-bold ml-3 mt-auto mb-auto">Class
                        <?=$classes[$i]['class_name'] . $classes[$i]['section']?> -
                        <?=$classes[$i]['Fname'] . " " . $classes[$i]['Lname']?></p>
                        <input type="hidden" name="class_id" value="<?=$classes[$i]['class_id']?>">
                    <button type="submit" class="btn border-0 mr-3 mt-auto mb-auto">Enroll</button>
                </div>
            </div>
        </form>
        <?php endfor;?>
    </div>
</div>

<?php
include "../inc/footer.php";
?>