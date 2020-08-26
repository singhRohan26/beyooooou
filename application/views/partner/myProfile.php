 
<div class="content-wrapper">
    <div class="col-12">
    
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											
                                            <h2>Shop Profile</h2>
                                            
										</div>
										<div class="card-body">
											<form method="post" id="shopProfile" action="<?php echo base_url('Partner/doUpdateProfile/'.$shop_id) ?>" enctype="multipart/form-data">
                                                <div class="error_msg"></div>
                                                <h4>Upload Image</h4><br>
                                                <div class="form-row">
													<div class="col-md-6 form-group">
														<label for="validationServer01">Profile Image</label>
														<input type="file" class="form-control" placeholder="Enter Language Name" name="image_url" id="image_url" value="">
                                                        <?php if(!empty($getPartnerdetails['image_url'])) {  ?>
                                                       <img src="<?php echo base_url('uploads/shop/'.$getPartnerdetails['image_url']) ?>" height="200" width="300">
                                                        <?php } ?>
													</div>
													<div class="col-md-6 form-group">
														<label for="validationServer02">Banner Image</label>
														<input type="file" class="form-control"  placeholder="Enter Language Code" name="banner_url" id="banner_url" value="">
                                                        <?php if(!empty($getPartnerdetails['banner_url'])) {  ?>
                                                        <img src="<?php echo base_url('uploads/banner/'.$getPartnerdetails['banner_url']) ?>" height="200" width="300">
                                                        <?php } ?>
													</div>
													
												</div>
                                                <div class="card-header card-header-border-bottom"></div>
                                                <h4>Choose Categories</h4><br>
                                                <div class="form-row">
													<div class="col-md-3 form-group">
														
                                                        <select class="form-control" id="category" name="category" data-url="<?php echo base_url('Category/subcat');?>" name="category">
                                                            <?php if(!empty($getPartnerdetails)) {  ?>
                                                            <option value="<?php echo $getPartnerdetails['category_id'] ?>"><?php echo $getPartnerdetails['catgory_en'] ?></option>
                                                            <?php } ?>
                                                             <option value="0">Choose Category</option>    
                                                              <?php foreach($getCategories as $category) { ?> 
                                                             <option value="<?php echo $category['category_id'] ?>"><?php echo $category['en'] ?></option>
                                                              <?php } ?>   
                                                            </select>
													</div>
													<div class="col-md-3 form-group">
														<select class="form-control" id="subcategory" name="subcategory" data-url="<?php echo base_url('Category/childcat') ?>">
                                                            <?php if(!empty($getPartnerdetails)) {  ?>
                                                            <option value="<?php echo $getPartnerdetails['sub_category_id'] ?>"><?php echo $getPartnerdetails['sub_category_en'] ?></option>
                                                            <?php } ?>
                                                             <option value="0">Choose Sub Category</option>    
                                                              <?php foreach($result as $res) { ?> 
                                                        <option value="<?php echo $res['sub_category_id'] ?>"><?php echo $res['en'] ?></option>
                                                              <?php } ?>   
                                                            </select> 
													</div>
													<div class="col-md-3 form-group">
														<select class="form-control" id="childcategory" name="childcategory" data-url="<?php echo base_url('Category/subchildcat') ?>">
                                                             <?php if(!empty($getPartnerdetails)) {  ?>
                                                            <option value="<?php echo $getPartnerdetails['child_category_id'] ?>"><?php echo $getPartnerdetails['child_category_en'] ?></option>
                                                            <?php } ?>
                                                             <option value="0">Choose Child Category</option>    
                                                              <?php foreach($result as $res) { ?> 
                                                        <option value="<?php echo $res['child_category_id'] ?>"><?php echo $res['en'] ?></option>
                                                              <?php } ?>   
                                                            </select>
													</div>
													<div class="col-md-3 form-group">
														<select class="form-control" id="superchild" name="superchild">
                                                            <?php if(!empty($getPartnerdetails)) {  ?>
                                                            <option value="<?php echo $getPartnerdetails['superchild_category_id'] ?>"><?php echo $getPartnerdetails['superchild_category_en'] ?></option>
                                                            <?php } ?>
                                                        <option value="0">Choose Super child Category</option>    
                                                              <?php foreach($getsuperchildcategories as $res) { ?> 
                                                        <option value="<?php echo $res['superchild_category_id'] ?>"><?php echo $res['en'] ?></option>
                                                              <?php } ?> 
                                                        </select>
													</div>
													
												</div>
                                                 <div class="card-header card-header-border-bottom"></div>
                                                <h4>Enter Shop details </h4><br>
                                                <div class="form-row">
													<div class="col-md-3 form-group">
														<label for="validationServer01">Shop Name(en)</label>
														<input type="text" class="form-control" placeholder="Shop Name(en)" name="shop_name_en" id="shop_name_en" value="<?php  echo $partnerDetails['shop_name_en'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">Shop Name(es)</label>
														<input type="text" class="form-control"  placeholder="Shop Name(es)" name="shop_name_es" id="shop_name_es" value="<?php  echo $getPartnerdetails['shop_name_es'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">Shop Name(fr)</label>
														<input type="text" class="form-control"  placeholder="Shop Name(fr)" name="shop_name_fr" id="shop_name_fr" value="<?php  echo $getPartnerdetails['shop_name_fr'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">Shop Name(pt)</label>
														<input type="text" class="form-control"  placeholder="Shop Name(pt)" name="shop_name_pt" id="shop_name_pt" value="<?php  echo $getPartnerdetails['shop_name_pt'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">Pin Code</label>
														<input type="number" class="form-control"  placeholder="Pin Code" name="code" id="code" value="<?php  echo $getPartnerdetails['pincode'] ?>">
													</div>
                                                    
                                                    <div class="col-md-3 form-group">
														<label for="validationServer02">From</label>
														<input type="time" class="form-control"  placeholder="Enter Language Code" name="from" id="from" value="<?php  echo $getPartnerdetails['from'] ?>">
													</div>
                                                     <div class="col-md-3 form-group">
														<label for="validationServer02">To</label>
														<input type="time" class="form-control"  placeholder="Enter Language Code" name="to" id="to" value="<?php  echo $getPartnerdetails['to'] ?>">
													</div>
                                                    <div class="col-md-12 form-group">
														<label for="validationServer02">Description</label>
														<textarea class="form-control" name="about" id="about"><?php  echo $getPartnerdetails['about'] ?></textarea>
													</div>
												</div>
                                                
                                                <div class="card-header card-header-border-bottom"></div>
                                                <h4>Enter City </h4><br>
                                                <div class="form-row">
													<div class="col-md-3 form-group">
														<label for="validationServer01">City(en)</label>
														<input type="text" class="form-control" placeholder="City(en)" name="city_name_en" id="city_name_en" value="<?php  echo $getPartnerdetails['city_en'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">City(es)</label>
														<input type="text" class="form-control"  placeholder="City(es)" name="city_name_es" id="city_name_es" value="<?php  echo $getPartnerdetails['city_es'] ?><?php  echo $getPartnerdetails['city_es'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">City(fr)</label>
														<input type="text" class="form-control"  placeholder="City(fr)" name="city_name_fr" id="city_name_fr" value="<?php  echo $getPartnerdetails['city_fr'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">City(pt)</label>
														<input type="text" class="form-control"  placeholder="City(pt)" name="city_name_pt" id="city_name_pt" value="<?php  echo $getPartnerdetails['city_pt'] ?>">
													</div>
													
												</div>
                                                
                                                <div class="card-header card-header-border-bottom"></div>
                                                <h4>Enter State </h4><br>
                                                <div class="form-row">
													<div class="col-md-3 form-group">
														<label for="validationServer01">State(en)</label>
														<input type="text" class="form-control" placeholder="State(en)" name="state_name_en" id="state_name_en" value="<?php  echo $getPartnerdetails['state_en'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">State(es)</label>
														<input type="text" class="form-control"  placeholder="State(es)" name="state_name_es" id="state_name_es" value="<?php  echo $getPartnerdetails['state_en'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">State(fr)</label>
														<input type="text" class="form-control"  placeholder="State(fr)" name="state_name_fr" id="state_name_fr" value="<?php  echo $getPartnerdetails['state_fr'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">State(pt)</label>
														<input type="text" class="form-control"  placeholder="State(pt)" name="state_name_pt" id="state_name_pt" value="<?php  echo $getPartnerdetails['state_pt'] ?>">
													</div>													
												</div>
                                                
                                                <div class="card-header card-header-border-bottom"></div>
                                                <h4>Enter Address </h4><br>
                                                <div class="form-row">
													<div class="col-md-3 form-group">
														<label for="validationServer01">Address(en)</label>
														<input type="text" class="form-control" placeholder="Address(en)" name="add_en" id="add_en" value="<?php  echo $getPartnerdetails['address_en'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">Address(es)</label>
														<input type="text" class="form-control"  placeholder="Address(es)" name="add_es" id="add_es" value="<?php  echo $getPartnerdetails['address_es'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">Address(fr)</label>
														<input type="text" class="form-control"  placeholder="Address(fr)" name="add_fr" id="add_fr" value="<?php  echo $getPartnerdetails['address_fr'] ?>">
													</div>
													<div class="col-md-3 form-group">
														<label for="validationServer02">Address(pt)</label>
														<input type="text" class="form-control"  placeholder="Address(pt)" name="add_pt" id="add_pt" value="<?php  echo $getPartnerdetails['address_pt'] ?>">
													</div>
													
												</div>
												<div class="form-row">
													<div class="col-md-12 form-group">
												<button class="btn btn-primary" type="submit">Save</button>
                                                    </div>
                                                </div>
											</form>
										</div>
									</div>
    </div>
    
</div>