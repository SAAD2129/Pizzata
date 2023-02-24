<?php
function showAlert($msg, $type)
{
    echo '<div class="alert">
    <div class="line '.$type.'"></div>
    '.$msg.'
                <i class="uil close uil-times"  onClick="hideAlert()"></i>
    </div>
    <script>
    setTimeout(() => {
        document.querySelector(".alert").style.display="none";
    }, 2000);
    </script>
    ';
}

?>