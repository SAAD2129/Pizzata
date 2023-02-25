<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata Admin Panel | Users  </title>
    <link rel="stylesheet" href="css/admin.css" />
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

</head>

<body>
    <?php
    include("admin_header.php");
    if(!isset($_SESSION['admin'])){
        header("location: login_admin.php");
        exit();
    }
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    ?>
    <div class="container">
        <div class="row-3">

            <?php
            $usersExist = false;
            while ($row = mysqli_fetch_assoc($result)) {
                    $usersExist = true;
                    echo ' <div class="col rounded-6 p-1 shadow-light">
                    <div class="text-left pl-min">
                    <p class="my-1">User Id : ' . $row['user_id'] . ' </p>
                    <p class="my-1">User Email : ' . $row['user_email'] . ' </p>
                    <p class="my-1">User Name : ' . $row['user_name'] . ' </p></div>
                     <a href="/pizzashop/admin/delete_admin.php?id=$" class="btn btn-1">DELETE</a>
                 </div>';
            }
            if(!$usersExist){
                echo '<div class="center mt-7"><h2>
                    No Users to show
                </h2> </div>';
            }
            ?>
        </div>
    </div>
</body>
<script src="js/main.js"></script>

</html>