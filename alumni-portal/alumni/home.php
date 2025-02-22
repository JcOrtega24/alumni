<?php
include('security.php');
include "../dbconfig.php";
$email = $_SESSION['email'];
$query = "SELECT *, alumni.id as userID 
            From alumni 
            LEFT JOIN course
            ON alumni.courseGraduated = course.id
            WHERE email  = '$email' ";
$query_run = mysqli_query($connection, $query);
$user = mysqli_fetch_array($query_run);
$id = $user["userID"];
$courseID = $user["courseGraduated"];
$query = "SELECT * FROM batch WHERE Name  =" . $id;
$query_run = mysqli_query($connection, $query);
$batch = mysqli_fetch_array($query_run);
$batch_row_cnt = mysqli_num_rows($query_run);

$survey = $connection->query("SELECT * FROM alumnisurvey WHERE studID =" . $id);

/* Get the number of rows in the result set */
$row_cnt = $survey->num_rows;
if ($row_cnt == 0) {
    // printf("Result set has %d rows.\n", $row_cnt);
    if ($user["socMed"] == " ") {
        echo ("<script LANGUAGE='JavaScript'>
        window.location.href='changePassword.php';
        </script>");
    } else {
        echo ("<script LANGUAGE='JavaScript'>
        window.location.href='sample.php';
        </script>");
    }
}

//   printf("Result set has %d rows.\n", $row_cnt);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hello! <?php echo $user["firstname"]; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- refresh 10secs -->
    <meta http-equiv="refresh" content="30">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/line-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">



</head>

<body>
    <div class="wrapper">
        <?php include("header.php"); ?>
        <main>
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 pd-left-none no-pd">
                                <div class="main-left-sidebar no-margin">
                                    <div class="user-data full-width">
                                        <div class="user-profile">
                                            <div class="username-dt">
                                                <div class="usr-pic">
                                                    <?php
                                                    $photo = "";
                                                    if ($user['photo'] == "" || $user['photo'] == " ") {
                                                        $photo =  "profilePic/userPic.jpg";
                                                    } else {
                                                        $photo =  $user['photo'];
                                                    }
                                                    ?>
                                                    <img src="<?php echo $photo; ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="user-specs">
                                                <h3>
                                                    <?php
                                                    echo $user['firstname'] . " " . $user['middleName'] . " " . $user['lastname'];
                                                    ?>
                                                </h3>
                                                <?php
                                                echo $user['bio'];
                                                ?>
                                                </span>
                                            </div>
                                        </div>
                                        <ul class="user-fw-status">
                                            <li>
                                                <h4>
                                                    <?php
                                                    $attended = $user['schoolAttended'];
                                                    if ($attended != "") {
                                                        if ($batch_row_cnt > 0) {
                                                            echo $attended . " <br> Batch (" . $batch['Description'] . ")";
                                                        } else {
                                                            echo "School: Not Set";
                                                        }
                                                    } else {
                                                        echo "School: Not Set";
                                                    }
                                                    ?>
                                                </h4>
                                            </li>
                                            <li>
                                                <h4>
                                                    <?php
                                                    $courseGraduated = $user['title'];
                                                    if ($courseGraduated != " ") {
                                                        echo "<b>Course: </b>" . $courseGraduated;
                                                    } else {
                                                        echo "Course: Not Set";
                                                    }
                                                    ?>

                                                </h4>
                                            </li>
                                            <!-- <li>
<h4>
    <?php

    $CurrentWork = $user['CurrentWork'];
    if ($CurrentWork != " ") {
        echo "<b>Job :</b>" . $CurrentWork;
    } else {
        echo "Job: Not Set";
    }
    ?>
</h4>
</li> -->
                                            <li>
                                                <a href="editProfile.php" title="">Edit Profile</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tags-sec full-width" hidden>
                                        <ul>

                                            <div class="cp-sec">
                                                <!-- <p><img src="images/cp.png" alt="">Copyright Alumni Service and 2022</p> -->
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-8 no-pd">
                                <div class="main-ws-sec">
                                    <div class="post-topbar">
                                        <div class="user-picy">
                                            <img src="images/resources/user-pic.png" alt="">
                                        </div>
                                        <div class="post-st">
                                            <ul>
                                                <li><a class="post-jb active" href="#" title="">Whats on your Mind?</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="posts-section">
                                        <?php
                                        $query = "SELECT *,
    events.id as post_id, 
    branch.Name as BranchNameShow,
    branch.Address as BranchAddShow,
    departments.Name as DepartmentNameShow,
    batch.Description as batchYear,
    events.Description as eventDesc
    
    FROM events 
    left join accounts 
    on events.CreatedUser = accounts.Id 
    left join branch 
    on accounts.BranchId = branch.Id 
    left join departments 
    on accounts.DepartmentId = departments.id  
    left join alumni 
    on alumni.id = events.CreatedUser
    left join batch 
    on batch.Name = alumni.id
    
    where TypeOfContent !='Jobs' and AllowPost='Approved'
    ORDER by CreatedDate DESC;";
                                        $content = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($content) > 0) {
                                            while ($row = mysqli_fetch_assoc($content)) {
                                        ?>

                                                <div class="post-bar">
                                                    <div class="post_topbar">
                                                        <div class="usy-dt">
                                                            <img src="images/resources/us-pic.png" alt="">
                                                            <div class="usy-name">
                                                                <h3>
                                                                    <?php
                                                                    if ($row['UserType'] == "Administrator") {
                                                                        echo $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName'] . " | Alumni Service Department";
                                                                    } else if ($row['UserType'] == "Alumni") {
                                                                        echo $row['firstname'] . " " . $row['middleName'] . " " . $row['lastname'] . " | " . $row['schoolAttended'] . " | " . $row['batchYear'];
                                                                    } else {

                                                                        echo  $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName'] . " | " . $row['BranchNameShow'] . " " . $row['BranchAddShow'] . " | " . $row['DepartmentNameShow'];
                                                                    }

                                                                    ?>
                                                                </h3>
                                                                <span><img src="images/clock.png" alt="">
                                                                    <?php
                                                                    $date = date_create($row['CreatedDate']);
                                                                    echo date_format($date, "M d, Y | h:i:s A");
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="job_descp">
                                                        <br />
                                                        <h3>
                                                            <b>
                                                                <?php echo $row['Title'] ?>
                                                            </b>
                                                        </h3>
                                                        <p>
                                                            <?php echo $row['Subtitle'] ?>
                                                        </p>
                                                        <p>
                                                            <?php echo $row['eventDesc'] ?>
                                                        </p>
                                                        <?php
                                                        if ($row['UserType'] == "Alumni") {
                                                            // $pathPhoto = "/alumni/" . $row['Image'];
                                                            $pathPhoto = $row['Image'];
                                                        } else {
                                                            // $pathPhoto = "/alumni/admin/" . $row['Image'];
                                                            // $pathPhoto = "/admin/" . $row['Image'];
                                                            $pathPhoto = $row['Image'];
                                                        }
                                                        ?>
                                                        <img src="<?php echo $pathPhoto;  ?>" class="mb-2" />
                                                        <?php if ($_SESSION['id'] == $row['CreatedUser']) : ?>
                                                            <div>
                                                                <a type="button" class="delete-post btn btn-primary p-1 text-white hideDropdown" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['post_id']; ?>">
                                                                    Delete
                                                                </a>
                                                                <!-- <button type="button" class="btn btn-primary p-1" data-toggle="modal" data-target="#deleteModal">
                                                                    <small>Delete</small>
                                                                </button> -->
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            ?>
                                        <?php
                                        }
                                        ?>



                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 pd-right-none no-pd">
                                <div class="right-sidebar">

                                    <div class="widget widget-jobs">
                                        <div class="sd-title">
                                            <h3>Top Jobs</h3>
                                        </div>
                                        <div class="jobs-list p-1">
                                            <div class="job-info">
                                                <div class="job-details  p-0 w-100">
                                                    <?php
                                                    $query = "SELECT *
    FROM events
    WHERE TypeOfContent ='Jobs'
    AND course =" . $courseID . "
    ORDER by CreatedDate DESC;";
                                                    $content = mysqli_query($connection, $query);
                                                    if (mysqli_num_rows($content) > 0) {
                                                        while ($row = mysqli_fetch_assoc($content)) {

                                                            $url = "postJobsolo.php?id=" . $row['id'];
                                                    ?>
                                                            <div class="jobs-list p-0" style="border-bottom: 1px solid #000;">
                                                                <div class="job-info">
                                                                    <div class="job-details p-1 w-100">
                                                                        <a href="<?php echo $url; ?>">
                                                                            <h3><?php echo $row['Title']; ?></h3>
                                                                        </a>
                                                                        <p><?php echo $row['Subtitle'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<i><small>0 Job Posted</small></i>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="post-popup pst-pj">
                                            <div class="post-project">
                                                <div class="post-project-fields">


                                                </div>
                                                <a href="#" title="">x</a>
                                            </div>
                                        </div>
                                        <div class="post-popup job_post">
                                            <div class="post-project">
                                                <h3>Whats on Your Mind?</h3>
                                                <div class="post-project-fields">

                                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <input type="hidden" name="id" placeholder="Title" value="<?php echo $user['userID']; ?>">
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="mb-1">Title :</label>
                                                                <input type="text" name="title" placeholder="" class="text-dark" required>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="mb-1">Subtitle :</label>
                                                                <input type="text" name="Subtitle" placeholder="" class="text-dark" required>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="mb-1">Description :</label>
                                                                <textarea name="description" placeholder="" class="text-dark"></textarea>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label class="mb-1">Image :</label>
                                                                <br>
                                                                <input type="file" name="file" />

                                                            </div>
                                                            <div class="col-lg-12">
                                                                <ul>
                                                                    <li>
                                                                        <button type="submit" name="postContent" class="active"> Yes</button>
                                                                    </li>
                                                                    <li><a href="#" title="">Cancel</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <a href="#" title="">x</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade mt-5" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-3">
                                                <h1 class="p-2 mb-2" style="font-size: 20pt !important;">Are you sure you want to Signout?</h1>

                                                <a href="logout.php" class="btn btn-danger">Yes</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade mt-5" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-3">
                                                <h1 class="p-2 mb-2" style="font-size: 20pt !important;">Are you sure you want to delete this post?</h1>
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="to-delete" id="to-delete" value="" />
                                                    <button type="submit" class="btn btn-danger" name="deleteUserPost">Yes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script type="text/javascript" src="js/jquery.min.js"></script>
                                <script type="text/javascript" src="js/popper.js"></script>
                                <script type="text/javascript" src="js/bootstrap.min.js"></script>
                                <script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
                                <script type="text/javascript" src="lib/slick/slick.min.js"></script>
                                <script type="text/javascript" src="js/scrollbar.js"></script>
                                <script type="text/javascript" src="js/script.js"></script>
                                <!--SweetAlert-->
                                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    function sweetalertclick() {
                                        Swal.fire({
                                            title: 'Posting Done!',
                                            text: 'Post will be checked by the Administrators',
                                            icon: 'warning',
                                            confirmButtonText: 'Done'
                                        });
                                    }

                                    $('.delete-post').on('click', function(e) {
                                        console.log('here');
                                        var postId = $(this).attr('data-id');
                                        console.log(postId);
                                        $("#to-delete").val(postId);
                                    });
                                </script>
                                <script>
                                    $(document).ready(function() {
                                        $(".hideDropdown").click(function() {
                                            $("#users").css("display", "none");
                                        });
                                    });
                                </script>

                                <?php
                                if (isset($_SESSION['notification']) && $_SESSION['notification'] != '') {
                                ?>
                                    <script>
                                        Swal.fire({
                                            title: 'Posting Done!',
                                            text: 'Post will be checked by the Administrators',
                                            icon: 'warning',
                                            confirmButtonText: 'Done'
                                        });
                                    </script>
                                <?php
                                    unset($_SESSION['notification']);
                                }

                                if (isset($_SESSION['deletenotif']) && $_SESSION['deletenotif'] != '') {
                                ?>
                                    <script>
                                        Swal.fire({
                                            title: 'Delete successful',
                                            text: 'Your post was successfully deleted',
                                            icon: 'info',
                                            confirmButtonText: 'Done'
                                        });
                                    </script>
                                <?php
                                    unset($_SESSION['deletenotif']);
                                }
                                ?>
</body>

</html>