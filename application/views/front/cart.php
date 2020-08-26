
<section class="my_booking boxs">
        <div class="container">
            <?php if(!empty($this->cart->contents())) {  ?>
            <div class="my_booking_row boxs">
                <div class="row1 checkbx boxs">
                    <div class="col-sm-7">
                        <div class="booking_area boxs">
                            <div class="booking_area_inner boxs">
                                <div class="booking_text mybook boxs">
                                    <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'cart_title') {   ?>
                                    <h3><?php echo $site['text']; ?></h3>
                                    <?php }elseif($site['key'] == 'cart_venue'){   ?>
                                </div>
                                <?php foreach($this->cart->contents() as $cart) {   ?>
                                <div class="booking_text booking_text_1 boxs">
                                    <p><?php echo $cart['name'] ?></p>
                                    <span>$ <?php echo $cart['price'] ?> <a href="<?php echo base_url('Site/removeFromCart/' . $cart['rowid']); ?>" class="removeCoupon"><i class="fa fa-times" aria-hidden="true"></i></a></span>
                                </div>                          
                               <?php } ?>
                                <div class="venues boxs">
                                    
                                <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo $site['text']; ?></a>
                                    <?php }}   ?>
                                </div>
                                
                                <?php
                                if (!empty($this->cart->contents())){
                                    $discount_msg = $this->session->userdata('discount_msg');
                                    $discount_val = $this->session->userdata('discount_val');
                                    if (!empty($discount_msg) && !empty($discount_val)) {
                                ?>
                                <div class="venues boxs">
                                <a href="<?php echo base_url('Site/removeCoupon'); ?>" data-target="#coupon" data-toggle="modal">Remove Coupon</a>
                                    
                                </div>
                                <?php
                                    } else {
                                ?>
                                <div class="venues boxs">
                                <a href="javascript:void(0)" data-target="#coupon" data-toggle="modal">Have a coupon?</a>
                                </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="booking_area_last boxs">
                                <div class="total_rder booking_text booking_text_1 boxs">
                                    <?php if (!empty($discount_msg) && !empty($discount_val)) { ?>
                                    <h3>Discounted Price </h3><span>$ <?php echo ($this->cart->total() - $discount_val)  ?></span>
                                    <?php }else{  ?>
                                    <h3>Total Order </h3><span>$ <?php echo $this->cart->total(); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="booking_area booki boxs">
                            <div class="booking_area_inner bok boxs">
                                <form method="post" action="<?php echo base_url('Site/booking'); ?>" id="book">
                                    <div class="error_msg"></div>
                                    <div class="booking_text bok_text booking_text_1 appo boxs">
                                        <p>Select time for your appointment</p>
                                        
                                        <p>Shop Timings:- <?php echo $shop_time; ?> </p>
                                    </div>
                                    <div class="form-group bok_text bok_border">
                                        <label for="date">Date</label>
                                        <input type="text" id="date" name="date" readonly class="form-control icon_set date-pick" placeholder="Select Date">
                                        <span><img src="<?php echo base_url('public/') ?>img/date.svg" alt="icon" class="img-responsive"></span>
                                    </div>
                                    <?php
                                    $timestamp = time() + 60 * 60;
                                    $current_time = date('h:i a', $timestamp);
                                    $time = explode('To', $shop_time);
                                    ?>
                                    <input type="hidden" name="open_time" id="open_time" value="<?php echo date("H:i", strtotime($time[0])); ?>">
                                    <input type="hidden" name="close_time" id="close_time" value="<?php echo date("H:i", strtotime($time[1])); ?>">
                                    <input type="hidden" name="curr_time" id="curr_time" value="<?php echo date("H:i", strtotime($current_time)); ?>">
                                    <div class="form-group bok_text bok_border">
                                        <label for="date">Time</label>
                                        <input type="time" id="time" name="time" disabled class="form-control icon_set" placeholder="Select Time">
                                        <span><img src="<?php echo base_url('public/') ?>img/time12.svg" alt="icon" class="img-responsive"></span>
                                    </div>
                                    <div class="booking_area_last boxs">
                                        <div class="checkbtn form-group boxs">
                                            <?php if(!empty($this->session->userdata('unique_id'))) {  ?>
                                            <button type="submit" class="form-control checkbtn_inner btnHover">Go To Checkout</button>
                                            <?php }else {  ?>
                                            <button type="button" class="form-control checkbtn_inner btnHover" data-toggle="modal" data-target="#login">Go To Checkout</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }else{  ?>
            <center><img src="<?php  echo base_url('public/img/cart.png') ?>"></center>
            <center><h4>No Services in your Cart</h4></center>
            <?php } ?>
        </div>
    </section>

<div id="coupon" class="modal fade getListedBox pad_rgt" role="dialog ">
    <div class="modal-dialog">
        <div class="modal-content sign_modelcontent boxs">
            <a href="javscript:void(0)" class="closed" data-dismiss="modal"><img src="<?php echo base_url('public/') ?>img/cross.png"></a>
            <div class="modal_rht boxs">
                <div class="signindiv psd_show boxs">
                    <div class="erro_msg_saloon"></div>
                    <form method="post" action="<?php echo base_url('Site/applyCoupon') ?>" id="apply_coupon">
                        <div class="error_msg"></div>
                        <div class="form_all booking_area_inner boxs">

                            <div class="inner_text boxs">
                                <h3>Apply Coupon</h3>
                            </div>
                            <div>
                            <div class="form-group bok_text bok_border log_text boxs ">
                                <label for="saloon_email">Enter Coupon</label>
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control log_email">
                            </div>
                            </div>
                           
                            <div class="login_btn boxs">
                                <button type="submit" class="btnHover ">Apply</button>
                            </div>
                        </div>
                    </form>                 
                </div>
            </div>
        </div>
    </div>
</div>