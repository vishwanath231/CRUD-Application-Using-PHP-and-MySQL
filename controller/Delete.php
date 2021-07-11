
// DELETE RECORDS


<?php

session_start();
include "../database/config.php";

// User Detele 

if (isset($_GET['ID'])) {

    $user_id = $_GET['ID'];

    $sql = "DELETE FROM info WHERE ID = '$user_id'";
    $query = mysqli_query($con, $sql);

    if ($query == true) {
        $_SESSION['successMsg'] = "Data Deteled";
        header("location:../include/view.php");
    } else {
        $_SESSION['successMsg'] = "Some <strong>Error</strong>";
        header("location:../include/view.php");
    }
}

?>