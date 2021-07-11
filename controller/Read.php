
// VIEW SINGLE USER RECORDS

<?php

session_start();
include "../database/config.php";

if (isset($_POST['checking_viewbtn'])) {

    $u_id = $_POST['users_id'];

    $sql = "SELECT * FROM info WHERE ID='$u_id'";

    $query = mysqli_query($con,$sql);

    if (mysqli_num_rows($query) > 0) {
        
        foreach ($query as $row) {
            echo $return = '
                <p>: &nbsp; &nbsp; '.$row["Name"]. '</p>
                <p>: &nbsp; &nbsp;' . $row["Email"] . '</p>
                <p>: &nbsp; &nbsp;' . $row["Gender"] . '</p>
                <p>: &nbsp; &nbsp;' . $row["Status"] . '</p>
            ';
        }
    }else {
        echo "no record";
    }
}

?>