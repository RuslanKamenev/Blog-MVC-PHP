<?php

class PostModel extends Model {

    public function getPost ($id) {
        $sql = 'SELECT * FROM posts WHERE id=:id';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch();
        $authorId = $result['authorId'];
        $result['authorName'] = $this->getUser($authorId)['name'];
        $result['authorAvatar'] = $this->getUser($authorId)['avatar'];
        return $result;
    }

    public function getUser ($id) {
        $sql = 'SELECT * FROM users WHERE id=:id';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $result = $query->fetch();
        $date = new DateTime($result['register_date']);
        $dateFormatted = date_format($date, 'd-m-Y');
        $result['date'] = $dateFormatted;
        return $result;
    }

    public function getUserId ($name) {
        $sql = 'SELECT id FROM users WHERE name=:name';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->execute();
        $result = $query->fetch();
        $id = $result['id'];
        return $id;
    }

    public function getComments ($post, $commentsAmount, $page = '') {
        if ( $page ) {
            $begin = $page * $commentsAmount - $commentsAmount;
            $sql = 'SELECT * FROM comments where post=:post ORDER BY date DESC LIMIT :begin, :limit';
        }
        else
            $sql = 'SELECT * FROM comments where post=:post ORDER BY date DESC LIMIT :limit';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':post', $post);
        $query->bindValue(':limit', $commentsAmount, PDO::PARAM_INT);
        if ( $page )
            $query->bindParam (':begin', $begin, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();
        $rows = $query->rowCount();
        for ($i = 0; $i < $rows; $i++) {
            $authorInfo = $this->getUser( $result[$i]['author'] );
            $result[$i]['authorName'] = $authorInfo['name'];
            $result[$i]['authorAvatar'] = $authorInfo['avatar'];
        }
        return $result;
    }

    public function getCommentsAmount ($post) {
        $sql = 'SELECT id FROM comments where post=:post ORDER BY date DESC';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':post', $post);
        $query->execute();
        $result = $query->rowCount();
        return $result;
    }

    public function getLastPosts ($page = '') {
        if ( $page ) {
            $begin = $page * 5 - 5;
            $sql = 'SELECT * FROM posts ORDER BY date DESC LIMIT :begin, 5';
        }
        else
            $sql = 'SELECT * FROM posts ORDER BY date DESC LIMIT 5';
        $query = DB::$pdo->prepare($sql);
        if ( $page )
            $query->bindParam (':begin', $begin, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();
        $rows = $query->rowCount();
        //Преобразование времени даты создания поста, получение ника автора поста
        for ($i = 0; $i < $rows; $i++) {
            $datetime = new DateTime($result[$i]['date']);
            $commentDate = date_format($datetime, 'd-m-Y H:i:s');
            $result[$i]['postDate'] = $commentDate;
            $authorId = $result[$i]['authorId'];
            $result[$i]['authorName'] = $this->getUser($authorId)['name'];
        }
        return $result;
    }

    public function addComment ($comment, $userId, $postId) {
        $date = date('Y-m-d H:i:s');
        $sql = 'INSERT INTO comments (text, date, post, author) VALUES (:text, :date, :post, :author)';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':text', $comment);
        $query->bindValue(':date', $date);
        $query->bindValue(':post', $postId, PDO::PARAM_INT);
        $query->bindValue(':author', $userId);
        $query->execute();
    }

    public function getPostsAmount () {
        $sql = 'SELECT id FROM posts';
        $query = DB::$pdo->prepare($sql);
        $query->execute();
        $result = $query->rowCount();
        return $result;
    }



}
