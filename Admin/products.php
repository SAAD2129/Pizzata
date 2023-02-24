<?php
include("admin_header.php");
include("util/alert.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // _POST is a global variable
    $name = $_POST['productname'];
    $price = $_POST['productprice'];
    $stock = $_POST['productstock'];

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $sql = "INSERT INTO `pizzas` ( `pizza_name`, `pizza_image`, `pizza_price`, `createdAt`, `pizza_stock`) VALUES ('$name', '$image', '$price', current_timestamp(), '$stock')";
    $isSubmitted = mysqli_query($conn, $sql);
    // echo var_dump($isSubmitted);
    if ($image_size > 200000) {
        showAlert('image size is too large', 'success');
    } else {
        if ($isSubmitted) {
            move_uploaded_file($image_tmp_name, $image_folder);
            showAlert('Product added successfully', 'success');
        } else {
            showAlert('500! Internal server error', 'error');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata Admin Panel | All Products </title>
    <link rel="stylesheet" href="css/admin.css" />
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="./alert.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <?php
    if (!isset($_SESSION['user'])) {
        header("location: login_admin.php");
        exit();
    }
    ?>
    <div class="container">

        <div class="my-3 center">
            <h2 class="my-2">Add Product</h2>
            <form action="products.php" method="post" enctype="multipart/form-data"
                class="form_product  shadow-light p-1 width-25 m-auto">
                <div class="my-1 with-100p">
                    <input type="text" required name="productname" placeholder="Product Name" class="plane width-100p">
                </div>
                <div class="my-1 with-100p">
                    <input type="text" required name="productprice" placeholder="Product Price"
                        class="plane width-100p">
                </div>
                <div class="my-1 with-100p">
                    <input type="text" required name="productstock" placeholder="Product Stock"
                        class="plane width-100p">
                </div>
                <div class="my-1 with-100p">
                    <input type="file" required accept="image/*" name="image" value="input file" class="width-100p">
                </div>
                <div class="mt-3 mb-1 center">
                    <input type="submit" value="ADD PRODUCT" class="btn">
                </div>
            </form>
        </div>
        <h2 class="small-font mb-3 center">PRODUCTS</h2>
        <div class="row">
            <?php
            $sql = "SELECT  * FROM pizzas";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col">
                        <img class="product-img" src="uploaded_img/' . $row['pizza_name'] . '.jpg" />
                        <div class="">
                     <p class="weight-500 my-min">' . $row['pizza_name'] . '</p>
                        <span class="main-color">Rs ' . $row['pizza_price'] . ' <small class="line-through color-gray">' . $row['pizza_price'] * 1.2 . '</small></span>
                    </div>
                        <div class="mt-min">
                        <p class="mt-min">
                        Product Stock
                        ' . $row['pizza_stock'] . '
                        </p>
                            </div>
                    </div>';
            }

            ?>
        </div>
    </div>
</body>
<script src="js/main.js"></script>

</html>