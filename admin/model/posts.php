<?php

class PostsModel extends Model {

    public function getPostsAmount () {
        $sql = 'SELECT id FROM posts';
        $query = DB::$pdo->prepare($sql);
        $query->execute();
        $rows = $query->rowCount();
        return $rows;
    }

    public function getPosts () {
        $sql = 'SELECT * FROM posts ORDER BY date DESC';
        $query = DB::$pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $rows = $query->rowCount();
        //Преобразование времени даты создания поста, получение ника автора поста
        for ($i = 0; $i < $rows; $i++) {
            $datetime = new DateTime($result[$i]['date']);
            $commentDate = date_format($datetime, 'd-m-Y H:i:s');
            $result[$i]['postDate'] = $commentDate;
            $result[$i]['comments'] = $this->getCommentsAmount($result[$i]['id']);
        }
        return $result;
    }

    public function getPostsSearch ($searchData) {
        $sql = 'SELECT id, title FROM posts WHERE title LIKE :searchData ORDER BY date DESC';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':searchData', '%'.$searchData.'%');
        $query->execute();
        $rows = $query->rowCount();
        $result = $query->fetchAll();
        if ($rows == 0)
            $result = 'Посты с указанным именем не найдены';
        else {
            for ($i = 0; $i < $rows; $i++) {
                $datetime = new DateTime($result[$i]['date']);
                $commentDate = date_format($datetime, 'd-m-Y H:i:s');
                $result[$i]['postDate'] = $commentDate;
                $result[$i]['comments'] = $this->getCommentsAmount($result[$i]['id']);
            }
        }
        return $result;
    }

    public function getAuthor ($id) {
        $sql = 'SELECT * FROM users WHERE id=:id';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function getCommentsAmount ($post) {
        $sql = 'SELECT * FROM comments where post=:post ORDER BY date DESC';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':post', $post);
        $query->execute();
        $result = $query->rowCount();
        return $result;
    }

    public function deletePost ($id) {
        $sql = 'DELETE FROM comments WHERE post=:post';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':post', $id);
        $query->execute();

        $sql = 'DELETE FROM posts WHERE id=:id';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return;
    }



}
