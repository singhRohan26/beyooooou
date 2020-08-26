<?php foreach($getSubcategory as $subcat){
$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
$color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
?>  
<div class="col-sm-4">
                            <div class="treatmentBoxs boxs">
                                <a href="<?php echo base_url('Site/shopsListing/'.$subcat['sub_category_id']) ?>">
                                    <div class="treatmentDesign boxs">
                                        <img src="<?php echo base_url('uploads/subcategory/'.$subcat['image_url']) ?>" alt="image" class="img-responsive">
                                        <div class="treatmentName" style="background-color: <?php echo $color; ?>">
                                            <div>
                                                <h3><?php echo $subcat['en'] ?></h3>
                                                <p>Book your bridal or party makeover</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div> 
<?php } ?>