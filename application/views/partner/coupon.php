
<div class="content-wrapper">
    <div class="col-12">
    
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											
                                            <h2>Add Coupon</h2>
                                            
										</div>
										<div class="card-body">
                                            <div class="row">
                                            <div class="col-sm-8">
                                                    <div class="basic-data-table">
                                                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sno.</th>
                                                                <th>Coupon Code</th>
                                                                <th>Coupon Value</th>
                                                                <th>User Type</th>
                                                                <th>Actions</th>											
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php $a=1; foreach($getCoupon as $coupon) {  ?>
                                                            <tr>
                                                                <td><?php echo $a; ?></td>
                                                                <td><?php echo $coupon['coupon_code']; ?></td>
                                                                <td><?php echo $coupon['coupon_value']; ?></td>
                                                                <td><?php echo $coupon['user_type']; ?></td>
                                                               
                                                                <td>
                                                            <a href="<?php echo base_url('Partner/editCoupon/'.$coupon['coupon_id']) ?>"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a>
                                                                <a class="delcoupon" href="<?php echo base_url('Partner/delCoupon/'.$coupon['coupon_id']) ?>"><button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a>
                                                            </td>

                                                            </tr>
                                                            <?php $a++; } ?>  


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="card card-default">
										<div class="card-header card-header-border-bottom">
                                             <?php if(!empty($getCouponById)) { ?>   
                                            <h4>Edit Coupon</h4>
                                            <?php }else{  ?>
                                            <h4>Add Coupon</h4>
                                            <?php } ?>
                                            <form method="post" id="addcoupon" action="<?php if(!empty($getCouponById)) {echo base_url('Partner/doEditCoupon/'.$getCouponById['coupon_id']);}else{ echo base_url('Partner/doAddcoupon'); } ?>" >
                                                
                                                    <div class="error_msg"></div>                                                     
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Coupon Code</label>
                                                            <input type="text" class="form-control" placeholder="Enter Service Name" name="coupon_code" id="coupon_code" value="<?php if(!empty($getCouponById)) { echo $getCouponById['coupon_code']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Coupon Value</label>
                                                            <input type="text" class="form-control" placeholder="Enter Service Name" name="coupon_value" id="coupon_value" value="<?php if(!empty($getCouponById)) { echo $getCouponById['coupon_value']; } ?>">
                                                            </div>
                                                        </div>                                                                                   </div>
                                                    <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                                </div>
                                                </div>
                                            </div>
										</div>
									</div>
    </div>
    
</div>


