
    <div class="confirmation boxs">
        <div class="container">
            <div class="confirmTop boxs">
                <div class="confirmInner boxs">
                    <div>
                        <div class="confirmLeft boxs">

                            <div class="confirmImg">
                                <img src="<?php echo base_url('public/') ?>img/confirmInner.svg" alt="icon" class="img-responsive">
                            </div>
                            <div class="confirmDtl">
                                <div class="schedule boxs">
                                    <p>Your appointment is Scheduled at <span><?php echo $booking['shop_name_en'] ?></span></p>
                                </div>
                                <div class="schedule scheduleDtl boxs">
                                    <p><img src="<?php echo base_url('public/') ?>img/calendar.svg" alt="icon" class="img-responsive"><?php echo $booking_date; ?></p>
                                    <p><img src="<?php echo base_url('public/') ?>img/time.svg" alt="icon" class="img-responsive"><?php echo $booking_time; ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="confirmRight">
                            <div class="scheduleBtn boxs">
                                <a href="javascript:void(0)" class="btnHover"  data-target="#reviewBox" data-toggle="modal">Add Reviews</a>
                                <a href="javascript:void(0)" class="btnHover">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

<div id="reviewBox" class="modal fade getListedBox pad_rgt" role="dialog ">
    <div class="modal-dialog">
        <div class="modal-content sign_modelcontent boxs">
            <a href="javscript:void(0)" class="closed" data-dismiss="modal"><img src="<?php echo base_url('public/') ?>img/cross.png"></a>
            <div class="modal_rht boxs">
                <div class="signindiv psd_show boxs">
                    <div class="erro_msg_saloon"></div>
                    <form method="post" action="<?php echo base_url('Site/doAddReviews/'.$booking['shop_id']); ?>" id="addReview">
                        <div class="error_msg"></div>
                        <div class="form_all booking_area_inner boxs">

                            <div class="inner_text boxs">
                                <h3>Add a Review</h3>
                                
                                <div class="rating">
                                    
                                    <span title="five stars">&#9734;</span>
                                    <span title="four stars">&#9734;</span>
                                    <span title="three stars">&#9734;</span>
                                    <span title="two stars">&#9734;</span>
                                    <span title="one star">&#9734;</span>
                                    
                                </div>
                                
                            </div>
                            
                            <div>
                            <div class="form-group bok_text bok_border log_text boxs ">
                                <label for="saloon_email">Add comments</label>
                                <textarea class="form-control" name="comment" id="comment"></textarea>
                            </div>
                            </div>
                            
                            
                            <div class="login_btn boxs">
                                <button type="submit" class="btnHover ">Add</button>
                            </div>
                        </div>
                    </form>                 
                </div>
            </div>
        </div>
    </div>
</div>