jQuery(document).ready(function($){
	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_modal_tab = $('.cd-switcher'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$main_nav = $('.main-nav'),
		$glav = $main_nav.find('#glav');

	//открыть модальное окно
	$glav.on('click', function(event){
		window.location.href = '/php/logout.php';
	});

	$main_nav.on('click', function(event){

		if( $(event.target).is($main_nav) ) {
			// открыть на мобильных подменю
			$(this).children('ul').toggleClass('is-visible');
		} else {
			// закрыть подменю на мобильных
			$main_nav.children('ul').removeClass('is-visible');
			//показать модальный слой
			$form_modal.addClass('is-visible');	
			//показать выбранную форму
			( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
		}

	});

	//закрыть модальное окно
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}	
	});
	//закрыть модальное окно нажатье клавиши Esc 
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
	    }
    });

	//переключения  вкладки от одной к другой
	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? login_selected() : signup_selected();
	});

	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}

	function signup_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	}

	//при желании можно отключить - это просто, сообщения об ошибках при заполнении
	$form_login.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		let loginForm = new FormData(document.getElementById('login-form'));
		fetch('php/authorization.php', {
				method: 'POST',
				body: loginForm
			}
		)
			.then(response => response.json())
			.then((result) => {
				console.log(result);
				if (result.errors) {
					$form_login.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
				} else {
					window.location.reload()
					$form_login.removeClass('is-visible');
					$form_signup.removeClass('is-visible');
				}
			})
			.catch(error => console.log(error));
	});
	$form_signup.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		let regForm = new FormData(document.getElementById('reg-form'));
		fetch('php/registration.php', {
				method: 'POST',
				body: regForm
			}
		)
			.then(response => response.json())
			.then((result) => {
				console.log(result);
				if (result.errors) {
					result.errors.forEach(function callback(currentValue) {
						if (currentValue == "1") {
							$form_signup.find('input[type="checkbox"]').toggleClass('has-error').next('span').toggleClass('is-visible');
						}
						if (currentValue == "3") {
							$form_signup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
						}
						if (currentValue == "4") {
							$form_signup.find('#username').toggleClass('has-error').next('span').toggleClass('is-visible');
						}
						if (currentValue == "5") {
							$form_signup.find('#password_confirm').toggleClass('has-error').next('span').toggleClass('is-visible');
						}
						if (currentValue == "6") {
							$form_signup.find('#password').toggleClass('has-error').next('span').toggleClass('is-visible');
						}
						if (currentValue == "7") {
							$form_signup.find('#password').toggleClass('has-error').next('span').toggleClass('is-visible');
						}
					})
				} else {
					window.location.reload()
				}
			})
			.catch(error => console.log(error));
		$form_signup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});




});


//credits http://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});
};