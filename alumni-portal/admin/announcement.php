<?php
include('security.php');
include('../includes/header.php');
include('../includes/navbar.php');
include "../dbconfig.php";


?>

<script>
    (function() {
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');

            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<!-- Modal -->
<div class="modal fade bd-example-modal-md" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Content Type:</label>
                            <select name="contentType" required class="form-control">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <option value="">Select Content Type</option>
                                <option value="Announcements">Announcements</option>
                                <option value="Events">Events</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" required name="user" value="<?php
                                                                        echo $user['Id'];
                                                                        ?>" class="form-control" placeholder="Enter Content Title">

                    <input type="hidden" required name="userData" value="<?php
                                                                            echo $user['userData'];
                                                                            ?>" class="form-control" placeholder="Enter Content Title">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Title:</label>
                            <input type="text" required name="Title" class="form-control" placeholder="Enter Content Title">
                        </div>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Subtitle :</label>
                            <input type="text" required name="Subtitle" class="form-control" placeholder="Enter Content Subtitle">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Description :</label>
                            <textarea name="Description" class="form-control" required></textarea>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Image :</label>
                            <input type="file" name="file" />

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="contentsInsert" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" class="was-validated" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="branch_id" name="branch_id" class="form-control" placeholder="Enter Branch Name" required>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Content Type:</label>
                            <select name="contentType" required class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <option id="contentTypes" value="">Select Content Type</option>
                                <option value="Announcements">Announcements</option>
                                <option value="Events">Events</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" required name="user" value="<?php
                                                                        echo $user['Id'];
                                                                        ?>" class="form-control" placeholder="Enter Content Title">
                    <input type="hidden" name="imageFetched" id="imageFetched" class="form-control" placeholder="Enter Content Title">

                    <input type="hidden" required name="userData" value="<?php
                                                                            echo $user['userData'];
                                                                            ?>" class="form-control" placeholder="Enter Content Title">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Title:</label>
                            <input type="text" required name="Title" id="Title" class="form-control" placeholder="Enter Content Title" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Subtitle :</label>
                            <input type="text" required name="Subtitle" id="Subtitle" class="form-control" placeholder="Enter Content Subtitle" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Description :</label>
                            <textarea name="Description" class="form-control" id="Description" required></textarea>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Image :</label>
                            <div id="pic" width="150" height="150">

                            </div>
                            <input type="file" name="file" />

                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="contentUpdate" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">

    <!-- Data tables -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Announcements and Events
                <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#addadminprofile">
                    Add New
                </button>
                <h6>
        </div>

        <div class="card-body">

            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<div class="alert alert-success"> ' . $_SESSION['success'] . ' </div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<div class="alert alert-danger"> ' . $_SESSION['status'] . ' </div>';
                unset($_SESSION['status']);
            }
            ?>
            <div class="table-responsive">

                <?php
                $query = "SELECT * FROM events left join accounts on events.CreatedUser = accounts.Id where TypeOfContent !='Jobs' AND AllowPost ='Approved' AND Usertype !='Alumni'";
                $query_run = mysqli_query($connection, $query);
                ?>

                <table class="table table-hover table-bordered dataTableASC" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Description</th>
                            <th>Posted By</th>
                            <th>Date and Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                                <tr>
                                    <td> <?php echo $row['TypeOfContent']; ?> </td>
                                    <td> <?php echo $row['Title']; ?> </td>
                                    <td> <?php echo $row['Subtitle']; ?> </td>
                                    <td> <?php echo $row['Description']; ?> </td>
                                    <td> <?php echo $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName']; ?> </td>
                                    <td> <?php echo $row['CreatedDate']; ?> </td>
                                    <td>

                                        <div class="btn-group">
                                            <button data-id="<?php echo $row['id']; ?>" data-title="<?php echo $row['Title']; ?>" data-subtitle="<?php echo $row['Subtitle']; ?>" data-user="<?php echo $row['CreatedUser']; ?>" data-date="<?php echo $row['CreatedDate']; ?>" data-type="<?php echo $row['TypeOfContent']; ?>" data-description="<?php echo $row['Description']; ?>" data-file="<?php echo $row['Image']; ?>" style='border-radius: 8px;  margin-right: 5px;' class="btn btn-primary edit_btn" data-toggle="modal" data-target="#updateadminprofile"> <i class="fas fa-edit"></i></button>
                                            <button type="button" style='border-radius: 8px;' class="btn btn-danger delete" data-toggle="modal" data-target="#confirmModal" data-id="<?php echo $row['id']; ?>">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmModalLabel">Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Are you sure you want to delete?</h5>


                                                        <form action="code.php" method="POST">
                                                            <input type="hidden" id="delete_id" name="delete_id" value="<?php echo $row['id']; ?>">
                                                            <button type="submit" name="deleteContent" class="btn btn-danger"> Yes</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal -->

                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No Record Found";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <?php
    include('../includes/footer.php');
    include('../includes/scripts.php');
    ?>

    <script>
        $(document).ready(function() {
            $(".edit_btn").click(function() {


                let photo;
                $("#branch_id").val($(this).data("id"));
                $("#Title").val($(this).data("title"));
                $("#Subtitle").val($(this).data("subtitle"));
                $("#Description").val($(this).data("description"));
                $("#user").val($(this).data("user"));
                $("#userData").val($(this).data("userData"));
                $("#contentTypes").val($(this).data("type"));
                $("#contentTypes").html($(this).data("type"));
                if (($(this).data("file")).includes("empty")) {
                    photo = "";
                } else {
                    photo = "/alumni/admin/" + $(this).data("file");
                }

                $("#imageFetched").val($(this).data("file"));

                $("#pic").empty();
                $("#pic").append("<img width='100%' height='100%' src=" + photo + " />");
            });
            $(".delete").click(function() {
                $("#delete_id").val($(this).data("id"));

            });
        });
    </script>