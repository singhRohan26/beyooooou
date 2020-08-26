<div class="content-wrapper">
    
<div class="col-lg-12">
    <?php foreach($getLanguages as $lang) {  ?>
    <?php foreach($aboutus as $about) { if($about['language_type'] == $lang['code']) {   ?>
    
                            <div class="card card-default">
                                <div class="card-header card-header-border-bottom">
                                    <h2>Help: </h2><h4>Language:<?php echo $lang['name'] ?>(<?php echo $lang['code'] ?>)</h4>                                          
                                        </div>
    
										<div class="card-body">
								            <form method="post" action="<?php echo base_url('Admin/doAddAboutus/'.$about['id']) ?>" id="aboutus">
                                                    <textarea class="summernote" name="aboutus" id="aboutus"><?php echo     $about['text'] ?></textarea>
                                                <button type="submit" class="btn btn-primary mr-10">Submit</button>
                                            </form>
										</div>
    
									</div>
        <?php } } ?>
        <?php } ?>
                                </div>  
                            </div>


