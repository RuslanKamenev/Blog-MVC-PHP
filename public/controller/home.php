<?php


class HomeController extends Controller {

    public function __construct($filename) {
        parent::__construct($filename);
    }

    public function index() {

        $data['title'] = 'Главная страница';

        //Загрузка контроллера и модели для добавления постов на страницу
        $postController = App::$app->loadController('post');
        $postModel = $this->loadModel('post');
        $userModel = $this->loadModel('user');
        $pagesController = App::$app->loadController('pagination');
        $headerController = App::$app->loadController('header');
        $headerController->index();

        $postsPage = App::$app->getParamsInd()[0];
        if ( $postsPage == '' )
            $postsPage = 1;

        $posts = $postModel->getLastPosts($postsPage);
        $postsAmount = $postModel->getPostsAmount();
        $postsCount = count($posts);
        $postsView = '';

        for ($i = 0; $i < $postsCount; $i++) {
            $commentsInPost = $postModel->getCommentsAmount( $posts[$i]['id'] );
            $posts[$i]['commentsAmount'] = $commentsInPost;
            $posts[$i]['authorAvatar'] = $userModel->getAvatar($posts[$i]['authorId']);
            $comments[$i] = $postModel->getComments( $posts[$i]['id'], 5 );
            $postsView .= $postController->getPost($posts[$i], $comments[$i], $posts[$i]['commentsAmount']);
        }

        $data['posts'] = $postsView;
        $pagination = $pagesController->pagination($postsPage, $postsAmount, 5);
        $data['pagination'] = $pagination;
        $page = $this->getFullPage($data);
        echo $page;
    }
}
