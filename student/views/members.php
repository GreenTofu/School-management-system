<?php
include "../inc/head.php";
include "../func/memberHandler.php";

$students = getStudentsByClassID($_SESSION['class']);
$classInfo = getClassByClassID($_SESSION['class']);
$class_name = $classInfo['class_name'];
$section = $classInfo['section'];
?>

<div class="container my-5 ml-2 flex-shrink-1 p-3">
    <div class="row p-3">
        <div class="col-md-12">
            <div class="align-items-baseline d-flex justify-content-between">
                <h5>Class: <?php echo $class_name?><?php echo $section?></h5>
                <div class="d-flex align-items-baseline">
                    <a class="text-decoration-none" href="index.php">Dashboard</a>
                    <p class="ml-1 text-muted">/ Member</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded">
        <div class="d-flex justify-content-between">
            <h5 class="text-center">List Members Of Class <?php echo $class_name?><?php echo $section?></h5>
            <a class="text-decoration-none" href="#">View All Members</a>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Member Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Last Login</th>
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
                    <td><?=$student['last_login_date']?></td>
                </tr>
                </div>
                <?php $i += 1;} ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include "../inc/footer.php";
?>