<?php 
	session_start();
	require_once 'operationWithDataBase.php';
	$username = $_POST['username'];
	$mail = $_POST['mail'];
    $phone = $_POST['phone'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
    $errors = [];
    if (!isset($_POST['processing'])) {
        $_SESSION['message'] = 'Вы не согласны на обработку персональных данных';
        array_push($errors, "1");
        echo json_encode(['errors' => $errors]);
        die();
    }
    if ( empty($username) && empty($mail) && empty($password) && empty($password_confirm)) {
        $_SESSION['message'] = 'Заполните все поля';
        array_push($errors, "2");
        echo json_encode(['errors' => $errors]);
        die();
    }
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Некоректная электронная почта';
        array_push($errors, "3");
        echo json_encode(['errors' => $errors]);
        die();
    }
    if (!preg_match('/^[-\ \а-яА-Я]+$/u', $username)){
        $_SESSION['message'] = 'В имени допустимы только русские буквы, пробелы и дефисы';
        array_push($errors, "4");
        echo json_encode(['errors' => $errors]);
        die();
    }
    if ($password !== $password_confirm) {
        $_SESSION['message'] = 'Пароли не совпадают';
        array_push($errors, "5");
        echo json_encode(['errors' => $errors]);
        die();
    }
    if (mb_strlen($password) < 6) {
        $_SESSION['message'] = 'Минимальная длина пароля 6 символов';
        array_push($errors, "6");
        echo json_encode(['errors' => $errors]);
        die();
    }
    if (!preg_match('/[a-zA-z\а-яА-я]+/u', $password)) {
        $_SESSION['message'] = 'Пароль должен состоять не только из цифр';
        array_push($errors, "7");
        echo json_encode(['errors' => $errors]);
        die();
    }

    $addNewUser = addUser($password, $username, $mail, $phone);
    if (!$addNewUser){
        $_SESSION['message'] = 'Ошибка при добавлении пользователя';
        array_push($errors, "8");
        echo json_encode(['errors' => $errors]);
        die();
    }
    $_SESSION["logged_user"] = $mail;
    echo json_encode(['success' => true]);




