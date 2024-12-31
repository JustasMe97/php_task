<?php
$link = mysqli_connect("localhost","root","","comments");
$name = mysqli_real_escape_string($link,$_POST['name']);
$email = mysqli_real_escape_string($link,$_POST['email']);
$parent_id = mysqli_real_escape_string($link,$_POST['parent_id']);
$comment_text = mysqli_real_escape_string($link,$_POST['comment_text']);
$comment_date = date_create()->format('Y-m-d H:i:s');

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

<script>
$(document).ready(function() {

    console.log("JavaScript is running");
    // $("#name").addClass("input-error");
    // $("#email").addClass("input-error");
    // $("#comment").addClass("input-error");

$("#name, #email, #comment").removeClass("input-error");
var errorEmptyName = "<?php echo $errorEmptyName; ?>";
var errorEmptyEmail = "<?php echo $errorEmptyEmail; ?>";
var errorEmptyComment = "<?php echo $errorEmptyComment; ?>";
var errorEmail = "<?php echo $errorEmail; ?>";
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
</script>