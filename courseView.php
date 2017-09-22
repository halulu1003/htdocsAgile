<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>courses</title>
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
		   <li><a href="courseList.php">Courses</a></li>
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

session_start();
@mysql_connect("localhost","root",'')

or die("data base connected failed");
@mysql_select_db("yx")

or die("data base selected failed");


$userId = $_SESSION['userID'];

if(isset($_GET["name"]))
{
	$course=$_GET["name"];
	echo $course;
}
if(isset($_GET["id"]))
{
    $courseID = $_GET['id'];
    echo $courseID;
}

//after recommend action
if(isset($_GET["rcid"]))
{
	echo "from recommend action";
    $recommend_course=$_GET["rcid"];
    $courseID = $_GET["rcid"];
}
if(isset($_GET["rbid"]))
{
	echo "rrrrrrrrr";
    $bookID = $_GET['rbid'];
	$sql = "INSERT INTO recommend_courses_books (person_id, course_id, book_id) VALUES (".$userId.", ".$courseID.", ".$bookID.")";

	echo $sql;		
    @mysql_query($sql)or die(" SQL failed");
}

//after delete action
if(isset($_GET["dcid"]))
{
	echo "from delete action";
    $recommend_course=$_GET["dcid"];
    $courseID = $_GET["dcid"];
}
if(isset($_GET["dbid"]))
{
	echo "ddddddd";
    $bookID = $_GET['dbid'];
	echo $bookID;
	//$sql = "INSERT INTO recommend_courses_books (person_id, course_id, book_id) VALUES (".$userId.", ".$courseID.", ".$bookID.")";
    echo "</br>";
	$sql = "DELETE FROM recommend_courses_books WHERE
	person_id = $userId and course_id = $courseID and book_id = $bookID";
	
	echo $sql;		
    @mysql_query($sql)or die(" SQL failed");
}

echo "</br>";
echo "<h2>recommeded book list:";
echo "</br>";
showRecommendedBooks($courseID,$userId);
echo "</br>";

function showRecommendedBooks($course_id,$user_id)
{
	$query = @mysql_query("select books.book_id,books.book_name from recommend_courses_books , books where 
	books.book_id = recommend_courses_books.book_id and
	recommend_courses_books.person_id = $user_id and
	recommend_courses_books.course_id = $course_id")or die("SQL failed");
	while($row = mysql_fetch_array($query))
	{
		echo "<div class=\"col-sm-4 col-xs-12\"> ";
	    echo "<div class=\"panel panel-default text-center\">";
        echo "<div class=\"panel-heading\">";
        echo "<h2>Recommeded Books</h2>";
        echo "</div>";
		 $bookID = $row['book_id'];
		 //$bookID = 3;
		 $bookName = $row['book_name'];
		 echo "</br>";
		 //echo $bookID;
		 //echo "</br>";
		 echo $bookName;
		 //echo "</br>";
		 //always pass the wrong bookID, so change type from button to link
		 //echo "<p align=\"left\"> <form method=\"POST\" action=\"courseView.php?dbid=".$bookID."&dcid=".$course_id."\"><input type=\"submit\" name=\"Submit\" value=\"delete\" />  </p>";
		 //echo "<p align=\"left\"> <form action=\"courseView.php?dbid=$bookID&dcid=$courseID><input type=\"button\" name=\"delete\" value=\"delete\" />  </p>";
		 
		 //echo "</br>";
		 
		 $linkStr = "<a href='courseView.php?dbid=".$bookID."&dcid=".$course_id." '>"."verify</a>";
		 echo "</br>";

		echo $linkStr."</br>";
		 echo "</div>";
		  echo "</div>";
	}	
}
?>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-book logo"></span>
    </div>
  </div>
</div>
</h2>other book list:
<?php
showNotRecommendedBooks($courseID);
function showNotRecommendedBooks($course_id)
{
	$query = @mysql_query("select books.book_id,books.book_name from books where 
	books.book_id not in
	(
	    select book_id from recommend_courses_books where
		recommend_courses_books.course_id = $course_id
	)
	")or die("SQL failed");
	while($row = mysql_fetch_array($query))
	{
		echo "<div class=\"col-sm-4 col-xs-12\"> ";
	    echo "<div class=\"panel panel-default text-center\">";
        echo "<div class=\"panel-heading\">";
        echo "<h2>Books</h2>";
        echo "</div>";
		 $bookID = $row['book_id'];
		 $bookName = $row['book_name'];
		 echo "</br>";
		 //echo $bookID;
		 //echo "</br>";
		 echo $bookName;
		 echo "<form method=\"POST\" action=\"courseView.php?rbid=".$bookID."&rcid=".$course_id."\"></br><input type=\"submit\" name=\"Submit\" value=\"recommend\" /></br>";
		 echo "</div>";
		 echo "</div>";
	}	
}

function forceUpdate()
{
	echo "<script>location:reload();</script>";
}


function show()
{
	echo "this is show";
}
echo "</div>";
echo "</div>";
?>

<script language="JavaScript">
function bt_click(){
  <?php show();?>
}
</script>
 </body>

 
 <footer class="container-fluid text-center col-sm-8">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Made on 2017/9/20</p>
</footer>
</html>