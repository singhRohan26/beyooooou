<div class="content-wrapper">
    <div class="col-12">
    
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											
                                            <h2>Category Management</h2>
                                            
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
                                                                <th>category(en)</th>
                                                                <th>category(es)</th>
                                                                <th>category(fr)</th>											
                                                                <th>category(pt)</th>											
                                                                <th>Actions</th>											
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php $a=1;
                                                            foreach($getCategories as $category) {  ?>
                                                            <tr>
                                                                <td><?php echo $a; ?></td>
                                                                <td><img src="<?php echo base_url('uploads/category/'.$category['image_url']) ?>" height="50" width="50"></td>
                                                                <td><?php echo $category['en']; ?></td>
                                                                <td><?php echo $category['es']; ?></td>
                                                                <td><?php echo $category['fr']; ?></td>
                                                                <td><?php echo $category['pt']; ?></td>
                                                                <td>
                                                            <a href="<?php echo base_url('Category/editCategory/'.$category['category_id']) ?>"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a>
                                                                <a class="delcategory" href="<?php echo base_url('Category/doDeleteCategory/'.$category['category_id']) ?>"><button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a>
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
                                                <?php if(!empty($getCategoryById)) {  ?>
                                            <h4>Edit Category</h4>
                                            <?php }else{  ?>
                                            <h4>Add Category</h4>
                                            <?php } ?>
                                                <form method="post" id="addcategory" action="<?php if(!empty($getCategoryById)){ echo base_url('Category/doEditCategory/'.$getCategoryById['category_id']); }else{  echo base_url('Category/doaddcategory'); } ?>" enctype="multipart/form-data">
                                                    <div class="error_msg"></div>                                                     
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Category(en)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_en" id="category_en" value="<?php if(!empty($getCategoryById)){echo $getCategoryById['en']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Category(es)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_es" id="category_es" value="<?php if(!empty($getCategoryById)){echo $getCategoryById['es'];} ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Category(fr)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_fr" id="category_fr" value="<?php if(!empty($getCategoryById)){echo $getCategoryById['fr'];} ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Category(pt)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_pt" id="category_pt" value="<?php if(!empty($getCategoryById)){echo $getCategoryById['pt'];} ?>">
                                                            </div>
                                                        </div>                                                       
                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Upload Image</label>
                                                            <input type="file" class="form-control" placeholder="" name="file1" id="file1" value="">
                                                             <?php if(!empty($getCategoryById)){ ?>
                                                             <img src="<?php echo base_url('uploads/category/'.$getCategoryById['image_url']) ?>" height="100" width="100">
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
    
</div>


