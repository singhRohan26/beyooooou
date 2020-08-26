<div class="content-wrapper">
    
    <div class="col-lg-12">
        <?php foreach($getLanguages as $lang) {  ?>
        <?php foreach($getprivacy as $privacy) { if($privacy['language_type'] == $lang['code']) {   ?>
        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h2>Privacy Policy</h2><h4>Language:<?php echo $lang['name'] ?>(<?php echo $lang['code'] ?>)</h4>
										</div>
										<div class="card-body">
											
                                            <form method="post" action="<?php echo base_url('Admin/doAddPrivacy/'.$privacy['id']) ?>" id="privacy">
                                              <textarea class="summernote" name="privacy" id="privacy"><?php echo $privacy['text'] ?></textarea>
                                                <button type="submit" class="btn btn-primary mr-10">Submit</button>
                                            </form>
										</div>
									</div>
       <?php } } ?>
       <?php } ?>
    
    
    </div>  
</div>


