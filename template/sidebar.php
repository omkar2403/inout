<body class="" cz-shortcut-listen="true"> 
  <!-- class sidebar-mini -->
  <div class="wrapper">          
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="assets/img/sidebar.jpg">
      <div class="logo">
        <a href="" class="simple-text logo-mini">I/O</a>
        <a href="index.php" class="simple-text logo-normal">In Out</a>
      </div>
      <div class="sidebar-wrapper"> 
        <div class="user">
          <div class="photo">
              <img src="assets/img/faces/avatar.jpg">
          </div>
          <div class="user-info">
              <a data-toggle="collapse" href="#collapseExample" class="username">
                  <span><?php echo $_SESSION['user_name']; ?></span>
              </a>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item <?php if($title == 'Dashboard') echo 'active'; ?>">
            <a class="nav-link" href="index.php"><i class="material-icons">dashboard</i><p>Dashboard</p></a>
          </li>
          <?php
            if(in_array('U02', $user_access)){
          ?>
            <li class="nav-item <?php if($title == 'Today\'s Entry') echo 'active'; ?>">
              <a class="nav-link" href="today.php"><i class="material-icons">content_paste</i><p>Today</p></a>
            </li>
          <?php
            }
            if(in_array('U03', $user_access)){
          ?>
            <li class="nav-item <?php if($title == 'Entry Register') echo 'active'; ?>">
              <a class="nav-link" href="register.php"><i class="material-icons">all_inbox</i><p>Register</p></a>
            </li>
          <?php
            }
            if(in_array('N01', $user_access)){
          ?>
            <li class="nav-item <?php if($title == 'Notice') echo 'active'; ?>">
              <a class="nav-link" href="notice.php"><i class="material-icons">speaker_notes</i><p>Notice</p></a>
            </li>
          <?php
            }
            if(in_array('R01', $user_access)){
          ?>
            <li class="nav-item <?php if($title == 'Report') echo 'active'; ?>">
              <a class="nav-link" href="reports.php"><i class="material-icons">list</i><p>Reports</p></a>
            </li>
            <li class="nav-item <?php if($title == 'Backup') echo 'active'; ?>">
              <a class="nav-link" href="backup.php"><i class="material-icons">cloud</i><p>Backup</p></a>
            </li>
          <?php
            }
            if(in_array('S01', $user_access)){
          ?>
            <li class="nav-item <?php if($title == 'Setup') echo 'active'; ?>">
              <a class="nav-link" href="setup.php"><i class="material-icons">settings_applications</i><p>Setup</p></a>
            </li>
          <?php
          }
            if(in_array('A02', $user_access)){
          ?>
            <li class="nav-item <?php if($title == 'User Management') echo 'active'; ?>">
              <a class="nav-link" href="user_mgnt.php"><i class="material-icons">supervised_user_circle</i><p>User Management</p></a>
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