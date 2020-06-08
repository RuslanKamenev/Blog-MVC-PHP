<?php

class UsersController extends Controller {

    public function index () {

        //Проверка авторизации админа
        App::$app->loginCheckAdmin(App::$app->controller);

        $model = $this->loadModel();

        $data['title'] = 'Пользователи';

        $navigationBar = App::$app->loadController('navigation');

        if ( isset($_POST['user-delete-button']) ){
            $userId = $_POST['user-delete-id'];
            $model->deleteUser($userId);
        }


        $data['usersAmount'] = $model->getUsersAmount();

        //Поиск пользователя по имени или отображение всех пользователей
        if ( isset( $_POST['admin-search_user-submit'] ) )
            $users = $model->getUsersSearch($_POST['admin-search_user']);
        else
            $users = $model->getUsers();

        $data['users'] = $users;

        $navigationBarView = $navigationBar->getContent('');
        $header = $this->getHeader($data);
        $content = $this->getContent($data);
        $footer = $this->getFooter();

        echo $header;
        echo $navigationBarView;
        echo $content;
        echo $footer;

    }

    public function edit () {

        //Проверка авторизации админа
        App::$app->loginCheckAdmin(App::$app->controller);

        $model = $this->loadModel();
        $postsModel = $this->loadModel('posts');

        $data['title'] = 'Редактирование доступа';

        $userId = App::$app->getParamsInd()[0];

        if ( isset($_POST['change-access']) )
            $model->changeAccess($userId, $_POST['access']);

        $user = $postsModel->getAuthor($userId);

        $data['user'] = $user;

        //Отображение доступа на странице по умолчанию
        switch ( $user['access'] ) {
            case 0:
                $data['accessDefault0'] = 'selected';
                break;
            case 1:
                $data['accessDefault1'] = 'selected';
                break;
        }

        $navigationBar = App::$app->loadController('navigation');

        $navigationBarView = $navigationBar->getContent('');
        $header = $this->getHeader($data);
        $content = $this->getContent($data, 'users/user');
        $footer = $this->getFooter();

        echo $header;
        echo $navigationBarView;
        echo $content;
        echo $footer;

    }


}
