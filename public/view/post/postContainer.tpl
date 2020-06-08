<div class="post">
    <div class="post-headline">
        <div class="post-author-avatar"><img src="/<?= $data['authorAvatar'] ?>"></div>
        <div class="post-info">
            <a href="/post/<?= $data['id'] ?>" class="post-title"><h3><?= $data['title'] ?>.</h3></a>
            <a href="/user/<?= $data['authorId'] ?>" class="post-author"><?= $data['authorName'] ?></a>
            <div class="post-date"><?= $data['postDate'] ?></div>
        </div>
    </div>
    <div class="post-text-full"><?= $data['text'] ?></div>

    <div class="comments"><h4>Комментарии (<?= $amount ?>)

            <?php foreach($comments as $comment): ?>
            <div class="comment">
                <div class="comment-avatar" ><img src = "/<?= $comment['authorAvatar'] ?>" ></div >
                <div class="comment-info">
                    <a href = "/user/<?=$comment['author'] ?>" class="comment-author"><?=$comment['authorName'] ?></a>
                    <div class="comment-date"><?= $comment['commentDate'] ?></div>
                    <div class="comment-text" >
                        <div class="comment-text-full"><?= $comment['text'] ?></div>
                    </div>
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