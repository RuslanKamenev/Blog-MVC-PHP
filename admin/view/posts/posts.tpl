<div class="admin-posts">
    <div class="admin-posts-headline"><h1>Посты</h1></div>
    <div class="admin-posts-total">Всего постов: <?= $postsAmount; ?></div>
    <form method="post">
        <h4>Поиск поста по названию</h4>
        <input type="text" name="admin-search_post">
        <input type="submit" name="admin-search_post-submit" value="Поиск">
    </form>
    <a href="/admin/post/add" class="admin-posts-add">Добавить пост</a>
    <div class="admin-posts-table">
        <table class="admin-posts-table__">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Дата написания</th>
                    <th>Комментариев</th>
                    <th>Удаление</th>
                </tr>
            </thead>
            <!--Вывод, если по результатам поиска ничего не найдено-->
            <?php if ( is_string($posts) ): ?>
                </table>
                <div class="posts-not-found">
                    <h3><?= $posts ?></h3>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <th>
                            <a href="/admin/post/<?= $post['id'] ?>">
                                <?= $post['title'] ?>
                            </a>
                        </th>
                        <th>
                            <?= $post['postDate'] ?>
                        </th>
                        <th>
                            <?= $post['comments'] ?>
                        </th>
                        <th>
                            <form method="post">
                                <input type="hidden" value="<?= $post['id'] ?>" name="comment-delete-id">
                                <input type="submit" name="comment-delete-button" value="Удалить пост">
                            </form>
                        </th>
                    </tr>
                <?php endforeach ?>
            </table>
        <?php endif; ?>

    </div>
</div>