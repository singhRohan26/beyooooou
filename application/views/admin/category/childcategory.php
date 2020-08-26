<div class="content-wrapper">
    <div class="col-12">
    
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											
                                            <h2>Child Category Management</h2>
                                            
										</div>
										<div class="card-body">
                                            <div class="row">
                                            <div class="col-sm-8">
                                                    <div class="basic-data-table">
                                                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sno.</th>
                                                                <th>Child category(en)</th>
                                                                <th>Child category(es)</th>
                                                                <th>Child category(fr)</th>											
                                                                <th>Child category(pt)</th>											
                                                                <th>Actions</th>											
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php $a=1;
                                                            foreach($getchildcategories as $childcat) {  ?>
                                                            <tr>
                                                                <td><?php echo $a; ?></td>
                                                                <td><?php echo $childcat['en']; ?></td>
                                                                <td><?php echo $childcat['es']; ?></td>
                                                                <td><?php echo $childcat['fr']; ?></td>
                                                                <td><?php echo $childcat['pt']; ?></td>
                                                                <td><a href="<?php echo base_url('Category/editChildCategory/'.$childcat['child_category_id']) ?>"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a>
                                                                <a class="delchildcategory" href="<?php echo base_url('Category/doDeleteChildcategory/'.$childcat['child_category_id']) ?>"><button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a>
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
                                                 <?php if(!empty($getChildCategoryByid)) {  ?>
                                                <h4>Edit Child Category</h4><br>
                                              <?php }else{  ?>
                                            <h4>Add Child Category</h4><br>
                                              <?php } ?>
                                                <form method="post" id="childcategory1" action="<?php if(!empty($getChildCategoryByid)){ echo base_url('Category/doEditChildCategory/'.$getChildCategoryByid['child_category_id']);}else{ echo base_url('Category/doaddchildcategory'); } ?>">
                                                    <div class="error_msg"></div>                                                     
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                             <select class="form-control" id="category" data-url="<?php echo base_url('Category/subcat');?>" name="category">
                                                             <?php if(!empty($getChildCategoryByid)) {  ?>
                                                           <option value="<?php echo $getChildCategoryByid['category_id'] ?>"><?php echo $getChildCategoryByid['category_en'] ?></option>      
                                                            <?php } ?>     
                                                             <option value="0">Choose Category</option>    
                                                              <?php foreach($getCategories as $category) { ?> 
                                                             <option value="<?php echo $category['category_id'] ?>"><?php echo $category['en'] ?></option>
                                                              <?php } ?>   
                                                            </select>   
                                                            </div>  
                                                        </div>
                                                         <div class="col-md-12">
                                                            <div class="form-group">
                                                             <select class="form-control" id="subcategory" name="subcategory">
                                                            <?php if(!empty($getChildCategoryByid)) {  ?>
                                                             <option value="<?php echo $getChildCategoryByid['sub_category_id'] ?>"><?php echo $getChildCategoryByid['sub_category_en'] ?></option>    
                                                            <?php } ?>     
                                                             <option value="0">Choose Sub Category</option>    
                                                              <?php foreach($result as $res) { ?> 
                                                        <option value="<?php echo $res['sub_category_id'] ?>"><?php echo $res['en'] ?></option>
                                                              <?php } ?>   
                                                            </select>   
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Child Category(en)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="childcategory_en" id="childcategory_en" value="<?php if(!empty($getChildCategoryByid)) { echo $getChildCategoryByid['en']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Child Category(es)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="childcategory_es" id="childcategory_es" value="<?php if(!empty($getChildCategoryByid)) { echo $getChildCategoryByid['es']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Child Category(fr)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="childcategory_fr" id="childcategory_fr" value="<?php if(!empty($getChildCategoryByid)) { echo $getChildCategoryByid['fr']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Child Category(pt)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="childcategory_pt" id="childcategory_pt" value="<?php if(!empty($getChildCategoryByid)) { echo $getChildCategoryByid['pt']; } ?>">
                                                            </div>
                                                        </div>
                                                        

                                                    </div>
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


