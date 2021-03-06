<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<title>Readium</title>
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- <meta property="og:image" content="path/to/image.jpg">
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="img/favicon/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png">
	Chrome, Firefox OS and Opera
	<meta name="theme-color" content="#000">
	Windows Phone
	<meta name="msapplication-navbutton-color" content="#000">
	iOS Safari
	<meta name="apple-mobile-web-app-status-bar-style" content="#000"> -->
	<style>body { overflow-x: hidden; } html { background-color: #fff; }</style>
	<link rel="stylesheet" href="fonts.css">
	<link rel="stylesheet" href="style.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>

<body>
	
	<header class="test-header clearfix">
		<div class="layout-position">
			<div class="logo">
				<img src="img/Logo-White.png" width="300" height="59" alt="Readium">
			</div>
			<a class="test-header__link btn" href="../abc/test-timer.html">Перейти к упражнениям</a>
			<div class="user-block">
				<div class="user-block__notification">
					<i class="far fa-bell"></i>
				</div>
				<div class="user-block__avatar">
					<img src="img/avatar1.jpg" alt="ваш аватар">
				</div>
				<div class="user-block__profile">
					<span class="user-block__profile-name">Казимир</span>
					<span class="user-block__profile-access">Базовый доступ</span>
				</div>
				<div class="arr-down">
					<i class="fas fa-angle-down"></i>
				</div>
			</div>
		</div>
	</header>

	<main>
		<div class="test layout-position">
			<div class="test-wraper">
				<p class="test-content">Приготовься читать текст быстро и одновременно внимательно. Как только ты нажмешь кнопку готов, перед тобой откроется текст и будет отсчитываться время. После текста будет контрольный вопрос на понимание текста.</p>
				<div class="questions">
					<span class="questions-item">question1</span>
					<span class="questions-item">question2</span>
					<span class="questions-item">question3</span>
				</div>
			</div>

			<button class="test-read btn">Старт</button>

		</div>
		<div class="timer">0
		</div>
	</main>
	<div class="overlay"></div>

	<script src="js/test.js"></script>
	
</body>
</html>
