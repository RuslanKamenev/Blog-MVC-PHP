<?php

class App {

    public static $registry;
    public static $app;

    private $routes=[];

    public $route=[];          // path, fileName, className, methodName, pathFolder
    public $controller = '';
    private $paramsInd=[];
    private $paramsAss=[];

    function __construct() {
        self::$registry = new Registry;
        self::$app = $this;
        DB::setConnection();
    }

    public function run() {
        $this->router();

        //Log in check
        $this->logInCheck();

        //Log out
        if ( isset($_POST['log-out']) )
            $this->logOut();

        //Log in
        if ( isset($_POST['log-in']) )
            $this->logIn();

        define ('CONTROLLER_PATH', APP_PATH.'/controller');
        define( 'MODEL_PATH', APP_PATH.'/model');
        define ('LANG_PATH', APP_PATH.'/lang');
        if ( APP_TYPE != 'api' )
            define( 'VIEW_PATH', APP_PATH.'/view');

        //Загрузка контроллера
        $controller = $this->loadController();

        //Загрузка модели
        $this->loadDictionary();

        //Запуск контроллера
        $this->controller = $controller;
        $controller->{$this->route['methodName']}();

    }

    private function router() {

        $url = $_SERVER['REQUEST_URI'];
        $url = rtrim($url, '/');
        $appUrl = ltrim($url, '/');
        $this::$registry->appUrl = explode('/', $appUrl);

        if ( strpos($url, '/'.ADMIN_DIR) === 0 ) {
            define ('APP_TYPE', 'admin');
            define ('APP_PATH', ROOT_PATH.'/'.ADMIN_DIR);
            $url = substr($url, strlen('/'.ADMIN_DIR));

        } elseif ( strpos($url, '/'.API_DIR) === 0 ) {
            define ('APP_TYPE', 'api');
            define ('APP_PATH', ROOT_PATH.'/'.API_DIR);
            $url = substr($url, strlen('/'.API_DIR));

        } else {
            define ('APP_TYPE', 'web');
            define ('APP_PATH', ROOT_PATH.'/'.WEB_DIR);
        }

        include_once(CONFIG_PATH.'/routes/'.APP_TYPE.'.php');

        //Проверка наличия контроллера в базе routes
        foreach ( $this->routes as $route )

            if ( strpos($url.'/', $route['url'].'/') === 0 ) {
                //Добавление названия контроллера и метода при нахождении в базе
                $arr = explode ('@', $route['config']);
                $this->route['methodName'] = $arr[1] ?? 'index';
                $pos = strrpos ( $arr[0], '/');

                //Проверка наличия папки при добавлении указания исполняющего контроллера типа 'folder/controller@method' в функции addRoute
                if ( $pos ) {
                    $this->route['className'] = substr($arr[0], $pos+1);
                    $this->route['path'] = substr($arr[0], 0, $pos);
                } else {
                    $this->route['className'] = $arr[0];
                    $this->route['path'] = '';
                }
                $this->route['filename'] = substr( $this->route['className'], 0, strlen($this->route['className'])-10 );

                if ( $this->route['path'] )
                    $this->route['path'] = APP_PATH. '/controller/'. $this->route['path'];
                else
                    $this->route['path'] = APP_PATH. '/controller';

                $url = ltrim( substr($url, strlen($route['url'])), '/' );
                //Добавление параметров после названия контроллера в ассоциативный массив paramsAss, если есть '=' или в индексированный paramsInd, если его нет
                if ( $url )

                    foreach ( explode( '/', $url) as $param ) {
                        $arr = explode('=', $param);
                        if ( count($arr) == 2 && $arr[0] != '' )
                            $this->paramsAss[$arr[0]] = $arr[1];
                        else 
                            $this->paramsInd[] = $param;
                    }
                break;
            }

        if ( $this->route['className'] == '' ) {
            $this->route['className'] = 'homeController';
            $this->route['filename'] = 'home';
            $this->route['path'] = APP_PATH. '/controller';
            $this->route['methodName'] = 'index';
            $this->paramsInd[] = ltrim($url, '/');
        }
    }

