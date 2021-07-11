<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="icon" href="../assets/icon/icon.png">
    <link rel="stylesheet" href="../assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
</head>

<body>


    <!-- HEADER -->

        <section class="header">
            <h2>CRUD Application</h2>
        </section>

        <section class="container">
            <div class="nav">
                <a href="view.php"><i class="fas fa-angle-double-left"></i> All Users</a>
            </div>
            <div class="form-title">
                <h2>Update User</h2>
                <p>Use the below form to update an account</p>
            </div>
        </section>

    <!-- END OF HEADER -->

    <!-- ERROR AND SUCCESS MSG DISPLAY -->

        <?php if (isset($_SESSION['successMsg'])) { ?>

            <div class="success" id="closeMsg">
                <div><?php echo $_SESSION['successMsg']; ?></div>
                <i class="fas fa-times-circle"></i>
            </div>

        <?php
            unset($_SESSION['successMsg']);
        }
        ?>
    
        <?php if (isset($_SESSION['errMsg'])) { ?>

            <div class="error" id="closeMsg">
                <div><?php echo $_SESSION['errMsg']; ?></div>
                <i class="fas fa-times-circle"></i>
            </div>

        <?php
            unset($_SESSION['errMsg']);
        }
        ?>

    <!-- END OF MSG -->

    
    
    
    <!-- UPDATE FORM AND PHP SCRIPT -->
    
    
        <?php

        include "../database/config.php";

        if (isset($_GET['ID'])) {

            $update_user_id = $_GET['ID'];

            $sql = "SELECT * FROM info WHERE ID='$update_user_id'";
            $query = $con->query($sql);


            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
                    $user_id = $row['ID'];
                    $name = $row['Name'];
                    $email = $row['Email'];
                    $gender = $row['Gender'];
                    $status = $row['Status'];
                }
        ?>


                <section class="formBx">
                    <form action="../controller/Update.php" method="POST" class="form">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <div class="form_div">
                            <input type="text" name="name" value="<?php echo $name; ?>" class="form_input" placeholder=" " required>
                            <label class="form_label">Name</label>
                        </div>
                        <div class="form_div">
                            <input type="email" name="email" value="<?php echo $email; ?>" class="form_input" placeholder=" " required>
                            <label class="form_label">Email</label>
                        </div>
                        <div class="form_div">
                            <label for="gender" class="label">Gender</label>
                            <div class="radio inline">
                                <input type="radio" id="radio-1" name="gender" value="Male" required <?php if ($gender == 'Male') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                <label for="radio-1" class="radio-label">Male</label>
                            </div>
                            <div class="radio inline">
                                <input type="radio" id="radio-2" name="gender" value="Female" required <?php if ($gender == 'Female') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                <label for="radio-2" class="radio-label">Female</label>
                            </div>
                        </div>
                        <div class="form_div">
                            <label for="gender" class="label">Status</label>
                            <div class="radio inline">
                                <input type="radio" id="radio-3" name="status" value="Active" required <?php if ($status == 'Active') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                <label for="radio-3" class="radio-label">Active</label>
                            </div>
                            <div class="radio inline">
                                <input type="radio" id="radio-4" name="status" value="Inactive" required <?php if ($status == 'Inactive') {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                <label for="radio-4" class="radio-label">Inactive</label>
                            </div>
                        </div>
                        <button type="submit" name="update" class="saveBtn">Update</button>

                    </form>
                </section>

        <?php


            } else {
                echo "error";
            }
        }

        ?>

    
    <!-- END OF UPDATE PHP SCRIPT  -->


    <script src="../assets/js/script.js"></script>

</body>

</html>