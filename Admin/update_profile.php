<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- AdminPanel </title>
    <title>Pizzata Admin Panel | Update Admin Profile </title>

    <link rel="stylesheet" href="css/admin.css" />
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

</head>

<body>
    <?php
    include("admin_header.php");
    include("util/alert.php");
    if (!isset($_SESSION['user'])) {
        echo '<script>
            location.href = "/pizzashop/admin/login_admin.php";
        </script>';
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['username'];
        $opass = $_POST['opassword'];
        $cpass = $_POST['cpassword'];
        $pass = $_POST['password'];

        // hashing new pass
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        if ($cpass == $pass) {
            $sql = "SELECT * FROM `admins` WHERE `admin_name` = '$name'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $rows = mysqli_num_rows($res);
            if ($rows > 0) {
                $check = password_verify($opass, $row['admin_password']);
                if ($check) {
                    $sql = "UPDATE `admins` SET `admin_password` = '$hash' WHERE `admins`.`admin_name` = '$name'";
                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                        session_destroy();
                        session_unset();
                        setcookie('user', null);
                        setcookie('showAlert', true);
                        setcookie('logout', true);
                        showAlert('account updated successfully', 'success');
                    } else {
                        showAlert('error updating account', 'error');
                    }
                } else {
                    showAlert('invalid old password', 'error');
                }
            } else {
                showAlert('invalid user name', 'error');
            }


        } else {
            showAlert('passwords do not match', 'error');
        }
    }
    ?>
    <div class="container">
        <h2 class="my-2 center">Update Admin Profile</h2>
        <form action="update_profile.php" method="post" class="form_product  shadow-light p-1 width-25 m-auto">
            <div class="my-1 with-100p">
                <input type="text" name="username" maxlength="12" placeholder="admin name" class="plane p-1 width-100p">
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="opassword" autocomplete="off" maxlength="10" placeholder="Old Password"
                    class="plane passwd p-1 width-100p">
                <button role="button" type="button" class="showHide plane d-none">SHOW</button>
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="password" autocomplete="off" maxlength="10" placeholder="New Password"
                    class="plane passwd p-1 width-100p">
                <button role="button" type="button" class="showHide plane d-none">SHOW</button>
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="cpassword" autocomplete="off" maxlength="10"
                    placeholder="Confirm new password" class="plane passwd p-1 width-100p">
                <button role="button" type="button" class="showHide plane d-none">SHOW</button>
            </div>
            <div class="mt-2 mb-1 center">
                <input type="submit" value="UPDATE" class="btn">
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