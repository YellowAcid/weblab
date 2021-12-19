<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="/css/style.css"> <!-- Gem style -->

    <title>Адаптивные модальные формы входа и регистрации</title>
</head>
<body>
<header role="banner">
    <div id="cd-logo"><a href="#0"><img src="/img/cd-logo.svg" alt="Logo"></a></div>

    <nav>
        <div class="main-nav">
            <ul>
                <li><a class="glav" href="/index.php">Главная</a></li>
                <?php
                if (isset($_SESSION['logged_user'])){
                    echo'<li><a href="/php/logout.php">Выход</a></li>';
                }
                else{
                    echo'<li><a class="cd-signin" href="#0">Вход</a></li>
            <li><a class="cd-signup" href="#0">Регистрация</a></li>';
                }
                ?>
                <!-- ссылки на вызов форм -->
            </ul>
        </div>
    </nav>
</header>
<div class="cd-user-modal"> <!-- все формы на фоне затемнения-->
    <div class="cd-user-modal-container"> <!-- основной контейнер -->
        <ul class="cd-switcher">
            <li><a href="#0">Вход</a></li>
            <li><a href="#0">Регистрация</a></li>
        </ul>

        <div id="cd-login"> <!-- форма входа -->
            <form class="cd-form" id="login-form">
                <p class="fieldset">
                    <label class="image-replace cd-email" for="signin-email">E-mail</label>
                    <input name="mail" class="full-width has-padding has-border" id="signin-email" type="email" placeholder="E-mail">
                    <span class="cd-error-message">Неправильная почта или пароль</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signin-password">Пароль</label>
                    <input name="password" class="full-width has-padding has-border" id="signin-password" type="text"  placeholder="Пароль">
                </p>

                <p class="fieldset">
                    <input class="full-width" type="submit" value="Войти">
                </p>
            </form>
            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-login -->

        <div id="cd-signup"> <!-- форма регистрации -->
            <form class="cd-form" id="reg-form">
                <p class="fieldset">
                    <label class="image-replace cd-email" for="signup-email">E-mail</label>
                    <input name="mail" class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail">
                    <span class="cd-error-message">Некоректная электронная почта</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-username" for="signup-username">ФИО</label>
                    <input name="username" class="full-width has-padding has-border" id="signup-username" type="text" placeholder="ФИО">
                    <span class="cd-error-message">В имени допустимы только русские буквы, пробелы и дефисы</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-username" for="signup-username">Номер телефона</label>
                    <input name="phone" class="full-width has-padding has-border" id="signup-username" type="text" placeholder="Номер телефона">
                    <span class="cd-error-message">Неправильный телефон</span>
                </p>


                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-password">Пароль</label>
                    <input name="password" class="full-width has-padding has-border" id="signup-password" type="text"  placeholder="Пароль">
                    <span class="cd-error-message">Мин. длина пароля 6 символов, пароль должен состоять не только из цифры</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-password_confirm">Повторите пароль</label>
                    <input name="password_confirm" class="full-width has-padding has-border" id="signup-password_confirm" type="text"  placeholder="Повторите пароль">
                    <span class="cd-error-message">Пароли не совпадают</span>
                </p>

                <p class="fieldset">
                    <input type="checkbox" name="processing" id="accept-terms">
                    <label for="accept-terms">Я согласен с <a href="#0">Условиями</a></label>
                    <span class="cd-error-message">Вы не согласны на обработку персональных данных</span>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding" type="submit" value="Создать аккаунт">
                </p>
            </form>

            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-signup -->
        <a href="#0" class="cd-close-form">Закрыть</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->