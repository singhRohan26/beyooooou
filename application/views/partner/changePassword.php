  <div class="content-wrapper">
   
 <div class="col-lg-12">
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h2>Change Password</h2>
										</div>
										<div class="card-body">
											<form method="post" id="partnerchangepass" action="<?php echo base_url('Partner/doChangePassword') ?>">
                                                <div class="error_msg"></div>
												<div class="form-row">
													<div class="col-md-12 mb-3">
														<label for="validationServer01">Old Password</label>
														<input type="password" class="form-control" placeholder="Enter Old Password" name="op" id="op">
													</div>
													<div class="col-md-12 mb-3">
														<label for="validationServer02">New Password</label>
														<input type="password" class="form-control"  placeholder="Enter New Password" name="np" id="np">
													</div>
													<div class="col-md-12 mb-3">
														<label for="validationServerUsername">Confirm New Password</label>
														<input type="password" class="form-control" placeholder="Enter Confirm New Password"  name="cp" id="cp">
														
													</div>
												</div>
												
												<button class="btn btn-primary" type="submit">Change</button>
											</form>
										</div>
									</div>
								</div>
      </div>


