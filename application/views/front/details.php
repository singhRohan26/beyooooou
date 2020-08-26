


    <section class="option_list boxs">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 leftTabs">
                    <div class="option_left boxs">
                        <ul class="nav nav-tabs">
                            <li><a href="javascript:void(0)" class="clicktab active" data-type="1">My Profile</a></li>
                            <li><a href="javascript:void(0)" class="clicktab" data-type="2">My Booking</a></li>
<!--                            <li><a href="javascript:void(0)" class="clicktab" data-type="2">Cancelled Bookings</a></li>-->
                            <li><a href="javascript:void(0)" class="clicktab" data-type="3">My Wishlist</a></li>
                            <li><a href="javascript:void(0)" class="clicktab" data-type="4">Payment Methods</a></li>
                            <li><a href="javascript:void(0)" class="clicktab" data-type="5">Change Password</a></li>
                            <li><a href="javascript:void(0)" class="clicktab" data-type="6">About</a></li>
                            <li><a href="javascript:void(0)" class="clicktab" data-type="7">Invite Friends</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 rgtBoxs">
                    <div class="option_right boxs payDtl payDtl1">
                        <h3>Your Details</h3>
                        <form method="post" action="<?php echo base_url('User/doUpdateProfile') ?>" id="profile_form" enctype="multipart/form-data">

                        <div class="img_choose boxs">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" name="file1" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url(<?php echo base_url('uploads/users/'.$UserDetails['image_url'])   ?>);">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" placeholder="Frank Wood" value="<?php echo $UserDetails['user_name'] ?>" name="name" id="name">
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="nick.miller@mail.com" value="<?php echo $UserDetails['email'] ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="number" class="form-control" placeholder="(808)707-3103" value="<?php echo $UserDetails['mobile'] ?>" name="number" id="number">
                            </div>


                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" class="form-control" placeholder="Enter location" value="<?php echo $UserDetails['location'] ?>" name="location" id="location">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btnHover">Save Changes</button>
                            </div>

                        </form>

                    </div>
                    <div class="option_right boxs payDtl payDtl2">
                        <h3>My Booking</h3>
                        <form>
                            <?php 
                         $date = "";
                         if(!empty($services)){
                         foreach ($services as $saloon) {
//                             print_r($saloon);die;
                           ?>
                            <div class="booking boxs">
                               <?php 
                              if ( $date != $saloon['booking_date'] ) {
                            ?>
                            <h2><?php echo $saloon['booking_date'] ?></h2>
                        <?php }
                           $date = $saloon['booking_date'];
                        ?>
                                
                               
                                <div class="booking_all boxs">
                                    <div class="booking_upper boxs">
                                        <div class="col-sm-4 nopadding">
                                            <div class="upper_left boxs">
                                                <h5><?php echo $saloon['shop_name'] ?></h5>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 nopadding">
                                            <div class="upper_mid boxs">
                                                <img src="<?php echo base_url('public/') ?>img/time12.svg" class="img-responive" alt="time">
                                                <p><?php echo $saloon['booking_time'] ?></p>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 nopadding">
                                            <div class="upper_mid boxs">
                                                <img src="<?php echo base_url('public/') ?>img/calendar12.svg" class="img-responive" alt="calendar">
                                                <p><?php echo $saloon['booking_date_month'] ?></p>

                                            </div>
                                        </div>
                                        <div class="col-sm-4 nopadding reshedule">
                                            <div class="upper_right boxs">
                                                <?php if($saloon['status']=='Cancel'){ echo "Cancelled";}
                                             else{
                                                echo $saloon['status']; 
                                             }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="booking_lower boxs">
                                        <div class="col-sm-2 nopadding">
                                            <div class="lower_img boxs">
                                                <img src="<?php echo $saloon['shop_image']; ?>" class="img-responsive" alt="img">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 nopadding">
                                            <div class="lowwer_list boxs">
                                                <ul>
                                                    <?php
                                                
                                                  foreach ($saloon['service_name'] as $ser) { ?>
                                                 <li><?php echo $ser; ?></li>
                                                <?php }; ?>
                                                </ul>
                                            </div>

                                        </div>


                                        <div class="col-sm-4 nopadding">
                                            <div class="charges boxs">
                                                <h4>Total Charges</h4>
                                                <p><span>$ </span><?php  if (!empty($saloon['discount'])) {echo $saloon['discount'];}else{echo $saloon['total'];} ?></p>
                                                <?php if($saloon['status']=='Processing'){?>
                                                <a href="<?php echo base_url('User/cancelOrder/'.$saloon['booking_id'])  ?>" class="btnHover">Cancel Booking</a>
                                                <?php };?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                

                            </div>
                             <?php }} else {
                        ?>
                        <h2>No Booking found</h2>
                        <?php
                    }
                    ?>
                        </form>
                    </div>

                    <div class="option_right boxs payDtl payDtl3 about_beauty_text ">
                        <?php if(!empty($getWishList)){   ?>
                        <?php foreach($getWishList as $wish) {  ?>
                        <div class="eros_row boxs">
                            <div class="col-sm-3 nopadding">
                                <div class="eros_lt eros_lt_detail boxs">
                                    <img src="<?php echo base_url('uploads/shop/'.$wish['image_url']) ?>" class="img-responsive" alt="images">
                                    <div class="logo_sm box">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 nopadding">
                                <div class="eros_rt eros_rt1 eros_detail boxs">
                                    <h2><?php echo $wish['shop_name'] ?> </h2>
                                    <p><?php echo $wish['address'] ?>, <?php echo $wish['city'] ?>,- <?php echo $wish['pincode'] ?></p>
                                    <ul>
                                        <li class="col_yel col_red">4.5</li>
                                        <li><img src="<?php echo base_url('public/') ?>img/favourite-31.png" class="img-responsive" alt="images"></li>
                                        <li><img src="<?php echo base_url('public/') ?>img/favourite-31.png" class="img-responsive" alt="images"></li>
                                        <li><img src="<?php echo base_url('public/') ?>img/favourite-31.png" class="img-responsive" alt="images"></li>
                                        <li><img src="<?php echo base_url('public/') ?>img/favourite-31.png" class="img-responsive" alt="images"></li>
                                        <li><img src="<?php echo base_url('public/') ?>img/star-orangeblack.svg" class="img-responsive small" alt="images"></li>
                                        <li class="last_rev">50 reviews</li>
                                    </ul>
                                    <ul class="loc_row loc_rowdeta">
                                        <li><a href="https://goo.gl/maps/2hyiCh8Xa8noV6rR8" target ="_blank"><img src="<?php echo base_url('public/') ?>img/loc.svg" class="img-rsponsive" alt="image">Show on Map</a></li>
                                        <li><a href="#"><img src="<?php echo base_url('public/') ?>img/road.svg" class="img-rsponsive" alt="image">1.2 Miles away</a></li>
                                        <li><a href="#"><img src="<?php echo base_url('public/') ?>img/discount.svg" class="img-rsponsive" alt="image">50% Discount</a></li>
                                    </ul>
                                    <div class="quick_lin  quick_detail boxs">
                                        <a href="#" class="quick"></a>
                                        <a href="<?php echo base_url('Site/shopDetails/'.$wish['shop_id']) ?>" class="venue">Go to Venue</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } }else{  ?>
                          <h4>No Favourites</h4>
                        <?php  } ?>

                    </div>


                    <div class="option_right boxs payDtl payDtl4">
                        <div class="method_inner boxs">
                            <h3>Payments</h3>
                            <form>
                                <div class="form_inner boxs">
                                    <div class="col-sm-4 nopadding">
                                        <div class="form-group radioTypes ">
                                            <input type="radio" id="paycard" name="pay">
                                            <label for="paycard">Pay with bKash</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-8 nopadding">
                                        <div class="form-group radioTypes ">
                                            <input type="radio" id="paycard2" name="pay">
                                            <label for="paycard2">Pay with Credit Cards</label>
                                        </div>
                                    </div>

                                    <div class="card_detail boxs">
                                        <div class="col-sm-6 nopadding">
                                            <div class="pay_card boxs">
                                                <label>Card Number</label>
                                                <input type="number" class="form-control" placeholder="1455-5306-3582-9741">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="pay_card boxs">
                                                <label>Exp. Date</label>
                                                <input type="number" class="form-control" placeholder="09/23">
                                            </div>
                                        </div>

                                        <div class="col-sm-3 nopadding">
                                            <div class="pay_card boxs">
                                                <label>CVC</label>
                                                <input type="number" class="form-control" placeholder="231">
                                            </div>
                                        </div>
                                        <div class="pay_btn boxs">
                                            <button type="submit" class="btn btnHover">Add Card</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="method_inner boxs">
                            <h3>Saved Cards</h3>
                            <form>
                                <div class="form_inner boxs">
                                    <div class="card_detail boxs">
                                        <div class="col-sm-6 nopadding">
                                            <div class="form-group radioTypes ">
                                                <input type="radio" id="paycard3" name="payment">
                                                <label for="paycard3">ICICI Debit Card</label>
                                                <input type="number" class="form-control card_input" placeholder="14** **** **** **41">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="pay_card boxs">
                                                <label>CVC</label>
                                                <input type="number" class="form-control" placeholder="231">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 nopadding">
                                            <div class="remove boxs">
                                                <a href="#" class="upp">REMOVE</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card_detail boxs">
                                        <div class="col-sm-6 nopadding">
                                            <div class="form-group radioTypes ">
                                                <input type="radio" id="paycard4" name="payment">
                                                <label for="paycard4">SBI Debit Card</label>
                                                <input type="number" class="form-control card_input" placeholder="14** **** **** **41">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 nopadding">
                                            <div class="remove boxs">
                                                <a href="#">REMOVE</a>
                                            </div>
                                        </div>
                                        <div class="pay_btn boxs">
                                            <button type="submit" class=" btn1 btnHover">Make Payment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="option_right boxs payDtl payDtl5">
                        <div class="method_inner boxs">
                            <h3>Change Password</h3>
                            <form method="post" action="<?php echo base_url('User/doChangePassword') ?>" id="user_chngpass">
                                <div class="error_msg"></div>
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control" placeholder="Enter Old Password" value="" name="op" id="op">
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" placeholder="Enter New Password" value="" name="np" id="cp">
                            </div>

                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control" placeholder="Enter Confirm Password" value="" name="cp" id="cp">
                            </div>

                            
                            <div class="form-group">
                                <button type="submit" class="btn btnHover">Change Password</button>
                            </div>

                        </form>
                        </div>
                    </div>
                    <div class="option_right boxs payDtl payDtl6 about_beauty_text ">
                        <h3>About the Beautishan</h3>
                        <p>It started back in 2008 in London around a dining room table. Since then we have been on a mission to inspire people to express their beauty in every way. We believe there is a better way to find and book your hair and beauty services. More choice and the confidence to try new things. We want to make booking beauty, styling and wellness appointments simple, effortless and fast – around the clock. It’s beauty to the people, no matter what you choose.</p>

                        <p> Today, Treatwell is the largest hair and beauty bookings website in Europe. We’re an eclectic group of 500 people working in offices throughout Europe, with over 20,000 local partners. It amounts to one amazing company: a 24/7 beauty bookings platform that puts customers and salon managers in control, lets you book at times and prices that suit you, and gives you all the style know-how you need to look and feel amazing. We’re more than a smarter booking platform. We’re the place where you can express yourself, every day.</p>

                        <p>Our UK headquarters and company registered address is:</p>
                        <div class="about_last boxs">
                            <p>Treatwell</p>
                            <p>Fairfax House</p>
                            <p>15 Fulwood Place</p>
                            <p>London</p>
                            <p>WC1V 6HU</p>
                        </div>

                        <p>Company number: 06457679</p>

                    </div>

                    <div class="option_right boxs payDtl payDtl7">

                        <div class="method_inner boxs">
                            <h3>Invite friends</h3>

                            <div class="invite_inner boxs">
                                <h5>Refer friends</h5>
                            </div>
                            <form>
                                <div class="invite_left boxs">
                                    <div class="col-sm-9 nopadding">
                                        <div class="invite_input boxs">
                                            <div class="form-group">
                                                <input type="text" value="https://www.BeYoou.fr/search?ei=dw2bXYrADLSFmg" id ="myInput" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="invite_btn boxs">
                                            <div class="form-group">
                                                <button type="button"  onclick="copyFun()" class="btn3 btnHover">Copy Link</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="invite_icon boxs">
                                    <h2>Share via </h2>
                                    <ul>
                                        <li><a href="javascript:void(0)"><img src="img/tw.png" class="img-responsive" alt="tw"></a></li>
                                        <li><a href="javascript:void(0)"><img src="img/fb.png" class="img-responsive" alt="fb"></a></li>
                                        <li><a href="javascript:void(0)"><img src="img/insta.png" class="img-responsive" alt="insta"></a></li>
                                        <li><a href="javascript:void(0)"><img src="img/pin.png" class="img-responsive" alt="pin"></a></li>
                                        <li><a href="javascript:void(0)"><img src="img/what.png" class="img-responsive" alt="what"></a></li>
                                        <li><a href="javascript:void(0)"><img src="img/vimo.png" class="img-responsive" alt="vimo"></a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
