<?php
    session_start();
    require ('header.php');
    if( !isset($_SESSION['logged_user'])){
        header('Location: ..index.php');
        exit;
    }
?>
<div class="container">
    <h1>Добавление объявления</h1>
    <form action="/php/addadvertisement.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <label class="form-label">Заголовок объявления</label>
            <input type="text" class="form-control" name="advertisement_title" placeholder="Введите заголовок объявления">
        </div>
        <div class="row">
            <label class="form-label">Описание</label>
            <textarea class="form-control" name="description" placeholder="Введите описание" rows="3"></textarea>
        </div>
        <div class="row">
            <label class="form-label">Цена</label>
            <textarea class="form-control" name="price" placeholder="Введите цену" rows="3"></textarea>
        </div>
        <div class="row">
            <label class="form-label">Фото</label>
            <input type="file" class="form-control" name="photo" accept = ".jpg, .png">
        </div>
        <button class="btn btn-primary mb-3">Создать объявление</button>
        <?php
        if(isset($_SESSION['message'])){
            echo '<p class = "msg"> ' . $_SESSION['message'] .' </p>';
            unset($_SESSION['message']);
        }
        ?>
    </form>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>