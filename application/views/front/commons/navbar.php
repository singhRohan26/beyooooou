 <!--        Header Start-->

    <div class="header boxs">
        <div class="container-fluid">
            <div class="mainHeader">
            <div class="logo">
                <a href="<?php echo base_url('/') ?>"><img src="<?php echo base_url('public/') ?>img/logo.png" class="img-responsive" alt="logo"></a>
            </div>
            <div class="menuBar">
                <ul>
                    <?php 
                 if(!empty($this->session->userdata('unique_id'))) {   
                         ?>
                    <li class="myAccount"><a href="#">My Account<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        <div class="accountDrop accountDrop1">
                            
                            <a href="<?php echo base_url('User/userProfile') ?>">My Profile</a>
                            <a href="#">My Cart</a>
                            <a href="<?php echo base_url('Site/logout') ?>">Sign Out</a>
                        </div>
                    </li>
                    
                    <?php  }  else {
                      foreach($getSiteLanguages as $site) { 
                     if($site['key'] == 'header_signup') {   ?>                
                   
                    
                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#signup"><?php echo $site['text'] ?></a></li>
                    <?php }elseif($site['key'] == 'header_login') {  ?>
                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#login"><?php echo $site['text'] ?></a></li>
                    <?php  } } } ?>
                    <li>
                        <select id="getLanguage" name="getLanguage" data-url="<?php echo base_url('Site/changeLanguage') ?>">
                        <option value="0"><?php if(!empty($this->session->userdata('lang'))) { echo $this->session->userdata('lang'); }else { echo 'Choose Language'; } ?></option>
                            <?php foreach($getLanguages as $lang) {?>
                        <option value="<?php echo $lang['code'] ?>"><?php echo $lang['name'] ?></option>
                           <?php } ?>
                        
                        </select>
                    </li>
                    <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'header_help') {  ?>
                    <li><a href="<?php echo base_url('Site/help') ?>"><?php echo $site['text'] ?></a></li>
                    
                    <?php } }   ?>
                   <?php
                        if (!empty($this->cart->contents())) {
                            $count = count($this->cart->contents());
                        }
                        ?>
                    <li><a href="<?php echo base_url('Site/cart') ?>"><i class="fa fa-shopping-cart"></i><span class="badge badge_txt"><?php
                                if (!empty($count)) {
                                    echo $count;
                                } else {
                                    echo '0';
                                }
                                ?></span></a></li>
                </ul>
            </div>
            </div>
            
        </div>
    </div>

    <!--        Header End-->