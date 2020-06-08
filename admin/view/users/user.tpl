<div class="admin-posts">

    <div class="username">
        Имя пользователя: <?= $user['name'] ?>
    </div>
    <div class="id">
        Id: <?= $user['id'] ?>
    </div>
    <div class="email">
        Почта: <?= $user['email'] ?>
    </div>
    <div class="register">
        Дата регистрации: <?= $user['register_date'] ?>
    </div>
    <form method="post" class="admin-access-form">
        Уровень доступа:
        <select name="access">
            <option <?= $accessDefault0 ?>>0</option>
            <option <?= $accessDefault1 ?>>1</option>
        </select>
        <br>
        <input type="submit" value="Сохранить изменения" name="change-access">
    </form>

</div>