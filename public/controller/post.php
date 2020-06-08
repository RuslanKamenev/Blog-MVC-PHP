<?php

class PostController extends Controller {

    public function __construct($filename) {
        parent::__construct($filename);
    }

    public function index() {

        $headerController = App::$app->loadController('header');
        $headerController->index();
        $postId = App::$app->getParamsInd()[0];
        $commentsPage = App::$app->getParamsInd()[1] ?? '1';
        $model = $this->loadModel();
        $postData = $model->getPost($postId);

        //Добавление комментария
        if ( $_POST['add-comment'] ) {
            $this->addComment($model, $postId);
        }

        $data['title'] = $postData['title'];

        //Форматирования даты создания поста
        $postDatetime = new DateTime($postData['date']);
        $postDateFormatted = date_format($postDatetime, 'd-m-Y H:i');
        $postData['postDate'] = $postDateFormatted;

        //Получение последних комментариев и их количества
        $commentsData = $model->getComments($postId, 10, $commentsPage);
        $commentsAmount = $model->getCommentsAmount($postId);
        $pagesController = App::$app->loadController('pagination');
        $pagination = $pagesController->pagination($commentsPage, $commentsAmount, 10, 'post', $postId);
        $post = $this->getPost($postData, $commentsData, $commentsAmount, $pagination);
        $data['post'] = $post;
        $page = $this->getFullPage($data);
        echo $page;

    }

    //Рендер поста
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
