<?php

    session_start(); 
    
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"
		/>

		<!-- Bootstrap CSS -->
		<link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
			integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
			crossorigin="anonymous"
		/>

		<title>Login</title>

		<link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">

		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Rajdhani:wght@600&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="./css/style.css">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
	</head>

	<body>
		<div class="overlay">
			<div class="container">
				<div class="row form">
					<div class="col-md-12 left">
						<img src="./img/pixelmini.png" alt="Pixel">
						<strong>Bem Vindo</strong>
						<div class="copyright">
							<div>
								<strong>
									&copy;
									<script>
										document.write(new Date().getFullYear());
									</script>
									| Autobots
								</strong>
							</div>
						</div>
					</div>
					<div class="col-md-12 right">
						<img src="./img/autobots.png" alt="Autobots">
						<strong>Login</strong>
						<p class="erro">
							<?php
								if (isset($_SESSION['loginErro'])) {
									echo $_SESSION['loginErro'];
									unset($_SESSION['loginErro']);
								}
							?>
						</p>
						<form action="login.php" method="POST">
							<div class="textbox">
								<input type="text" name="user" id="user" placeholder="Usuário">
								<span class="check-message hidden">Obrigatório</span>
							</div>
							<div class="textbox">
								<input type="password" name="password" id="password" placeholder="Senha">
								<span class="check-message hidden">Obrigatório</span>
							</div>
							<input type="submit" value="Entrar" name="login" id="login" class="login-btn" disabled>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Optional JavaScript -->
		<script type="text/javascript">
        $(".textbox input").focusout(function () {
            if ($(this).val() == "") {
                $(this).siblings().removeClass("hidden");
            } else {
                $(this).siblings().addClass("hidden");
                $(this).css("background", "#484848");
            }
        });
        $(".textbox input").keyup(function () {
            let inputs = $(".textbox input");
            if (inputs[0].value != "" && inputs[1].value) {
                $(".login-btn").attr("disabled", false);
                $(".login-btn").addClass("active");
            } else {
                $(".login-btn").attr("disabled", true);
                $(".login-btn").removeClass("active");
            }
        });
    </script>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script
			src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
			integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
			integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
			crossorigin="anonymous"
		></script>
		<script
			src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
			integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
			crossorigin="anonymous"
		></script>
	</body>
</html>
