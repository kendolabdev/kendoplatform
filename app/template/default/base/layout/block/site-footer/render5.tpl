<div class="footer-layout5">
    <div class="container-fluid">

        <div class="row margin-top-60 margin-bottom-40 size-13">

            <!-- col #1 -->
            <div class="col-md-4 col-sm-4">

                <!-- Footer Logo -->
                <img class="footer-logo" src="assets/images/logo-footer.png" alt="" />

                <p>
                    Incredibly beautiful responsive Bootstrap Template for Corporate and Creative Professionals.
                </p>

                <h2>(800) 123-4567</h2>

                <!-- Social Icons -->
                <div class="clearfix">

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
            <!-- /col #1 -->

            <!-- col #2 -->
            <div class="col-md-8 col-sm-8">

                <div class="row">

                    <div class="col-md-5 hidden-sm hidden-xs">
                        <h4 class="letter-spacing-1">RECENT NEWS</h4>
                        <ul class="list-unstyled footer-list half-paddings">
                            <li>
                                <a class="block" href="#">New CSS3 Transitions this Year</a>
                                <small>June 29, 2015</small>
                            </li>
                            <li>
                                <a class="block" href="#">Inteligent Transitions In UX Design</a>
                                <small>June 29, 2015</small>
                            </li>
                            <li>
                                <a class="block" href="#">Lorem Ipsum Dolor</a>
                                <small>June 29, 2015</small>
                            </li>
                            <li>
                                <a class="block" href="#">New CSS3 Transitions this Year</a>
                                <small>June 29, 2015</small>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 hidden-sm hidden-xs">
                        <h4 class="letter-spacing-1">EXPLORE US</h4>
                        <ul class="list-unstyled footer-list half-paddings noborder">
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> About Us</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> About Me</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> About Our Team</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Services</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Careers</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> Gallery</a></li>
                            <li><a class="block" href="#"><i class="fa fa-angle-right"></i> FAQ</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h4 class="letter-spacing-1">SECURE PAYMENT</h4>
                        <p>Donec tellus massa, tristique sit amet condim vel, facilisis quis sapien. Praesent id enim sit amet.</p>
                        <p>	<!-- see assets/images/cc/ for more icons -->
                            <img src="assets/images/cc/Visa.png" alt="" />
                            <img src="assets/images/cc/Mastercard.png" alt="" />
                            <img src="assets/images/cc/Maestro.png" alt="" />
                            <img src="assets/images/cc/PayPal.png" alt="" />
                        </p>
                    </div>

                </div>

            </div>
            <!-- /col #2 -->

        </div>

    </div>

    <div class="copyright">
        <div class="container-fluid">
            <ul class="pull-right nomargin list-inline mobile-block">
                <li><a data-toggle="1" href="<?php echo $this->helper()->url('help_page',['page'=>'terms']);?>">
                    <?php echo $this->helper()->text('core.terms_of_service');?></a></li>
                <li>•</li>
                <li><a href="<?php echo $this->helper()->url('help_page',['page'=>'privacy']);?>"
                       data-toggle="1">
                    <?php echo $this->helper()->text('core.privacy');?></a></li>
            </ul>

            © All Rights Reserved, Company LTD
        </div>
    </div>
</div>