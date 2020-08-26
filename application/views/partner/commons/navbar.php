      <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">
                <div class="input-group">                 
                  
                </div>
                <div id="search-results-container">
                  <ul id="search-results"></ul>
                </div>
              </div>

              <div class="navbar-right ">
                <ul class="nav navbar-nav">
                 
                  
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                      
                      <span class="d-none d-lg-inline-block">Hello,<?php echo $partnerDetails['shop_name_en']; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header">
                        
                        <div class="d-inline-block">
                          Partner <small class="pt-1"><?php echo $partnerDetails['email'] ?></small>
                        </div>
                      </li>
                      <li class="right-sidebar-in">
                        <a href="<?php echo base_url('Partner/myProfile') ?>"> <i class="mdi mdi-settings"></i> My Profile </a>
                      </li>
                      <li class="right-sidebar-in">
                        <a href="<?php echo base_url('Partner/changePassword') ?>"> <i class="mdi mdi-settings"></i> Change Password </a>
                      </li>

                      <li class="dropdown-footer">
                        <a href="<?php echo base_url('Partner/logout') ?>"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>


          </header>