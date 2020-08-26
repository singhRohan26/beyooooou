 
    <!--    Banner Start-->

    <div class="banner boxs">
        <div class="container">
            <div class="bannerInner boxs">
                <div class="appointmentBox boxs">
                    <div class="appointInner boxs">
                        <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'filter_content') {   ?>
                        <h2><?php echo $site['text']; ?></h2>
                       <?php } } ?>
                        <form id="form_front_page_filter" action="<?php echo base_url('Site/shopFrontFilter');?>">
                            <div class="form-group">
                                <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'filter_content1') {   ?>
                                <label for="categ"><?php echo $site['text']; ?></label>
                                <?php } } ?>
                                <select name="service" id="categ" class="form-control" placeholder="Service">
                                <option value="">Enter Categories</option>
                                <?php foreach($getServices as $service) {  ?>
                                <option value="<?php echo $service['service_id'] ?>"><?php echo $service['service_name'] ?></option>
                                <?php } ?>
                                </select>
                                <span class="iconimg"><img src="https://www.beautishian.com/assets/img/search.svg" alt="icon" class="img-responsive"></span>
                            </div>
                            <div class="form-group">
                                <select name="city" id="service" class="form-control" placeholder="Service">
                                    <option value="">Enter Location</option>
                                <?php foreach($getAllCities as $city) {  ?>
                                <option value="<?php echo $city['city_name'] ?>"><?php echo $city['city_name'] ?></option>
                                <?php } ?>
                                </select>
                                <span class="iconimg"><img src="https://www.beautishian.com/assets/img/search.svg" alt="icon" class="img-responsive"></span>
                            </div>
                            <div class="form-group">
                                <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'filter_content2') {   ?>
                                <label for="location"><?php echo $site['text']; ?></label>
                                <?php } } ?>
                                <select name="location" id="location" class="form-control" placeholder="Location">
                                <option value="">Enter Location</option>
                                <option value="Noida">Noida</option>
                                </select>
                                <span class="iconimg"><img src="https://www.beautishian.com/assets/img/location.svg" alt="icon" class="img-responsive"></span>
                            </div>
                            <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'filter_button') {   ?>
                            <button type="search" class="form-control btnHover"><?php echo $site['text']; ?></button>
                            <?php } } ?>
                        </form>
                        <!--<a href="getlisted.html">Are you a hair stylist or beauty professional? Join Now</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    Banner End-->

    <!--    Discover Treatment Start-->

    <div class="discTreatment boxs">
        <div class="container">
            <div class="treatmentInner boxs">
                <!-- <h2>Discover the Treatment</h2> -->
                <div class="catList boxs">
                    <ul>
                        <?php foreach($allCategories as $category) { ?>
                        <li><a href="<?php echo base_url('Site/doCategoryFilter/'.$category['category_id']) ?>" class="clickme active btnHover" data-type="a" id="categoryFilter"><?php echo $category['cat_name'] ?></a></li>
                       <?php } ?>
                    </ul>
                </div>
                <div class="treatmentOptn boxs all alla">
                    <div class="row">
                        
                        <div  id="category_wrapper">
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
                                                <h3><?php echo $subcat['sub_category_name'] ?></h3>
                                                <p>Book your bridal or party makeover</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div> 
<?php } ?>
                        </div>
                       
                        
                        
                    </div>
                </div>
               
                
                <div class="workBeYoou boxs">
                    <div class="col-sm-4">
                                <div class="treatmentDesign boxs">
                                    <img src="<?php echo base_url('public/') ?>img/beauti1.png" alt="image" class="img-responsive">
                                </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="treatmentBoxs boxs">
                                    <div>
                                        <div class="boxs">
                                            <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'freelancer_title') {   ?>
                                            <h2><?php echo $site['text'] ?></h2>
                                            <?php }} ?>
                                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                                                nonumy eirmod tempor invidunt ut labore et dolore magnaLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                                                nonumy eirmod tempor invidunt ut labore et dolore magna
                                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                                                nonumy eirmod tempor invidunt ut labore et dolore magna
                                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                                                nonumy eirmod tempor invidunt ut labore et dolore magna</p></div>
                                                <div class="catList boxs">
                                                    <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'freelancer_button') {   ?>
                                                    <a href="#" class="btnHover"><?php echo $site['text'] ?></a>
                                                     <?php }} ?>
                                                </div>
                                        
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    Discover Treatment End-->

    <!--    Browse City Section Start-->

    <div class="browseCity boxs">
        <div class="container">
            <div class="browseInner boxs">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="locationDtl boxs">
                            <div class="cityAvailabel boxs">
                                <div class="browseTop">
                                    <h2>Available In</h2>
                                </div>
                                <div class="browseBtm">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">Chittagong</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment1.png" class="img-responsive" alt="location image">
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Dhaka</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment2.png" class="img-responsive" alt="location image">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="cityAvailabel cityLaunch boxs">
                                <div class="browseTop">
                                    <h2>Launching Soon in</h2>
                                </div>
                                <div class="browseBtm">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">Khulna</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment3.png" class="img-responsive" alt="location image">
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Rajshahi</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment4.png" class="img-responsive" alt="location image">
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Rangpur</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment5.png" class="img-responsive" alt="location image">
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Sylhet</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment6.png" class="img-responsive" alt="location image">
                                        </li>
                                        <li><a href="javascript:void(0)">Barisal</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment7.png" class="img-responsive" alt="location image">
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Mymensingh</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment8.png" class="img-responsive" alt="location image">
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Rangpur</a>
                                            <img src="<?php echo base_url('public/') ?>img/treatment9.png" class="img-responsive" alt="location image">
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Sylhet</a>
                                            <img src="<?php echo base_url('public/') ?>img/appstore.png" class="img-responsive" alt="location image">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="map boxs">
                            <div class="locationMap boxs">
                                <img src="<?php echo base_url('public/') ?>img/dhaka.png" class="img-responsive" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Browse City Section End-->


    