<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata Admin Panel | Orders </title>
    <link rel="stylesheet" href="css/admin.css" />
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

</head>

<body>
    <?php
    include("admin_header.php");
    include("util/alert.php");
    if (!isset($_SESSION['admin'])) {
        header("location: login_admin.php");
        exit();
    }
    $sql = "SELECT * FROM pizza_orders";
    $res = mysqli_query($conn, $sql);
    $order = mysqli_fetch_assoc($res);
    if (isset($_POST['updateorder'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // _POST is a global variable
            $id = $_POST['order_id'];
            $orderStatus = $_POST['order_status'];
            $paymentStatus = $_POST['payment_status'];
            $sql = "UPDATE `pizza_orders` SET `order_status` = '$orderStatus' , `payment_status` = '$paymentStatus' WHERE `order_id` = $id";
            $isSubmitted = mysqli_query($conn, $sql);
            if ($isSubmitted) {
                showAlert('Order updated successfully', 'success');
            } else {
                showAlert('500! Internal server error', 'error');
            }
        }
    }
    ?>
    <div class="container">

        <div class="row-3">
            <?php
            $sql = "SELECT * FROM pizza_orders";
            $res = mysqli_query($conn, $sql);
            $prodExist = false;
            while ($order = mysqli_fetch_assoc($res)) {
                $prodExist = true;
                echo ' <div class="order_box">
                    <p class="my-1 text__color"><b class="my-1 text__color p-font ">User Name</b> <span class="ml-min">
                            ' . $order['order_user'] . '
                        </span></p>
                    <p class="my-1 text__color"><b class="my-1  p-font text__color">Total Products </b> <span class="ml-min">
                            ' . $order['total_products'] . '
                        </span></p>
                    <p class="my-1 text__color"><b class="my-1  p-font text__color">Contact </b> <span class="ml-min">
                            ' . $order['order_user_contact'] . '
                        </span></p>
                    <p class="my-1 text__color"><b class="my-1  p-font text__color">Address</b> <span class="ml-min">
                            ' . $order['address line01'] . ' , ' . $order['address line02'] . '
                        </span></p>
                    <p class="my-1 text__color"><b class="my-1 text__color p-font ">Total Price</b> <span class="ml-min">
                            ' . $order['payment'] . '
                        </span></p>
                    <p class="my-1 text__color"><b class="my-1 text__color p-font ">Payment Method </b> <span class="ml-min">
                            ' . $order['payment_method'] . '
                        </span></p>
                    <p class="my-1 text__color"><b class="my-1 text__color p-font ">Ordered At</b> <span class="ml-min">
                            ' . $order['placedAt'] . '
                        </span></p>
                    <p class="my-1 text__color"><b class="my-1 text__color p-font ">Payment Status At</b> <span class="ml-min">
                            ' . $order['payment_status'] . '
                        </span></p>
                        <form action="orders_admin.php" method="post">
                        
                        <div>
                    ';

                echo '</div>
                    <form action="orders_admin.php" method="post">
                        <input hidden value=" ' . $order['order_id'] . '" name="order_id" type="text" />
                       
                        <select name="order_status" id="order_status">
                            <option value="' . $order['order_status'] . '" selected>' . strtoupper($order['order_status']) . '</option>
                            <option value="pending">Pending</option>
                            <option value="placed">Placed</option>
                            <option value="completed">Completed</option>
                        </select>
                        <select name="payment_status" id="payment_status">
                            <option value="' . $order['payment_status'] . '" selected>' . strtoupper($order['payment_status']) . '</option>
                            <option value="pending">Pending</option>
                            <option value="un paid">Un Paid</option>
                            <option value="paid">Paid</option>
                        </select>
                        <div>';
                if ($order['order_status'] != 'completed') {
                    echo '<input class="btn btn-2 block m-auto ml-min bg-color" name="updateorder" value="UPDATE" type="submit" />';
                }
                echo '</div>
                    </form>

                </div>';
            }

            ?>
        </div>
    </div>
    <?php
    if (!$prodExist) {
        echo ' <div class="flex gap-2 content-center direction-col item-center mt-5">
                        <h2 class="large-font">No Orders yet</h2>
                    </div>';

    }
    ?>

</body>
<script src="js/main.js"></script>

</html>