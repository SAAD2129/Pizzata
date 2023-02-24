<?php
session_start();
session_unset();
session_destroy();
setcookie('user', null);
setcookie('showAlert', true);
setcookie('logout', true);

?>

<script>
    location.href = "/pizzashop/admin/login_admin.php";
</script>