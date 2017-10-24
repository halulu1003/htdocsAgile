<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Welcome</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
      <a class="navbar-brand" href="#myPage">FreshTreasure Online Study Hub</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.html">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>FreshTreasure Online Study Hub</h1> 
  <p>Welcome to FreshTreasure Study Hub</p> 
</div>

<!-- Container (Login Section) -->
<div id="Login" class="container-fluid">
  <div class="row">
    <div class="col-sm-8"><br>
<?php
session_start();
if(isset($_SESSION['username']))
{
    echo " ".$_SESSION['userID']." ";
    if($_SESSION['userflag'] == 0)
        echo "<h4>Welcome administrator    ".$_SESSION['username']."   login</h4>";
    if($_SESSION['userflag'] == 1)
        echo "<h4>Welcome lecture    ".$_SESSION['username']."   login</h4>";
    if($_SESSION['userflag'] == 2)
        echo "<h4>Welcome student    ".$_SESSION['username']."   login</h4>";
	}
else
{
    echo "<h4>ERROR! You are not authorized to log in this application!</h4>";
}
echo "<h3> <a href='destroy_session_login.php'>Log out now</a> </h3>";

if($_SESSION['userflag'] > 0)
{
    echo "</br></br></br>";
    echo "<h2> <a href=\"courseList.php\">My courses</a></h2>";
}
else
{
	echo "</br></br></br>";
    echo "<h2> <a href=\"assignCourses.php\">Assign courses</a></h2>";
	echo "</br></br></br>";
    echo "<h2> <a href=\"showMySql.php\">manage db</a>";
}

?>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-book logo"></span>
    </div>
  </div>
</div>  

 <footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-book logo"></span>
  </a>
  <p>Made on 2017/10/16</p>
</footer>

</body>
</html>