<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>courses</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
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
		   <li><a href="courseList.php">Courses</a></li>
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


session_start();

/*
@mysql_connect("localhost","root",'')
or die("data base connected failed");
@mysql_select_db("yx")
or die("data base selected failed");
*/


//$userId = $_SESSION['userID'];
$studentID = $_SESSION['userID'];

$sql = "select person_id, course_id from person_courses where person_id = $studentID ";

//$query = @mysql_query("select person_id, course_id from person_courses where person_id = $studentID ")or die("SQL failed");
$query = $mysqli->query($sql) or die("SQL execuation fails.");

//echo "<h2>db success</br></br>";
//echo "<h4>".$_SESSION['username'];


//echo $sql."</br></br>";
$courseID = 0;


$userFlag = $_SESSION['userflag'];
//if($row = mysql_fetch_array($query))
//echo $row[1];
//echo "<h2>db success 1023</br></br>";
?>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-book logo"></span>
    </div>
  </div>
</div>
<?php
while($row = mysqli_fetch_array($query))
{
	echo "<div class=\"col-sm-4 col-xs-12\"> ";
	echo "<div class=\"panel panel-default text-center\">";
    echo "<div class=\"panel-heading\">";
    echo "<h2>Courses</h2>";
    echo "</div>";
	//echo $row['person_id'];
	echo "</br>";
	//echo $row['course_id'];
    $courseID = $row['course_id'];

	
	$sql = "select course_name from courses where course_id = $courseID ";
	$subQuery = $mysqli->query($sql) or die("SQL execuation fails.");
	//$subQuery = @mysql_query("select course_name from courses where course_id = $courseID ")or die("SQL failed");
	
	$res = mysqli_fetch_array($subQuery);
	
	echo "</br>";
	//echo $res['course_name'];
	
	$courseName = $res['course_name'];
	
	//echo $courseName;
	//echo "</br>";
	//$linkStr = "<a href='bookView.php?id=".$bookID."&name=".$bookName." '>".$res['book_name'];
	    echo "<div class=\"panel-body\">";
	$courseLink = "<h2><a href='courseView.php?id=".$courseID."&name=".$courseName." '>".$courseName."</a>";
	echo $courseLink;
	echo "</div>";
	//$example = "<a href='bookView.php?id=19 '>click me to jump</a>";
	//echo $example;
	
	showCourseBooks($studentID,$courseID,$mysqli);
	echo "</div>";
	echo "</div>";
	
	if($userFlag == 1)
	{
	    $studentLink = "<h2><a href='studentList.php?id=".$courseID."&name=".$courseName." '>student management</a>";
	echo $studentLink;
		
	}
	
}	

function showCourseBooks($student_id,$course_id,$sqlHandle)
{
	//echo "</br>$student_id";
	//echo "</br>$course_id";
    // $query = @mysql_query("select book_id from student_courses_books where student_id = 8 and course_id = 7 ")or die(" SQL failed");
	
	$query = $sqlHandle->query("select book_id from student_courses_books where person_id = $student_id and course_id = $course_id")or die(" SQL failed");

	while($row = mysqli_fetch_array($query))
	{
		echo "</br>";
		//echo $row['book_id'];
		
		$bookID = $row['book_id'];
		
		$subQuery = $sqlHandle->query("select book_name from books0923 where book_id = $bookID ")or die("SQL failed");
	
	    $res = mysqli_fetch_array($subQuery);
	    //echo "</br>";
	    //echo $res['book_name'];
		$bookName = $res['book_name'];
		//echo "</br>";
		
		//$linkStr = "<a href='bookView.php'>".$res['book_name']."method=\"post\" \"name\" = \"book\"";
		
		//$linkStr = "<a href='bookView.php' method =\"post\" name = \"book\" value=\"10\">".$res['book_name'];
		
		$linkStr = "<a href='bookView.php?id=".$bookID."&name=".$bookName." '>".$res['book_name'];
		
		//$example = "<a href='bookView.php?id=19 '>click me to jump</a>";
		//echo $example;
		echo "</br>";
		echo $linkStr."</br>";
	}
	
}
//<div class="panel-footer">
   //       <h3>$49</h3>
      //    <h4>per month</h4>
         // <button class="btn btn-lg">Sign Up</button>
     //   </div>
$subQuery->close();
$query->close();
mysqli_close();
?>
         
 
 <footer class="container-fluid text-center col-sm-8">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Made on 2017/10/16</p>
</footer>
 </body>
</html>