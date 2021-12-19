<?php
    session_start();
    include_once('header.php');
?>
	<div class="container">
		<h1 class="text-center">Регистрация нового пользователя</h1>
		<form action="../php/registration.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <label class="form-label">Имя пользователя</label>
                <input type="text" class="form-control" name="username" placeholder="Введите имя">
            </div>
            <div class="row mt-2">
                <label class="form-label">Mail</label>
                <input type="text" class="form-control" name="mail" placeholder="Введите эл. почту">
            </div>
            <div class="row mt-2">
                <label class="form-label">Пароль</label>
                <input type="password" class="form-control" name="password" placeholder="Введите пароль">
            </div>
            <div class="row mt-2">
                <label class="form-label">Повторный пароль</label>
                <input type="password" class="form-control" name="password_confirm" placeholder="Введите подтвверждение пароля ">
            </div>
            <div class="form-check mt-2 mb-2">
                <input class="form-check-input" type="checkbox" name="processing" value="yes" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Согласен на обработку персональных данных
                </label>
            </div>
			<button class="btn btn-primary mb-3">Регистрация</button>
			<?php
            if(isset($_SESSION['message'])){
				echo '<p class = "msg"> ' . $_SESSION['message'] .' </p>';
				unset($_SESSION['message']);
			}
			?>
		</form>
	</div>
</body>
</html>