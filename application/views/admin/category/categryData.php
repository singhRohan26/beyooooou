 <option value="0">Choose Sub Category</option>    
                                                              <?php foreach($result as $res) { ?> 
                                                        <option value="<?php echo $res['sub_category_id'] ?>"><?php echo $res['en'] ?></option>
                                                              <?php } ?> 