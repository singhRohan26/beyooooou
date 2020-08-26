            <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="<?php echo base_url('Admin/dashboard/') ?>" title="Sleek Dashboard">
                <svg
                  class="brand-icon"
                  xmlns="http://www.w3.org/2000/svg"
                  preserveAspectRatio="xMidYMid"
                  width="30"
                  height="33"
                  viewBox="0 0 30 33">
                  <g fill="none" fill-rule="evenodd">
                    <path
                      class="logo-fill-blue"
                      fill="#7DBCFF"
                      d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                    />
                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                  </g>
                </svg>
                <span class="brand-name text-truncate">Be-Yoou Dashboard</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">                     
                  <li  class="has-sub active expand" >
                    <a class="sidenav-item-link" href="<?php echo base_url('Admin/dashboard/') ?>" 
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text">Dashboard</span>
                    </a>                   
                  </li>
                
                   <li  class="has-sub active expand" >
                    <a class="sidenav-item-link" href="<?php echo base_url('Admin/languages/') ?>" 
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text">Languages</span>
                    </a>                   
                  </li>
                
                       
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#apps"
                      aria-expanded="false" aria-controls="apps">
                      <i class="mdi mdi-pencil-box-multiple"></i>
                      <span class="nav-text">Categories</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="apps"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                        
                          
                            <li >
                              <a class="sidenav-item-link" href="<?php echo base_url('Category/category') ?>">
                                <span class="nav-text">Category</span>
                                
                              </a>
                            </li>
                          
                        <li >
                              <a class="sidenav-item-link" href="<?php echo base_url('Category/subCategory') ?>">
                                <span class="nav-text">Sub-Category</span>
                                
                              </a>
                            </li>
                          
                          <li>
                              <a class="sidenav-item-link" href="<?php echo base_url('Category/childCategory') ?>">
                                <span class="nav-text">Child Category</span>
                                
                              </a>
                            </li>
                          
                          <li>
                              <a class="sidenav-item-link" href="<?php echo base_url('Category/superchildCategory') ?>">
                                <span class="nav-text">Super Child Category</span>
                                
                              </a>
                            </li>
                                          
                          </div>
                    </ul>
                  </li>
                  
                
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                      aria-expanded="false" aria-controls="app">
                      <i class="mdi mdi-pencil-box-multiple"></i>
                      <span class="nav-text">Site Settings</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="app"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                        
                          
                            <li >
                              <a class="sidenav-item-link" href="<?php echo base_url('Admin/aboutUs') ?>">
                                <span class="nav-text">Help</span>
                                
                              </a>
                            </li>
                          
                        <li >
                              <a class="sidenav-item-link" href="<?php echo base_url('Admin/privacyPolicy') ?>">
                                <span class="nav-text">Privacy Policy</span>
                                
                              </a>
                            </li>
                          
                          <li >
                              <a class="sidenav-item-link" href="<?php echo base_url('Admin/faq') ?>">
                                <span class="nav-text">FAQ's</span>
                                
                              </a>
                            </li>
                                          
                          </div>
                    </ul>
                  </li>
                  
                  <li  class="has-sub active expand" >
                    <a class="sidenav-item-link" href="<?php echo base_url('Category/siteLanguage/') ?>" 
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text">Language Management</span>
                    </a>                   
                  </li>
                  
                  <li  class="has-sub active expand" >
                    <a class="sidenav-item-link" href="<?php echo base_url('Admin/partnerRequest') ?>" 
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text">Partner Request</span>
                    </a>                   
                  </li>
                  
                
     </ul>

            </div>

            <div class="sidebar-footer">
              <hr class="separator mb-0" />
              <div class="sidebar-footer-content">
                <h6 class="text-uppercase">
                  Cpu Uses <span class="float-right">40%</span>
                </h6>
                <div class="progress progress-xs">
                  <div
                    class="progress-bar active"
                    style="width: 40%;"
                    role="progressbar"
                  ></div>
                </div>
                <h6 class="text-uppercase">
                  Memory Uses <span class="float-right">65%</span>
                </h6>
                <div class="progress progress-xs">
                  <div
                    class="progress-bar progress-bar-warning"
                    style="width: 65%;"
                    role="progressbar"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </aside>