<?php

require_once 'CommentsController.php';

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$parent_id = $_POST['parent_id'];
$comment_text = htmlspecialchars($_POST['comment_text']);
$comment_date = date_create()->format('Y-m-d H:i:s');

//patikrinami laukai
    $errorEmptyName = false;
    $errorEmptyEmail = false;
    $errorEmptyComment = false;
    $errorEmail = false;
    $errorLongName = false;
    $errorLongComment = false;
if (empty($name) || empty($email) || empty($comment_text)) {
        echo "<span class='form-error'>Užpildykite visus laukus!</span>";
        $errorEmpty = true;
    }    
        if (empty($name)) {
        $errorEmptyName = true;
    }   if (empty($email)) {
        $errorEmptyEmail = true;
    }    if (empty($comment_text)) {
        $errorEmptyComment = true;
    }   
    
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span class='form-error'>
        Įveskite tinkamą el. pašto adresą! </span>";
        $errorEmail = true;
    }
    elseif (strlen($comment_text)>200) {
        echo "<span class='form-error'>Komentaras per ilgas, max 200 simbolių!</span>";
        $errorLongComment = true;
    }   
    elseif (strlen($name)>20) {
        echo "<span class='form-error'>Vardas per ilgas, max 20 simbolių!</span>";
        $errorLongName = true;
    }
    else {
        echo "<span class='form-success'>
        Jūs sėkmingai pakomentavote!
        </span>";
        
        $commentsController = new CommentsController();
        $commentsController->createComment($name, $email,$parent_id,$comment_text,$comment_date);
    }
?>
<?php
if($parent_id==-1){
echo '
<script>
$(document).ready(function() {

$("#name, #email, #comment").removeClass("input-error");
var errorEmptyName = "'.$errorEmptyName.'";
var errorEmptyEmail = "'.$errorEmptyEmail.'";
var errorEmptyComment = "'.$errorEmptyComment.'";
var errorEmail = "'.$errorEmail.'";
var errorLongComment = "'.$errorLongComment.'";
var errorLongName = "'.$errorLongName.'";
if (errorEmptyName == true || errorLongName == true ) {
    $("#name").addClass("input-error");
}   if (errorEmptyEmail == true) {
    $("#email").addClass("input-error");
}   if (errorEmptyComment == true || errorLongComment == true) {
    $("#comment").addClass("input-error");
}
if (errorEmail == true) {
    $("#email").addClass("input-error");
}
if (errorEmptyName == false && errorEmptyEmail == false && errorEmptyComment == false && errorEmail == false) {
    $("#name, #email, #comment").val("");
}

})
</script>';
}
?>