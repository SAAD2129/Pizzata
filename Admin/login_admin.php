<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata | Login Admin Account</title>
    <link rel="stylesheet" href="css/admin.css" />
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

</head>

<body>
    <?php
    include("admin_header.php");
    include("util/alert.php");

    if (isset($_COOKIE['showAlert']) && isset($_COOKIE['logout']) && $_COOKIE['logout'] == true) {
        showAlert('Logout successful', 'success');
        setcookie('showAlert', false);
        setcookie('logout', false);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // _POST is a global variable
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM `admins` WHERE `admin_name` = '$name'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        if ($row) {
            $check = password_verify($pass, $row['admin_password']);
            // echo $check;
            if ($check) {
                $_SESSION['admin'] = $name;
                setcookie('user', $name);
                setcookie('login', true);
                setcookie('showAlert', true);
                echo '<script>location.href = "/pizzashop/admin/"</script>';
            } else {
                showAlert('invalid credentials', 'error');
            }
        } else {
            showAlert('invalid credentials', 'error');
        }
    }
    ?>
    <div class="form">

        <form action="login_admin.php" method="post" class="">
            <h2 class="my-2 center">Login to Admin Account</h2>
            <div class="my-1 with-100p">
                <input type="text" name="username" autocomplete="off" required placeholder="User Name"
                    class=" p-1 width-100p">
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="password" required placeholder="Password" class=" passwd p-1 width-100p">
                <button role="button" type="button" class="showHide  d-none">SHOW</button>

            </div>
            <div class="mt-2 mb-1 center">
                <input type="submit" value="LOGIN" class="btn">
            </div>
        </form>
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
<script src="js/main.js"></script>

</html>