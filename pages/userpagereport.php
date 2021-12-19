<?php
session_start();
if( !isset($_SESSION['logged_user'])){
    header('Location: ../index.php');
    exit;
}
include_once('header.php');
?>
<div class="container">
    <div class="container-lg">
        <?php
        require_once ('../php/operationWithDataBase.php');
        $advertisement = getAdvertisement((int)$_GET['id']);
        var_dump($_SESSION['message']);
        echo '
        <label class="h5">Заголовок объявления:</label><br/>
        <label>'.$advertisement->advertisement_title.'</label><br/>
        <label class="h5">Описание:</label><br/>
        <label>'.$advertisement->description.'</label><br/>
        <label class="h5">Цена:</label><br/>
        <label>'.$advertisement->price.'</label><br/>
        <label class="h5">Фото:</label><br/>
        <img src="../'.$advertisement->path_photo.'" width="255" height="255"><br/>';
        if ($_SESSION["logged_user"] != $advertisement->email)
        {
            echo '<label class="h5">Телефон автора объявления:</label><br/>
        <label>'.$advertisement->phone.'</label><br/>
        <a href="/php/respond.php?id='.$_GET['id'].'">Откликнуться</a>
        ';
        }
        else{
            $respondUsers = getRespondUsers((int)$_GET['id']);
            if($respondUsers != false){
                echo '<label class="h5">Откликнувшиеся</label><br/>';
                foreach ($respondUsers as $r){
                    echo '<label class="h5">'.$r->FIO.''.$r->phone.'</label><br/>';

                }
            }
        }
        ?>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>