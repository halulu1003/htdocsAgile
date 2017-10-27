<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Notes</title>
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
		   <li><a href="coursesList.php">CoursesList</a></li>
		   <li><a href="courseView.php">Courses</a></li>
		   <li><a href="bookView.php">Notes</a></li>
		   <li><a href="assignCourses.php">CoursesAssign</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>Comston Online Study Hub</h1> 
  <p>Welcome to our Study Hub</p> 
</div>

<?php
//include("courseList.php");

session_start();
@mysql_connect("localhost","root",'')
or die("data base connected failed");
@mysql_select_db("yx")
or die("data base selected failed");

$studentId = $_SESSION['userID'];
//echo $studentId;
	echo "</br>";

if(isset($_POST["acid"]))
{
    $courseID=$_POST["acid"];
    echo $courseID;
	echo "</br>";

	if(isset($_POST["lecturer"]))
    {
        $lectureID = $_POST['lecturer'];
        echo $lectureID;
		echo "</br>";
		
		$sql = "INSERT INTO person_courses (person_id, course_id) VALUES (".$lectureID.",".$courseID.")";
		
		echo "</br>";
        echo $sql;
		
		@mysql_query($sql)or die(" SQL failed");
		
		echo "</br>";
	}
}

if(isset($_GET["dcid"]))
{
	$courseID=$_GET["dcid"];
    echo $courseID;
	echo "</br>";

	if(isset($_GET["dlid"]))
	{
		$lectureID = $_GET['dlid'];
        echo $lectureID;
		echo "</br>";
		
		$sql = "DELETE FROM person_courses WHERE
    	person_id = $lectureID and course_id = $courseID";
 
	    echo $sql;		
        @mysql_query($sql)or die(" SQL failed");
	}
}
showAllcourses();

function showAllcourses()
{
    $sql = "select course_id, course_name from courses";
	$query = @mysql_query($sql)or die("SQL failed");
    while($row = mysql_fetch_array($query))
    {
		echo "<div class=\"col-sm-4 col-xs-12\"> ";
	echo "<div class=\"panel panel-default text-center\">";
    echo "<div class=\"panel-heading\">";
    echo "<h2>Courses</h2>";
    echo "</div>";
		echo "</br>";
		echo $row['course_name'];
		$courseID = $row['course_id'];
		echo "</br>is assigned to";
		showAssignedLecturers($courseID);
		echo "</br></br>other lecturers";
		showNotAssignedLecturers($courseID);
	    echo "</br>---------------------------------------------------------";
			echo "</div>";
	echo "</div>";
	}
}

function showAssignedLecturers($course_id)
{
	$sql = "select username,ID from users where userflag = 1 and ID in
	(
	    select person_id from person_courses where
        person_courses.course_id = $course_id
	)";
	$query = @mysql_query($sql)or die("SQL failed");
    while($row = mysql_fetch_array($query))
    {
		$lectureID = $row['ID'];
		echo "</br>";
		echo $row['username'];
		echo "</br>";
		
		$linkStr = "<a href='assignCourses.php?dcid=".$course_id."&dlid=".$lectureID." '>"."delete</a>";

		echo "</br>";
        echo $linkStr."</br>";
	}
}

function showNotAssignedLecturers($course_id)
{
	//<form ACTION="SelectFormControlHandler.php" METHOD="POST">
    //echo "<form method=\"POST\" action=\"bookView.php?id=".$bookID."&name=".$book."\">
	
	echo "<form method=\"POST\" action = \"assignCourses.php\">";
	//echo "form method=\"POST\" action = \"assignCourses.php?acid =".$course_id;
	
	$sql = "select username,ID from users where userflag = 1 and ID not in
	(
	    select person_id from person_courses where
        person_courses.course_id = $course_id
	)";
	$query = @mysql_query($sql)or die("SQL failed");
    while($row = mysql_fetch_array($query))
    {
		
		$lectureID = $row['ID'];
		echo "</br>";
		//<INPUT TYPE="radio" NAME="Candy" VALUE="Snickers">Snickers<BR>

		echo "<input type = \"radio\" name =\"lecturer\" value = ".$lectureID.">";
		echo $row['username'];
		echo "</br>";
	}
	echo "</br><input type=\"hidden\" name=\"acid\" value = ".$course_id."></br>";
	echo "</br><input type=\"submit\"/></br>";
	echo "</form>";
}

?>
 </body>

 
 <footer class="container-fluid text-center col-sm-8">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Made on 2017/9/20</p>
</footer>
</html>