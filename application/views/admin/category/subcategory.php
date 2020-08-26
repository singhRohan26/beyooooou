<div class="content-wrapper">
    <div class="col-12">
    
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											
                                            <h2>Sub Category Management</h2>
                                            
										</div>
										<div class="card-body">
                                            <div class="row">
                                            <div class="col-sm-8">
                                                    <div class="basic-data-table">
                                                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sno.</th>
                                                                <th>Image</th>
                                                                <th>Sub category(en)</th>
                                                                <th>Sub category(es)</th>
                                                                <th>Sub category(fr)</th>											
                                                                <th>Sub category(pt)</th>											
                                                                <th>Actions</th>											
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php $a=1;
                                                            foreach($getsubcategories as $subcategory) {  ?>
                                                            <tr>
                                                                <td><?php echo $a; ?></td>
                                                                <td><img src="<?php echo base_url('uploads/subcategory/'.$subcategory['image_url']) ?>" height="50" width="50"></td>
                                                                
                                                                <td><?php echo $subcategory['en']; ?></td>
                                                                <td><?php echo $subcategory['es']; ?></td>
                                                                <td><?php echo $subcategory['fr']; ?></td>
                                                                <td><?php echo $subcategory['pt']; ?></td>
                                                                <td><a href="<?php echo base_url('Category/editSubcategory/'.$subcategory['sub_category_id']) ?>"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a>
                                                                <a class="delcategory" href="<?php echo base_url('Category/doDeleteSubcategory/'.$subcategory['sub_category_id']) ?>"><button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a>
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
                                                <h4>Add Sub Category</h4><br>
                                                <form method="post" id="addsubcategory" action="<?php if(!empty($getsubcategoriesById)){ echo base_url('Category/doEditSubcategory/'.$getsubcategoriesById['sub_category_id']); } else {  echo base_url('Category/doaddsubcategory'); } ?>" enctype="multipart/form-data">
                                                    <div class="error_msg"></div>                                                     
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                             <select class="form-control" id="category" name="category">
                                                                <?php  if(!empty($getsubcategoriesById)){ ?>   
                                                                <option value="<?php echo $getsubcategoriesById['category_id']; ?>"><?php echo $getsubcategoriesById['category_en'];  ?></option>
                                                                <?php } ?> 
                                                             <option value="0">Choose Category</option>
                                                                 <?php foreach($getCategories as $category) {
                                                                 
                                                                 ?>
                                                            
                                                                
                                                             <option value="<?php echo $category['category_id'] ?>"><?php echo $category['en'] ?></option>
                                                              <?php  }  ?>   
                                                            </select>   
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Sub Category(en)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="subcategory_en" id="subcategory_en" value="<?php if(!empty($getsubcategoriesById)){ echo $getsubcategoriesById['en']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Sub Category(es)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="subcategory_es" id="subcategory_es" value="<?php if(!empty($getsubcategoriesById)){ echo $getsubcategoriesById['es']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Sub Category(fr)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="subcategory_fr" id="subcategory_fr" value="<?php if(!empty($getsubcategoriesById)){ echo $getsubcategoriesById['fr']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Sub Category(pt)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="subcategory_pt" id="subcategory_pt" value="<?php if(!empty($getsubcategoriesById)){ echo $getsubcategoriesById['pt']; } ?>">
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Upload Image</label>
                                                            <input type="file" class="form-control" placeholder="" name="file1" id="file1" value="">
                                                                <?php if(!empty($getsubcategoriesById)){  ?>
                                                                <img src="<?php echo base_url('uploads/subcategory/'.$getsubcategoriesById['image_url']) ?>" height="100" width="100" >
                                                                <?php } ?>
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


