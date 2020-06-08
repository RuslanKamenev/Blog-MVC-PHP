<?php

class HomeController extends Controller {

    public function index () {

        $data['title'] = 'Admin page';

        if ( App::$registry->authorise['access'] == TRUE ) {

            $navigationBar = App::$app->loadController('navigation');

            $navigationBarView = $navigationBar->getContent('');

            $header = $this->getHeader($data);
            $content = $this->getContent();
            $footer = $this->getFooter();

            echo $header;
            echo $navigationBarView;
            echo $content;
            echo $footer;


        }
        else {
            $data['title'] = 'Login page';

            $view = $this->getContent($data, 'common/login');

            echo $view;
        }

    }

}
