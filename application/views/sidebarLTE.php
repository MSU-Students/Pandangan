<aside class="main-sidebar  elevation-3">
    <!-- Brand Logo --> 
     
    <!-- <img src="<?=base_url()?>small-pandangan.png" class="brand-link brand-image card"> -->
    <div href="#" class="brand-link ">
      <img src="<?=base_url()?>/lte/pandangan-logo.3.png" alt="AdminLTE Logo" class="brand-image">
      <strong><span class="brand-text font-weight-light" style="font-family:Lemon;color:rgb(3, 3, 100)">ANDANGAN</span></strong>
    </div>
    <!-- Sidebar -->
    <div class="sidebar dropdown-divider">
      <!-- Sidebar user panel (optional) -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-1">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item mb-1 mt-1">
            <a href="<?=base_url()?>ADMS/homePageV" class="nav-link inactive ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                <strong>
                Home
              </strong>
              </p>
            </a>
            
          </li>
               <?php
                    if($user->userType == 'Admin'){
                      echo ' <li class="nav-item mb-1 mt-1">
                      <a href="'.base_url().'ADMS/adminManageAccountPageV" class="nav-link inactive ">
                        <i class="nav-icon fas fa-fw fa-users"></i>
                        <p>
                          <strong>
                          Manage Accounts
                        </strong>
                        </p>
                      </a>
                      
                    </li>';
                } ?>

         <?php
          if($user->userType != 'Accreditor'){

           echo   '<li class="nav-item mb-1 mt-1">
                  <a href="'.base_url().'ADMS/myAssignedAreaV" class="nav-link inactive " >
                  <i class="nav-icon fas fa-fw fa-tags"></i>
                  <p>
                    <strong>
                    My Assigned Area
                  </strong>
                  </p>
                </a>
                
              </li>
              <li class="nav-item mb-1 mt-1">
                <a href="'.base_url().'ADMS/foldersV" class="nav-link inactive ">
                  <i class="nav-icon fas fa-fw fa-folder"></i>
                  <p>
                    <strong>
                    Folders
                  </strong>
                  </p>
                </a>
                
              </li>';
          
                    if($user->userType == 'Admin'){
                      echo '<li class="nav-item mb-1 mt-1">
                      <a href="'.base_url().'ADMS/assignTaskV" class="nav-link inactive ">
                        <i class="nav-icon fas fa-fw fa-tasks"></i>
                        <p>
                          <strong>
                          Assign Task
                        </strong>
                        </p>
                      </a>
                      
                    </li>';
                    }
             
          
          echo '<li class="nav-item mb-1 mt-1">
            <a href="'.base_url().'ADMS/accountSettingPageV" class="nav-link inactive ">
              <i class="nav-icon fas fa-fw fa-cog"></i>
              <p>
                <strong>
                Acount Setting
              </strong>
              </p>
            </a>
            
          </li>';
          
                    if($user->userType == 'Area Faculty'){
                      echo '<li class="nav-item mb-1 mt-1">
                      <a href="'.base_url().'ADMS/assignTaskV" class="nav-link inactive ">
                        <i class="nav-icon fas fa-fw fa-tasks"></i>
                        <p>
                          <strong>
                          View Tasks
                        </strong>
                        </p>
                      </a>
                      
                    </li> ';
           } 
          }
         
          if($user->userType != 'Admin'){
         
           echo  '<li class="nav-item mb-1 mt-1 dropdown menu-close">
                      <a href="'.base_url().'ADMS/manageProgramsV" class="nav-link inactive ">
                    <i class="nav-icon fas fa-fw fa-book"></i>
                    <p>
                      <strong>
                      Programs
                    </strong>
                   <!-- <i class="right fas fa-angle-left"></i> -->

                    </p>
                  </a>
            </li>';
          }  
          
          
                    if($user->userType == 'Admin'){

                      echo '<li class="nav-item mb-1 mt-1 ">
                      <a href="'.base_url().'ADMS/manageProgramsV" class="nav-link inactive ">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>
                          <strong>
                          Manage Programs
          
                        </strong>
          
                        </p>
                      </a>
                      
                    </li>
                    
                    <li class="nav-item mb-1 mt-1 ">
                      <a href="'.base_url().'ADMS/manageLevelsV" class="nav-link inactive ">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                          <strong>
                          Manage Levels
          
                        </strong>
          
                        </p>
                      </a>
                
                    </li>';

                      echo '<li class="nav-item mb-1 mt-1 ">
                      <a href="'.base_url().'ADMS/archivePageV" class="nav-link inactive ">
                        <i class="nav-icon fa fa-archive"></i>
                        <p>
                          <strong>
                          Archive
          
                        </strong>
          
                        </p>
                      </a>
          
                      
                      
                    </li>';
                    }
                    if($user->userType != ''){
                      echo '<li class="nav-item mb-1 mt-1 ">
                      <a href="'.base_url().'ADMS/generalAssessmentV" class="nav-link inactive ">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                          <strong>
                          General Assessment
          
                        </strong>
          
                        </p>
                      </a>
          
                      
                      
                    </li>
                    ';
                    } 
          
         if($user->userType == 'Admin'){

          echo '<li class="nav-item mb-1 mt-1">
            <a href="'.base_url().'ADMS/manageSliderV" class="nav-link inactive ">
              <i class="nav-icon fas fa-image"></i>
              <p>
                <strong>
                Manage Slider Images
              </strong>
              </p>
            </a>
            
          </li>';
         }
         ?>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
