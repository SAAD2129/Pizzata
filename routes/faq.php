<?php
include("../partials/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata | Faq</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../user.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <div class="container mt-2">
        <h2 class="center">Frequently Asked Questions</h2>
        <h3 class="my-2">How can I get Pizzata delivery?</h3>
        <p>

            To get Pizzata delivery, simply locate the restaurants and shops near you by typing in your address,
            browse
            through a variety of restaurants and cuisines, check menus and prices, choose your dishes and add them to
            the
            basket. Now you only need to checkout and make the payment. Soon your delicious food will arrive at your
            doorstep!
        </p>
        <h3 class="my-2">Which takeout restaurants open now near me?</h3>
        <p> You can check which takeout restaurants are open now near you by simply typing your address in the location
            bar
            on Pizzata and pressing search. You will see all the available restaurants and shops that deliver to your
            area. </p>

        <h3 class="my-2"> Does Pizzata deliver 24 hours?</h3>
        <p>

            Yes, Pizzata in Pakistan delivers 24 hours. However, many restaurants may be unavailable for a late-night
            delivery. Please check which places in Pakistan deliver to you within 24 hours by using your address. You
            can
            also order groceries 24 hours a day via pandamart.
        </p>
        <h3 class="my-2">
            Can you pay cash for Pizzata?
        </h3>
        <p>
            Yes, you can pay cash on delivery for Pizzata in Pakistan.
        </p>
        <h3 class="my-2">

            How can I pay Pizzata online?
        </h3>
        <p>
            You can pay online while ordering at Pizzata Pakistan by using a credit or debit card or PayPal.
        </p>
        <h3 class="my-2">
            Can I order Pizzata for someone else?
        </h3>
        <p>
            Yes, Pizzata Pakistan allows you to place an order for someone else. During checkout, just update the name
            and
            delivery address of the person you're ordering for. Please keep in mind that if the delivery details are not
            correct and the order cannot be delivered, we won't be able to process a refund.
            How much does Pizzata charge for delivery?
            Delivery fee charged by Pizzata in Pakistan depends on many operational factors, most of all - location and
            the restaurant you are ordering from. You can always check the delivery fee while forming your order.
            Besides,
            you can filter the restaurants by clicking on the "Free Delivery" icon at the top of your restaurant
            listing.
        </p>
        <h3 class="my-2">
            What restaurants let you order online?
        </h3>
        <p>
            There are hundreds of restaurants on Pizzata Pakistan that let you order online. For example, KFC,
            McDonald's,
            Pizza Hut, OPTP, Hardee's, Domino's, Kababjees and many-many more! In order to check all the restaurants
            near
            you that deliver, just type in your address and discover all the available places.
        </p>
        <h3 class="my-2">
            Does Pizzata have minimum order?
        </h3>
        <p>
            Yes, many restaurants have a minimum order. The minimum order value depends on the restaurant you order from
            and
            is indicated during your ordering process.
        </p>
        <h3 class="my-2">
            What is the difference between delivery and Pick-Up?
        </h3>
        <p>
            If you choose delivery, a Pizzata rider will collect your order from the restaurant and take it to your
            chosen
            delivery address. If you choose Pick-Up, you can takeaway your food directly from the restaurant for extra
            savings – and to jump to the front of the queue. Pick-Up orders are available for restaurants only.
        </p>
    </div>
    <?php
    include("footer.php");
    ?>
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