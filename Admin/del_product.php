<?php
include("admin_header.php");
$id = $_GET['id'];
$sql = "DELETE FROM pizzas WHERE `pizzas`.`pizza_id` = $id";
$isSubmitted = mysqli_query($conn, $sql);
// echo var_dump($isSubmitted);

if ($isSubmitted) {
    $_SESSION['showAlert'] = true;
    $_SESSION['product_remove'] = true;
    echo '<script>location.href = "/pizzashop/admin/products.php"</script>';
} else {
    $_SESSION['showError'] = true;
    echo '<script>location.href = "/pizzashop/admin/products.php"</script>';

}

?>