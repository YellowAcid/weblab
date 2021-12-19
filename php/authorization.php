<?php
    session_start();
    require_once 'operationWithDataBase.php';
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $check = checkUser($mail, $password);
    $errors = [];
    if ($check['err'] === false) {
        array_push($errors, "error");
        echo json_encode(['errors' => $errors]);
        die();
    }

    $_SESSION['logged_user'] = $mail;
    if ($check['admin']) {
        $_SESSION['logged_admin'] = true;
    } else {
        $_SESSION['logged_admin'] = false;
    }
    echo json_encode(['success' => $mail]);