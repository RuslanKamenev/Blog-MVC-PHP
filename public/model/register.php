<?php

class RegisterModel extends Model {

    public function addNewUser ($name, $email, $pass) {
        $date = date('Y-m-d');
        $sql = 'INSERT INTO users (name, email, password, access, register_date) VALUES (:name, :email, :pass, :access, :date)';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':email', $email);
        $query->bindValue(':pass', $pass);
        $query->bindValue(':date', $date);
        $query->bindValue(':access', '0');
        $query->execute();
        setcookie('login', $name, time() + 60 * 60, '/');
        $register['username'] = $name;
        header('Location: /register_successful');
    }

    public function userExistCheck ($name) {
        $sql = 'SELECT * FROM users WHERE name=:name';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->execute();
        $rows = $query->rowCount();
        if ($rows > 0) {
            $error = 'Пользователь с таким именем уже зарегестрирован';
            return $error;
        }
    }

    public function emailExistCheck ($email) {
        $sql = 'SELECT * FROM users WHERE email=:email';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        $rows = $query->rowCount();
        if ($rows > 0) {
            $error = 'Эта почта уже используется другим пользователем';
            return $error;
        }
    }


}