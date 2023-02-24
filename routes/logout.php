<?php
include("../partials/header.php");
session_unset();
session_destroy();
setcookie('logout', true);
setcookie('user', null);
setcookie('showAlert', true);
echo '
<script>
    location.href = "/pizzashop/routes/login.php";
</script>
'
    ?>