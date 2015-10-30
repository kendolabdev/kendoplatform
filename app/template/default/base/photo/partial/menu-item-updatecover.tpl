<li>
    <a type="button" class="dropdown-toggle" data-toggle="dropdown"
            aria-expanded="false">
        Update Cover
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li data-toggle="tl-cover-upload" data-target="#inputFileCover">
            <a role="button">Upload Photo</a>
        </li>
        <li data-toggle="tl-cover-take">
            <a role="button">Take a Photo</a></li>
        <li data-toggle="tl-cover-reposition" class="cover-required">
            <a role="button">Reposition</a></li>
        <li data-toggle="tl-cover-remove" class="cover-required"
            data-object='<?php echo json_encode($dataSubject);?>'>
            <a role="button">Remove</a></li>
        <li data-toggle="tl-cover-save" class="hidden"
            data-object='<?php echo json_encode($dataSubject);?>'>
            <a role="button">
                Save Cover
            </a>
        </li>
        <li data-toggle="tl-cover-cancel" class="hidden">
            <a role="button">
                Cancel
            </a>
        </li>
    </ul>
    <input type="file" id="inputFileCover" accept="image/*" data-toggle="" class="hidden"/>
</li>