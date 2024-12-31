<?php
$link = mysqli_connect("localhost","root","","comments");
$commentsCount=mysqli_num_rows(mysqli_query($link,"SELECT * FROM comments"));
$result = mysqli_query($link,"SELECT * FROM comments WHERE parent_id=-1 ORDER BY comment_date DESC");

if(mysqli_num_rows($result)>0)
{
    
    echo '<div class="fw-bold h4 mb-3">'.$commentsCount.' komentarų(-ai)</div>';
    $output='';
    while($row=mysqli_fetch_object($result))
	{
        $output .= '<div class="single_comment">
        <div class="bg-light rounded p-2 mt-2 mb-2">
        <div class="d-flex">
        <div class="d-flex">
		<div class="fw-bold">'.$row->name.'</div>
        <div class="mx-1">'.$row->comment_date.'</div>
        </div>
        <div class="d-flex flex-grow-1 justify-content-end">
        <div type="button" class="reply btn" id="'.$row->id.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
  <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.7 8.7 0 0 0-1.921-.306 7 7 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254l-.042-.028a.147.147 0 0 1 0-.252l.042-.028zM7.8 10.386q.103 0 .223.006c.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96z"/>
</svg>Atsakyti</div>
</div>
        </div>
		<div class="col-md-5">'.$row->comment_text.'</div>
		<div class="clearfix"></div>
		<p>&nbsp;</p>
    </div>
    
    <div style="display:none;" class="replyForm ms-5">
    <input type="text" class="nameReply form-control" placeholder="Vardas"><br>
    <input type="text" class="emailReply form-control" placeholder="El. paštas"><br>
    <input type="hidden" class="parent_idReply" value="'.$row->id.'"><br>
    <textarea class="comment_textReply form-control" placeholder="Jūsų komentaras"></textarea>
    <p>&nbsp;</p>
    <a href="javascript:void(0)" class="btn btn-light submitReply">Komentuoti</a>
    </div>
    </div>'
    ;
        $output .= getReplies($link,$row->id);
    }
    echo $output.='</div>';

}


function getReplies($link,$parent_id){
    $outputReplies='';
    $replies = mysqli_query($link,"SELECT * FROM comments WHERE parent_id=$parent_id ORDER BY id DESC");
        if(mysqli_num_rows($replies)>0)
        {
            while($row=mysqli_fetch_object($replies))
	        {
                $outputReplies .= '
                    <div class="bg-light rounded p-2 mt-2 mb-2 ms-5">
                        <div class="d-flex">
                            <div class="fw-bold">'.$row->name.'</div>
                            <div class="mx-1">'.$row->comment_date.'</div>
                        </div>
                            <div class="col-md-5">'.$row->comment_text.'</div>
                            <div class="clearfix"></div>
                        <p>&nbsp;</p>
                    </div>';
            }
        }
        return $outputReplies;
}
?>