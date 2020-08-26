<!-- search start -->

    <section class="search_section main boxs">
        <div class="container-fluid">
            <div class="search_sec boxs">
                <form method="post" action="<?php echo base_url('Site/shopFilteration/'.$id) ?>" id="shop_filter">
                    <div class="ser_frm boxs">
                        <div class="col-sm-3">
                            <div class="form-group boxs">
                                <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'filter_content1') {   ?>
                                <label for="search"><?php echo $site['text']; ?></label>
                                <?php }elseif($site['key'] == 'service_list'){  ?>
                                <select name="service" id="categ" class="form-control" placeholder="Service">                                    
                                <option value=""><?php echo $site['text']; ?></option>
                                <?php }} foreach($getServices as $service) {  ?>
                                <option <?php if($this->session->flashdata('service') == $service['service_id']){ echo "selected"; } ?> value="<?php echo $service['service_id'] ?>"><?php echo $service['service_name'] ?></option>
                                <?php } ?>
                                </select>
                                <img src="<?php echo base_url('public/') ?>img/search.svg" alt="icon" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group boxs">
                                <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'filter_content2') {   ?>
                                <label for="location"><?php echo $site['text']; ?></label>
                                <?php }elseif($site['key'] == 'city_list'){    ?>
                                <select name="city" id="service" class="form-control" placeholder="Service">
                                <option value=""><?php echo $site['text']; ?></option>
                                <?php }} foreach($getAllCities as $city) {  ?>
                                <option <?php if($this->session->flashdata('city') == $city['city_name']){ echo "selected"; } ?> value="<?php echo $city['city_name'] ?>"><?php echo $city['city_name'] ?></option>
                                <?php } ?>
                                </select>
                                <img src="<?php echo base_url('public/') ?>img/location.svg" alt="icon" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group boxs">
                                <?php foreach($getSiteLanguages as $site) { if($site['key'] == 'filter_content2') {   ?>
                                <label for="date"><?php echo $site['text']; ?></label>
                                <?php }elseif($site['key'] == 'filter_button'){  ?>
                                <input type="date" id="date" name="date" class="form-control" placeholder="Enter Location">
                                <img src="<?php echo base_url('public/') ?>img/date.svg" alt="icon" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="search_btn boxs "> <button type="submit" class="btnHover"><?php echo $site['text']; ?></button></div>
                            <?php } } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <!-- search end -->

    <!--    filter Start-->

    <section class="filter boxs">
        <div class="container-fluid">
            <div class="filter_sec  boxs">
                
                <a href="#" class="filter_sec1"> <img src="<?php echo base_url('public/') ?>img/prefer.svg" class="img-responsive" alt="image">Filter</a>
                
                <!--    shop wrapper-->
                <div data-url="<?php echo base_url('Site/shop_wrapper/'.$id) ?>" id="shop_wrapper"></div>
                <!--    shop wrapper-->
                

            </div>
        </div>
    </section>

    <!--   filter End-->