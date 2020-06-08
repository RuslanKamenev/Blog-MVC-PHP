<html>
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script type="text/javascript" src="/assets/js/main.js"></script>
</head>
<body>

<div class="top-bar">
    <a href="/" class="main-page">ГЛАВНАЯ</a>
    <div class="search-bar">
        <input type="search" class="search-bar-field" placeholder="Введите название или часть названия поста для поиска">
        <div style="display: none" class="search-results"></div>
    </div>
    <div class="login-error"><?= App::$registry->errors['loginError'] ?></div>

    <?php if ( App::$registry->authorise['login'] ): ?>
        <div class="logged-greeting">Приветствую, <a id="user-link" href="/user/<?= App::$registry->authorise['id'] ?>"><?= App::$registry->authorise['name'] ?></a></div>
        <div class="logout">
            <form method="post" class="logout-form">
                <input type="submit" name="log-out" value="Log Out" class="button">
            </form>
        </div>
    <?php else: ?>
        <div class="auth-form">
            <form method="post" class="login">
                <input type="text" placeholder="Логин" required name="username">
                <input type="password" placeholder="Пароль" required name="password">
                <input type="submit" name="log-in" value="Log In" class="button">
            </form>
            <div class="login-links">
                <a href="register">Зарегистрироваться</a>
                <a href="forgot">Забыли пароль?</a>
            </div>
        </div>
    <?php endif ?>

</div>

<div class="full-width-page">
