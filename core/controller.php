<?php

abstract class Controller {

    protected $dir;
    public $filename;

    function __construct($controllerName) {
        $this->filename = preg_replace('/Controller$/i','',get_class($this));
    }

    abstract public function index();

    //Подключение модели с именем filename. Если имя не указано, загружается модель с именем контроллера
    public function loadModel ($modelName = '') {

        if ( !$modelName ) {
            $className = get_class($this);
            $model = preg_replace('/Controller$/i','',$className);
            $filename = MODEL_PATH .'/'. $model .'.php';
        } else {
            $arr = explode('/', $modelName);
            $arrLength = count($arr);

            if ( $arrLength > 1 ) {
                $folder = $arr[0];
                $model = $arr[1];
                $filename = MODEL_PATH .'/'. $folder .'/'.  $model .'.php';
            } else {
                $model = $arr[ ($arrLength - 1) ];
                $filename = MODEL_PATH .'/'. $model .'.php';
            }
        }

        if ( file_exists( $filename ) )
            include_once ( $filename );
        else {
            return 'Модель ' .$model. '.php не найдена';
        }

            $modelName = $model.'Model';

            if ( class_exists ( $modelName ) )
                return new $modelName();
            else
                $this->errorLog( 'Класс '. $this->route['className'] .' не найден' );
    }
    
    private function errorLog ($errorMsg) {
        echo '<br>', 'Ошибка: ', $errorMsg, '<br>';
        exit;
    }

    //Рендеринг содержимого страницы
    public function getContent ($data = [], $viewName = '') {

        if ( $viewName == '' ) {
            $fileName = $this->filename;
            $directory = $this->filename;
        } else {
            $arr = explode('/', $viewName);
            $arrLength = count($arr);
            if ( $arrLength > 1 ) {
                $directory = $arr[0];
                $fileName = $arr[1];
            } else {
                $fileName = $arr[ ($arrLength - 1) ];
                $directory = $this->filename;
            }
        }
        $fileRoute = VIEW_PATH .'/'. $directory .'/'.  $fileName .'.tpl';

        if ( is_array($data) )
            extract($data);

        if ( file_exists( $fileRoute ) ) {
            ob_start();
            include_once($fileRoute);
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
        else {
            return 'Представление ' .$fileName. '.tpl не найдена';
        }

    }

    //Рендер хедера
    public function getHeader($data = []) {
        return $this->getContent($data,'common/header');
    }

    //Рендер футера
    public function getFooter($data = []) {
        return $this->getContent($data,'common/footer');
    }

    //Рендер все страницы
    public function getFullPage ($data = [], $view = '') {
        $page = '';
        $page .= $this->getHeader($data);
        $page .= $this->getContent($data, $view);
        $page .= $this->getFooter($data);
        return $page;
    }

    public function getControllerName() {
        return $this->filename;
    }

    
}