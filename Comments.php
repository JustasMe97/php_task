<?php
require_once 'Dbh.php';

class Comments extends Dbh {

    protected function getComment($parent_id){

        $sql = "SELECT * FROM comments WHERE parent_id=? ORDER BY comment_date DESC";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$parent_id]);
        $results=$stmt->fetchAll();

        return $results;

    }
    
    protected function getCommentsCount() {

        $sql = "SELECT * FROM comments";
        $stmt= $this->connect()->query($sql);
        $results=$stmt->fetchAll();

        return count($results);
    }

    protected function setComment($name, $email,$parent_id,$comment_text,$comment_date){

        $sql="INSERT INTO comments (name,email,parent_id,comment_text,comment_date) VALUES(?,?,?,?,?)";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute([$name, $email, $parent_id, $comment_text, $comment_date]);

    }
}