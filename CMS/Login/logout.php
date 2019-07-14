<?php
    ob_start();
    session_start();
    header('Location: Login.php');
    session_destroy();

?>