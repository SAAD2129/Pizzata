<?php
// session_start();
if (!isset($_COOKIE['user'])) {
    header("location: /pizzashop/admin/login_admin.php");
    exit();
}
include("admin_header.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata Admin Panel | About Me </title>
    <link rel="stylesheet" href="../user.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>
    <div class="width-50p m-4auto">
        <H4>MY PROFILE</H4>
        <div class="mt-2">
            <fieldset class="plane width-75p my-1 rounded-6 px-1 font-color">
                <legend class="main-color">User Name</legend>
                <?php
                $name = $_SESSION['user'];
                $sql = "SELECT * FROM `admins` WHERE `admin_name` = '$name'";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $User = mysqli_fetch_assoc($res);
                    echo $User['admin_name'];
                }
                ?>
            </fieldset>
            <fieldset class="plane width-75p my-1 rounded-6 px-1 font-color">
                <legend class="main-color">Password</legend>
                <?php
                echo $User['admin_password'];
                ?>
            </fieldset>
        </div>
    </div>
</body>

<script>

    let Alert = document.querySelector(".alert");
    const hideAlert = () => {

        Alert.style.display = 'none';

    }
    let dropDown = document.querySelector("#dropdown");
    let drop = document.querySelector(".drop");

    dropDown.addEventListener("click", () => {
        drop.classList.toggle('active');
    });

</script>
<script src="../main.js"></script>

</html>