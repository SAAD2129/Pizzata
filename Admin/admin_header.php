<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pizza shop');
// session_start();
if (!$conn) {
    echo '<h2>Connection Unsuccessful</h2>';
}
echo '
<header>
    <div class="logo">
        <h2><a href="/pizzashop/admin/">Admin<span >Pannel</span></a></h2>
    </div>
    <nav>
        <ul class="navigation flex">
            <li class="mx-min">
                <a class="p-min nav-links " href="/pizzashop/admin/">Home</a>
            </li>
            <li class="mx-min">
                <a class="p-min nav-links " href="products.php">products</a>
            </li>
            <li class="mx-min">
                <a class="p-min nav-links "  href="orders_admin.php">orders</a>
            </li>
            <li class="mx-min">
                <a class="p-min nav-links " href="admins.php">admins</a>
            </li>
            <li class="mx-min">
                <a class="p-min nav-links " href="users.php">users</a>
            </li>

        </ul>
    </nav>
    <div class="acounting">
        <i id="dropdown" class="uil pointer exsmall-font main-color
             uil-user"></i>
             <div class="drop">
             ';
if (!isset($_SESSION['user'])) {
    echo '
            <a href="/pizzashop/admin/login_admin.php" class=" max btn my-min">LOGIN</a>
            ';
            // <a href="/pizzashop/admin/register_admin.php" class=" max btn my-min">REGISTER</a>
} else {
    echo '<a href="/pizzashop/admin/logout.php" class="btn p-font my-min btn-1">LOGOUT</a>
    <a href="/pizzashop/admin/aboutme.php" class="btn p-font my-min btn-1">ABOUT ME</a>
            <a href="/pizzashop/admin/update_profile.php" class="btn p-font my-min btn-1 block max btn-dark">UPDATE PROFILE</a>';
}



echo '
             </div>
    </div>
</header>';
?>