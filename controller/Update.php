
// UPDATE

<?php

session_start();
include "../database/config.php";

if (isset($_POST['update'])) {

    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];


    $sql = "UPDATE info SET Name='$name', Email='$email', Gender='$gender', Status='$status' WHERE ID='$id'";
    $query = mysqli_query($con, $sql) or die("error");

    if ($query) {
        $_SESSION['successMsg'] = "Data Updated successfully";
        header("location:../include/update.php");
    } else {
        $_SESSION['errMsg'] = "<strong>Error</strong> data not updated! ";
        header("location:../include/update.php");
    }
}

?>