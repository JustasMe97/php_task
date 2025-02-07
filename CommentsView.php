<?php
require_once 'Comments.php';

class CommentsView extends Comments {

    public function listComments() {

        if($this->getCommentsCount()>0)
        {
            
            echo '<div class="fw-bold h4 mb-3">'.$this->getCommentsCount().' komentarų(-ai)</div>';
            $output='';
            foreach ($this->getComment(-1) as $row)
            {
                $output .= '<div class="single_comment">
                <div class="bg-light rounded px-3 pb-3 my-2">
                <div class="d-flex align-items-center">
                <div class="d-flex">
                <div class="fw-bold">'.$row['name'].'</div>
                <div class="mx-1">'.date('d M Y', strtotime($row['comment_date'])).'</div>
                </div>
                <div class="d-flex flex-grow-1 justify-content-end">
                <div type="button" class="reply btn" id="'.$row['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
        <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.7 8.7 0 0 0-1.921-.306 7 7 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254l-.042-.028a.147.147 0 0 1 0-.252l.042-.028zM7.8 10.386q.103 0 .223.006c.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96z"/>
        </svg>Atsakyti</div>
        </div>
                </div>
                <div class="col-md-5">'.$row['comment_text'].'</div>
                <div class="clearfix"></div>
                <p>&nbsp;</p>
            </div>
            
            <div style="display:none;" class="replyForm ms-5">
            <input type="text" id="name" class="nameReply form-control" placeholder="Vardas" maxlength="20"><br>
            <input type="text" id="email" class="emailReply form-control" placeholder="El. paštas"><br>
            <input type="hidden" class="parent_idReply" value="'.$row['id'].'">
            <textarea id="comment" class="comment_textReply form-control" placeholder="Jūsų komentaras (max 200 simbolių)" maxlength="200"></textarea>
            <br>
            <a href="javascript:void(0)" class="btn btn-light submitReply">Komentuoti</a>
            <div class="form_message"></div>
            </div>
            </div>'
            ;
                //prideda atsakymus prie atitinkamų komentarų
                $output .= $this->listReplies($row['id']);
            }
            echo $output.='</div>';
        
        }
    }


    protected function listReplies($parent_id) {
    $outputReplies='';
    $replies= $this->getComment($parent_id);
   
    if(count($replies)>0)
        {
            foreach ($replies as $row)
	        {
                $outputReplies .= '
                    <div class="bg-light rounded p-3 mt-2 mb-2 ms-5">
                        <div class="d-flex">
                            <div class="fw-bold">'.$row['name'].'</div>
                            <div class="mx-1">'.date('d M Y', strtotime($row['comment_date'])).'</div>
                        </div>
                            <div class="mt-1">'.$row['comment_text'].'</div>
                            <div class="clearfix"></div>
                        <p>&nbsp;</p>
                    </div>';
            }
        }
        return $outputReplies;

    }


}