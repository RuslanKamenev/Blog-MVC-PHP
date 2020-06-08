<div class="registration-place"><h2>Зарегестрироваться</h2>
    <form method="post" class="registration-form">
        Имя пользователя:<br><input type="text" name="register-username" class="registration-fields" value="<?= $registerName; ?>"><br>
        email адресс:<br><input type="email" name="register-email" class="registration-fields" value="<?= $registerEmail; ?>"><br>
        Пароль:<br><input type="password" name="register-password-1" class="registration-fields" value="<?= $pass1; ?>" title="Введите пароль длинной не менее 8 символов"><br>
        Повторите пароль:<br><input type="password" name="register-password-2" class="registration-fields" value="<?= $pass2; ?>"><br>
        <div class="registration-error"><?= $registerError ?></div>
        <input type="hidden" name="register-press" value="register">
        <input type="submit" name="register-submit" value="Создать аккаунт" class="registration-submit">
    </form>
</div>
