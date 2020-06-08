<?php

class PostsController extends Controller {

    public function index () {

        //Проверка авторизации админа
        App::$app->loginCheckAdmin(App::$app->controller);

        $model = $this->loadModel();

        if ( isset( $_POST['post-delete-button'] ) )
            $model->deletePost( $_POST['post-delete-id'] );

        $data['title'] = 'Перечень постов';

        $navigationBar = App::$app->loadController('navigation');


        $postsAmount = $model->getPostsAmount();
        $data['postsAmount'] = $postsAmount;

        //Поиск постов по указанному имени или отображение всех постов
        if ( isset( $_POST['admin-search_post-submit'] ) )
            $posts = $model->getPostsSearch($_POST['admin-search_post']);
        else
            $posts = $model->getPosts();
        $data['posts'] = $posts;

        $navigationBarView = $navigationBar->getContent('');
        $header = $this->getHeader($data);
        $content = $this->getContent($data);
        $footer = $this->getFooter();

        echo $header;
        echo $navigationBarView;
        echo $content;
        echo $footer;


    }


}
