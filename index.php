<!DOCTYPE html>
<html>
<head>
	<title>Comments</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	
</head>
<body>
<div class="container-fluid">
    <h1 class="d-flex justify-content-center">Komentarų forma</h1>
            <p>&nbsp;</p>
        <div class="d-flex align-items-center flex-column">
           
		<div class="col-lg-6 col-md-12">
			<input type="text" id="name" class="name form-control" placeholder="Vardas" maxlength="20"><br>
			<input type="text" id="email" class="email form-control" placeholder="El. paštas"><br>
            <input type="hidden" class="parent_id" value="-1">
			<textarea id="comment" class="comment_text form-control"  placeholder="Jūsų komentaras (max 200 simbolių.)"></textarea>
             <br>
			<a href="javascript:void(0)" class="btn btn-light submit">Komentuoti</a>
		</div>
        <div id="form_message" class="form_message"></div>
        </div>
		<div class="clearfix"></div>
        <p>&nbsp;</p>

        <div class="d-flex justify-content-center">
		<div class="col-lg-6 col-md-12 comment_listing"></div>
        </div>

	</div>
</body>
</html>


<script type="text/javascript">
//funkcija komentarų atvaizdavimui
	function listComments()
		{
			$.ajax({
				url:'comment_list.php',
				success:function(res){
					$('.comment_listing').html(res);
				}
			})
		}

	$(function(){

		listComments();
        //naujo komentaro pridėjimas naudojant ajax
		$('.submit').click(function(){
		var name = $('.name').val();
		var email = $('.email').val();
        var parent_id = $('.parent_id').val();
		var comment_text = $('.comment_text').val();
		$.ajax({
		url:'create_comment.php',
		data:'name='+name+'&email='+email+'&parent_id='+parent_id+'&comment_text='+comment_text,
		type:'post',
		success:function(response){
        $('.form_message').html(response);
        $.globalEval(response);
		listComments();
		}
		})
		})

	})

</script>

<script>
$(document).on("click", ".reply", function() {
	//išskleidžia komentarų atsakymo formą
    // Suranda arčiausią .single_comment konteinerį paspaustam .reply mygtukui
    var $comment = $(this).closest(".single_comment");
    // Suranda .replyForm viduje specifinio .single_comment konteinerio ir pakeičia matomumą
    $comment.find(".replyForm").slideToggle(function() {
        // sufokusuoja į input lauką su klase 'nameReply' kai forma tampa matoma
        if ($(this).is(":visible")) {
            $(this).find(".nameReply").focus();
        }
    });

});
</script>

<script>
	//komentarų atsakymų pridėjimas
$(document).on("click", ".submitReply", function(){

		
    var $container = $(this).closest('.single_comment'); //suranda į kurį komentarą atsakyti.
    var parent_id = $container.find('.parent_idReply').val();
    var name = $container.find('.nameReply').val();
    var email = $container.find('.emailReply').val();
    var comment_text = $container.find('.comment_textReply').val();
		$.ajax({
		url:'create_comment.php',
		data:'name='+name+'&email='+email+'&parent_id='+parent_id+'&comment_text='+comment_text,
		type:'post',
		success:function(response){
        $('.form_message').html(response);
        $.globalEval(response);
		//jei formoje klaidų nėra, iš naujo atvaizduoti komentarus su naujai pridėtu
		//jei yra klaidų, tada forma lieka
		if(!response.includes("form-error")){
		listComments();
		}

		}
		})
        $('replyForm').show();
		});
</script>
