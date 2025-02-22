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
<div class="modal fade bd-example-modal-lg" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container mt-3">
                <form action="code.php" class="needs-validation" novalidate method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Employee #:</label>
                                <input type="text" name="employeeNo" class="form-control " placeholder="Enter Employee Number*" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">

                                <div class="col-4">
                                    <label>First Name:</label>
                                    <input type="text" name="firstname" class="form-control " placeholder="Enter First Name*" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>

                                <div class="col-4">
                                    <label>Middle Name:</label>
                                    <input type="text" name="middlename" class="form-control  " placeholder="Enter Middle Name*" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="col-4">

                                    <label>Last Name:</label>
                                    <input type="text" name="lastname" class="form-control  " placeholder="Enter Last Name*" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-6">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email*" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="form-group col-6">
                                <label>Contact #:</label>
                                <input type="number" autocomplete="off" onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;" onKeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" name="contact" id="contact_insert" class="form-control" placeholder="Enter contact #" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>School Branch:</label>
                                <select name="branch" id="insert_branch" class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    <option value="">Select Branch</option>
                                    <?php
                                    $query = "SELECT * FROM branch";
                                    $branch = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($branch) > 0) {
                                        while ($row = mysqli_fetch_assoc($branch)) {
                                            echo $row['Name'];
                                    ?>
                                            <option value=<?php echo $row['Id']; ?>><?php echo $row['Name'] . " - " . $row['Address'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label>School Deparment:</label>
                                <select name="department" id="department" class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    <option value="">Select Department</option>
                                    <?php
                                    $query = "SELECT * FROM departments";
                                    $branch = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($branch) > 0) {
                                        while ($row = mysqli_fetch_assoc($branch)) {
                                            echo $row['Name'];
                                    ?>
                                            <option value=<?php echo $row['id']; ?>><?php echo $row['Name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="row d-none">
                            <div class="form-group col-6">
                                <label>Password:</label>
                                <input type="password" value="123456" name="password" id="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="form-group col-6">
                                <label>Confirm Password:</label>
                                <input type="password" value="123456" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Enter Confirm Password">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="employeeInsert" id="employeeInsert" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="updateadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container mt-3">
                <form action="code.php" class="was-validated" method="POST">
                    <div class="row">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="form-group col-6">
                            <label>Employee #:</label>
                            <input type="text" name="employeeNo" id="employeeNo" class="form-control" placeholder="Enter Employee Number" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div class="form-group col-6">
                            <label>Username:</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">

                            <div class="col-4">
                                <label>First Name:</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label>Middle Name:</label>
                                <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Enter Middle" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="col-4">

                                <label>Last Name:</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-6">
                            <label>Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div class="form-group col-6">
                            <label>Contact #:</label>
                            <input type="number" autocomplete="off" onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;" onKeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" name="contact" id="contact" class="form-control" placeholder="Enter contact #" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>School Branch:</label>
                            <select name="branch" id="branch" class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <option id="branchSelected"></option>
                                <?php
                                $query = "SELECT * FROM branch";
                                $branch = mysqli_query($connection, $query);
                                if (mysqli_num_rows($branch) > 0) {
                                    while ($row = mysqli_fetch_assoc($branch)) {
                                        echo $row['Name'];
                                ?>
                                        <option value=<?php echo $row['Id']; ?>><?php echo $row['Name'] . " - " . $row['Address'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label>School Deparment:</label>
                            <select name="department" id="department" class="form-control checkBranch" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <option id="departSelected"></option>
                                <?php
                                $query = "SELECT * FROM departments";
                                $branch = mysqli_query($connection, $query);
                                if (mysqli_num_rows($branch) > 0) {
                                    while ($row = mysqli_fetch_assoc($branch)) {
                                ?>
                                        <option class="<?php echo "checkershowed show_" . $row['branch_id']; ?>" value=<?php echo $row['id']; ?>><?php echo $row['Name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                    <div id="error_edit"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="employeeEdit" id="employeeEdit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="container-fluid">

    <!-- Data tables -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                List of Employee
                <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#addadminprofile">
                    Add Employee
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
                $query = "SELECT *, accounts.id as Account_ID, branch.Name, branch.Address, departments.Name as Department_Name
            FROM accounts 
            left join branch 
            on accounts.BranchID = branch.id
            left join departments
            on accounts.DepartmentId = departments.id
            where accounts.userData !='Administrator'";
                $query_run = mysqli_query($connection, $query);
                ?>

                <table class="table table-hover table-bordered dataTableASC" id="dataTable" width="100%" cellspacing="0%">
                    <thead>
                        <tr>
                            <th>Employee Number</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Branch Assigned</th>
                            <th>Department Assigned</th>
                            <th>Actions</th>
                            <th hidden>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                                <tr>
                                    <td hidden> <?php echo $row['Account_ID']; ?> </td>
                                    <td> <?php echo $row['IdNumber']; ?> </td>
                                    <td> <?php echo $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName']; ?> </td>
                                    <td> <?php echo $row['Email']; ?> </td>
                                    <td> <?php echo $row['ContactNumber']; ?> </td>
                                    <td> <?php echo $row['Name'] . "-" . $row['Address']; ?> </td>
                                    <td> <?php echo $row['Department_Name']; ?></td>
                                    <td>

                                        <div class="btn-group">

                                            <button data-id="<?php echo $row['Account_ID']; ?>" data-empid="<?php echo $row['IdNumber']; ?>" data-fname="<?php echo $row['FirstName']; ?>" data-mname="<?php echo $row['MiddleName']; ?>" data-lname="<?php echo $row['LastName']; ?>" data-username="<?php echo $row['Username']; ?>" data-email="<?php echo $row['Email']; ?>" data-contact="<?php echo $row['ContactNumber']; ?>" data-pass="<?php echo $row['Password']; ?>" data-branchid="<?php echo $row['BranchId']; ?>" ; data-departmentid="<?php echo $row['DepartmentId']; ?>" data-department="<?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            $query = "SELECT * FROM departments WHERE id=" . $row['DepartmentId'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            $deparmentName = mysqli_query($connection, $query);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            if (mysqli_num_rows($deparmentName) > 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                while ($row_dept = mysqli_fetch_assoc($deparmentName)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $row_dept['Name'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ?>" data-branch="<?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $query = "SELECT * FROM branch WHERE Id=" . $row['BranchId'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $branchName = mysqli_query($connection, $query);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if (mysqli_num_rows($branchName) > 0) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    while ($row_branch = mysqli_fetch_assoc($branchName)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo $row_branch['Name'] . " " . $row_branch['Address'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>" style='border-radius: 8px;  margin-right: 5px;' class="btn btn-primary edit_btn" data-toggle="modal" data-target="#updateadminprofile"> <i class="fas fa-edit"></i></button>
                                            <button style='border-radius: 8px;' type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#confirmModal" data-id="<?php echo $row['Account_ID']; ?>">
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
                                                            <input type="hidden" id="delete_id" name="delete_id" value="<?php echo $row['Staff_ID']; ?>">
                                                            <button type="submit" name="deleteEmployee" class="btn btn-danger"> Yes</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

                var branch = $("#branch").val();
                var dataid = $(".checkBranch ").find(':selected').data('id')
                $(".checkBranch option").css("display", "none")
                $(".checkBranch .show_" + branch).css("display", "block")

                $("#edit_id").val($(this).data("id"));
                $("#employeeNo").val($(this).data("empid"));
                $("#firstname").val($(this).data("fname"));
                $("#middlename").val($(this).data("mname"));
                $("#lastname").val($(this).data("lname"));
                $("#username").val($(this).data("username"));
                $("#email").val($(this).data("email"));
                $("#contact").val($(this).data("contact"));
                $("#pass").val($(this).data("pass"));
                $("#cpass").val($(this).data("pass"));
                $("#departSelected").val($(this).data("departmentid"));
                $("#departSelected").html($(this).data("department"));
                $("#branchSelected").val($(this).data("branchid"));
                $("#branchSelected").html($(this).data("branch"));

            });


            $("#contact_insert").blur(function() {
                if ($(this).val().length > 10) {
                    // Enable submit button
                    $("#employeeInsert").removeAttr('disabled');
                    $("#error").empty();
                } else {
                    // Disable submit button
                    $("#employeeInsert").attr('disabled', 'disabled');
                    $("#error").empty();
                    $("#error").append(`
                <div class="alert alert-danger" role="alert">
                    Invalid Contact Number
                </div>
                `);
                }
            });

            $("#contact").blur(function() {
                if ($(this).val().length > 10) {
                    // Enable submit button
                    $("#employeeEdit").removeAttr('disabled');
                    $("#error_edit").empty();
                } else {
                    // Disable submit button
                    $("#employeeEdit").attr('disabled', 'disabled');
                    $("#error_edit").empty();
                    $("#error_edit").append(`
                <div class="alert alert-danger" role="alert">
                    Invalid Contact Number
                </div>
                `);
                }
            });

            $("#password,#confirmpassword").keyup(function() {
                var pass = $("#password").val();
                var cpass = $("#confirmpassword").val();
                if (pass != cpass) {
                    $("#error").empty();
                    $("#employeeInsert").attr('disabled', 'disabled');
                    $("#error").append(`
                <div class="alert alert-danger" role="alert">
                    Password and Confirm password doesn't match!
                </div>
                `);

                } else {
                    $("#employeeInsert").removeAttr('disabled');
                    $("#error").empty();
                }

            });
            $("#pass,#cpass").keyup(function() {
                var pass = $("#pass").val();
                var cpass = $("#cpass").val();
                if (pass != cpass) {
                    $("#error_edit").empty();
                    $("#employeeEdit").attr('disabled', 'disabled');
                    $("#error_edit").append(`
                <div class="alert alert-danger" role="alert">
                    Password and Confirm password doesn't match!
                </div>
                `);

                } else {
                    $("#employeeEdit").removeAttr('disabled');
                    $("#error_edit").empty();
                }

            });

            $(".delete").click(function() {
                $("#delete_id").val($(this).data("id"));

            });

            $("#insert_branch").change(function() {
                $(".checkBranch").val($(".checkBranch option:first").val());
                var branch = $(this).val();
                var dataid = $(".checkBranch ").find(':selected').data('id')
                $(".checkBranch option").css("display", "none")
                $(".checkBranch .show_" + branch).css("display", "block")
            });

            $("#branch").change(function() {
                $(".checkBranch").val($(".checkBranch option:first").val());
                var branch = $(this).val();
                var dataid = $(".checkBranch ").find(':selected').data('id')
                $(".checkBranch option").css("display", "none")
                $(".checkBranch .show_" + branch).css("display", "block")
            });



        });
    </script>
    </script>