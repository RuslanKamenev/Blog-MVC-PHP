<div class="post">
    <div class="admin-post-editing">
        <a href="/admin/edit/<?= $data['id'] ?>">Редактировать пост</a>
        <div class="login-error"></div>
        <form method="post" class="admin-post-delete">
            <input type="hidden" value="<?= $data['id'] ?>" name="post-delete-id">
            <input type="submit" name="post-delete-button" value="Удалить пост">
        </form>
    </div>
    <div class="post-headline">
        <div class="post-author-avatar"><img src="/<?= $data['authorAvatar'] ?>"></div>
        <div class="post-info">
            <a href="/admin/post/<?= $data['id'] ?>" class="post-title"><h3><?= $data['title'] ?></h3></a>
            <a href="/admin/user/<?= $data['authorId'] ?>" class="post-author"><?= $data['authorName'] ?></a>
            <div class="post-date"><?= $data['postDate'] ?></div>
        </div>
    </div>
    <div class="post-text-full"><?= $data['text'] ?></div>

    <div class="comments"><h4>Комментарии (<?= $amount ?>)

            <?php foreach($comments as $comment): ?>
            <div class="comment">
                <div class="comment-avatar" ><img src = "/<?= $comment['authorAvatar'] ?>" ></div >
                <div class="comment-info">
                    <a href = "/admin//user/<?=$comment['author'] ?>" class="comment-author"><?=$comment['authorName'] ?></a>
                    <div class="comment-date"><?= $comment['commentDate'] ?></div>
                    <div class="comment-text" >
                        <div class="comment-text-full"><?= $comment['text'] ?></div>
                    </div>
                    <form method="post" id="comment-remove">
                        <input type="hidden" value="<?= $comment['id'] ?>" name="comment-delete-id">
                        <input type="submit" value="Удалить комментарий" name="comment-delete-button">
                    </form>

                </div>
            </div>
            <?php endforeach ?>

    </div>

    <?= $pagination ?>

    <?php if ( App::$registry->authorise['login'] && App::$app->route['className'] == 'PostController' ): ?>
        <div id="editor"></div>
        <div id="add-comment">
            <form id="add-comment-form" method="post">
                <input type="hidden" id="comment-text" value="" name="comment-text">
                <input type="submit" id="add-comment-submit" value="Добавить комментарий" name="add-comment">
            </form>
        </div>
    <?php endif ?>


</div>