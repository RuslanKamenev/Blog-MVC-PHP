<?php

class PostController extends Controller {

    //Страница поста
    public function index() {

        App::$app->loginCheckAdmin(App::$app->controller);

        $model = $this->loadModel();
        $modelPosts = $this->loadModel('posts');

        if ( isset( $_POST['post-delete-button'] ) ) {
            $modelPosts->deletePost($_POST['post-delete-id']);
            header('Location: /admin/post/deleted');
        }

        if ( isset( $_POST['comment-delete-button'] ) ) {
            $model->deleteComment($_POST['comment-delete-id']);
        }

        $data['title'] = 'Пост';

        $navigationBar = App::$app->loadController('navigation');

        $postId = App::$app->getParamsInd()[0];
        $commentsPage = App::$app->getParamsInd()[1] ?? '1';

        $postData = $model->getPost($postId);

        //Добавление комментария
        if ( $_POST['add-comment'] ) {
            $this->addComment($model, $postId);
        }

        $data['title'] = 'Пост';

        //Форматирования даты создания поста
        $postDatetime = new DateTime($postData['date']);
        $postDateFormatted = date_format($postDatetime, 'd-m-Y H:i');
        $postData['postDate'] = $postDateFormatted;

        //Получение последних комментариев и их количества
        $commentsData = $model->getComments($postId, 10,$commentsPage);
        $commentsAmount = $model->getCommentsAmount($postId);

        $pagesController = App::$app->loadController('pagination');
        $pagination = $pagesController->pagination($commentsPage, $commentsAmount, 10, 'admin/post', $postId);

        $post = $this->getPost($postData, $commentsData, $commentsAmount, $pagination);
        $data['post'] = $post;

        $navigationBarView = $navigationBar->getContent('');
        $header = $this->getHeader($data);
        $content = $this->getContent($data);
        $footer = $this->getFooter();

        echo $header;
        echo $navigationBarView;
        echo $content;
        echo $footer;
    }

    //Страница добавления поста
    public function add () {
        App::$app->loginCheckAdmin(App::$app->controller);


        $navigationBar = App::$app->loadController('navigation');

        $model = $this->loadModel();

        //Добавление нового поста
        if ( isset( $_POST['add-comment']) ) {
            $postTitle = $_POST['post-title'];
            $postText = $_POST['comment-text'];
            $authorId = App::$registry->authorise['id'];
            $postCheck = $model->postExistCheck($postTitle);
            if ( $postCheck ) {
                $data['post']['error'] = 'Пост с таким названием уже существует';
                $data['post']['title'] = $postTitle;
                $data['post']['text'] = $postText;
            }
            else {
                $model->addPost($authorId, $postTitle, $postText);
                $postId = $model->getPostId($postTitle)['id'];
                header('Location: /admin/post/' . $postId);
            }
        }

        $data['title'] = 'Добавить пост';

        $navigationBarView = $navigationBar->getContent('');
        $header = $this->getHeader($data);
        $content = $this->getContent($data, 'post/add');
        $footer = $this->getFooter();

        echo $header;
        echo $navigationBarView;
        echo $content;
        echo $footer;
    }

    //Страница редактирования поста
    public function edit () {
        App::$app->loginCheckAdmin(App::$app->controller);

        $data['title'] = 'Редактировать пост';

        $postId = App::$app->getParamsInd()[0];

        $navigationBar = App::$app->loadController('navigation');

        $model = $this->loadModel();

        $postData = $model->getPost($postId);


        if ( isset( $_POST['add-comment']) ) {
            $data['post']['error'] = '';
            $currentTitle = $postData['title'];
            $postTitle = $_POST['post-title'];
            $postText = $_POST['comment-text'];
            if ( $currentTitle != $postTitle )
            $postCheck = $model->postExistCheck($postTitle);
            if ( $postCheck ) {
                $data['post']['error'] = 'Пост с таким названием уже существует';
                $data['post']['title'] = $postTitle;
                $data['post']['text'] = $postText;
            }
            else {
                $model->changePost($postId, $postTitle, $postText);
                $postId = $model->getPostId($postTitle)['id'];
                header('Location: /admin/post/' . $postId);
            }
        }

        if ( !$data['post'] )
            $data['post'] = $postData;

        $navigationBarView = $navigationBar->getContent('');
        $header = $this->getHeader($data);
        $content = $this->getContent($data, 'post/edit');
        $footer = $this->getFooter();

        echo $header;
        echo $navigationBarView;
        echo $content;
        echo $footer;

    }

    //Страница - пост успешно удален
    public function deleted () {
        App::$app->loginCheckAdmin(App::$app->controller);

        header('refresh:5; url=/admin/posts');

        $data['title'] = 'Пост успешно удален';

        $navigationBar = App::$app->loadController('navigation');

        $navigationBarView = $navigationBar->getContent('');
        $header = $this->getHeader($data);
        $content = $this->getContent($data, 'post/deleted');
        $footer = $this->getFooter();

        echo $header;
        echo $navigationBarView;
        echo $content;
        echo $footer;

    }

    public function getPost ($data, $comments, $amount, $pagination='') {
        $count = count($comments);
        for ($i = 0; $i < $count; $i++) {
            $datetime = new DateTime($comments[$i]['date']);
            $commentDate = date_format($datetime, 'd-m-Y H:i:s');
            $comments[$i]['commentDate'] = $commentDate;
        }
        ob_start();
        include(VIEW_PATH. '/post/postContainer.tpl');
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function addComment ($model, $postId) {
        $commentText = $_POST['comment-text'];
        $user = App::$registry->authorise['name'];
        $userId = $model->getUserId($user);
        $model->addComment($commentText, $userId, $postId);
    }


}
