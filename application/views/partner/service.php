<div class="content-wrapper">
    <div class="col-12">
    
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											
                                            <h2>Add Services</h2>
                                            
										</div>
										<div class="card-body">
                                            <div class="row">
                                            <div class="col-sm-8">
                                                    <div class="basic-data-table">
                                                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sno.</th>
                                                                <th>Service(en)</th>
                                                                <th>Service(es)</th>
                                                                <th>Service(fr)</th>											
                                                                <th>Service(pt)</th>											
                                                                <th>Actions</th>											
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php $a=1; foreach($getServices as $service) {  ?>
                                                            <tr>
                                                                <td><?php echo $a; ?></td>
                                                                <td><?php echo $service['en']; ?></td>
                                                                <td><?php echo $service['en']; ?></td>
                                                                <td><?php echo $service['en']; ?></td>
                                                                <td><?php echo $service['en']; ?></td>
                                                                <td>
                                                            <a href=""><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a>
                                                                <a class="delservices" href="<?php echo base_url('Partner/delServices/'.$service['service_id']) ?>"><button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a>
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
                                                
                                            <h4>Add Services</h4>
                                            
                                                <form method="post" id="addservicesss" action="<?php echo base_url('Partner/doAddServices') ?>" >
                                                    <div class="error_msg"></div>                                                     
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            
                                                            <select class="form-control" name="service" id="service">
                                                            <option>Choose Service</option>
                                                            <?php foreach($getServicescategory as $service) {  ?>
                                                            <option value="<?php echo $service['service_category_id'] ?>"><?php echo $service['en']  ?></option>
                                                            <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Service(en)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Service Name" name="service_en" id="service_en" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Service(es)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Service Name" name="service_es" id="service_es" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Service(fr)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Service Name" name="service_fr" id="service_fr" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Service(pt)</label>
                                                            <input type="text" class="form-control" placeholder="Enter Service Name" name="service_pt" id="service_pt" value="">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="validationServer01">Price</label>
                                                            <input type="number" class="form-control" placeholder="Enter Price" name="price" id="price" value="">
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


