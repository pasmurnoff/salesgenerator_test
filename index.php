<html>
<head>
    <title>Тестовое задание</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script src="js/jquery.maskedinput.js"></script>
</head>
<body>
<button class="btn callPopup" data-popup="modal">Кликни</button>
<div class="overlay"></div>
<div class="modal">
    <div class="modal-header">
        <div id="close"><img src="images/close.png"></div>
    </div>
    <h3 class="modal-title">Получите набор файлов <br> для руководителя:</h3>
        <div class="modal-left">
            <img src="images/icons.png" class="img-icons">
            <img src="images/file.png" class="img-file">
        </div>
        <div class="modal-right">
            <div class="form">
                <form method="post" action="send.php">
                    <label for="email">Введите Email для получения файлов</label>
                    <input type="email" id="email" required name="email" placeholder="Email">
                    <label for="basic-url">Введите телефон для подтверждения доступа</label>
                    <input type="text" id="phone" required name="phone" placeholder="+7 (000) 000-00-00">
                    <button type="submit" name="submit" class="btn-send">Скачать файлы <img src="images/cursor.png"> </button>
                </form>
                <div class="form-bottom">
                    <span>PDF 4.7 MB</span>
                    <span>DOC 0.8 MB</span>
                    <span>XLS 1.2 MB</span>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/scripts.js"></script>
</html>