    //Include контроллера при наличии соответствующего файла
    public function loadController ($controllerName = '') {
        
        if ( !$controllerName ) {
            $filename = $this->route['path'] .'/'. $this->route['filename'] .'.php';
            $controller = $this->route['filename'];
        }
        else {
            $arr = explode('/', $controllerName);
            $arrLength = count($arr);

            if ( $arrLength > 1 ) {
                $folder = $arr[0];
                $controller = $arr[1];
                $filename = CONTROLLER_PATH .'/'. $folder .'/'.  $controller .'.php';
            }
            else {
                $controller = $arr[ ($arrLength - 1) ];
                $filename = CONTROLLER_PATH .'/'. $controller .'.php';
            }
        }

        if ( file_exists( $filename ) ) {
            include_once( $filename );
        }
        else 
            $this->errorLog( 'Файл '. $filename .' не найден');

        $controllerName = $controller.'Controller';

        if ( class_exists ($this->route['className']) ) {
            return new $controllerName($controller);
        }
        else
            $this->errorLog( 'Класс '. $this->route['className'] .' не найден' );
    }

    private function errorLog ($errorMsg) {
        echo '<br>', 'Ошибка: ', $errorMsg, '<br>';
        exit;
    }

    private function staticPageExistCheck () {
        //В работе - статичные страницы, добавляемые админом через админ панель
    }

    //Добавление языков в $registry
    private function loadDictionary ($lang = 'ru', $dictFile = 'common') {

        if ( file_exists(LANG_PATH .'/'. $lang .'/'. $dictFile .'.php') ) {
            include_once(LANG_PATH .'/'. $lang .'/'. $dictFile . '.php');
        }
        else {
            echo 'Библиотека для языка ' .$lang. ' не найдена.';
            include_once ( LANG_PATH .'/ru/common.php');
        }
        App::$registry->dict[$dictFile] = $dict;
    }

    //Добавление в $routes возможных url и соответствующих ему контроллеров (controller_nameController@method_name)
    public function addRoute($url, $config) {
        $this->routes[] = [
            'url' => $url, 
            'config' => $config
        ];
    }

    public function getParamsInd () {
        return $this->paramsInd;
    }

    private function logIn () {
        unset( self::$registry->authorise );
        $name = strip_tags( $_POST['username'] );
        $pass = strip_tags( $_POST['password'] );
        $sql = 'SELECT * FROM users WHERE name=:name AND password=:pass';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':pass', $pass);
        $query->execute();
        $rows = $query->rowCount();
        $result = $query->fetch();
        if ( $rows ) {
            self::$registry->authorise['name'] = $name;
            self::$registry->authorise['id'] = $result['id'];
            self::$registry->authorise['login'] = TRUE;
            setcookie('login', $name, time() + 60 * 60, '/');
            if ( $result['access'] == TRUE )
                App::$registry->authorise['access'] = TRUE;
            else
                App::$registry->authorise['access'] = FALSE;
        }
        else
            self::$registry->errors['loginError'] = 'Неправильно введено имя пользователя или пароль';
    }

    private function logOut () {
        setcookie('login', '', time() - 60 * 60, '/');
        unset( self::$registry->authorise );

    }

    private function logInCheck () {
        if ( isset($_COOKIE['login']) ) {
            $query = DB::$pdo->prepare( "SELECT * FROM users WHERE name=:name" );
            $query->execute([ ':name' => $_COOKIE['login'] ]);
            App::$registry->authorise['name'] = ( $query->rowCount() ) ? $_COOKIE['login'] : '';
            App::$registry->authorise['login'] = TRUE;
            $result = $query->fetch();
            App::$registry->authorise['id'] = $result['id'];
            //Проверка имеет ли пользователь доступ к admin странице
            if ( $result['access'] == TRUE )
                App::$registry->authorise['access'] = TRUE;
            else
                App::$registry->authorise['access'] = FALSE;
        }
        else {
            App::$registry->authorise['name'] = '';
            App::$registry->authorise['login'] = FALSE;
            App::$registry->authorise['access'] = FALSE;
            App::$registry->authorise['id'] = FALSE;
        }
    }

    //Log in страницы админа
    public function logInCheckAdmin ($controller) {
        if (App::$registry->authorise['access'] != TRUE) {
            $data = [];
            $data['title'] = 'Login page';
            $view = $controller->getContent($data, 'common/login');
            echo $view;
            die();
        }
        else
            return;
    }





}

