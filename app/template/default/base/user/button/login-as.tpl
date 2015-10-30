<a role="button"
   class="btn btn-sm btn-default"
   data-toggle="1"
   href="<?php echo $this->helper()->url('login_as',['type'=>$item->getType(),'id'=>$item->getId()]);?>">
    <i class="ion-forward"></i>
    <span class="txt">Login</span>
</a>