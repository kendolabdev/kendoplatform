<div class="footer-layout1">
    <div class="board">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <h4 class="letter-spacing-1"><?php echo $this->helper()->text('core.about_us');?></h4>
                    <address>
                        <p class="location">
                            <i class="ion-android-pin"></i> &nbsp;
                            <?php echo $contact['address_line_1'];?> <br/>
                            <?php echo $contact['address_line_2'];?> <br/>
                            <?php echo $contact['address_line_3'];?>
                        </p>

                        <p class="phone">
                            <i class="ion-ios-telephone"></i>&nbsp;
                            <?php echo $contact['phone'];?><br/>
                            <i class="fa fa-fax"></i>
                            <?php echo $contact['fax'];?>
                        </p>

                        <p class="mail">
                            <i class="ion-email"></i>&nbsp;
                            <a href="mailto:support@yourname.com">
                                <?php echo $contact['email'];?></a>
                        </p>
                    </address>
                </div>
                <div class="col-md-4 col-sm-6 visible-md">
                    <h4 class="letter-spacing-1"><?php echo $this->helper()->text('core.latest_news');?></h4>
                    <ul class="footer-posts list-unstyled">
                        <li>
                            <a href="#">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue</a>
                            <small>29 June 2015</small>
                        </li>
                        <li>
                            <a href="#">Nullam id dolor id nibh ultricies</a>
                            <small>29 June 2015</small>
                        </li>
                        <li>
                            <a href="#">Duis mollis, est non commodo luctus</a>
                            <small>29 June 2015</small>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 col-sm-6">
                    <h4 class="letter-spacing-1"><?php echo $this->helper()->text('core.keep_in_touch');?></h4>

                    <p><?php echo $this->helper()->text('core.keep_in_touch_note');?></p>

                    <form class="validate" action="php/newsletter.php" method="post"
                          data-success="Subscribed! Thank you!" data-toastr-position="bottom-right"
                          novalidate="novalidate">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" id="email" name="email" class="form-control required"
                                   placeholder="<?php echo $this->helper()->text('core.enter_your_email');?>">
									<span class="input-group-btn">
										<button class="btn btn-success" type="submit">
                                            <?php echo $this->helper()->text('core.subscribe');?>
                                        </button>
									</span>
                        </div>
                        <input type="hidden" name="is_ajax" value="true"></form>
                    <div class="pt-b">
                        <a target="_blank" href="<?php echo $contact['facebook'];?>" class="btn-social facebook"
                           data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                            <i class="ion-social-facebook"></i>
                        </a>

                        <a target="_blank" href="<?php echo $contact['twitter'];?>" class="btn-social twitter"
                           data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                            <i class="ion-social-twitter"></i>
                        </a>

                        <a target="_blank" href="<?php echo $contact['google'];?>" class="btn-social google"
                           data-toggle="tooltip" data-placement="top" title="" data-original-title="Google plus">
                            <i class="ion-social-googleplus"></i>
                        </a>

                        <a target="_blank" href="<?php echo $contact['linkedin'];?>" class="btn-social linkedin"
                           data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
                            <i class="ion-social-linkedin"></i>
                        </a>

                        <a target="_blank" href="<?php echo $contact['website'];?>" class="btn-social rss"
                           data-toggle="tooltip" data-placement="top" title="" data-original-title="Rss">
                            <i class="ion-social-rss"></i>
                        </a>
                        <a target="_blank" href="<?php echo $contact['instagram'];?>" class="btn-social instagram"
                           data-toggle="tooltip" data-placement="top" title="" data-original-title="Instagram">
                            <i class="ion-social-instagram"></i>
                        </a>
                        <a target="_blank" href="<?php echo $contact['youtube'];?>" class="btn-social youtube"
                           data-toggle="tooltip" data-placement="top" title="" data-original-title="YouTube">
                            <i class="ion-social-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Copyright-->
    <div class="copyright">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    &copy; <?php echo date('Y'); ?>  <?php echo $this->helper()->text('core.copyright_label');?>
                </div>
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <ul class="pull-right nomargin list-inline mobile-block">
                        <li><a data-toggle="1" href="<?php echo $this->helper()->url('help_page',['page'=>'terms']);?>">
                            <?php echo $this->helper()->text('core.terms_of_service');?></a></li>
                        <li>•</li>
                        <li><a href="<?php echo $this->helper()->url('help_page',['page'=>'privacy']);?>"
                               data-toggle="1">
                            <?php echo $this->helper()->text('core.privacy');?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>