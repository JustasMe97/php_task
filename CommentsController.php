<?php
require_once 'Comments.php';

class CommentsController extends Comments {

    public function createComment($name, $email,$parent_id,$comment_text,$comment_date){
        $this->setComment($name, $email,$parent_id,$comment_text,$comment_date);
    }

    public function getCommentsCount(){

        $results=$this->getAllComments();
        return count($results);
        }


    
}