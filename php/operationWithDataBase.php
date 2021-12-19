<?php
    function connect() { // Подключение
        $dbconfig = parse_ini_file("dbconfig.ini");
        try {
            $pdo = new PDO('mysql:host='.$dbconfig['host'].';dbname='.$dbconfig['name'], $dbconfig['login'], $dbconfig['password']);
            return $pdo;
        } catch (PDOExeption $e) {
            die('Error connect db');
        }
    }

    function addUser($password, $username, $mail, $phone): bool { // Регистрация
        $pdo = connect();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users(FIO, email, password, phone, admin) VALUES(:username, :mail, :password, :phone, false)';
        $stmt = $pdo->prepare($sql);
        $params = [ 'username' => $username, 'mail' => $mail, 'password' => $password, 'phone' => $phone];
        return $stmt->execute($params);
    }

    function checkUser($mail, $password): bool { // Авторизация
        $ret = true;
        $pdo = connect();
        $sql = 'SELECT email, password FROM users WHERE email = :mail';
        $params = [ 'mail' => $mail ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if (!$user or !password_verify($password, $user->password)){
            $ret = false;
        }
        return $ret;
    }

    function getAdvertisement($id){ // Получение объявления с определенным id
        $pdo = connect();
        $sql = 'SELECT advertisement.advertisement_title, advertisement.description, advertisement.price, advertisement.path_photo, advertisement.mail, users.phone FROM advertisement, users WHERE advertisement.id = :id and users.email = advertisement.mail';
        $params = [ 'id' => $id ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    function addAdvertisement($advertisement_title, $description, $price, $path_photo, $mail): bool {// Добавление доклада
        $pdo = connect();
        $sql = 'INSERT INTO advertisement (advertisement_title, description, price, path_photo, mail) VALUES(:advertisement_title, :description, :price, :path_photo, :mail)';
        $stmt = $pdo->prepare($sql);
        $params = [ 'advertisement_title' => $advertisement_title, 'description' => $description, 'price' => $price,
            'path_photo' => $path_photo, 'mail' => $mail];
        return $stmt->execute($params);
    }

function getAdvertisements($start_from, $record_per_page): array{
    $pdo = connect();
    $sql = 'SELECT id, advertisement_title, price, path_photo FROM advertisement LIMIT :start_from,:record_per_page';
    $params = [ ':start_from' => (int)$start_from, ':record_per_page' => (int)$record_per_page ];
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $ret;
}

function getCountAdvertisements()   {
    $pdo = connect();
    $sql = 'SELECT count(*) FROM advertisement';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function respond($id_adv){
    $pdo = connect();
    $sql = 'INSERT INTO adv_users (mail, id_adv) VALUES (:mail, :id_adv)';
    $stmt = $pdo->prepare($sql);
    $params = [ 'mail' => $_SESSION["logged_user"], 'id_adv' => $id_adv];
    $tmp = $stmt->execute($params);
    $_SESSION['message'] = $tmp;
    return $tmp;
}

function getRespondUsers($id){
    $pdo = connect();
    $sql = 'SELECT users.FIO, users.phone FROM adv_users, users WHERE adv_users.id_adv = :id and users.email = adv_users.mail';
    $stmt = $pdo->prepare($sql);
    $params = [ 'id' => $id];
    return $stmt->execute($params);
}

