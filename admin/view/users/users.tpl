<div class="admin-posts">
    <div class="admin-posts-headline"><h1>Пользователи</h1></div>
    <div class="admin-posts-total">Всего пользователей: <?= $usersAmount; ?></div>
    <form method="post">
        <h4>Поиск пользователя по имени</h4>
        <input type="text" name="admin-search_user">
        <input type="submit" name="admin-search_user-submit" value="Поиск">
    </form>
    <div class="admin-posts-table">
        <table class="admin-posts-table__">
            <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Дата регистрации</th>
                    <th>Комментариев</th>
                    <th>Ур. доступа</th>
                    <th>Удалить пользователя</th>
                </tr>
            </thead>
            <!--Вывод, если по результатам поиска ничего не найдено-->
            <?php if ( is_string($users) ): ?>
        </table>
        <div class="posts-not-found">
            <h3><?= $users ?></h3>
        </div>
        <?php else: ?>

        <?php foreach ($users as $user): ?>
            <tr>
                <th>
                    <?= $user['name'] ?>
                </th>
                <th>
                    <?= $user['register_date'] ?>
                </th>
                <th>
                    <?= $user['comments'] ?>
                </th>
                <th>
                    <a href="/admin/user/<?= $user['id'] ?>">
                        <?= $user['access'] ?>
                    </a>
                </th>
                <th>
                    <form method="post">
                        <input type="hidden" value="<?= $user['id'] ?>" name="user-delete-id">
                        <input type="submit" name="user-delete-button" value="Удалить">
                    </form>
                </th>
            </tr>
            <?php endforeach ?>
        </table>
        <?php endif; ?>

    </div>
</div>