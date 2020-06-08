<?php

class HeaderModel extends Model {

    public function searchPost ($searchData) {

        $sql = 'SELECT id, title FROM posts WHERE title LIKE :searchData ORDER BY date DESC ';
        $query = DB::$pdo->prepare($sql);
        $query->bindValue(':searchData', '%'.$searchData.'%');
        $query->execute();
        $rows = $query->rowCount();
        $result = $query->fetchAll();

        if ($rows == 0)
            echo "No matches found";
        else {
            echo "<ul>";
            foreach ($result as $row) {
                $title = $row['title'];
                $id = $row['id'];
                echo "<li><a href='/post/$id'><div class='search-result-row'><div class='search-result-game'>". $title ."</div></div></a></li>";
            }
            echo "</ul>";
        };

    }

}
