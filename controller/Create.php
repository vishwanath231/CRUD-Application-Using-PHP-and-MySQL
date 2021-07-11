
// INSERT NEW RECORD

<?php

session_start();
include "../database/config.php";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];

    $sql = "SELECT * FROM info WHERE Email='$email'";
    $query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($query);

    if ($count > 0) {

        
        $_SESSION['errMsg'] = "This <strong>Email</strong> alreay exit!";
        header("location:../index.php");
    } else {
        $sql = "INSERT INTO info(Name, Email, Gender, Status) VALUES ('$name','$email','$gender','$status')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            $_SESSION['successMsg'] = "Data Inserted successfully";
            header("location:../index.php");
        } else {
            $_SESSION['errMsg'] = "<strong>Error</strong> data not inserted! ";
            header("location:../index.php");
        }
    }

}


?>