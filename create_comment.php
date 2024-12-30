<?php
$link = mysqli_connect("localhost","root","","comments");
$name = mysqli_real_escape_string($link,$_POST['name']);
$email = mysqli_real_escape_string($link,$_POST['email']);
$comment_text = mysqli_real_escape_string($link,$_POST['comment_text']);
$comment_date = date('Y m d');


$q = "INSERT INTO comments (name,email,comment_text,comment_date) VALUES('".$name."','".$email."','".date_format($comment_date,'d M Y')."','".$comment_date."')";
mysqli_query($link,$q);


?>