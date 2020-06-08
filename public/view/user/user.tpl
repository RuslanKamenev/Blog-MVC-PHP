<div class="user-profile">
    <div class="user-info">
        <div class="post-author-avatar"><img src="/<?= $userInfo['avatar'] ?>"></div>
        <div class="user-info-about">
            <div class="user-name"><?= $userInfo['name'] ?></div>
            <div class="user-register">Register date: <?= $userInfo['date'] ?></div>
        </div>
    </div>
    <div class="user-comments-amount">Комментариев пользователя: <?= $commentsAmount ?></div>

    <?php if ( App::$registry->authorise['id'] == $userInfo['id'] ): ?>
        <div class="upload-avatar">
            <form method="post" enctype="multipart/form-data">
                Сменить аватар:<br>
                <input type="file" accept=".jpg, .jpeg, .png" name="user-avatar"><br>
                <input type="submit" name="upload-avatar-submit" value="Загрузить">
            </form>
        </div>
    <?php endif ?>

</div>