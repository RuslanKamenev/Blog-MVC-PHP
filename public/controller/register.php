<?php

class RegisterController extends Controller {

    public function __construct($filename) {
        parent::__construct($filename);
    }

    public function index() {

        $headerController = App::$app->loadController('header');
        $headerController->index();
        $data['title'] = 'Зарегестрироваться';
        $model = $this->loadModel();

        //Исходные данные
        $result['title'] = 'Зарегестрироваться';
        $registerName = $_POST['register-username'] ?? '';
        $data['registerName'] = $registerName;
        $registerEmail = $_POST['register-email'] ?? '';
        $data['registerEmail'] = $registerEmail;
        $pass1 = $_POST['register-password-1'] ?? '';
        $pass2 = $_POST['register-password-2'] ?? '';

        //Проверка формы при нажатии на кнопку
        if ($_POST['register-press']) {
            $data['registerError'] = $this->registerUser($registerName, $registerEmail, $pass1, $pass2, $model);

            if ($data['registerError'] == '') {
                $model->addNewUser($registerName, $registerEmail, $pass1);
            }
        }

        $page = $this->getFullPage($data);
        echo $page;
    }

    public function successful() {

        $data['title'] = 'Регистрация завершена';
        header('refresh:5; url=/home');
        $page = $this->getFullPage($data, 'register/successful');
        echo $page;
    }

    public function registerUser($registerName, $registerEmail, $pass1, $pass2, $model) {
        $error = $this->userValidation($registerName);
        if ($error) {
            $result = $error;
            return $result;
        }
        $error = $this->emailValidation($registerEmail);
        if ($error) {
            $result = $error;
            return $result;
        }
        $error = $this->passwordValidation($pass1, $pass2);
        if ($error) {
            $result = $error;
            return $result;
        }
        $error = $model->userExistCheck($registerName);
        if ($error) {
            $result = $error;
            return $result;
        }
        $error = $model->emailExistCheck($registerEmail);
        if ($error) {
            $result = $error;
            return $result;
        }
    }

    public function userValidation ($name) {
        $error = strlen($name) < 2 ? 'Имя не может иметь меньше 2-х символов' : '';
        return $error;
    }

    public function emailValidation($email) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $error = $email == FALSE ? 'Проверьте правильность ввода почты' : '';
        return $error;
    }

    public function passwordValidation($pass1, $pass2) {
        if (strlen($pass1) < 3)
            return 'Пароль не может быть короче 3 символов';
        if ($pass1 !== $pass2)
            return 'Пароли не совпадают';
        return '';
    }




}
