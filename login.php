<?php
  session_start();
  include './function/dbconn.php';
  include './function/init.php';
  require './template/header.php';
?>
<body>
<section class="head">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-12 col-lg-12 text-center main_title">
        <div class="h1 title"><b><?php echo $cname[0]; ?></b></div>
        <div class="h2 sub_title"><b>Welcome to Library</b><br><h3>In / Out Management System</h3></div>
      </div>
    </div>
  </div>
</section>
<section class="main">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div class="panel shadow panel-primary">
      <div class="panel-heading">
        <div class="title">Login Panel</div>
      </div>
      <div class="panel-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" class="form-control" name="name" placeholder="Username" autofocus="autofocus">
        <br>
        <input type="password" class="form-control" name="pass" placeholder="Password">
        <br>
        <select class="form-control" name="loc" required="">
        <option placeholder="Select Location"></option>
        <?php
        $query = "select * from `loc`";
        $res = mysqli_query($link2, $query) or die("Invalid Query:".mysql_error());
        while($row=mysqli_fetch_array($res)){
        echo "<option>".$row['1']."</option>";
        }
        ?>
        <hr>
        <option>Master</option>
        </select>
        <br>
        <input type="submit" class="btn btn-success" value="Log In">
        <input type="reset" class="btn btn-danger" value="clear">
        </form>
      </div>
    </div>
  </div>
</section>
<?php
require './template/footer.php';
?>
