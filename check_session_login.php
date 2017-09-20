<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>welcom</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="style.css">
 <script type="text/javascript" src="script.js"></script>
</head> 
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">Comston Online Study Hub</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.html">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>Comston Online Study Hub</h1> 
  <p>Welcome to our Study Hub</p> 
</div>

<!-- Container (Login Section) -->
<div id="Login" class="container-fluid">
  <div class="row">
    <div class="col-sm-8"><br>
<?php
@mysql_connect("localhost","root",'')
or die("data base connected failed");
@mysql_select_db("yx")
or die("data base selected failed");
//获取输入的信息
$username = $_POST['username'];
$passcode = $_POST['passcode'];
//获取session的值
$query = @mysql_query("select username,userflag,ID from users where username = '$username' and passcode = '$passcode'")
or die("SQL语句执行失败");
//判断用户以及密码
if($row = mysql_fetch_array($query))
{
	echo $row['ID'];
    session_start();
    //判断权限
    if($row['userflag'] == 1 or $row['userflag'] == 0 or $row['userflag'] == 2){
        $_SESSION['username'] = $row['username'];
        $_SESSION['userflag'] = $row['userflag'];
		$_SESSION['userID'] = $row['ID'];
		
		if($row['userflag'] == 0)
		    echo "<h4> Welcome you, administrator~~ ";
	    else if($row['userflag'] == 1)
		    echo "<h4> Welcome you, lecturer~~ ";
	    else if($row['userflag'] == 2)
		    echo "<h4> Welcome you, student~~ ";
	  
          echo "</br><p><a href='welcome_session_login.php'>www.cnblogs.com/txw1958</a><p>";
    }else{
        echo "<h4>userflag不正确";
    }

}else{
    echo "username or usercode is not correct";
}
?>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-book logo"></span>
    </div>
  </div>
</div>  
 </body>
 <footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Made on 2017/9/20</p>
</footer>
</html>