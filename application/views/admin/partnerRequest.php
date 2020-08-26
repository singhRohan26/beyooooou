<div class="content-wrapper">

    
  <div class="col-12">
									<div class="card card-default">
										<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h2>Partner Requests</h2>

											
										</div>

										<div class="card-body">
											<div class="basic-data-table">
												<table id="basic-data-table" class="table nowrap" style="width:100%">
													<thead>
														<tr>
															<th>Sno.</th>															
															<th>Partner Email</th>
															<th>Organisation Name</th>
															<th>Actions</th>											
														</tr>
													</thead>

													<tbody>
                                                        <?php  $a=1;
                                                        foreach($getPartner as $partner) {  ?>
														<tr>
															<td><?php echo $a; ?></td>															
															<td><?php echo $partner['email'] ?></td>
															<td><?php echo $partner['shop_name_en'] ?></td>
															<td>
                                                                <?php if($partner['status'] == 'Active') {  ?>
                                                            <a  href="<?php echo base_url('Admin/inactivatePartnerStatus/'.$partner['shop_id']) ?>" class="inactivate"><button type="button" class="btn btn-outline-danger">Inactive</button>
                                                                </a>
                                                            <?php }else{  ?>
                                                                <a  href="<?php echo base_url('Admin/activatePartnerStatus/'.$partner['shop_id']) ?>" class="activate"><button type="button" class="btn btn-outline-success">Active</button>
                                                                </a>
                                                            <?php } ?>
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


