<?php

class UsersModel extends Model {

    public function getUsersAmount () {
        $sql = 'SELECT id FROM users';
        $query = DB::$pdo->prepare($sql);
        $query->execute();
        $rows = $query->rowCount();
        return $rows;
    }

    public function getUsers () {
        $sql = 'SELECT * FROM users ORDER BY register_date DESC';
        $query = DB::$pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $rows = $query->rowCount();
        for ($i = 0; $i < $rows; $i++) {
            $result[$i]['comments'] = $this->getCommentsAmount($result[$i]['id']);
        }
        return $result;
    }

    public function getUsersSearch ($searchData) {
        $sql = 'SELECT * FROM users WHERE name LIKE :searchData ORDER BY register_date DESC';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':searchData', '%'.$searchData.'%');
        $query->execute();
        $result = $query->fetchAll();
        $rows = $query->rowCount();
        if ($rows == 0)
            $result = 'Пользователи с указанным именем не найдены';
        else {
            for ($i = 0; $i < $rows; $i++) {
                $result[$i]['comments'] = $this->getCommentsAmount($result[$i]['id']);
            }
        }
        return $result;
    }

    public function getCommentsAmount ($author) {
        $sql = 'SELECT id FROM comments where author=:author ORDER BY date DESC';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':author', $author);
        $query->execute();
        $result = $query->rowCount();
        return $result;
    }

    public function deleteUser ($id) {
        $sql = 'DELETE FROM comments WHERE author=:author';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':author', $id);
        $query->execute();

        $sql = 'DELETE FROM users WHERE id=:id';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return;
    }

    public function changeAccess ($id, $access) {
        $sql = 'UPDATE users SET access=:access WHERE id=:id';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':access', $access);
        $query->execute();
        return;
    }


}
