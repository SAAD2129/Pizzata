<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pizzata Admin Panel | Admin Accounts </title>
    <link rel="stylesheet" href="css/admin.css" />
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <?php
    include("admin_header.php");
    include("util/alert.php");
    if (!isset($_SESSION['user'])) {
        header("location: login_admin.php");
        exit();
    }
    $sql = "SELECT * FROM admins";
    $result = mysqli_query($conn, $sql);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // _POST is a global variable
        $id = $_POST['_id'];
        $sql = "DELETE FROM `admins` WHERE `admin_id` = '$id'";
        $isSubmitted = mysqli_query($conn, $sql);
        if ($isSubmitted) {
            showAlert('admin account removed', 'success');
            $isSubmitted = false;
            echo '<script>location.href = "/pizzashop/admin/admins.php"</script>';
        } else
            showAlert('500! internal server error', 'error');
    }
    ?>
    <div class="container">
        <div class="row-3">
            <?php
            $adminsExist = false;

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['admin_name'] != $_SESSION['user']) {
                    $adminsExist = true;
                    echo ' <div class="col rounded-6 p-1 shadow-light">
                    <p class="my-1">User id : ' . $row['admin_id'] . ' </p>
                    <p class="my-1">User Name : ' . $row['admin_name'] . ' </p>
                    <form action="admins.php" method="post">
                        <input name="_id" type="number" hidden value=' . $row['admin_id'] . ' >
                        <input type="submit" class="btn btn-1" value="DELETE" >
                        </from>
                    </div>';
                }
            }


            ?>
            <div class="col rounded-6 p-1 shadow-light">
                <p class="box-sm mb-1">add a new admin Account</p>
                <a href="/pizzashop/admin/register_admin.php" class="btn my-min">Register Admin</a>
            </div>
        </div>
        <?php
        if (!$adminsExist) {
            echo '<div class="center mt-7"><h2>
                    No Admins to show
                </h2> </div>';
        }
        ?>
    </div>
</body>
<script src="js/main.js"></script>


</html>