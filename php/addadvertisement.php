<?php
    session_start();
    require_once 'operationWithDataBase.php';
    $advertisement_title = $_POST['advertisement_title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $mail = $_SESSION['logged_user'];

    if (empty($advertisement_title) && empty($description) && empty($price))
    {
        $_SESSION['message'] = 'Заполните все поля';
        header('Location: ../pages/useraddadvertisement.php');
        exit();
    }
    if( !isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE) {
        $_SESSION['message'] = 'Добавте фото';
        header('Location: ../pages/useraddadvertisement.php');
        exit();
    }
    //Проверка файла на допустимый формат
    $photo_types = array('jpg', 'png');
    $current_photo_type = substr(strrchr($_FILES['photo']['name'], '.'), 1);
    $mimetype = mime_content_type($_FILES['photo']['tmp_name']);
    if (!in_array($current_photo_type, $photo_types) && in_array($mimetype, array('image/jpeg', 'image/png'))) {
        $_SESSION['message'] = 'Неправильный формат фото. Допустимы .jpg и .png';
        header('Location: ../pages/useraddadvertisement.php');
        exit();
    }

    $path_photo = 'photo/'. time() . $_FILES['photo']['name'];
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../'. $path_photo)) {
        $_SESSION['message'] = 'Ошибка при загруке фото.'.$path_photo;
        header('Location: ../pages/useraddadvertisement.php');
        exit();
    }

    $add_adv = addAdvertisement($advertisement_title, $description, (int)$price, $path_photo, $mail);
    if(!$add_adv){
        unlink('../'. $path_photo);
        $_SESSION['message'] = 'Ошибка записи в бд';
        header('Location: ../pages/useraddadvertisement.php');
        exit();
    } else{
        unset($_SESSION['message']);
        header('Location: ../index.php');
    }
