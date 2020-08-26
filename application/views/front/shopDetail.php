    <!--        Header End-->
    <?php
        $shop_id = "";
        if(!empty($this->cart->contents())){
            foreach($this->cart->contents() as $cart){
                if($shop_chk_id != $cart['shop_id']){
                    $shop_id = $cart['shop_id'];
                }
            }
        }
    ?>
    <section class="store boxs main">

        <div class="store_sec boxs">
            <img src="<?php echo base_url('uploads/banner/'.$getShopById['banner_url']) ?>" class="img-responsive" alt="imges">
        </div>

    </section>
    <section class="store_rev boxs">
        <div class="container">
            <div class="store_review boxs">
                <div class="col-sm-8">
                    <div class="lor_row boxs">
                        <div class="store_re_lt boxs">
                            <h3><?php echo $getShopById['shop_name_'.$lang] ?></h3>

                            <p><?php echo $getShopById['address_'.$lang] ?>,<?php echo $getShopById['city_'.$lang] ?>,<?php echo $getShopById['pincode'] ?></p>
                        </div>


                        <div class="store_loret boxs">
                            <ul>
                                <li class="col_yel">4.5</li>
                                <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                                <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                                <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                                <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                                <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                            </ul>
                            <p>50 reviews</p>

                            <div class="store_lore2 boxs">
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="fa fa-facebook-f"></i></a></li>

                                    <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>

                                    <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                foreach($getServices1 as $service1) {
                    $a = 1;
                    foreach($getServices as $service) {
                        if($service['service_category'] == $service1['service_category']) {
                ?>
                    <div class=" nailmain boxs">
                        <?php
                            if($a == 1){
                        ?>
                        <div class="nail_sec boxs">
                            <h4><?php echo $service1['service_category'] ?></h4>
                        </div>
                        <?php
                        }
                        ?>  
                        <div class="arched boxs">
                            <div class="boxs">
                                
                                <h4><?php echo $service['service'] ?></h4>
                                <p>$ <?php echo $service['price'] ?> </p>
                            </div>
                            <div class="boxs book_btn">
                                <?php
                                    if(!empty($shop_id)){ ?>
                                <a href="<?php echo base_url('Site/doRemoveBokkedCart') ?>" class="cart_sec">BOOK</a>
                                <?php
                                    }else{  ?>
                                <a href="<?php echo base_url('Site/addToCart/'.$getShopById['shop_id'].'/'.$service['service'].'/'.$service['service_id'].'/'.$service['price']) ?>" class="cart">BOOK</a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        
                    </div>
                   <?php $a++; }  } } ?>
                    
                    
                </div>

                <div class="col-sm-4">

                    <div class="orange_sec boxs">
                        <div class="triangle triangle-0"></div>
                        <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'detail_about') {   ?>
                        <h3><?php echo $site['text']; ?></h3>
                        <?php }elseif($site['key'] == 'detail_opening'){   ?>
                        <p><?php echo $getShopById['about'] ?></p>
                        <h3><?php echo $site['text']; ?></h3>
                        <?php }elseif($site['key'] == 'detail_location'){  ?>
                        <div class="days_list ">
                            <ul>
                                <li>Monday<span>10:00 AM - 08:00 PM</span></li>
                                <li>Tuesday<span>10:00 AM - 08:00 PM</span></li>
                                <li>Wednesday<span>10:00 AM - 08:00 PM</span></li>
                                <li>Thrusday<span>10:00 AM - 08:00 PM</span></li>
                                <li>Friday<span>10:00 AM - 08:00 PM</span></li>
                                <li>Saturday<span>10:00 AM - 08:00 PM</span></li>
                                <li>Sunday<span>10:00 AM - 08:00 PM</span></li>
                            </ul>
                        </div>
                        <h3><?php echo $site['text']; ?></h3>
                        <?php }elseif($site['key'] == 'detail_review') {  ?>
                        <div class="location_sec boxs">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.38703692693!2d90.27923991057244!3d23.780573258035957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sin!4v1570601337040!5m2!1sen!2sin" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                        <h6 class="boxs"><?php echo $getShopById['address_'.$lang] ?>,<?php echo $getShopById['city_'.$lang] ?>,<?php echo $getShopById['pincode'] ?></h6>
                    </div>
                </div>
            </div>
            <div class="lor_row boxs">
                <div class="store_re_lt boxs">
                    <h3><?php echo $site['text']; ?></h3>
                    <?php }} ?>
                </div>


                <div class="store_loret reiv_re_lt boxs">
                    <ul>
                        <li class="col_yel">4.5</li>
                        <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                        <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                        <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                        <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                        <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                    </ul>
                </div>
            </div>
            <div class="sort_sec boxs">
                <a href="javascript:void(0)" class="sort">Sort By<img src="<?php echo base_url('public/') ?>img/square_upload.svg" class="img-responsive" alt="images"></a>
                <div class="filDrop_content">
                    <a href="javascript:void(0)">Sort By</a>
                    <a href="javascript:void(0)">Sort By</a>
                    <a href="javascript:void(0)">Sort By</a>
                    <a href="javascript:void(0)">Sort Bye</a>
                    <a href="javascript:void(0)">Sort By</a>
                </div>
            </div>
            <div class="lourev_sec boxs">
                <?php  if(!empty($getReviews)) {   ?>
                <?php foreach($getReviews as $review) {   ?>
                <div class="lourev_row boxs">
                    <div class="col-sm-5 nopadding">
                        <div class="lou_lf boxs">
                            <div class="col-xs-6 nopadding">
                                <div class="boxs day_r">
                                    <div class="face_img">
                                        <?php if(!empty($review['image_url'])){  ?>
                                        <img src="<?php echo base_url('uploads/users/'.$review['image_url']) ?>" class="img-responsive" alt="images">
                                        <?php }else{  ?>
                                        <img src="<?php echo base_url('public/img/dummy.png') ?>" class="img-responsive" alt="images">
                                        <?php } ?>
                                    </div>

                                    <div class="boxsss">
                                        <h4><?php echo $review['user_name']; ?></h4>
                                        <p><?php echo $review['created']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="store_loret reiv_re_lt boxs">
                                    <ul>
                                        <?php for ($i = 1; $i <= $review['rating']; $i++) {?>
                                        <li><img src="<?php echo base_url('public/') ?>img/star.svg" class="img-responsive" alt="images"></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="rev_con boxs">
                            <p> <?php echo $review['review']; ?></p>
                        </div>
                    </div>
                </div>  
                    <div class="reviewBtn boxs">
                        <a href="javascript:void(0)"  data-target="#reviewBox" data-toggle="modal">More Reviews</a>
                    </div>
                <?php }}else{ ?>
			  <p>No Reviews yet.</p>
			  <?php } ?>
                
            </div>
        </div>


    </section>


    
<div id="reviewBox" class="modal fade getListedBox pad_rgt" role="dialog ">
    <div class="modal-dialog">
        <div class="modal-content sign_modelcontent boxs">
            <a href="javscript:void(0)" class="closed" data-dismiss="modal"><img src="<?php echo base_url('public/') ?>img/cross.png"></a>
            <div class="reviewModal modal_rht boxs">
            <div class="lourev_sec boxs">
                <div class="lourev_row boxs">
                    <div class="col-sm-5 nopadding">
                        <div class="lou_lf boxs">
                            <!-- <div class="col-xs-6 nopadding"> -->
                                <div class="boxs day_r">
                                    <div class="face_img">
                                        <img src="http://localhost/beyoou/public/img/dummy.png" class="img-responsive" alt="images">
                                    </div>

                                    <div class="boxsss">
                                        <h4>Vishu Singh</h4>
                                        <p>2020-03-31</p>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!-- <div class="col-xs-6"> -->
                                <div class="store_loret reiv_re_lt modalStar boxs">
                                    <ul>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                    </ul>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="rev_con boxs">
                            <p> They provide very good services at a very low cost.Thankyou</p>
                        </div>
                    </div>
                </div> 
                <div class="lourev_row boxs">
                    <div class="col-sm-5 nopadding">
                        <div class="lou_lf boxs">
                            <!-- <div class="col-xs-6 nopadding"> -->
                                <div class="boxs day_r">
                                    <div class="face_img">
                                        <img src="http://localhost/beyoou/public/img/dummy.png" class="img-responsive" alt="images">
                                    </div>

                                    <div class="boxsss">
                                        <h4>Vishu Singh</h4>
                                        <p>2020-03-31</p>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!-- <div class="col-xs-6"> -->
                                <div class="store_loret reiv_re_lt modalStar boxs">
                                    <ul>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                    </ul>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="rev_con boxs">
                            <p> They provide very good services at a very low cost.Thankyou</p>
                        </div>
                    </div>
                </div> 
                <div class="lourev_row boxs">
                    <div class="col-sm-5 nopadding">
                        <div class="lou_lf boxs">
                            <!-- <div class="col-xs-6 nopadding"> -->
                                <div class="boxs day_r">
                                    <div class="face_img">
                                        <img src="http://localhost/beyoou/public/img/dummy.png" class="img-responsive" alt="images">
                                    </div>

                                    <div class="boxsss">
                                        <h4>Vishu Singh</h4>
                                        <p>2020-03-31</p>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!-- <div class="col-xs-6"> -->
                                <div class="store_loret reiv_re_lt modalStar boxs">
                                    <ul>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                    </ul>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="rev_con boxs">
                            <p> They provide very good services at a very low cost.Thankyou</p>
                        </div>
                    </div>
                </div> 
                <div class="lourev_row boxs">
                    <div class="col-sm-5 nopadding">
                        <div class="lou_lf boxs">
                            <!-- <div class="col-xs-6 nopadding"> -->
                                <div class="boxs day_r">
                                    <div class="face_img">
                                        <img src="http://localhost/beyoou/public/img/dummy.png" class="img-responsive" alt="images">
                                    </div>

                                    <div class="boxsss">
                                        <h4>Vishu Singh</h4>
                                        <p>2020-03-31</p>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!-- <div class="col-xs-6"> -->
                                <div class="store_loret reiv_re_lt modalStar boxs">
                                    <ul>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                    </ul>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="rev_con boxs">
                            <p> They provide very good services at a very low cost.Thankyou</p>
                        </div>
                    </div>
                </div> 
                <div class="lourev_row boxs">
                    <div class="col-sm-5 nopadding">
                        <div class="lou_lf boxs">
                            <!-- <div class="col-xs-6 nopadding"> -->
                                <div class="boxs day_r">
                                    <div class="face_img">
                                        <img src="http://localhost/beyoou/public/img/dummy.png" class="img-responsive" alt="images" style="border-radius: 100%;">
                                    </div>

                                    <div class="boxsss">
                                        <h4>Vishu Singh</h4>
                                        <p>2020-03-31</p>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!-- <div class="col-xs-6"> -->
                                <div class="store_loret reiv_re_lt modalStar boxs">
                                    <ul>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                        <li><img src="http://localhost/beyoou/public/img/star.svg" class="img-responsive" alt="images"></li>
                                    </ul>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="rev_con boxs">
                            <p> They provide very good services at a very low cost.Thankyou</p>
                        </div>
                    </div>
                </div>            
                                
            </div>
            </div>
        </div>
    </div>
</div>