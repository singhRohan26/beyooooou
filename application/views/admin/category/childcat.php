<option value="0">Choose Child Category</option>    
                                                              <?php foreach($result as $res) { ?> 
                                                        <option value="<?php echo $res['child_category_id'] ?>"><?php echo $res['en'] ?></option>
                                                              <?php } ?> 