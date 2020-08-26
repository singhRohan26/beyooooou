<!--    Footer Start-->

    <div class="footer boxs">
        <div class="container-fluid">
            <div class="footerInner boxs">
                <div class="footerTop boxs">
                    <div class="col-sm-4 footContent nopadding">
                        <div class="leftContent">
                            <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'footer_title') {   ?>
                            <h2><?php echo $site['text']; ?></h2>
                            <?php }elseif($site['key'] == 'footer_content') {  ?>
                            <p><?php echo $site['text']; ?></p>
                            <?php } } ?>
                        </div>
                    </div>
                    <div class="col-sm-5 footList nopadding">
                        <div class="feetMenu boxs">
                            <div class="col-sm-6 nopadding">
                                <div class="menuBox">
                                    <ul>
                                        <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'footer_link_professional') {   ?>
                                        <li><a href="search.html"><?php echo $site['text']; ?></a></li>
                                        <?php }elseif($site['key'] == 'footer_link_list'){  ?>
                                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#getListedBox"><?php echo $site['text']; ?></a></li>
                                        <?php }elseif($site['key'] == 'footer_link_carrer'){  ?>
                                        <li><a href="login_page.html"><?php echo $site['text']; ?></a></li>
                                        <?php }elseif($site['key'] == 'footer_link_terms'){  ?>
                                        <li><a href="terms_condition.html"><?php echo $site['text']; ?></a></li>
                                        <?php }elseif($site['key'] == 'footer_link_termsClient'){  ?>
                                        <li><a href="terms_for_client.html"><?php echo $site['text']; ?></a></li>
                                        <?php }elseif($site['key'] == 'footer_link_privacy'){  ?>
                                        <li><a href="privacy.html"><?php echo $site['text']; ?></a></li>
                                        <?php }elseif($site['key'] == 'footer_link_sitemap'){  ?>
                                        <li><a href="sitemap.html"><?php echo $site['text']; ?></a></li>
                                        <?php } } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 nopadding">
                                <div class="talktoUs boxs">
                                    <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'footer_link_talk') {   ?>
                                    <h3><?php echo $site['text']; ?></h3>
                                    <?php } } ?>
                                    <ul>
                                        <li><a href="mailto:info@BeYoou.com">info@BeYoou.com</a></li>
                                        <li><a href="javascript:void(0)">BeYoou Help Center</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 socialBox nopadding">
                        <div class="footRight boxs">
                            <div class="socialApp boxs">
                                <a href="javascript:void(0)"><img src="<?php echo base_url('public/') ?>img/google.svg" class="img-responsive"
                                        alt="image"></a>
                                <a href="javascript:void(0)"><img src="<?php echo base_url('public/') ?>img/appstore.svg" class="img-responsive"
                                        alt="image"></a>
                            </div>
                            <div class="socialIcon boxs">
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="fa fa-facebook"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-pinterest-p"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-instagram"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-twitter"
                                                aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright boxs">
                    
                    <p>2020 BeYoou. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>

    <!--    Footer End-->

    <!--    Signup Modal Start-->

    <div id="signup" class="modal fade signin" role="dialog ">
        <div class="modal-dialog">
            <div class="modal-content sign_modelcontent boxs">
                <a href="javscript:void(0)" class="closed" data-dismiss="modal"><img src="<?php echo base_url('public/') ?>img/cross.png"></a>
                <div class="modal_rht boxs">
                    <div class="signindiv boxs">

                        <form method="post" action="<?php echo base_url('Site/doRegistration') ?>" id="register_form">
                            <div class="error_msg"></div>
                            <div class="form_all booking_area_inner signup_inner boxs">

                                <div class="inner_text boxs">
                                    <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'signup_modal_title') {   ?>
                                    <h3><?php echo $site['text']; ?></h3>
                                    <?php } } ?>
                                </div>
                                <div class="row ">
                                    
                                        <div class="col-sm-6 ">
                                            <div class="form-group bok_text bok_border log_text boxs ">
                                                <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'signup_modal_name') {   ?>
                                                <label><?php echo $site['text']; ?></label>
                                                <?php }} ?>
                                                <input type="text" name="name" id="name" class="form-control log_email"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group bok_text bok_border log_text boxs ">
                                            <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'login_modal_email') {   ?>
                                            <label><?php echo $site['text']; ?></label>
                                            <?php }} ?>
                                            <input type="email" name="email" id="email" class="form-control log_email"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row ">
                                    <div class="col-sm-6">
                                            <div class="form-group bok_text bok_border log_text boxs">
                                                <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'login_modal_pass') {   ?>
                                                    <label><?php echo $site['text']; ?></label>
                                                <?php }elseif($site['key'] == 'signup_modal_phone'){  ?>
                                                    <input type="Password" name="password" id="password" class="form-control log_email"
                                                        placeholder="Password">
                                                </div>
                                    </div>
                                    <div class="col-sm-6">
                                            <div class="form-group bok_text bok_border log_text boxs">
                                                    <label><?php echo $site['text']; ?></label>
                                                <?php }elseif($site['key'] == 'signup_modal_terms'){  ?>
                                                    <input type="number" name="number" id="number" class="form-control log_email"
                                                        placeholder="Phone Number">
                                                </div>
                                    </div>
                               
                               
                            </div>
                                
                                <div class="form-group bok_text log_check log_text boxs">
                                    <input type="checkbox" name="registerr" id="registerr" value="1">
                                    
                                    <label class="log_email"><?php echo $site['text']; ?></label>
                                    <?php }} ?>
                                </div>



                                <div class="login_btn boxs">
                                    <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'signup_modal_title') {   ?>
                                    <button type="submit" class="btnHover "><?php echo $site['text']; ?></button>
                                    <?php }} ?>
                                </div>
                            </div>
                        </form>
                    </div>



                </div>

            </div>
        </div>
    </div>

    <!--    Signup Modal End-->


    <!--    Login Modal Start-->
    <div id="login" class="modal fade signin" role="dialog ">
        <div class="modal-dialog">
            <div class="modal-content sign_modelcontent boxs">
                <a href="javscript:void(0)" class="closed" data-dismiss="modal"><img src="<?php echo base_url('public/') ?>img/cross.png"></a>
                <div class="modal_rht boxs">
                    <div class="signindiv psd_show boxs">
                        <form method="post" action="<?php echo base_url('Site/doLogin') ?>" id="login_form">
                            <div class="error_msg"></div>
                            <div class="form_all booking_area_inner boxs">

                                <div class="inner_text boxs">
                                    <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'login_modal_title') {   ?>
                                    <h3><?php echo $site['text']; ?></h3>
                                    <?php }elseif($site['key'] == 'login_modal_email'){  ?>
                                </div>
                                <div class="form-group bok_text bok_border log_text boxs ">
                                    <label><?php echo $site['text']; ?></label>
                                    <?php }elseif($site['key'] == 'login_modal_pass') { ?>
                                    <input type="email" name="login_email" id="login_email" class="form-control log_email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group bok_text bok_border log_text boxs">
                                    <label><?php echo $site['text']; ?></label>
                                    <?php }elseif($site['key'] == 'login_modal_forget') { ?>
                                    <input type="Password" name="login_password" id="login_password" class="form-control log_email"
                                        placeholder="Password">
                                </div>
<!--
                                <div class="form-group bok_text log_check log_text boxs">
                                    <input type="checkbox" name="checkbox">
                                    <label class="log_email">Remember Me</label>
                                </div>
-->
                                <div class="form-group bok_text log_check log_text boxs">
                                    <a href="javascript:void(0)" class="psd_fwd"><?php echo $site['text']; ?></a>
                                    <?php }} ?>
                                </div>
                                <div class="login_btn boxs">
                                    <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'login_modal_title') {   ?>
                                    <button type="submit" class="btnHover "><?php echo $site['text']; ?></button>
                                    <?php } } ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="signindiv psd_hide boxs">
                            <form method="post" action="<?php echo base_url('User/forgot_password_checked') ?>" id="forgot_link">
                                <div class="error_msg"></div>
                                <div class="form_all booking_area_inner boxs">
    
                                    <div class="inner_text boxs">
                                        <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'forgot_title') {   ?>
                                        <h3><?php echo $site['text']; ?></h3>
                                        <?php }elseif($site['key'] == 'login_modal_email'){  ?>
                                    </div>
                                    <div class="form-group bok_text bok_border log_text boxs">
                                        <label><?php echo $site['text']; ?></label>
                                        <?php }elseif($site['key'] == 'forgot_btn'){  ?>
                                        <input type="email" name="forgot_email" id="forgot_email" class="form-control log_email"
                                            placeholder="Enter Registered Email">
                                    </div>
                                    
                                   <div class="login_btn boxs">
                                        <button type="submit" class="btnHover "><?php echo $site['text']; ?></button>
                                       <?php }} ?>
                                    </div>
                                </div>
                            </form>
                        </div>

                </div>

            </div>
        </div>
    </div>
   
