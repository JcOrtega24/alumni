<?php
include('security.php');
include('../includes/header.php');
include('../includes/navbar.php');
include "../dbconfig.php";

$display;
$redirect;
if ($user['userData'] === "Employee") {
    $display = "none";
    $redirect = "employeeIndex.php";
} else {
    $display = "unset";
    $redirect = "index.php";
}

$last_id_select = "SELECT id FROM alumni ORDER BY id DESC LIMIT 1;";
$last_id_query = mysqli_query($connection, $last_id_select);
$raw_id = 1700001;
$last_id = 1700001;
if ($last_id_query->num_rows > 0) {
    while ($row = $last_id_query->fetch_assoc()) {
        $last_id = $row["id"] + 1;
        $raw_id = $row["id"] + 1;
    }
}
$last_id = strval($last_id);
$last_id = substr_replace($last_id, '-', 2, 0);
?>

<script>
    // console.log('<?php echo $last_id; ?>');
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
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="addadminprofile" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Alumni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" class="needs-validation" novalidate method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 ">
                            <label> <span class="text-danger fw-bold">*</span> Remarks / Alumni ID #:</label>
                            <input type="hidden" name="raw_id" id="raw_id" value="<?php echo $raw_id; ?>">
                            <input tabindex="2" name="studRemarks" class="form-control format-alumniID" placeholder="Enter Remarks / Alumni ID #" id="last_id" readonly required value="17-00001">
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Last Name:</label>
                                <input type="text" tabindex="5" onKeyDown="return /[a-z]/i.test(event.key)" name="lastname" class="form-control" placeholder="Enter Last" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>First Name:</label>
                                <input type="text" tabindex="3" onKeyDown="return /[a-z]/i.test(event.key)" name="firstname" class="form-control" placeholder="Enter First" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Middle Name:</label>
                                <input type="text" tabindex="4" onKeyDown="return /[a-z]/i.test(event.key)" name="middlename" class="form-control" placeholder="Enter Middle" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Birthday:</label>
                                <input type="date" tabindex="6" name="birthday" class="form-control" placeholder="Rizal" tabindex="10" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Gender:</label>
                                <select name="gender" class="form-control" tabindex="10" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Student Number:</label>
                                <input tabindex="13" name="studNo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control format-studNo" id="" placeholder="Ex: 18-00001" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="form-group col-12">
                            <label>Address:</label>
                            <textarea class="form-control" tabindex="8" name="address" required></textarea>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label>Telephone #:</label>
                                <input type="number" autocomplete="off" name="telephone" class="form-control" placeholder="Enter telephone #">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Contact #:</label>
                                <input type="number" autocomplete="off" tabindex="9" onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;" onKeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" name="contact" id="contact_insert" class="form-control" placeholder="Enter contact #" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Date Filed:</label>
                                <input type="date" name="studDate" id="date_filed" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Enter Designation">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Batch</label>
                                <input type="number" tabindex="10" min="1980" onKeyDown="if(this.value.length==4 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" required name="yeargraduated" placeholder="Enter year graduated" tabindex="10" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field. (1980 minimum)</div>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Campus:</label>
                                <input type="hidden" name="testSchoolID" id="testSchoolID" />
                                <select name="schoolAttended" tabindex="11" id="schooolDataID" class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    <option value="">Select</option>
                                    <?php
                                    $query = "SELECT * FROM branch";
                                    $branch = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($branch) > 0) {
                                        while ($row = mysqli_fetch_assoc($branch)) {
                                            echo $row['Name'];
                                    ?>
                                            <option data-id=<?php echo $row['Id'] ?>><?php echo $row['Name'] . " - " . $row['Address'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Course:</label>
                                <select name="course" tabindex="12" class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                    <option value="">Select Course</option>
                                    <?php
                                    $query = "SELECT * FROM course";
                                    $branch = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($branch) > 0) {
                                        while ($row = mysqli_fetch_assoc($branch)) {
                                    ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['code'] . "-" . $row['title']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Email:</label>
                                <input type="email" tabindex="7" name="email" class="form-control" placeholder="Enter Email" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="col-4">
                                <label>Twitter:</label>
                                <input type="text" tabindex="7" name="twitter" class="form-control" placeholder="Enter Twitter" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Facebook:</label>
                                <input type="text" tabindex="7" name="facebook" class="form-control" placeholder="Enter Facebook" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label><span class="text-danger fw-bold">*</span>Mailing Address:</label>
                                <input type="text" tabindex="7" name="mailing_address" class="form-control" placeholder="Enter Mailing Address" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-6">
                                <label>Company Address:</label>
                                <input type="text" tabindex="7" name="company_address" class="form-control" placeholder="Enter Company Address">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5></h5>
                    <!--Add Admin-->
                    <!-- <div class="row">
                        <div class="form-group col-6 ">
                            <label>Student Number:</label>
                            <input tabindex="13" name="studNo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control format-studNo" id="" placeholder="Ex: 18-00001" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group col-6 ">
                            <label>Status:</label>
                            <select name="studStatus" tabindex="14" class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <option value="">Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Separated">Separated</option>
                                <option value="Widow / Widower">Widow / Widower</option>
                                <option value="Single Parent">Single Parent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6 ">
                            <label>Designation:</label>
                            <input type="text" tabindex="15" name="studDes" class="form-control" placeholder="Enter Designation" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group col-6 ">
                            <label>OR#:</label>
                            <input type="number" tabindex="16" name="studOR" class="form-control" placeholder="Enter OR#" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6 ">
                            <label>Date Filed:</label>
                            <input type="date" name="studDate" id="date_filed" value="" class="form-control" placeholder="Enter Designation">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label>Current Work:</label>
                            <input type="text" name="currentWork" class="form-control" placeholder="Enter Current Work">
                        </div>
                    </div> -->

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Elementary School: </label>
                                <input type="text" tabindex="7" name="elementary" class="form-control" placeholder="Elementary School" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Year Graduated: </label>
                                <input type="number" tabindex="7" name="year_elementary" class="form-control" placeholder="Year Graduated" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label></span>Honors Received: </label>
                                <input type="text" tabindex="7" name="honor_elementary" class="form-control" placeholder="Honors Received">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>High School: </label>
                                <input type="text" tabindex="7" name="highschool" class="form-control" placeholder="High School" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label><span class="text-danger fw-bold">*</span>Year Graduated: </label>
                                <input type="number" tabindex="7" name="year_highschool" class="form-control" placeholder="Year Graduated" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-4">
                                <label></span>Honors Received: </label>
                                <input type="text" tabindex="7" name="honor_highschool" class="form-control" placeholder="Honors Received">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label><span class="text-danger fw-bold">*</span>College: </label>
                                <input type="text" tabindex="7" name="college" class="form-control" placeholder="College" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-3">
                                <label><span class="text-danger fw-bold">*</span>Degree: </label>
                                <input type="text" tabindex="7" name="degree" class="form-control" placeholder="Degree" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-3">
                                <label><span class="text-danger fw-bold">*</span>Year Graduated: </label>
                                <input type="number" tabindex="7" name="year_college" class="form-control" placeholder="Year Graduated" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <div class="col-3">
                                <label>Honors Received: </label>
                                <input type="text" tabindex="7" name="honor_college" class="form-control" placeholder="Honors Received">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label><span class="text-danger fw-bold">*</span>Password:</label>
                            <input type="password" name="password" value="123456" id="password_insert" class="form-control" required placeholder="Enter Password">
                        </div>
                        <div class="form-group col-6">
                            <label><span class="text-danger fw-bold">*</span>Confirm Password:</label>
                            <input type="password" name="confirmpassword" value="123456" id="confirmpassword_insert" class="form-control" required placeholder="Enter Confirm Password">
                        </div>

                    </div>
                    <div class="row">
                        <small class="fw-bold">NOTE: All fields marked with <span class="text-danger">*</span> are mandatory.</small>
                    </div>
                    <div id="error"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" tabindex="18" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" tabindex="17" name="alumniInsert" id="alumniInsert" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="container-fluid">

    <div class="modal fade" id="updateadminprofile" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="code.php" class="was-validated" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="edit_id" id="edit_id" class="form-control" required>

                            <div class="row">
                                <div class="form-group col-6 ">
                                    <label> <span class="text-danger fw-bold">*</span> Remarks / Alumni ID #:</label>
                                    <input tabindex="2" name="studRemarks" id="studRemarks" class="form-control format-alumniID" placeholder="Enter Remarks / Alumni ID #" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-4">
                                        <label><span class="text-danger fw-bold">*</span>Last Name:</label>
                                        <input type="text" tabindex="5" onKeyDown="return /[a-z]/i.test(event.key)" id="lastname" name="lastname" class="form-control" placeholder="Enter Last" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-4">
                                        <label><span class="text-danger fw-bold">*</span>First Name:</label>
                                        <input type="text" tabindex="3" onKeyDown="return /[a-z]/i.test(event.key)" id="firstname" name="firstname" class="form-control" placeholder="Enter First" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-4">
                                        <label><span class="text-danger fw-bold">*</span>Middle Name:</label>
                                        <input type="text" tabindex="4" onKeyDown="return /[a-z]/i.test(event.key)" id="middlename" name="middlename" class="form-control" placeholder="Enter Middle" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label><span class="text-danger fw-bold">*</span>Birthday:</label>
                                        <input type="date" tabindex="6" name="birthday" id="birthday" class="form-control" placeholder="Rizal" tabindex="10" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-6">
                                        <label><span class="text-danger fw-bold">*</span>Gender:</label>
                                        <select name="gender" tabindex="6" class="form-control" tabindex="10" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                            <option id="gender"></option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">
                        <div class="form-group col-12">
                            <label>Address:</label>
                            <textarea class="form-control" tabindex="8" name="address" required></textarea>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div> -->

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label><span class="text-danger fw-bold">*</span>Student Number:</label>
                                        <input tabindex="13" name="studNo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control format-studNo" id="studentNo" placeholder="Ex: 18-00001" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="col-4">
                                        <label>Telephone #:</label>
                                        <input type="number" autocomplete="off" name="telephone" class="form-control" placeholder="Enter telephone #">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="col-4">
                                        <label><span class="text-danger fw-bold">*</span>Contact #:</label>
                                        <input type="number" autocomplete="off" tabindex="9" onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;" onKeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57" name="contact" id="contact-insert" class="form-control" placeholder="Enter contact #" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6 ">
                                    <label><span class="text-danger fw-bold">*</span>Date Filed:</label>
                                    <input type="date" name="studDate" id="date_filed" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Enter Designation">
                                </div>

                                <div class="form-group col-6">
                                    <label><span class="text-danger fw-bold">*</span>Batch</label>
                                    <input type="number" tabindex="10" min="1980" id="batch" onKeyDown="if(this.value.length==4 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" required name="yeargraduated" placeholder="Enter year graduated" tabindex="10" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field. (1980 minimum)</div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label><span class="text-danger fw-bold">*</span>Campus:</label>
                                    <input type="hidden" tabindex="12" name="testSchoolIDedit" id="testSchoolIDedit" />
                                    <select name="schoolAttended" name="testSchoolID" id="schooolDataIDedit" class="form-control" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                        <option id="schoolAttended">Select</option>
                                        <?php
                                        $query = "SELECT * FROM branch";
                                        $branch = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($branch) > 0) {
                                            while ($row = mysqli_fetch_assoc($branch)) {
                                                echo $row['Name'];
                                        ?>
                                                <option data-id=<?php echo $row['Id'] ?>><?php echo $row['Name'] . " - " . $row['Address'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label><span class="text-danger fw-bold">*</span>Course:</label>
                                    <select name="course" tabindex="13" class="form-control" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                        <?php echo '<option id="course">Select</option>';
                                        ?>

                                        <?php
                                        $query = "SELECT * FROM course";
                                        $branch = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($branch) > 0) {
                                            while ($row = mysqli_fetch_assoc($branch)) {
                                        ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['code'] . "-" . $row['title']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <label><span class="text-danger fw-bold">*</span>Email:</label>
                                            <input type="email" tabindex="7" name="email" id="email" disabled class="form-control" placeholder="Enter Email" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Twitter:</label>
                                            <input type="text" tabindex="7" id="twitter" name="twitter" class="form-control" placeholder="Enter Twitter" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="col-6">
                                            <label><span class="text-danger fw-bold">*</span>Facebook:</label>
                                            <input type="text" tabindex="7" id="facebook" name="facebook" class="form-control" placeholder="Enter Facebook" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <label><span class="text-danger fw-bold">*</span>Mailing Address:</label>
                                            <input type="text" tabindex="7" name="mailing_address" id="mailing_address" class="form-control" placeholder="Enter Mailing Address" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Company Address:</label>
                                            <input type="text" tabindex="7" id="company_address" name="company_address" class="form-control" placeholder="Enter Company Address">
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <h5></h5>
                            <!--Add Admin-->
                            <!-- <div class="row">
                        <div class="form-group col-6 ">
                            <label>Student Number:</label>
                            <input tabindex="13" name="studNo" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control format-studNo" id="" placeholder="Ex: 18-00001" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group col-6 ">
                            <label>Status:</label>
                            <select name="studStatus" tabindex="14" class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                                <option value="">Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Separated">Separated</option>
                                <option value="Widow / Widower">Widow / Widower</option>
                                <option value="Single Parent">Single Parent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6 ">
                            <label>Designation:</label>
                            <input type="text" tabindex="15" name="studDes" class="form-control" placeholder="Enter Designation" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group col-6 ">
                            <label>OR#:</label>
                            <input type="number" tabindex="16" name="studOR" class="form-control" placeholder="Enter OR#" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6 ">
                            <label>Date Filed:</label>
                            <input type="date" name="studDate" id="date_filed" value="" class="form-control" placeholder="Enter Designation">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label>Current Work:</label>
                            <input type="text" name="currentWork" class="form-control" placeholder="Enter Current Work">
                        </div>
                    </div> -->

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label><span class="text-danger fw-bold">*</span>Elementary School: </label>
                                        <input type="text" tabindex="7" name="elementary" id="elementary" class="form-control" placeholder="Elementary School" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-6">
                                        <label><span class="text-danger fw-bold">*</span>Year Graduated: </label>
                                        <input type="number" tabindex="7" name="year_elementary" id="year_elementary" class="form-control" placeholder="Year Graduated" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-6">
                                        <label></span>Honors Received: </label>
                                        <input type="text" tabindex="7" name="honor_elementary" id="honor_elementary" class="form-control" placeholder="Honors Received">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label><span class="text-danger fw-bold">*</span>High School: </label>
                                        <input type="text" tabindex="7" name="highschool" id="highschool" class="form-control" placeholder="High School" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-6">
                                        <label><span class="text-danger fw-bold">*</span>Year Graduated: </label>
                                        <input type="number" tabindex="7" name="year_highschool" id="year_highschool" class="form-control" placeholder="Year Graduated" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-6">
                                        <label></span>Honors Received: </label>
                                        <input type="text" tabindex="7" name="honor_highschool" id="honor_highschool" class="form-control" placeholder="Honors Received">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label><span class="text-danger fw-bold">*</span>College: </label>
                                        <input type="text" tabindex="7" name="college" id="college" class="form-control" placeholder="College" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-6">
                                        <label><span class="text-danger fw-bold">*</span>Degree: </label>
                                        <input type="text" tabindex="7" name="degree" id="degree" class="form-control" placeholder="Degree" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-6">
                                        <label><span class="text-danger fw-bold">*</span>Year Graduated: </label>
                                        <input type="number" tabindex="7" name="year_college" id="year_college" class="form-control" placeholder="Year Graduated" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>

                                    <div class="col-6">
                                        <label>Honors Received: </label>
                                        <input type="text" tabindex="7" name="honor_college" id="honor_college" class="form-control" placeholder="Honors Received">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-6">
                                    <label><span class="text-danger fw-bold">*</span>Password:</label>
                                    <input type="password" name="password" value="123456" id="password_insert" class="form-control" required placeholder="Enter Password">
                                </div>
                                <div class="form-group col-6">
                                    <label><span class="text-danger fw-bold">*</span>Confirm Password:</label>
                                    <input type="password" name="confirmpassword" value="123456" id="confirmpassword_insert" class="form-control" required placeholder="Enter Confirm Password">
                                </div>

                            </div>
                            <div class="row">
                                <small class="fw-bold">NOTE: All fields marked with <span class="text-danger">*</span> are mandatory.</small>
                            </div>
                            <div id="error"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" tabindex="18" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" tabindex="17" name="alumniEdit" id="alumniEdit" class="btn btn-primary">Save</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="viewProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Alumni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <img id="pic" width="150" height="150" />
                        </div>
                        <div class="col-9">
                            <h2>Alumni Information</h2>
                            <h5 id="fullname_view"></h5>
                            <h5 id="birthday_view"></h5>
                            <h5 id="gender_view"></h5>
                            <h5 id="address_view"></h5>
                            <hr />
                            <h2>Contact Details</h2>
                            <h5 id="email_view"></h5>
                            <h5 id="contanct_view"></h5>
                            <hr />
                            <h2>Alumni History</h2>
                            <h5 id="schoolAttended_view"></h5>
                            <h5 id="course_view"></h5>
                            <h5 id="yeargraduated_view"></h5>
                            <h5 id="currentWork_view"></h5>


                        </div>
                    </div>

                </div>
            </div>
        </div>
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
                        <input type="hidden" name="delete_id" id="delete_id" value="<?php echo $row['studID']; ?>">
                        <button type="submit" name="deleteAlumni" class="btn btn-danger"> Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> List of Alumni </h6>
                <div class="d-flex flex-nowrap float-end">
                    <label for="" class="text-md text-dark mt-2 mr-3">Bulk Upload Alumni:</label>
                    <form action="importCSV.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="uploadfile" onchange="this.form.submit();" value="Bulk Upload Alumni" id="bulk" class="form-control" style="<?php echo "display:" . $display ?>" accept="text/x-comma-separated-values, text/comma-separated-values, application/octet-stream, 
                                 application/vnd.ms-excel, application/x-csv, text/x-csv, text/csv, application/csv,
                                  application/excel, application/vnd.msexcel">
                    </form>
                    <button type="button" class="btn btn-primary ml-3" style="<?php echo "display:" . $display ?>" data-toggle="modal" data-target="#addadminprofile">
                        Add Alumni
                    </button>
                    <!--
                            <button type="button" id="del" disabled="disabled" class="btn btn-danger ml-3" style="<?php echo "display:" . $display ?>" data-toggle="modal" data-target="#deleteAll">
                            Multiple Delete
                            </button>-->
                </div>
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
                if (isset($_SESSION['exist']) && $_SESSION['exist'] != '') {
                    echo '<div class="alert alert-danger"> ' . $_SESSION['exist'] . ' </div>';
                    unset($_SESSION['exist']);
                }

                if (isset($_SESSION['empty']) && $_SESSION['empty'] != '') {
                    echo '<div class="alert alert-danger"> ' . $_SESSION['empty'] . ' </div>';
                    unset($_SESSION['empty']);
                }

                if (isset($_SESSION['regex']) && $_SESSION['regex'] != '') {
                    echo '<div class="alert alert-danger"> ' . $_SESSION['regex'] . ' </div>';
                    unset($_SESSION['regex']);
                }


                ?>
                <div class="table-responsive">

                    <?php

                    if ($user['userData'] == "Employee") {

                        $userDept = $user['DepartmentId'];
                        // $query = "SELECT *, alumni.id as studID from alumni 
                        //     left join course
                        //     on alumni.courseGraduated = course.id
                        //     left join departments
                        //     on departments.id = course.dep_id
                        //     WHERE courseGraduated !=' ' 
                        //     AND 
                        //     schoolAttended != ' ' 
                        //     AND departments.id ='$userDept'
                        //     AND interest =" . $user['BranchId'];
                        $query = "SELECT *, alumni.id as studID from alumni 
                            left join course
                            on alumni.courseGraduated = course.id
                            left join departments
                            on departments.id = course.dep_id
                            WHERE courseGraduated !=' ' 
                            AND 
                            schoolAttended != ' ' 
                            AND departments.id ='$userDept' . ";
                        $query_run = mysqli_query($connection, $query);
                    } else {
                        $query = "SELECT *, alumni.id as studID from alumni 
                        LEFT JOIN course
                        ON alumni.courseGraduated = course.id
                        WHERE courseGraduated !=' ' 
                        AND 
                        schoolAttended != ' ' ORDER BY studNo ASC";
                        $query_run = mysqli_query($connection, $query);
                    }

                    ?>
                    <!--  <form action="code.php" method="POST"> -->
                    <table class="table table-hover table-bordered dataTableASC" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th><input type="checkbox" class="checkboxtop" onclick="select_all()" id="delete"></th>  -->
                                <th>Student Number</th>
                                <th>Full Name</th>
                                <th>Course</th>
                                <th>Branch Graduated</th>
                                <th>Batch</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // fix for other variable not showing on update modal
                            $mailing_address;
                            $company_address;
                            $elementary_graduated;
                            $elementary_honor;
                            $highschool_graduated;
                            $highschool_honor;
                            $college_graduated;
                            $college_degree;
                            $college_honor;
                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    $mailing_address = $row['mailingAddress'];
                                    $company_address = $row['companyAddress'];
                                    $elementary_graduated = $row['elementaryGraduated'];
                                    $elementary_honor = $row['elementaryGraduated'];
                                    $highschool_graduated = $row['highschoolGraduated'];
                                    $highschool_honor = $row['highschoolHonors'];
                                    $college_graduated = $row['collegeGraduated'];
                                    $college_degree = $row['collegeDegree'];
                                    $college_honor = $row['collegeHonors'];
                            ?>
                                    <tr>
                                        <!-- 
                                            <td>
                                               <input type="checkbox" class="checkbox" id="<? php // echo $row['studID']; 
                                                                                            ?>" name="checkbox[]" value ="<? php // echo $row['studID']; 
                                                                                                                            ?>"> 
                                            </td>
                                            -->
                                        <td>
                                            <?php echo $row['studNo']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['firstname'] . " " . $row['middleName'] . " " . $row['lastname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['title']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['schoolAttended']; ?>
                                        </td>

                                        <td>
                                            <!-- Modal --
                                            <div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteAllModalLabel">Delete</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Are you sure you want to delete?</h5>
                                                            <input type="submit" id="delete_row" name="delete_row" class="btn btn-danger" value="Yes"></button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        </form>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                -->
                                            <?php
                                            $query = "SELECT * FROM batch WHERE Name=" . $row['studID'] . " order by id desc
                                                    limit 1";
                                            $querybatch = mysqli_query($connection, $query);
                                            $batch = mysqli_fetch_array($querybatch);
                                            $row_cnt = mysqli_num_rows($querybatch);
                                            if ($row_cnt > 0)
                                                if (!$batch['Description']) {
                                                    echo "--";
                                                } else {
                                                    echo $batch['Description'];
                                                }
                                            else {
                                                echo "--";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a data-id="<?php echo $row['studID']; ?>" data-photo="<?php echo $row['photo']; ?>" data-fname="<?php echo $row['firstname']; ?>" data-mname="<?php echo $row['middleName']; ?>" data-lname="<?php echo $row['lastname']; ?>" data-gender="<?php echo $row['gender']; ?>" data-birthday="<?php echo $row['birthday']; ?>" data-email="<?php echo $row['email']; ?>" data-contact="<?php echo $row['contact']; ?>" data-address="<?php echo $row['address']; ?>" data-school="<?php echo $row['schoolAttended']; ?>" data-course="<?php echo $row['courseGraduated']; ?>" data-pass="<?php echo $row['password']; ?>" data-studNo="<?php echo $row['studNo']; ?>" data-studStatus="<?php echo $row['studStatus']; ?>" data-studDes="<?php echo $row['studDes']; ?>" data-studOR="<?php echo $row['studOR']; ?>" data-studDate="<?php echo $row['studDate']; ?>" data-studRemarks="<?php echo $row['studRemarks']; ?>" data-currentwork="<?php echo $row['CurrentWork']; ?>" data-coursetitle="
                                                <?php
                                                if ($row['courseGraduated'] != "" || $row['courseGraduated'] != NULL) {
                                                    $query = "SELECT * FROM course WHERE id=" . $row['courseGraduated'] . "";
                                                    $queryc = mysqli_query($connection, $query);
                                                    $c = mysqli_fetch_array($queryc);
                                                    // echo $c['title'];
                                                    $row_cnt = mysqli_num_rows($queryc);
                                                    if ($row_cnt > 0) {
                                                        echo $c['title'];
                                                    } else {
                                                        echo "--";
                                                    }
                                                } else {
                                                    echo "--";
                                                }
                                                ?>" data-yeargraduated="
                                                <?php
                                                $query = "SELECT * FROM batch WHERE Name=" . $row['studID'] . " order by id desc
                                                limit 1";
                                                $querybatch = mysqli_query($connection, $query);
                                                $batch = mysqli_fetch_array($querybatch);
                                                $row_cnt = mysqli_num_rows($querybatch);
                                                if ($row_cnt > 0)
                                                    if (!$batch['Description']) {
                                                        echo "--";
                                                    } else {
                                                        echo $batch['Description'];
                                                    }
                                                else {
                                                    echo "--";
                                                }
                                                ?>" style='border-radius: 8px;  margin-right: 5px;' class="btn btn-success view_btn" href="viewProfile.php?id=<?php echo $row['studID']; ?>"><i class="far fa-eye"></i></a>
                                                <button data-id="<?php echo $row['studID']; ?>" data-interest="<?php echo $row['interest']; ?>" data-fname="<?php echo $row['firstname']; ?>" data-mname="<?php echo $row['middleName']; ?>" data-lname="<?php echo $row['lastname']; ?>" data-gender="<?php echo $row['gender']; ?>" data-birthday="<?php echo $row['birthday']; ?>" data-email="<?php echo $row['email']; ?>" data-contact="<?php echo $row['contact']; ?>" data-address="<?php echo $row['address']; ?>" data-school="<?php echo $row['schoolAttended']; ?>" data-course="<?php echo $row['courseGraduated']; ?>" data-telephone="<?php echo $row['telephone']; ?>" data-pass="<?php echo $row['password']; ?>" data-studNo="<?php echo $row['studNo']; ?>" data-studStatus="<?php echo $row['studStatus']; ?>" data-studDes="<?php echo $row['studDes']; ?>" data-studOR="<?php echo $row['studOR']; ?>" data-studDate="<?php echo $row['studDate']; ?>" data-studRemarks="<?php echo $row['studRemarks']; ?>" data-twitter="<?php echo $row['twitterURL']; ?>" data-facebook="<?php echo $row['fbURL']; ?> " data-elementary="<?php echo $row['elementary']; ?> " data-elementaryGraduated="<?php echo $elementary_graduated ?> " data-highschool="<?php echo $row['highschool']; ?> " data-highschoolGraduated="<?php echo $highschool_graduated ?> " data-highschoolHonors="<?php echo $highshool_honor ?> " data-college="<?php echo $row['college']; ?>" data-collegeDegree="<?php echo $college_degree ?>" data-collegeGraduated="<?php echo $college_graduated ?>" data-collegeHonors="<?php echo $college_honor ?>" data-companyAddress="<?php echo $company_address ?>" data-mailingAddress="<?php echo $mailing_address ?>" data-batch="<?php echo $batch['Description']; ?>" data-currentwork="<?php echo $row['CurrentWork']; ?>" data-coursetitle="
                                                <?php
                                                if ($row['courseGraduated'] != "" || $row['courseGraduated'] != NULL) {
                                                    $query = "SELECT * FROM course WHERE id=" . $row['courseGraduated'] . "";

                                                    $queryc = mysqli_query($connection, $query);
                                                    $c = mysqli_fetch_array($queryc);
                                                    echo $c['title'];
                                                } else {
                                                    echo "Select";
                                                }
                                                ?>" data-yeargraduated="
                                                <?php
                                                $query = "SELECT * FROM batch WHERE Name=" . $row['studID'] . " order by id desc
                                                limit 1";
                                                $querybatch = mysqli_query($connection, $query);
                                                $batch = mysqli_fetch_array($querybatch);
                                                echo $batch['Description'];
                                                ?>" style='border-radius: 8px;  margin-right: 5px;' class="btn btn-primary edit_btn" style="<?php echo "display:" . $display ?>" data-toggle="modal" data-target="#updateadminprofile">
                                                    <i class="fas fa-edit"></i>
                                                </button>


                                                <button type="button" style='border-radius: 8px;' class="btn btn-danger delete" style="<?php echo "display:" . $display ?>" data-toggle="modal" data-target="#confirmModal" data-id="<?php echo $row['studID']; ?>">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
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
    </div>


    <?php
    include('../includes/footer.php');
    include('../includes/scripts.php');
    ?>
    <script>
        $(document).ready(function() {
            $("#last_id").val("<?php echo $last_id; ?>");
            $(".edit_btn").click(function() {
                $("#firstname").val($(this).data("fname"));
                $("#edit_id").val($(this).data("id"));
                $("#middlename").val($(this).data("mname"));
                $("#lastname").val($(this).data("lname"));
                $("#gender").html($(this).data("gender"));
                $("#birthday").val($(this).data("birthday"));
                $("#email").val($(this).data("email"));
                $("#contact-insert").val($(this).data("contact"));
                $("#address").html($(this).data("address"));
                $("#studentNo").val($(this).data("studno"));
                $("#batch").val($(this).data("batch"));
                $("#mailing_address").val("<?php echo $mailing_address; ?>");
                $("#company_address").val("<?php echo $company_address; ?>");
                $("#contact").val($(this).data("contact"));
                $("#telephone").val($(this).data("telephone"));
                $("#twitter").val($(this).data("twitter"));
                $("#facebook").val($(this).data("facebook"));
                $("#facebook").val($(this).data("facebook"));
                $("#elementary").val($(this).data("elementary"));
                $("#year_elementary").val("<?php echo $elementary_graduated; ?>");
                $("#honor_elementary").val("<?php echo $elementary_honor; ?>");
                $("#highschool").val($(this).data("highschool"));
                $("#year_highschool").val("<?php echo $highschool_graduated; ?>");
                $("#honor_highschool").val("<?php echo $highschool_honor; ?>");
                $("#college").val($(this).data("college"));
                $("#degree").val("<?php echo $college_degree; ?>");
                $("#year_college").val("<?php echo $college_graduated; ?>");
                $("#honor_college").val("<?php echo $college_honor; ?>");


                // alert($("#course").val())
                var courseChecker = $("#course").val();
                if (courseChecker != 0 || courseChecker != "0" || courseChecker != "Select") {
                    $("#course").val($(this).data("course"));
                    $("#course").html($(this).data("coursetitle"));
                } else {
                    $("#course").val(0);
                    $("#course").html("Select Course");

                }

                $("#schoolAttended").html($(this).data("school"));
                $("#currentWork").val($(this).data("currentwork"));
                // $("#password").val($(this).data("pass"));
                // $("#confirmpassword").val($(this).data("pass"));
                $("#yeargraduated").val($(this).data("yeargraduated"));


                $("#studStatus").html($(this).data("studstatus"));
                $("#studDes").val($(this).data("studdes"));
                $("#studOR").val($(this).data("studor"));
                $("#studDate").val($(this).data("studdate"));
                $("#studRemarks").val($(this).data("studremarks"));
                $("#testSchoolIDedit").val($(this).data("interest"));
                $('#schoolAttended').data('id', $(this).data("interest")); //setter

                // alert($(this).data("studstatus"))


            });

            $(".view_btn").click(function() {
                var full = $(this).data("fname") + " " + $(this).data("mname") + " " + $(this).data("lname");
                let photo;
                if ($(this).data("photo") == " ") {
                    photo = "/alumni/students/profilePic/userPic.jpg";
                } else {
                    photo = "/alumni/students/" + $(this).data("photo");
                }

                $("#pic").attr("src", photo);
                $("#fullname_view").html("Name: " + full);
                $("#birthday_view").html("Date of birth: " + $(this).data("birthday"));
                $("#gender_view").html("Gender: " + $(this).data("gender"));
                $("#email_view").html("Email Address:  " + $(this).data("email"));
                $("#address_view").html("Address:  " + $(this).data("address"));
                $("#contanct_view").html("Contact #:  " + $(this).data("contact"));
                $("#course_view").html("Course:  " + $(this).data("coursetitle"));
                $("#schoolAttended_view").html("School:  " + $(this).data("school"));
                $("#yeargraduated_view").html("Graduated Year:  " + $(this).data("yeargraduated"));
                $("#currentWork_view").html("Current Work:  " + $(this).data("currentwork"));
            });

            $("#contact_insert").blur(function() {
                if ($(this).val().length > 10) {
                    // Enable submit button
                    $("#alumniInsert").removeAttr('disabled');
                    $("#error").empty();
                } else {
                    // Disable submit button
                    $("#alumniInsert").attr('disabled', 'disabled');
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
                    $("#alumniEdit").removeAttr('disabled');
                    $("#error_edit").empty();
                } else {
                    // Disable submit button
                    $("#alumniEdit").attr('disabled', 'disabled');
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
                    $("#error_edit").empty();
                    $("#alumniEdit").attr('disabled', 'disabled');
                    $("#error_edit").append(`
                <div class="alert alert-danger" role="alert">
                    Password and Confirm password doesn't match!
                </div>
                `);

                } else {
                    $("#alumniEdit").removeAttr('disabled');
                    $("#error_edit").empty();
                }

            });
            $("#password_insert,#confirmpassword_insert").keyup(function() {
                var pass = $("#password_insert").val();
                var cpass = $("#confirmpassword_insert").val();
                if (pass != cpass) {
                    $("#error").empty();
                    $("#alumniInsert").attr('disabled', 'disabled');
                    $("#error").append(`
                <div class="alert alert-danger" role="alert">
                    Password and Confirm password doesn't match!
                </div>
                `);

                } else {
                    $("#alumniInsert").removeAttr('disabled');
                    $("#error").empty();
                }

            });
            $(".delete").click(function() {
                $("#delete_id").val($(this).data("id"));

            });
            $("#schooolDataID").change(function() {
                var id = $(this).find(':selected').data('id');
                $("#testSchoolID").val(id);

            });
            $("#schooolDataIDedit").change(function() {
                var id = $(this).find(':selected').data('id');
                $("#testSchoolIDedit").val(id);

            });
            $("#schooolDataIDbulk").change(function() {
                var id = $(this).find(':selected').data('id');
                $("#testSchoolIDbulk").val(id);

            });


        });

        function edValueKeyPress() {
            var edValue = document.getElementById("edValue");
            var s = edValue.value;

            var lblValue = document.getElementById("lblValue");

            if (s >= 48 && s <= 57)

                // to check whether pressed key is number or not 
                return true;


            else return false;

        }

        //check all function

        function select_all() {
            if (jQuery('#delete').prop("checked")) {
                jQuery('input[type=checkbox]').each(function() {
                    jQuery('#' + this.id).prop('checked', true);
                });
            } else {
                jQuery('input[type=checkbox]').each(function() {
                    jQuery('#' + this.id).prop('checked', false);
                });
            }
        }


        $(function() {
            $(".checkbox").click(function() {
                $('#del').prop('disabled', $('input.checkbox:checked').length == 0);
            });
        });

        $(function() {
            $(".checkboxtop").click(function() {
                $('#del').prop('disabled', $('input.checkbox:checked').length == 0);
            });
        });
    </script>
    <style>
        .error {
            background: #F2DEDE;
            color: A94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
        }
    </style>