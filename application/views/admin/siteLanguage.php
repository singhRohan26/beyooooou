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
                                                                <th>Key</th>
                                                                <th>en</th>
                                                                <th>es</th>
                                                                <th>fr</th>											
                                                                <th>pt</th>											
                                                                <th>Actions</th>											
                                                            </tr>
                                                            
                                                            
                                                        </thead>

                                                        <tbody>
                                                            <?php 
                                                            $a=1;
                                                            foreach($getSiteLanguage as $siteLang) {  ?>
                                                            <tr>
                                                                <td><?php echo $a; ?></td>
                                                                <td><?php echo $siteLang['key']; ?></td>
                                                                <td><?php echo $siteLang['en']; ?></td>
                                                                <td><?php echo $siteLang['es']; ?></td>
                                                                <td><?php echo $siteLang['fr']; ?></td>
                                                                <td><?php echo $siteLang['pt']; ?></td>
                                                                <td>Edit</td>

                                                            </tr>
                                                             <?php $a++; } ?>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="card card-default">
										<div class="card-header card-header-border-bottom">
                                              <h4>Manage Language</h4>
                                           
                                                <form method="post" id="manage_lang" action="<?php echo base_url('Category/doManageLanguage') ?>">
                                                    <div class="error_msg"></div>                                                     
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Key Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter key Name" name="key" id="key" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">En</label>
                                                            <input type="text" class="form-control" placeholder="Enter in en" name="en" id="en" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Es</label>
                                                            <input type="text" class="form-control" placeholder="Enter in es" name="es" id="es" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Fr</label>
                                                            <input type="text" class="form-control" placeholder="Enter in fr" name="fr" id="fr" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Pt</label>
                                                            <input type="text" class="form-control" placeholder="Enter in pt" name="pt" id="pt" value="">
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


