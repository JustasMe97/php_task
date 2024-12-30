<!DOCTYPE html>
<html>
<head>
	<title>Comments</title>
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
	<div class="container">
    <h1 class="d-flex justify-content-center">Komentarų forma</h1>
            <p>&nbsp;</p>
        <div class="d-flex justify-content-center">
           
		<div class="col-md-6">
			<input type="text" class="name form-control" placeholder="Vardas"><br>
			<input type="text" class="email form-control" placeholder="El. paštas"><br>
			<textarea class="comment_text form-control" placeholder="Jūsų komentaras"></textarea>
			<p>&nbsp;</p>
			<a href="javascript:void(0)" class="btn btn-primary submit">Komentuoti</a>
		</div>
        </div>
		<div class="clearfix"></div>
        <p>&nbsp;</p>

        <div class="d-flex justify-content-center">
		<div class="col-md-6 comment_listing"></div>
        </div>

	</div>
</body>
</html>


<script type="text/javascript">
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
		// setInterval(function(){
		// listComments();
		// },10000);
		$('.submit').click(function(){
		var name = $('.name').val();
		var email = $('.email').val();
		var comment_text = $('.comment_text').val();
		$.ajax({
		url:'create_comment.php',
		data:'name='+name+'&email='+email+'&comment_text='+comment_text,
		type:'post',
		success:function()
		{
		alert("Your comment has been posted");
		listComments();
		}
		})
		})
	})
</script>

