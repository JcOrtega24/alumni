<?php
session_start();
include "../dbconfig.php";
if (!$_SESSION['username']) {
    header('Location: ../login.php');
} else {

    $username = $_SESSION['username'];
    $query = "SELECT *, accounts.id as Accounts_ID, branch.Name as Branch_Name, branch.Address as Branch_Address, departments.Name as Department_Name
            FROM accounts 
            left join branch 
            on accounts.BranchID = branch.id
            left join departments
            on accounts.DepartmentId = departments.id
            where Username ='$username'";
    $query_run = mysqli_query($connection, $query);
    $user = mysqli_fetch_array($query_run);
}
