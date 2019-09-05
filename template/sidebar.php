<body class="sidebar-mini" cz-shortcut-listen="true">
  <div class="wrapper">          
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="assets/img/sidebar.jpg">
      <div class="logo">
        <a href="" class="simple-text logo-mini">HM</a>
        <a href="index.php" class="simple-text logo-normal">Hospital</a>
      </div>
      <div class="sidebar-wrapper"> 
        <div class="user">
          <div class="photo">
              <img src="assets/img/faces/avatar.jpg">
          </div>
          <div class="user-info">
              <a data-toggle="collapse" href="#collapseExample" class="username">
                  <span>Administrator<b class="caret"></b></span>
              </a>
              <div class="collapse" id="collapseExample">
                  <ul class="nav">
                      <li class="nav-item">
                          <a class="nav-link" href="#">
                            <span class="sidebar-mini"> P </span>
                            <span class="sidebar-normal"> Profile </span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">
                            <span class="sidebar-mini"> T </span>
                            <span class="sidebar-normal"> Task 1</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">
                            <span class="sidebar-mini"> T </span>
                            <span class="sidebar-normal"> Task 2 </span>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item <?php if($title == 'Dashboard') echo 'active'; ?>">
            <a class="nav-link" href="index.php"><i class="material-icons">dashboard</i><p>Dashboard</p></a>
          </li>
          <?php
          $nav_admin = array("R01");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#patient" aria-expanded="false">
                <i class="material-icons">content_paste</i>
                <p> Receptionist <b class="caret"></b></p>
            </a>
            <div class="collapse" id="patient">
                <ul class="nav">
                  <?php
                      if(in_array('R01', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Receptionist') echo 'active'; ?>">
                        <a class="nav-link" href="desk.php">
                            <span class="sidebar-mini"> AD </span>
                            <span class="sidebar-normal"> Admission </span>
                        </a>
                    </li>
                  <?php } ?>
                </ul>
            </div>
          </li>
          <?php
          }
          $nav_admin = array("D01","D02");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#hr" aria-expanded="false">
                <i class="material-icons">face</i>
                <p> Doctor <b class="caret"></b></p>
            </a>
            <div class="collapse" id="hr">
                <ul class="nav">
                  <?php
                      if(in_array('D01', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Doctor Dashboard') echo 'active'; ?>">
                        <a class="nav-link" href="admin.php">
                            <span class="sidebar-mini"> TD </span>
                            <span class="sidebar-normal"> Doctor Dashboard </span>
                        </a>
                    </li>
                  <?php 
                    }
                    if(in_array('D05', $user_access)){
                   ?>
                   <li class="nav-item <?php if($title == 'Search Patient') echo 'active'; ?>">
                        <a class="nav-link" href="psearch.php">
                            <span class="sidebar-mini"> SP </span>
                            <span class="sidebar-normal"> Search Patient </span>
                        </a>
                    </li>
                    <?php 
                    }
                    if(in_array('D03', $user_access)){
                   ?>
                    <li class="nav-item <?php if($title == 'OPD Register') echo 'active'; ?>">
                        <a class="nav-link" href="opdreg.php">
                            <span class="sidebar-mini"> OR </span>
                            <span class="sidebar-normal"> OPD Register</span>
                        </a>
                    </li>
                    <?php 
                    }
                    if(in_array('D04', $user_access)){
                   ?>
                    <li class="nav-item <?php if($title == 'IPD Register') echo 'active'; ?>">
                        <a class="nav-link" href="ipdreg.php">
                            <span class="sidebar-mini"> IR </span>
                            <span class="sidebar-normal"> IPD Register</span>
                        </a>
                    </li>
                    <?php 
                    }
                    if(in_array('D02', $user_access)){
                   ?>
                      <li class="nav-item <?php if($title == 'Medicine') echo 'active'; ?>">
                        <a class="nav-link" href="medi.php">
                            <span class="sidebar-mini"> JT </span>
                            <span class="sidebar-normal">Medicine</span>
                        </a>
                    </li>
                    <?php 
                    }
                    if(in_array('D02', $user_access)){
                   ?>
                    <li class="nav-item <?php if($title == 'Employee Management') echo 'active'; ?>">
                        <a class="nav-link" href="employee_mgnt.php">
                            <span class="sidebar-mini"> EM </span>
                            <span class="sidebar-normal"> Employee Management </span>
                        </a>
                    </li>
                  <?php } ?>
                </ul>
            </div>
          </li>
          <?php
          }
          $nav_admin = array("B01","B02");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#dept" aria-expanded="false">
                <i class="material-icons">all_inbox</i>
                <p> Department <b class="caret"></b></p>
            </a>
            <div class="collapse" id="dept">
                <ul class="nav">
                  <?php 
                    if(in_array('B01', $user_access)){
                   ?>
                    <li class="nav-item <?php if($title == 'Department Management') echo 'active'; ?>">
                        <a class="nav-link" href="dept_mgnt.php">
                            <span class="sidebar-mini"> DS </span>
                            <span class="sidebar-normal"> Deaprtment Section</span>
                        </a>
                    </li>
                  <?php } ?>
                </ul>
            </div>
          </li>
          <?php
          }
          $nav_admin = array("A01","A02");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#admin" aria-expanded="false">
                <i class="material-icons">build</i>
                <p> Administration <b class="caret"></b></p>
            </a>
            <div class="collapse" id="admin">
                <ul class="nav">
                    <?php
                      if(in_array('A01', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Administration') echo 'active'; ?>">
                        <a class="nav-link" href="admin_panel.php">
                            <span class="sidebar-mini"> DS </span>
                            <span class="sidebar-normal"> Dashboard</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                    <?php
                      if(in_array('A02', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'User Management') echo 'active'; ?>">
                        <a class="nav-link" href="user_mgnt.php">
                            <span class="sidebar-mini"> UM </span>
                            <span class="sidebar-normal"> User Management</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                </ul>
            </div>
          </li> 
          <?php
          }
          $nav_admin = array("G01","G02");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#inve" aria-expanded="false">
                <i class="material-icons">store</i>
                <p> Inventory <b class="caret"></b></p>
            </a>
            <div class="collapse" id="inve">
                <ul class="nav">
                    <?php
                      if(in_array('G01', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Inventory Dashboard') echo 'active'; ?>">
                        <a class="nav-link" href="inve_panel.php">
                            <span class="sidebar-mini"> DS </span>
                            <span class="sidebar-normal"> Dashboard</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                    <?php
                      if(in_array('G02', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Store Management') echo 'active'; ?>">
                        <a class="nav-link" href="store_mgnt.php">
                            <span class="sidebar-mini"> SS </span>
                            <span class="sidebar-normal">Store Management</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                    <?php
                      if(in_array('G03', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Store') echo 'active'; ?>">
                        <a class="nav-link" href="store.php">
                            <span class="sidebar-mini"> S </span>
                            <span class="sidebar-normal">Store</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                </ul>
            </div>
          </li> 
          <?php
           }
          $nav_admin = array("F01","F02");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>  
          <li class="nav-item <?php if($title == 'Insurance') echo 'active'; ?>">
            <a class="nav-link" href="insurance.php"><i class="material-icons">view_carousel</i><p>Insurance</p></a>
          </li>  
          <?php
          }
        ?>
        </ul>    
      </div>
      <div class="sidebar-background" style="background-image: url(assets/img/sidebar.jpg) "></div>
    </div>
      <div class="main-panel">
              <!-- NAVBAR STARTS -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top" id="navigation-example">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                  <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                  <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
              </div>
              <a class="navbar-brand" href="#"><?php echo $title; ?></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
              <form class="navbar-form">
              </form>
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">notifications</i>
                    <span class="notification">5</span>
                    <p class="d-lg-none d-md-block">
                    Notifications
                    </p>
                    <div class="ripple-container"></div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Notifications 1</a>
                    <a class="dropdown-item" href="#">Notifications 2</a>
                    <a class="dropdown-item" href="#">Notifications 3</a>
                    <a class="dropdown-item" href="#">Notifications 4</a>
                    <a class="dropdown-item" href="#">Notifications 5</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="functions/signout.php">
                    <i class="material-icons">power_settings_new</i>
                    <p class="d-lg-none d-md-block">
                    Logout
                    </p>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- NAVBAR ENDS -->