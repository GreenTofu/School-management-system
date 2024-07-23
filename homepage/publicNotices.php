<?php
  include "../func/db.php";
  include "../admin/func/PublicNoticeHandler.php";

  $publicNotices = getPublicNotices();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.0/cosmo/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Education</title>
</head>
<body style="background-color: #f5f5f5; background: none;">
    <nav class="navbar navbar-expand-md navbar-dark bg-black ">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Education</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <div class="bg-white p-4 rounded container">
        <div class="d-flex justify-content-between">
            <h5 class="text-center">Manage Public Notice</h5>
            <a class="text-decoration-none" href="#">View All Notices</a>
        </div>
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Notice Title</th>
                    <th scope="col">Notice Date</th>
                    <th scope="col">Notice ID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($publicNotices as $notice) { ?>
                <tr>
                    <th><?php echo $i?></th>
                    <td style="max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?php echo $notice['notice_title']?></td>
                    <td><?php echo $notice['date']?></td>
                    <td><?php echo $notice['notice_id']?></td>
                    <td>
                        <a class="text-decoration-none text-info" data-bs-toggle="modal"
                            data-bs-target="#viewModal<?=$i?>"><i class="fa-solid fa-file-invoice"></i></a>
                    </td>
                </tr>
                <!-- View Modal -->
                <div class="modal fade" id="viewModal<?=$i?>" tabindex="-1" aria-labelledby="viewModalLabel<?=$i?>"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 style="max-width:350px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" class="modal-title fs-5" id="viewModalLabel<?=$i?>"><?=$notice['notice_title']?></h1>
                                <hr>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body mt-2">
                                <form action="">
                                    <div class="form-group">
                                        <h5 class="overflow-scroll"><?=$notice['notice_body']?></h5>
                                        <div class="form-group">
                                            <div class="d-flex gap-3">
                                                <div class="creator">
                                                    <label for="creator<?=$i?>">Note creator</label>
                                                    <input type="text" name="creator<?=$i?>"
                                                        class="form-control border border-primary font-weight-bold bg-white"
                                                        value="<?=$notice['Fname'] . " " . $notice['Lname']?>" readonly
                                                        required>
                                                </div>
                                                <div class="date">
                                                    <label for="CreatedDay<?=$i?>">Notice day</label>
                                                    <input type="date" name="CreatedDay<?=$i?>"
                                                        class="form-control border border-primary font-weight-bold bg-white"
                                                        value="<?=substr($notice['date'],0,10)?>" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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


  <footer class="py-3 my-4">
    <p class="text-center text-muted">&copy; 2023 Group 3, Advance Software Engineering</p>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/ea7b7f7751.js" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </footer>
</body>
<!-- Script for login button -->
</html>