
<body class="" cz-shortcut-listen="true">
  <div class="wrapper">          
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="assets/img/sidebar.jpg">
      <div class="logo">
        <a href="" class="simple-text logo-mini">I/O</a>
        <a href="index.php" class="simple-text logo-normal">In Out</a>
      </div>
      <div class="sidebar-wrapper"> 
        <div class="user">
          <div class="photo">
              <img src="assets/img/faces/avatar.jpg" alt="User Avatar">
          </div>
          <div class="user-info">
              <a data-toggle="collapse" href="#collapseExample" class="username">
                  <span><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Guest', ENT_QUOTES, 'UTF-8'); ?></span>
              </a>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item <?php echo ($title ?? '') === 'Dashboard' ? 'active' : ''; ?>">
            <a class="nav-link" href="index.php"><i class="material-icons">dashboard</i><p>Dashboard</p></a>
          </li>
          
          <?php if (!empty($user_access) && in_array('U02', $user_access)): ?>
            <li class="nav-item <?php echo ($title ?? '') === "Today's Entry" ? 'active' : ''; ?>">
              <a class="nav-link" href="today.php"><i class="material-icons">content_paste</i><p>Today</p></a>
            </li>
          <?php endif; ?>
          
          <?php if (!empty($user_access) && in_array('U03', $user_access)): ?>
            <li class="nav-item <?php echo ($title ?? '') === 'Entry Register' ? 'active' : ''; ?>">
              <a class="nav-link" href="register.php"><i class="material-icons">all_inbox</i><p>Register</p></a>
            </li>
          <?php endif; ?>
          
          <?php if (!empty($user_access) && in_array('N01', $user_access)): ?>
            <li class="nav-item <?php echo ($title ?? '') === 'Notice' ? 'active' : ''; ?>">
              <a class="nav-link" href="notice.php"><i class="material-icons">speaker_notes</i><p>Notice</p></a>
            </li>
          <?php endif; ?>
          
          <?php if (!empty($user_access) && in_array('R01', $user_access)): ?>
            <li class="nav-item <?php echo ($title ?? '') === 'Report' ? 'active' : ''; ?>">
              <a class="nav-link" href="reports.php"><i class="material-icons">list</i><p>Reports</p></a>
            </li>
            <li class="nav-item <?php echo ($title ?? '') === 'Backup' ? 'active' : ''; ?>">
              <a class="nav-link" href="backup.php"><i class="material-icons">cloud</i><p>Backup</p></a>
            </li>
          <?php endif; ?>
          
          <?php if (!empty($user_access) && in_array('S01', $user_access)): ?>
            <li class="nav-item <?php echo ($title ?? '') === 'Setup' ? 'active' : ''; ?>">
              <a class="nav-link" href="setup.php"><i class="material-icons">settings_applications</i><p>Setup</p></a>
            </li>
          <?php endif; ?>

          <?php if (!empty($user_access) && in_array('A02', $user_access)): ?>
            <li class="nav-item <?php echo ($title ?? '') === 'User Management' ? 'active' : ''; ?>">
              <a class="nav-link" href="user_mgnt.php"><i class="material-icons">supervised_user_circle</i><p>User Management</p></a>
            </li> 
          <?php endif; ?>
        </ul>    
      </div>
      <div class="sidebar-background" style="background-image: url(assets/img/sidebar.jpg)"></div>
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
            <a class="navbar-brand" href="#"><?php echo htmlspecialchars($title ?? '', ENT_QUOTES, 'UTF-8'); ?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation-example" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form"></form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="functions/signout.php">
                  <i class="material-icons">power_settings_new</i>
                  <p class="d-lg-none d-md-block">Logout</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- NAVBAR ENDS -->
