<div class="footer-layout3">
    <div class="container-fluid pt-b pb-b">

        <div class="row">

            <div class="col-md-8">

                <!-- Footer Logo -->
                <img class="footer-logo footer-2" src="assets/images/logo-footer.png" alt="" />

                <!-- Small Description -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque.</p>

                <hr />

                <div class="row">
                    <div class="col-md-6 col-sm-6">

                        <!-- Newsletter Form -->
                        <p class="margin-bottom-10">Subscribe to Our <strong>Newsletter</strong></p>

                        <form id="newsletterForm" action="php/newsletter.php" role="form" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email" required="required">
								<span class="input-group-btn">
									<button class="btn btn-success" type="submit">Subscribe</button>
								</span>
                            </div>
                        </form>
                        <!-- /Newsletter Form -->
                    </div>

                    <div class="col-md-6 col-sm-6 hidden-xs">

                        <!-- Social Icons -->
                        <div class="margin-left-50 clearfix">

                            <p class="margin-bottom-10">Follow Us</p>
                            <div class="">
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
                        <!-- /Social Icons -->

                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="copyright">
        <div class="container-fluid">
            <ul class="list-inline inline-links mobile-block pull-right nomargin">
                <li><a data-toggle="1" href="<?php echo $this->helper()->url('help_page',['page'=>'terms']);?>">
                    <?php echo $this->helper()->text('core.terms_of_service');?></a></li>
                <li>•</li>
                <li><a href="<?php echo $this->helper()->url('help_page',['page'=>'privacy']);?>"
                       data-toggle="1">
                    <?php echo $this->helper()->text('core.privacy');?></a></li>
            </ul>

            &copy; <?php echo date('Y'); ?>  <?php echo $this->helper()->text('core.copyright_label');?>
        </div>
    </div>
</div>