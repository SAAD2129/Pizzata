<?php
include("admin_header.php");
include("util/alert.php");

if (isset($_SESSION['showAlert']) && $_SESSION['product_remove'] && $_SESSION['showAlert']) {
    showAlert('Product deleted successfully', 'success');
    unset($_SESSION['showAlert']);
    unset($_SESSION['product_remove']);
} else if (isset($_SESSION['showError']) && $_SESSION['showError']) {
    showAlert('500! Internal server error', 'error');
    unset($_SESSION['showError']);
}

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
    if (!isset($_SESSION['admin'])) {
        header("location: login_admin.php");
        exit();
    }
    ?>
    <div class="form">
        <form action="products.php" method="post" enctype="multipart/form-data">
            <h2 class="my-2 center">Add Product</h2>
            <div class="my-1 with-100p">
                <input type="text" required name="productname" placeholder="Product Name" class="p-1 width-100p">
            </div>
            <div class="my-1 with-100p">
                <input type="number" required name="productprice" placeholder="Product Price" class="p-1 width-100p">
            </div>
            <div class="my-1 with-100p">
                <input type="number" required name="productstock" placeholder="Product Stock" class="p-1 width-100p">
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
    <div class="container">

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
                            <div class="flex space-around item-center  mt-1">
                                <a href="/pizzashop/admin/del_product.php/?id=' . $row['pizza_id'] . '">
                                    <i type="submit" class="uil main-color small-font uil-trash"></i>
                                </a>
                                <a href="update_product.php/?id=' . $row['pizza_id'] . '" class="btn block width-50p rounded-full">Edit</a>
                            </div>
                    </div>';
            }

            ?>
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
    let showHideBtns = Array.from(document.querySelectorAll(".showHide"));
    let passwds = Array.from(document.querySelectorAll(".passwd"));
    console.log(passwds)
    passwds.forEach(passwd => {
        passwd.addEventListener('input', (e) => {
            if (e.target.value.length > 0) {
                passwd.nextElementSibling.style.display = 'block';
            } else {
                passwd.nextElementSibling.style.display = 'none';
            }
        })
    })
    showHideBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            let sib = btn.previousElementSibling;
            if (sib.type == "text") {
                sib.type = "password";
                btn.innerText = "SHOW";
            } else {
                sib.type = "text";
                btn.innerText = "HIDE";
            }
        })

    });
    dropDown.addEventListener("click", () => {
        drop.classList.toggle('active');
    });</script>
<script src="js/main.js"></>

</html >