<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pizzata | Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin.css" />
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <?php
    include("admin_header.php");
    include("util/alert.php");

    if (!isset( $_SESSION['admin'])) {
        header("location: login_admin.php");
        exit();
    }
    if (isset($_COOKIE['showAlert']) && isset($_COOKIE['signup'])  && $_COOKIE['signup']== true) {
        showAlert('admin account created successfully', 'success');
        setcookie('signup', false);
        setcookie('showAlert', false);
    }
    if (isset($_COOKIE['showAlert']) &&  isset($_COOKIE['login'])  && $_COOKIE['login']== true) {
        showAlert('you are logged in', 'success');
        setcookie('login', false);
        setcookie('showAlert', false);
    }

    ?>
    <h2 class="med-font center my-2">DASHBOARD</h2>
    <div class="container">
        <div class="grid gap-2 gtc-3">
            <div class="col rounded-6 p-1 shadow-light">
                <p class="flex space-between item-center">
                    <span class="counts exsmall-font weight-500 center">
                        <?php
                        $sql = "SELECT * FROM `pizza_orders` WHERE `order_status` = 'pending'";
                        $res = mysqli_query($conn, $sql);
                        $pricePending = 0;
                        if ($res) {
                            echo mysqli_num_rows($res);
                            while ($row = mysqli_fetch_assoc($res)) {
                                $pricePending += $row['payment'];
                            }
                        } else {
                            echo '0';
                        }
                        ?>
                    </span>
                    <span class="counts  weight-500 center">Total Price <b class="price">
                            <?php
                            if ($pricePending) {
                                echo "$pricePending" . ".00";
                            } else {
                                echo '0.00';
                            }
                            ?>
                        </b>
                    </span>
                </p>

                <p class="box-sm">all Orders To be Delivered</p>
                <a href="/pizzashop/admin/orders_admin.php" class="btn max">Pending Orders</a>
            </div>
            <div class="col rounded-6 p-1 shadow-light">
                <p class="flex space-between item-center">
                    <span class="counts exsmall-font weight-500 center">
                        <?php
                        $sql = "SELECT * FROM `pizza_orders` WHERE `order_status` = 'placed'";
                        $res = mysqli_query($conn, $sql);
                        $pricePlaced = 0;
                        if ($res) {
                            echo mysqli_num_rows($res);
                            while ($row = mysqli_fetch_assoc($res)) {
                                $pricePlaced += $row['payment'];
                            }
                        } else {
                            echo '0';
                        }
                        ?>
                    </span>
                    <span class="counts  weight-500 center">Total Price <b class="price">
                            <?php
                            if ($pricePlaced) {
                                echo "$pricePlaced" . ".00";

                            } else {
                                echo '0.00';
                            }
                            ?>
                        </b>
                    </span>
                </p>
                <p class="box-sm">all orders that are placed in</p>
                <a href="/pizzashop/admin/orders_admin.php" class="btn max">Placed Orders</a>
            </div>
            <div class="col rounded-6 p-1 shadow-light">
                <p class="flex space-between item-center">
                    <span class="counts exsmall-font weight-500 center">
                        <?php
                        $sql = "SELECT * FROM `pizza_orders` WHERE `order_status` = 'completed'";
                        $res = mysqli_query($conn, $sql);

                        $priceCompleted = 0;
                        if ($res) {
                            echo mysqli_num_rows($res);
                            while ($row = mysqli_fetch_assoc($res)) {
                                $priceCompleted += $row['payment'];
                            }
                        } else {
                            echo '0';
                        }
                        ?>
                    </span>
                    <span class="counts  weight-500 center">Total Price <b class="price">
                            <?php
                            if ($priceCompleted) {
                                echo "$priceCompleted" . ".00";
                            } else {
                                echo '0.00';
                            }
                            ?>
                        </b>
                    </span>
                </p>
                <p class="box-sm">all Completed Orders</p>
                <a href="/pizzashop/admin/orders_admin.php" class="btn max">Completed Orders</a>
            </div>
            <div class="col rounded-6 p-1 shadow-light">
                <p class="center">
                    <span class="counts exsmall-font weight-500 center">
                        <?php
                        $sql = "SELECT * FROM pizzas";
                        $res = mysqli_query($conn, $sql);
                        if ($res) {
                            echo mysqli_num_rows($res);
                        } else {
                            echo '0';
                        }
                        ?>
                    </span>
                </p>
                <p class="box-sm">all added Products</p>
                <a href="/pizzashop/admin/products.php" class="btn max">Products</a>
            </div>
            <div class="col rounded-6 p-1 shadow-light">
                <p class="center">
                    <span class="counts exsmall-font weight-500 center">
                        <?php
                        $sql = "SELECT * FROM users";
                        $res = mysqli_query($conn, $sql);
                        if ($res) {
                            echo mysqli_num_rows($res);
                        } else {
                            echo '0';
                        } ?>
                    </span>
                </p>
                <p class="box-sm">all User Accounts</p>
                <a href="/pizzashop/admin/users.php" class="btn max">Users</a>
            </div>
            <div class="col rounded-6 p-1 shadow-light">
                <p class="center">
                    <span class="counts exsmall-font weight-500 center">
                        <?php
                        $sql = "SELECT * FROM admins";
                        $res = mysqli_query($conn, $sql);
                        if ($res) {
                            echo mysqli_num_rows($res);
                        } else {
                            echo '0';
                        } ?>
                    </span>
                </p>
                <p class="box-sm">all admin Accounts</p>
                <a href="/pizzashop/admin/admins.php" class="btn max">Admins</a>
            </div>
        </div>
    </div>
</body>
<script src="js/main.js"></script>

</html>