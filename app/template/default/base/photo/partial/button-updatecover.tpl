<div class="btn-group">
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"
            aria-expanded="false">
        Update Cover
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li data-toggle="tl-cover-upload" data-target="#inputFileCover">
            <a role="button">Upload Photo</a>
        </li>
        <li data-toggle="tl-cover-reposition" class="cover-required">
            <a role="button">Reposition</a></li>
        <li data-toggle="tl-cover-remove" class="cover-required"
            data-object='<?php echo json_encode($dataSubject);?>'>
            <a role="button">Remove</a></li>
    </ul>
    <input type="file" id="inputFileCover" accept="image/*" data-toggle="" class="hidden"/>
</div>