<!--    Login Modal End-->


<div id="getListedBox" class="modal fade getListedBox pad_rgt" role="dialog ">
    <div class="modal-dialog">
        <div class="modal-content sign_modelcontent boxs">
            <a href="javscript:void(0)" class="closed" data-dismiss="modal"><img src="<?php echo base_url('public/') ?>img/cross.png"></a>
            <div class="modal_rht boxs">
                <div class="signindiv psd_show boxs">
                    <div class="erro_msg_saloon"></div>
                    <form method="post" action="<?php echo base_url('Site/doAddPartner'); ?>" id="addPartnerForm">
                        <div class="error_msg"></div>
                        <div class="form_all booking_area_inner boxs">

                            <div class="inner_text boxs">
                                <h3>Be a Partner</h3>
                            </div>
                            <div>
                            <div class="form-group bok_text bok_border log_text boxs ">
                                <label for="saloon_email">Email Address</label>
                                <input type="email" name="partner_email" id="partner_email" class="form-control log_email">
                            </div>
                            </div>
                            <div>
                            <div class="form-group bok_text bok_border log_text boxs">
                                <label for="saloon_password">Password</label>
                                <input type="Password" name="partner_password" id="partner_password" class="form-control log_email">
                            </div>
                            </div>
                            <div>
                            <div class="form-group bok_text bok_border log_text boxs">
                                <label for="saloon_name">Organisation Name</label>
                                <input type="text" name="saloon_name" id="saloon_name" class="form-control log_email" >
                            </div>
                            </div>
                            <div class="login_btn boxs">
                                <button type="submit" class="btnHover ">Register</button>
                            </div>
                        </div>
                    </form>                 
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="wishBox">
      <h3>
        <span>Added to your wishlist!.</span>
      </h3>
  </div>
    <script src="<?php echo base_url('public/') ?>js/jquery.js"></script>
    <script src="<?php echo base_url('public/') ?>js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-clock-timepicker@2.3.2/jquery-clock-timepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="<?php echo base_url('public/') ?>js/custom.js"></script>
    <script src="<?php echo base_url('public/') ?>assets/js/event.js"></script>
    
    <script>
            $('.date-pick').datepicker({
                format: "dd-mm-yyyy",
                startDate: '1d',
                endDate: '+6m'
            });
    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            $('#service,#location,#categ').select2();
        </script>
        <script type="text/javascript">
                if ($(window).width() <= 767) {
                    function googleTranslateElementInit1() {
                        new google.translate.TranslateElement({
                            pageLanguage: 'en',
                            includedLanguages: 'en,bn',
                            defaultLanguage: 'en',
                            multilanguagePage: true
                        },
                                'google_translate_element1');
                    }
                    $(document).ready(function () {
            
                        var head = document.getElementsByTagName('head')[0];
                        var script = document.createElement('script');
                        script.type = 'text/javascript';
                        script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit1';
                        head.appendChild(script);
            
                    });
                } else {
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({
                            pageLanguage: 'en',
                            includedLanguages: 'en,bn',
                            defaultLanguage: 'en',
                            multilanguagePage: true
                        },
                                'google_translate_element');
                    }
                    $(document).ready(function () {
            
                        var head = document.getElementsByTagName('head')[0];
                        var script = document.createElement('script');
                        script.type = 'text/javascript';
                        script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
                        head.appendChild(script);
                    });
                }
            
            </script>
</body>

</html>