<!DOCTYPE html>
<html lang="en">
<?php
include("admin_header.php");
include("util/alert.php");

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata Admin Panel | Update Product </title>
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/util.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <?php
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM `pizzas` WHERE `pizza_id` = '$product_id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    echo var_dump($row);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // _POST is a global variable
        $name = $_POST['productname'];
        $price = $_POST['productprice'];
        $stock = $_POST['productstock'];
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/' . $image;
        if ($image) {
            $sql = "UPDATE `pizzas` SET `pizza_name` = '$name', `pizza_$image` = '$image', `pizza_price` = '$price', `pizza_stock` = '$stock' WHERE `pizzas`.`pizza_id` = $product_id";
        } else {
            $sql = "UPDATE `pizzas` SET `pizza_name` = '$name', `pizza_price` = '$price', `pizza_stock` = '$stock' WHERE `pizzas`.`pizza_id` = $product_id";
        }
        $isSubmitted = mysqli_query($conn, $sql);
        if ($image_size > 200000) {
            showAlert('image size is too large', 'success');
        } else {
            if ($isSubmitted) {
                if($image)
                    move_uploaded_file($image_tmp_name, $image_folder);
                showAlert('Product updated successfully', 'success');
            } else {
                showAlert('500! Internal server error', 'error');
            }
        }
    }
    echo '<div class="form">
    <form action="/pizzashop/admin/update_product.php/?id='.$product_id.'" method="post" enctype="multipart/form-data">
        <h2 class="my-2 center">Update Product</h2>
        <div class="my-1 with-100p">
            <input type="text" name="productname" required value="' . $row['pizza_name'] . '" placeholder="Product Name" class="p-1 width-100p">
        </div>
        <div class="my-1 with-100p">
            <input type="number" required value="' . $row['pizza_price'] . '" name="productprice" placeholder="Product Price" class="p-1 width-100p">
        </div>
        <div class="my-1 with-100p">
            <input type="number" required value="' . $row['pizza_stock'] . '" name="productstock" placeholder="Product Stock" class="p-1 width-100p">
        </div>
        <div class="my-1 with-100p">
            <input type="file" accept="image/*" name="image" value="input file" class="width-100p">
        </div>
        <div class="mt-3 mb-1 center">
            <input type="submit" value="UPDATE" class="btn">
        </div>
    </form>
</div>'
        ?>

</body>

</html>