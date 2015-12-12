<?php foreach($comments as $comment): ?>
<?php echo $this->helper()->partial('platform/comment/partial/comment-item',['comment'=>$comment,'about'=>$about,'poster'=>$comment->getPoster(), 'attachment'=> $comment->getAttachment()]);?>
<?php endforeach; ?>