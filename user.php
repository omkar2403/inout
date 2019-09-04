<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>
            User Managenent Panel
        </title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/main.css" rel="stylesheet"/>
        <link rel="stylesheet" href="assets/css/datepicker.css">
        <link rel="stylesheet" href="assets/css/picker.css">
        <link href="register/css/fresh-bootstrap-table.css" rel="stylesheet" />
    </head>
    <body>
        <?php    
            if($_SESSION['id']=="admin") {
        ?>
        <div class="wrapper">
            <div class="main-panel">
                <section class="head">
                    <div class="container-fluid">
                        <div class="row">
                            <a href="today.php" class="but btn btn-fill btn-success">Today</a>
                            <a href="register.php" class="but btn btn-fill btn-warning">Register</a>
                            <a href="logout.php" class="but btn btn-fill btn-danger">Logout</a>
                        </div>
                    </div>
                </section>
                <section class="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-primary shadow">                           
                                    <div class="panel-body">
                                        <div class="content">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-primary shadow">                           
                                    <div class="panel-body">
                                        <div class="content">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="foot">
                    <!-- blank -->
                </footer>
            </div>
        </div>  
        <?php 
            }
        ?>
    </body>
</html> 