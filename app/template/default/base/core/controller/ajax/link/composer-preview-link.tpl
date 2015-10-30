<div class="composer-preview-link as-<?php echo $link_type;?>">
    <?php if($link_type=='video'): ?>
    <div class="attachment-wrap attachment-media small attachment-ratio-85 _video">
        <div class="attachment-stage noope">
            <div class="attachment-content">
                <div class="attachment-content-stage">
                    <div class="attachment-thumb">
                        <div class="attachment-img" style="background-image: url(<?php echo $thumbnail_url; ?>)"></div>
                        <div class="attachment-duration"><?php echo $duration;?></div>
                        <div class="attachment-mask"></div>
                        <a class="attachment-close ion-close" data-toggle="fc-attatch-remove"></a>
                    </div>
                    <div class="attachment-body">
                        <div class="attachment-body-stage">
                            <div class="attachment-title">
                                <div class="attachment-title-stage"><?php echo $title; ?></div>
                            </div>
                            <div class="attachment-desc">
                                <div class="attachment-desc-stage"><?php echo $description; ?></div>
                            </div>
                            <div class="attachment-extra">
                                <div class="attachment-extra-stage"><?php echo $provider_name;?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden"><input type="hidden" name="video[title]" value="<?php echo $title;?>"/>
            <input type="hidden" name="video[description]" value="<?php echo $description;?>"/>
            <input type="hidden" name="video[provider_name]" value="<?php echo $provider_name;?>"/>
            <input type="hidden" name="video[thumbnail_url]" value="<?php echo $thumbnail_url;?>"/>
            <input type="hidden" name="video[thumbnail_small_url]" value="<?php echo $thumbnail_small_url;?>"/>
            <input type="hidden" name="video[video_duration" value="<?php echo $video_duration;?>"/>
            <input type="hidden" name="video[origin_url]" value="<?php echo $origin_url;?>"/>
            <input type="hidden" name="video[definition]" value="<?php echo $definition;?>"/>
            <input type="hidden" name="video[provider_code]" value="<?php echo $provider_code;?>"/>
            <input type="hidden" name="video[dimension]" value="<?php echo $dimension;?>"/>
            <input type="hidden" name="video[video_code]" value="<?php echo $video_code;?>"/>
            <input type="hidden" name="video[thumb_mode]" value="<?php echo $thumb_mode;?>"/></div>
    </div>
    <?php endif; ?>
    <?php if(!empty($thumbnail_url)): ?>
    <div class="attachment-wrap attachment-media small attachment-ratio-85 _link">
        <div class="attachment-stage noope">
            <div class="attachment-content">
                <div class="attachment-content-stage">
                    <div class="attachment-thumb">
                        <div class="attachment-img" style="background-image: url(<?php echo $thumbnail_url; ?>)"></div>
                        <a class="attachment-close ion-close" data-toggle="fc-attatch-remove"></a>
                    </div>
                    <div class="attachment-body">
                        <div class="attachment-body-stage">
                            <div class="attachment-title">
                                <div class="attachment-title-stage"><?php echo $title; ?></div>
                            </div>
                            <div class="attachment-desc">
                                <div class="attachment-desc-stage"><?php echo $description; ?></div>
                            </div>
                            <div class="attachment-extra">
                                <div class="attachment-extra-stage"><?php echo $provider_name;?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden"><input type="hidden" name="link[title]" value="<?php echo $title;?>"/>
            <input type="hidden" name="link[description]" value="<?php echo $description;?>"/>
            <input type="hidden" name="link[provider_name]" value="<?php echo $provider_name;?>"/>
            <input type="hidden" name="link[origin_url]" value="<?php echo $origin_url;?>"/>
            <input type="hidden" name="link[thumbnail_url]" value="<?php echo $thumbnail_url;?>"/></div>
    </div>
    <?php else: ?>
    <div class="attachment-wrap attachment-media attachment-ratio-85 _link small">
        <div class="attachment-stage noope">
            <div class="attachment-content">
                <div class="attachment-content-stage">
                    <div class="attachment-thumb" style="background-image: url(<?php echo $thumbnail_url;?>)">
                        <img src="<?php echo $thumbnail_url; ?>"/>
                        <a class="attachment-close ion-close" data-toggle="fc-attatch-remove"></a>
                    </div>
                    <div class="attachment-body">
                        <div class="attachment-body-stage">
                            <div class="attachment-title">
                                <div class="attachment-title-stage"><?php echo $title; ?></div>
                            </div>
                            <div class="attachment-desc">
                                <div class="attachment-desc-stage"><?php echo $description; ?></div>
                            </div>
                            <div class="attachment-extra">
                                <div class="attachment-extra-stage"><?php echo $provider_name;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden"><input type="hidden" name="link[title]" value="<?php echo $title;?>"/>
                        <input type="hidden" name="link[description]" value="<?php echo $description;?>"/>
                        <input type="hidden" name="link[provider_name]" value="<?php echo $provider_name;?>"/>
                        <input type="hidden" name="link[thumbnail_url]" value="<?php echo $thumbnail_url;?>"/>
                        <input type="hidden" name="link[origin_url]" value="<?php echo $origin_url;?>"/></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="cmd-list">
        <?php if($link_type != 'link'): ?>
        <a role="button"
           class="" data-toggle="fc-attatch-as-link"
           data-label1="Attatch as link"
           data-label2="Attatch as video"
                >Attatch as link</a>
        <?php endif; ?>
        <a role="button" class="" data-toggle="fc-attatch-remove">Remove</a>
    </div>
    <input type="hidden" name="attachment[type]" class="attachment-type" value="<?php echo $link_type;?>"/>
</div>