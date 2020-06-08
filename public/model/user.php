<?php

class UserModel extends Model {

    public function getCommentsAmount ($id) {
        $sql = 'SELECT id FROM comments where author=:author';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':author', $id);
        $query->execute();
        $result = $query->rowCount();
        return $result;
    }

    public function uploadAvatar ($userId, $fileName) {
        $sql = 'UPDATE users SET avatar=:avatar WHERE id=:id';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':id', $userId);
        $query->bindValue(':avatar', $fileName);
        $query->execute();
        return;
    }

    public function getAvatar ($userId) {
        $sql = 'SELECT avatar FROM users where id=:id';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':id', $userId);
        $query->execute();
        $result = $query->fetch()['avatar'];
        return $result;
    }

}