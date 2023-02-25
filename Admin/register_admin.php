<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata Admin Panel | Register Admin Account </title>
    <link rel="stylesheet" href="css/admin.css" />
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

</head>

<body>
    <?php
    include("admin_header.php");
    include("util/alert.php");
    if (!isset($_SESSION['admin'])) {
        header("location: /pizzashop/admin/login_admin.php");
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // _POST is a global variable
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM `admins` WHERE `admin_name = '$name'";
        $res = mysqli_query($conn, $sql);
        // echo $res;
        if (!$res) {
            $sql = "INSERT INTO `admins` (`admin_name`, `admin_password`,`role`) VALUES ('$name', '$hash', 'admin')";
            $res = mysqli_query($conn, $sql);
            // $_SESSION['admin'] = $name;
            setcookie('showAlert', true);
            setcookie('signup', true);
            echo ' <script>
                location.href =  "/pizzashop/admin/";
            </script>';
        } else {
            showAlert('user already exist', 'error');
        }
    }
    ?>

    <div class="form">
        <form action="register_admin.php" method="post">
            <h2 class="my-2 center">Sign For an Admin Account</h2>
            <div class="my-1 with-100p">
                <input type="text" name="username" required minlength="5" maxlength="15" placeholder="Admin Name"
                    class=" p-1  width-100p">
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="password" required minlength="8" maxlength="20" placeholder="your password"
                    class=" passwd p-1 width-100p">
                <button role="button" type="button" class="showHide  d-none">SHOW</button>
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="cpassword" required minlength="8" maxlength="20"
                    placeholder="confirm password" class=" passwd p-1 width-100p">
                <button role="button" type="button" class="showHide  d-none">SHOW</button>
            </div>
            <div class="mt-2 mb-1 center">
                <input type="submit" value="REGISTER" class="btn">
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
    });

</script>

</html>