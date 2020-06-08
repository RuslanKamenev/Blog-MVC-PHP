<?php

class ForgotController extends Controller {

    public function index() {

        $headerController = App::$app->loadController('header');
        $headerController->index();
        $data['title'] = 'Востановление пароля';

        $page = $this->getFullPage($data);
        echo $page;
    }

}
