<div class="footer-layout2">
    <div class="container-fluid">

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

                        <form action="php/newsletter.php" role="form" method="post">
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
                            <a href="#" class="social-icon social-icon-sm social-icon-transparent social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">
                                <i class="icon-facebook"></i>
                                <i class="icon-facebook"></i>
                            </a>

                            <a href="#" class="social-icon social-icon-sm social-icon-transparent social-twitter pull-left" data-toggle="tooltip" data-placement="top" title="Twitter">
                                <i class="icon-twitter"></i>
                                <i class="icon-twitter"></i>
                            </a>

                            <a href="#" class="social-icon social-icon-sm social-icon-transparent social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">
                                <i class="icon-gplus"></i>
                                <i class="icon-gplus"></i>
                            </a>

                            <a href="#" class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                <i class="icon-linkedin"></i>
                                <i class="icon-linkedin"></i>
                            </a>

                            <a href="#" class="social-icon social-icon-sm social-icon-transparent social-rss pull-left" data-toggle="tooltip" data-placement="top" title="Rss">
                                <i class="icon-rss"></i>
                                <i class="icon-rss"></i>
                            </a>

                        </div>
                        <!-- /Social Icons -->

                    </div>

                </div>

            </div>

            <div class="col-md-4">
                <h4 class="letter-spacing-1">PHOTO GALLERY</h4>

                <div class="footer-gallery lightbox" data-plugin-options='{"delegate": "a", "gallery": {"enabled": true}}'>
                    <a href="assets/images/demo/1200x800/10-min.jpg">
                        <img src="assets/images/demo/150x99/10-min.jpg" width="106" height="70" alt="" />
                    </a>
                    <a href="assets/images/demo/1200x800/19-min.jpg">
                        <img src="assets/images/demo/150x99/19-min.jpg" width="106" height="70" alt="" />
                    </a>
                    <a href="assets/images/demo/1200x800/12-min.jpg">
                        <img src="assets/images/demo/150x99/12-min.jpg" width="106" height="70" alt="" />
                    </a>
                    <a href="assets/images/demo/1200x800/13-min.jpg">
                        <img src="assets/images/demo/150x99/13-min.jpg" width="106" height="70" alt="" />
                    </a>
                    <a href="assets/images/demo/1200x800/18-min.jpg">
                        <img src="assets/images/demo/150x99/18-min.jpg" width="106" height="70" alt="" />
                    </a>
                    <a href="assets/images/demo/1200x800/15-min.jpg">
                        <img src="assets/images/demo/150x99/15-min.jpg" width="106" height="70" alt="" />
                    </a>
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