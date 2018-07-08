<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>test-3</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="read.ico" type="image/x-icon">

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
    <link rel="stylesheet" href="../../css/landing/fonts_landing.css">
    <link rel="stylesheet" href="../../css/landing/style_landing.css">
    <link rel="stylesheet" href="template/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="template/js/jqueryrotate.2.1.js"></script>
    <script type="text/javascript" src="template/js/alphabet.js"></script>

    <script>
        $(document).ready(function () {
            //Скрыть PopUp при загрузке страницы
            $("#popup1").hide();
            PopUpHide();
        });

        //Функция отображения PopUp
        function PopUpShow() {
            $("#popup1").show();
        }

        //Функция скрытия PopUp
        function PopUpHide() {
            jQuery(function ($) {
                $(document).mouseup(function (e) { // отслеживаем событие клика по веб-документу
                    $("#popup1").hide(); // если условия выполняются - скрываем наш элемент
                });
            });
        }
    </script>
</head>

<body>