<?php

class UserController extends Controller {

    public function index () {

        $headerController = App::$app->loadController('header');
        $headerController->index();
        $userId = App::$app->getParamsInd()[0];
        $userModel = $this->loadModel();
        $postModel = $this->loadModel('post');

        if ( isset( $_POST['upload-avatar-submit'] ) )
            $this->uploadAvatar($userId, $userModel);

        $userData = $postModel->getUser($userId);
        $commentsAmount = $userModel->getCommentsAmount($userData['id']);
        $data['title'] = 'Пользователь';
        $data['userInfo'] = $userData;
        $data['commentsAmount'] = $commentsAmount;
        $page = $this->getFullPage($data);
        echo $page;
    }

    public function uploadAvatar ($id, $model) {

        if ($_FILES == "") {
            $error = 'Файл не выбран';
            return $error;
        }

        $filesDir = "uploads/avatar/";
        $fileName = $_FILES['user-avatar']['name'];
        $filePath = $filesDir . uniqid() . $fileName;
        $fileCheck = 0;

        switch ($_FILES['user-avatar']['type']) {
            case 'image/jpeg':
            case 'image/jpg':
            case 'image/png':
                $fileCheck += 0;
                break;
            default:
                $fileCheck += 1;
                break;
        }

        if ($fileCheck > 0) {
            $error = "<br>Поддерживаемые форматы: jpeg, jpg или png. Файл \"$fileName\" имеет неправильное расширение<br>";
            return $error;
        } else {
            $tmpFilePath = $_FILES['user-avatar']['tmp_name'];
            move_uploaded_file($tmpFilePath, $filePath);
            $model->uploadAvatar($id, $filePath);
        }
    }

}
