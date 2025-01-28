<?php
require_once 'CommentsView.php';
require_once 'CommentsController.php';
$commentsView= new CommentsView();
$parentComments=$commentsView->listComments(-1);
?>