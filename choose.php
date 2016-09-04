<?php
if (!isset($_COOKIE["token"])) {
      echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
}
include("connect.php");
$name=$_COOKIE["user"];
if (isset($_POST['choose'])) {
  $rs=$_POST['choose'];
  $room=substr($rs,1,3);
  $seat=substr($rs,5);
  $sql="UPDATE seat SET `name`='$name', `allow`=0 WHERE `room`=$room AND `seat`=$seat AND `allow`=1";
  mysql_query($sql);
}
if (isset($_POST['unchoose'])) {
  $rs=$_POST['unchoose'];
  $room=substr($rs,1,3);
  $seat=substr($rs,5);
  $sql="UPDATE seat SET `name`='', `allow`=1 WHERE `name`='$name' AND `room`=$room AND `seat`=$seat";
  mysql_query($sql);
}
$sql="SELECT * FROM `seat` WHERE `name`='$name'";
$result=mysql_query($sql);
$userchoose=mysql_result($result,0,0);
if ($userchoose) {
  $user=1;
}else{
  $user=0;
}

$sql1="SELECT * FROM `seat` WHERE `room`=416";
$result=mysql_query($sql1);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>選位系統</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">選位系統</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">首頁</a></li>
              <li  class="active"><a href="#">選位</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              
              <!--<li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>-->
              <?php
              if(isset($_COOKIE["token"])) {
              ?>  
                  <li><a ><?php echo $_COOKIE["user"];?>，您好！</a></li>
                  <li><a href="logout.php">登出</a></li>
              <?php
              }else{
              ?>
                  <li><a href="login.php">登入</a></li>
              
              <?php
              }
              ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <h2>成大數學所研究室座位表 - 416</h2>
      <table class="table table-bordered">
      <form role="form" method="post" action="choose.php">
      <?php
      while($rows=mysql_fetch_array($result)){
        if ($rows['seat'] % 4==1) {
          echo "<tr>";
        }
        echo '<td style="height:100px" class="col-md-3">';
        echo $rows['name'];
        if ($rows['allow']==1 && $user==0) {
          echo '<button type="submit" class="btn btn-default" name="choose" value="r416s'.$rows['seat'].'">選位</button>';
        }
        if ($rows['allow']==0 && $user==1 && $rows['name']==$name) {
          echo '<br><button type="submit" class="btn btn-default" name="unchoose" value="r416s'.$rows['seat'].'">取消選位</button>';
        }
        echo "</td>";

        if ($rows['seat'] % 4==0) {
          echo "</tr>";
        }
      }
      ?>
      </form>
      </table>
      
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
