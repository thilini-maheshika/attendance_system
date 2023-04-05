<?php

session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['teacher']) && !isset($_SESSION['student'])) {
    echo '<script>window.location.href = "sign-in.php"</script>';
}


?>
