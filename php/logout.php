<?php
    session_start();
    unset($_SESSION['logged_user']);
    unset($_SESSION['logged_admin']);
    header('Location: ../index.php');