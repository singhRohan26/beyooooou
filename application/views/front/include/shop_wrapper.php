<?php if(!empty($getShops)){   ?>
                <?php foreach($getShops as $shops) {  ?>
                <div class="eros_row boxs">
                    <div class="col-sm-3 nopadding">
                        <div class="eros_lt boxs">
                            <img src="<?php echo base_url('uploads/shop/'.$shops['image_url']) ?>" class="img-responsive" alt="images">
                            <div class="new_lb boxs">
                                <h2>NEW</h2>
                            </div>
                            <div class="logo_sm box">
                                <!-- <img src="./img/eros.png" class="img-responsive" alt="images"> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 nopadding">
                        <div class="eros_rt boxs">
                            <h2><?php echo $shops['shop_name'];  ?> <a href="<?php echo base_url('Site/doAddWishlist/'.$shops['shop_id']) ?>" class="wish_heart" id=""><i class="fa fa-heart-o img_heart <?php if(!empty($wishlists)){ if(in_array($shops['shop_id'], $wishlists)) { echo "heartColor"; } } ?>"></i></a></h2>
                            <p><?php echo $shops['address'];  ?>,<?php echo $shops['city'];  ?>,<?php echo $shops['pincode'];  ?></p>
                            <ul>
                                <li class="col_yel">4.5</li>
                                <li><img src="<?php echo base_url('public/') ?>img/favourite-31.png" class="img-responsive" alt="images"></li>
                                <li><img src="<?php echo base_url('public/') ?>img/favourite-31.png" class="img-responsive" alt="images"></li>
                                <li><img src="<?php echo base_url('public/') ?>img/favourite-31.png" class="img-responsive" alt="images"></li>
                                <li><img src="<?php echo base_url('public/') ?>img/favourite-31.png" class="img-responsive" alt="images"></li>
                                <li><img src="<?php echo base_url('public/') ?>img/star-orangeblack.svg" class="img-responsive small " alt="images"></li>
                                <li class="last_rev">50 reviews</li>
                            </ul>
                            <ul class="loc_row">
                                <li><a href="https://goo.gl/maps/2hyiCh8Xa8noV6rR8" target="_blank"><img src="<?php echo base_url('public/') ?>img/loc.svg" class="img-rsponsive" alt="image">Show on Map</a></li>
                                <li><a href="#"><img src="<?php echo base_url('public/') ?>img/road.svg" class="img-rsponsive" alt="image">1.2 Miles away</a></li>
                                <li><a href="#"><img src="<?php echo base_url('public/') ?>img/discount.svg" class="img-rsponsive" alt="image">50% Discount</a></li>
                            </ul>
                            <div class="quick_lin boxs">
                                <a href="#" class="quick">Quick View Venue Details</a>
                                <a href="<?php echo base_url('Site/shopDetails/'.$shops['shop_id']) ?>" class="venue btnHover">Go to Venue</a>
                            </div>
                        </div>
                    </div>
                </div>
                  <?php } }else { ?>
                     
                <h3>No shops Found</h3>

<?php } ?> 