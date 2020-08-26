<option value="0">Choose Super child Category</option>    
                                                              <?php foreach($result as $res) { ?> 
                                                        <option value="<?php echo $res['superchild_category_id'] ?>"><?php echo $res['en'] ?></option>
                                                              <?php } ?> 