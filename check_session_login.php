<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Welcome_0722</title>
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

require_once('connectDB.php');

$mysqli = initPermanentConnection();


//Get the user login info
$username = $_POST['username'];
$passcode = $_POST['passcode'];
//Query users table for user account info
//$query = @mysql_query("select username,userflag,ID from users where username = '$username' and passcode = '$passcode'")
//or die("SQL statement fail");
$sql = "SELECT username,userflag,ID from users where username = '$username' and passcode = '$passcode'";
$result = $mysqli->query($sql) or die("SQL execuation fails.");

//Verify the user login info
//if($row = mysql_fetch_array($query))
if($row = mysqli_fetch_array($result))
{
	//echo $row['ID'];
    session_start();
    
    if($row['userflag'] == 1 or $row['userflag'] == 0 or $row['userflag'] == 2){
        $_SESSION['username'] = $row['username'];
        $_SESSION['userflag'] = $row['userflag'];
		$_SESSION['userID'] = $row['ID'];
		
		if($row['userflag'] == 0)
		    echo "<h4> Administrator login success!</h4>";
	    else if($row['userflag'] == 1)
		    echo "<h4> Lecturer login success! </h4>";
	    else if($row['userflag'] == 2)
		    echo "<h4> Student  login success! </h4> ";
	  
        echo "</br><p><a href='welcome_session_login.php'>Enter Hub</a><p>";
          //echo "</br><p><a href='welcomeTest.php'>enter hub</a><p>";
    }else{
        echo "<h4>userflag is incorrect! </h4>";
    }

}else{
    echo "Your Username or Password is not correct!";
}
$result->close();
mysqli_close();
?>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-book logo"></span>
    </div>
  </div>
</div> 
 <footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Made on 2017/10/16</p>
</footer> 

</body>
</html>