<?php
session_start();
include "../dbconfig.php";
if (isset($_POST['changepass'])) {
    $id = $_POST['id'];
    $currentpw = $_POST['currentpw'];
    $newpw = $_POST['newpw'];
    $confrimpw = $_POST['confrimpw'];

    $query = "SELECT * FROM alumni WHERE id = '$id'";
    $query_run = mysqli_query($connection, $query);
    $result = mysqli_fetch_array($query_run);
    // echo $query;
    // echo $currentpw;
    // echo $result['password'];
    if (password_verify($currentpw, $result['password'])) {
        $_SESSION['success'] = "Password is now updated";
        if ($newpw === $confrimpw) {
            $pass = password_hash($newpw, PASSWORD_DEFAULT);
            $query = "UPDATE alumni SET 
                    password='$pass' ";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                $_SESSION['success'] = "Successfully Updated";

                echo '<script>window.location.replace("/alumni/alumni/home.php?Updated");</script>';
            }
        }
    } else {
        $_SESSION['error'] = 'Incorrect Current password';
        echo '<script>window.location.replace("/alumni/alumni/home.php?Changepass");</script>';
    }
}
if (isset($_POST['postContent'])) {


    $contentType = "Announcements";
    $Title = $_POST['title'];
    $Subtitle = $_POST['Subtitle'];
    $Description = $_POST['description'];
    $user = $_POST['id'];
    $userData = "Alumni";
    $file = $_POST['file'];
    $date = date('Ymd');
    $file = $_FILES['file']['name'];

    if (!empty($file)) {
        move_uploaded_file($_FILES['file']['tmp_name'], 'contents/' . $date . "-" . $file);
        $file = $file;
    } else {
        $file = "empty";
    }

    $picture = "contents/" . $date . "-" . $file;
    $query = "INSERT INTO events(id, Title, Subtitle, Description, Image, CreatedDate, CreatedUser, UserType, TypeOfContent, AllowPost)
            VALUES(
                null,
                '$Title',
                '$Subtitle',
                '$Description',
                '$picture',
                now(),
                '$user',
                '$userData',
                '$contentType',
                'Pending'
    
            )";

    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['notification'] = "Successfully Created";
        echo $update;
        header('Location: home.php');
    } else {
        $_SESSION['status'] = "Error on creation";
        header('Location: home.php');
    }
}



if (isset($_POST['deleteUserPost'])) {
    $id = $_POST['to-delete'];
    $query = "DELETE FROM events WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['deletenotif'] = "Successfully Created";
        header('Location: home.php');
    } else {
        $_SESSION['status'] = "Your post deletion was unsuccessful";
        header('Location: home.php');
    }
}
