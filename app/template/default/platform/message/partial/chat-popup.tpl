<div class="chat-popup">
    <div class="chat-popup-header">
        <div class="clearfix">
            <span class="recipients"><?php echo $person->getTitle();?></span>

            <div class="pull-right">
                <div class="btn-group">
                    <a href="#" class="btn btn-xs ion-person-add txt" data-toggle="dropdown">
                    </a>
                    <a href="#" class="btn btn-xs ion-gear-b txt" data-toggle="dropdown">
                    </a>
                    <a href="#" class="btn btn-xs ion-close txt" data-toggle="btn-chat-conf-close">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div clares="chat-popup-content">

    </div>
    <div class="chat-popup-footer">
        <div class="edit-group">
            <textarea style="" rows="1" placeholder="write some things"></textarea>
        </div>
        <div class="attach-group">
            <div class="btn-group">
                <button class="btn btn-xs btn-primary">send</button>
                <button class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
            </div>
        </div>
        <!--<a class="ion-happy">-->

        <!--</a>-->
        <!--<a class="ion-android-camera"></a>-->
    </div>
</div>