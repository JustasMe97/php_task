<?php
$link = mysqli_connect("localhost","root","","comments");
$name = htmlspecialchars(mysqli_real_escape_string($link,$_POST['name']));
$email = htmlspecialchars(mysqli_real_escape_string($link,$_POST['email']));
$parent_id = mysqli_real_escape_string($link,$_POST['parent_id']);
$comment_text = htmlspecialchars(mysqli_real_escape_string($link,$_POST['comment_text']));
$comment_date = date_create()->format('Y-m-d H:i:s');

//patikrinami laukai
    $errorEmptyName = false;
    $errorEmptyEmail = false;
    $errorEmptyComment = false;
    $errorEmail = false;
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
    else {
        echo "<span class='form-success'>
        Jūs sėkmingai pakomentavote!
        </span>";
        
        $q = "INSERT INTO comments (name,email,parent_id,comment_text,comment_date) VALUES('".$name."','".$email."','".$parent_id."','".$comment_text."','".$comment_date."')";
        mysqli_query($link,$q);
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
if (errorEmptyName == true) {
    $("#name").addClass("input-error");
}   if (errorEmptyEmail == true) {
    $("#email").addClass("input-error");
}   if (errorEmptyComment == true) {
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