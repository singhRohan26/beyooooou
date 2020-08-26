<div class="content-wrapper">
    <?php if(!empty($getLanguagesById)) {  ?>
    <div class="col-12">    
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
                                            <h2>Edit Languages</h2>
                                    </div>
										<div class="card-body">
											<form method="post" id="addlanguage" action="<?php if(empty($getLanguagesById)) {echo base_url('Admin/doAddLanguage'); }else{ echo base_url('Admin/doEditLanguage/'.$getLanguagesById['id']);} ?>">
                                                <div class="error_msg"></div> 
                                                <div class="form-row">
													<div class="col-md-4 mb-3">
														<label for="validationServer01">Language Name</label>
														<input type="text" class="form-control" placeholder="Enter Language Name" name="name" id="name" value="<?php if(!empty($getLanguagesById['name'])) { echo $getLanguagesById['name']; }?>">
													</div>
													<div class="col-md-4 mb-3">
														<label for="validationServer02">Language Code</label>
														<input type="texts" class="form-control"  placeholder="Enter Language Code" name="code" id="code" value="<?php if(!empty($getLanguagesById['code'])) { echo $getLanguagesById['code']; }?>">
													</div>
													
												</div>
												
												<button class="btn btn-primary" type="submit">Save</button>
											</form>
										</div>
									</div>
    </div>
    <?php } ?>
    
  <div class="col-12">
									<div class="card card-default">
										<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h2>Languages</h2>

											
										</div>

										<div class="card-body">
											<div class="basic-data-table">
												<table id="basic-data-table" class="table nowrap" style="width:100%">
													<thead>
														<tr>
															<th>Sno.</th>
															<th>Language Name</th>
															<th>Language Code</th>
															<th>Actions</th>											
														</tr>
													</thead>

													<tbody>
                                                        <?php  $a=1;
                                                        foreach($getLanguages as $lang) {  ?>
														<tr>
															<td><?php echo $a; ?></td>
															<td><?php echo $lang['name'] ?></td>
															<td><?php echo $lang['code'] ?></td>
															<td>
                                                            <a  href="<?php echo base_url('Admin/editLanguage/'.$lang['id']) ?>"><button type="button" class="btn btn-outline-info">Edit</button></a>
                                                                
                                                            </td>
															
														</tr>
														<?php $a++; } ?>


													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div> 
</div>


