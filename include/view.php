<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="icon" href="../assets/icon/icon.png">
    <link rel="stylesheet" href="../assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
</head>

<body>

    <div id="shadow">
        <!-- background blur id -->

        <!-- HEADER -->

        <!-- <section class="header">
                <h2>CRUD Application</h2>
            </section> -->

        <section class="container">
            <div class="nav">
                <a href="../index.php">New User <i class="fas fa-user"></i></a>
            </div>
            <div class="form-title" style="margin-top:20px;">
                <h2>User Management System</h2>
            </div>
        </section>

        <!-- END OF HEADER -->

        <!-- Error and Success Msg -->

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

        <!-- End of Msg -->


        <!-- FILTER/SEARCH -->

        <div class="filter">
            <p></p>
            <form action="view.php" method="GET">
                <div>
                    <input type="text" name="key" placeholder="search">
                    <a href="view.php"><i class="fas fa-sync-alt"></i></a>
                </div>
            </form>
        </div>

        <!-- END OF FILTER/SEARCH -->


        <!-- DISPLAY USER RECORD AND FILTER/SEARCH PHP SCRIPT -->


        <?php

        include "../database/config.php";

        @$k = $_GET['key'];
        $terms = explode(" ", $k);
        $i = 0;

        $query = "SELECT * FROM info WHERE";
        foreach ($terms as $each) {
            $i++;

            if ($i == 1) {
                $query .= " Name LIKE '%$each%' ";
            } else {
                $query .= " OR Status LIKE '%$each%'  ";
            }
        }
        $qry = mysqli_query($con, $query);
        $result1 = mysqli_num_rows($qry);
        $num = 1;

        ?>

        <table class="table">
            <thead class="thead">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>@Email</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                if ($result1 > 0) {
                    while ($row = $qry->fetch_assoc()) {
                        $id = $row['ID'];
                        $name = $row['Name'];
                        $email = $row['Email'];
                        $gender = $row['Gender'];
                        $status = $row['Status'];

                ?>

                        <tr id="items">
                            <td style="display: none;" class="user_id"><?php echo $id ?></td>

                            <td><?php echo $num++; ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $gender ?></td>
                            <td><?php echo $status ?></td>
                            <td>
                                <a href="#?ID=<?php echo $id ?>" onclick="toggle()" class="btn viewBtn"><i class="fas fa-book-reader"></i></a>
                                <a href="update.php?ID=<?php echo $id ?>" class="btn"><i class="fas fa-pen"></i></a>
                                <a href="../controller/Delete.php?ID=<?php echo $id ?>" class="btn"><i class="fas fa-times-circle"></i></a>
                            </td>
                        </tr>

                <?php
                    }
                } else {
                    echo "<h2 style='text-align:center; padding:10px 0px;'>No Record Found " . @$_GET['key'] . "</h2>";
                }

                ?>
            </tbody>
        </table>

        <!-- END OF SCRIPT -->



    </div>




    <!-- READ USER DETAILS -->

    <section class="detail_container" id="popup">
        <i class="fas fa-times-circle" onclick="toggle();"></i>
        <div class="detail">
            <div class="detail_title">User Detail</div>
            <div class="detail-grid">
                <div class="detail_box">
                    <h3>Name</h3>
                    <h3>Email</h3>
                    <h3>Gender</h3>
                    <h3>Status</h3>
                </div>
                <div class="user_viewing_data">
                    <p>dkjkjdg</p>
                </div>
            </div>
        </div>
    </section>

    <!-- END OF USER DETAILS -->



    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/jquery.min.js"></script>


    <!-- POP-UP USER VIEW DETAILS -->
        <script>
            function toggle() {
                var shadow = document.getElementById('shadow');
                shadow.classList.toggle('active')
                var popup = document.getElementById('popup');
                popup.classList.toggle('active');
            }
        </script>
    <!-- END OF POP-UP -->


    <!-- USER VIEW SINGLE RECORD FILTER  -->

        <script>
            $(document).ready(function() {
                $(".viewBtn").click(function(e) {
                    e.preventDefault();

                    var user_id = $(this).closest('tr').find('.user_id').text();
                    //    console.log(user_id);
                    $.ajax({
                        type: "POST",
                        url: "../controller/Read.php",
                        data: {
                            'checking_viewbtn': true,
                            'users_id': user_id,
                        },
                        success: function(response) {
                            // console.log(response);
                            $('.user_viewing_data').html(response);
                        }
                    })

                });
            });
        </script>
    
    <!-- END  -->


</body>

</html>