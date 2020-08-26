<div class="content-wrapper">
    <div class="col-12">
    
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											
                                            <h2>SuperChild Category Management</h2>
                                            
										</div>
										<div class="card-body">
                                            <div class="row">
                                            <div class="col-sm-8">
                                                    <div class="basic-data-table">
                                                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sno.</th>
                                                                <th>SuperChild category(en)</th>
                                                                <th>SuperChild category(es)</th>
                                                                <th>SuperChild category(fr)</th>											
                                                                <th>SuperChild category(pt)</th>											
                                                                <th>Actions</th>											
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php $a=1;
                                                            foreach($getsuperchildcategories as $superchild) {  ?>
                                                            <tr>
                                                                <td><?php echo $a; ?></td>
                                                                <td><?php echo $superchild['en']; ?></td>
                                                                <td><?php echo $superchild['es']; ?></td>
                                                                <td><?php echo $superchild['fr']; ?></td>
                                                                <td><?php echo $superchild['pt']; ?></td>
                                                                <td><a href="<?php echo base_url('Category/editSuperChildCategory/'.$superchild['superchild_category_id']) ?>"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a>
                                                                <a class="delSuperchildcategory" href="<?php echo base_url('Category/doDeleteSuperChildcategory/'.$superchild['superchild_category_id']) ?>"><button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a>
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
                                                <?php if(!empty($getSuperChildById)){  ?>
                                                <h4>Edit SuperChild Category</h4><br>
                                               <?php }else{  ?>
                                                <h4>Add SuperChild Category</h4><br>
                                               <?php } ?>
                                                <form method="post" id="superchildcategory" action="<?php if(!empty($getSuperChildById)){ echo base_url('Category/doEditSuperchild/'.$getSuperChildById['superchild_category_id']); }else{  echo base_url('Category/doaddsuperchildcategory'); } ?>">
                                                    <div class="error_msg"></div>                                                     
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                             <select class="form-control" id="category" data-url="<?php echo base_url('Category/subcat');?>" name="category">
                                                             <?php if(!empty($getSuperChildById)){  ?>
                                                            <option value="<?php echo $getSuperChildById['category_id'] ?>"><?php echo $getSuperChildById['category_en'] ?></option>   
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
                                                             <select class="form-control" id="subcategory" name="subcategory" data-url="<?php echo base_url('Category/childcat') ?>">
                                                            <?php if(!empty($getSuperChildById)){  ?>
                                                            <option value="<?php echo $getSuperChildById['sub_category_id'] ?>"><?php echo $getSuperChildById['sub_category_en'] ?></option>
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
                                                             <select class="form-control" id="childcategory" name="childcategory">
                                                              <?php if(!empty($getSuperChildById)){  ?>
                                                            <option value="<?php echo $getSuperChildById['child_category_id'] ?>"><?php echo $getSuperChildById['child_category_en'] ?></option>
                                                            <?php } ?>   
                                                             <option value="0">Choose Child Category</option>    
                                                              <?php foreach($result as $res) { ?> 
                                                        <option value="<?php echo $res['child_category_id'] ?>"><?php echo $res['en'] ?></option>
                                                              <?php } ?>   
                                                            </select>   
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">SuperChild Category(en)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="superchildcategory_en" id="superchildcategory_en" value="<?php if(!empty($getSuperChildById)) { echo $getSuperChildById['en']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">SuperChild Category(es)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="superchildcategory_es" id="superchildcategory_es" value="<?php if(!empty($getSuperChildById)){ echo $getSuperChildById['es']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">SuperChild Category(fr)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="superchildcategory_fr" id="superchildcategory_fr" value="<?php if(!empty($getSuperChildById)){ echo $getSuperChildById['fr']; } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">SuperChild Category(pt)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Category Name" name="superchildcategory_pt" id="superchildcategory_pt" value="<?php if(!empty($getSuperChildById)){ echo $getSuperChildById['pt']; } ?>">
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


