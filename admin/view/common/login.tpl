<html>
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/main.js"></script>
</head>
<body>

<div class="full-width-page">

    <div class="registration-place"><h2>Войти</h2>
        <form method="post" class="registration-form">
            Имя :<br><input type="text" required name="username" class="registration-fields" value="<?= $registerName; ?>"><br>
            Пароль:<br><input type="password" required name="password" class="registration-fields"><br>
            <div class="registration-error"><?= $registerError ?></div>
            <input type="hidden" name="register-press" value="register">
            <input type="submit" name="log-in" value="Войти" class="registration-submit">
        </form>
    </div>

</div>

</body>
