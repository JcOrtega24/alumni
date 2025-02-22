<?php
include('../admin/security.php');
include('../alumni/security.php');
include "../dbconfig.php";

if (isset($_POST['login_btn'])) {
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];
    $query = "SELECT * FROM accounts WHERE Username = '$email_login'";
    $query_run = mysqli_query($connection, $query);

    // accounts found
    if (mysqli_num_rows($query_run) >= 1) {
        $result = mysqli_fetch_array($query_run);

        // accounts code
        if (password_verify($password_login, $result['Password'])) {
            $_SESSION['username'] = $email_login;
            $_SESSION['UserId'] = $result['Id'];
            $_SESSION['Usertype'] = $result['userData'];
            $fullname = $result['FirstName'] . " " . $result['MiddleName'] . " " . $result['LastName'];
            $_SESSION['Full_Name'] = $fullname;
            if ($result['userData'] == "Administrator") {

                $querylogs = "INSERT INTO logs (user,movement,movement_date,log_type) VALUES ('$email_login','User Logged In',now(),'Login')";
                $query_run_logs = mysqli_query($connection, $querylogs);
                if ($query_run_logs) {
                    header('Location: ../admin/index.php');
                }
            } else if ($result['userData'] == "Employee") {
                $querylogs = "INSERT INTO logs (user,movement,movement_date,log_type) VALUES ('$email_login','User Logged In',now(),'Login')";
                $query_run_logs = mysqli_query($connection, $querylogs);
                if ($query_run_logs) {
                    header('Location: ../admin/employeeIndex.php');
                }
            }
        } else {
            $_SESSION['error'] = 'Incorrect password';
            echo '<script>alert("Email / Password is Invalid")</script>';
            header('Location: ../login.php');
        }
    }
    // check for alumni
    else {
        $email = $_POST['email'];
        // echo $email;
        $password_login = $_POST['password'];
        $query = "SELECT * FROM alumni WHERE email = '$email'";
        $query_run = mysqli_query($connection, $query);
        $result = mysqli_fetch_array($query_run);
        // echo $query;
        if (password_verify($password_login, $result['password'])) {
            $_SESSION['email'] = $email;
            $query = "SELECT * FROM alumni WHERE email  = '$email' ";
            $query_run = mysqli_query($connection, $query);
            $user = mysqli_fetch_array($query_run);
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['middleName'] = $user['middleName'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['user'] = $user;
            $_SESSION['id'] = $user['id'];
            $_SESSION['Full_Name'] = $user['firstname'] . " " . $user['middleName'] . " " . $user['lastname'];
            header('Location: ../alumni/home.php');
        } else {
            $_SESSION['error'] = 'Incorrect password';
            echo '<script>alert("Email / Password is Invalid")</script>';
            header('Location: ../login.php');
        }
    }
}
