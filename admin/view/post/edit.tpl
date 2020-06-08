<div class="admin-add-post">
    <h2>Редактировать пост</h2>
    <div class="admin-post-error"><?= $post['error'] ?></div>
    <form id="add-comment-form" method="post" class="admin-add-post-title-form">
        <div class="admin-add-post-title">
            <h4>Название поста</h4>
            <input type="text" name="post-title" value="<?= $post['title'] ?>" required>
        </div>

        <div class="admin-add-post-text">
            <h4>Текст поста</h4>
        </div>

        <div id="editor"><?= $post['text'] ?></div>
        <div id="add-comment">
            <input type="hidden" id="comment-text" value="" name="comment-text">
            <input type="submit" id="add-comment-submit" class="admin-add-post-submit" value="Отредактировать пост" name="add-comment">
        </div>
    </form>
</div>