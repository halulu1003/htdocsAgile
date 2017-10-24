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

//include('connect.php');
//include('loginchg.php');

session_start();

@mysql_connect("localhost","root",'')
or die("data base connected failed");
@mysql_select_db("yx")
or die("data base selected failed");

//$userId = $_SESSION['userID'];
$studentID = $_SESSION['userID'];
$userFlag = $_SESSION['userflag'];

$query = @mysql_query("select person_id, course_id from person_courses where person_id = $studentID ")or die("SQL failed");

echo "<h2>db success</br></br>";
echo "<h4>".$_SESSION['username'];


echo "</br></br>";
$courseID = 0;
//if($row = mysql_fetch_array($query))
//echo $row[1];

//after recommend action
if(isset($_GET["rcid"]))
{
	//echo "from recommend action";
    $recommend_course=$_GET["rcid"];
    $courseID = $_GET["rcid"];
}
if(isset($_GET["rbid"]))
{
	//echo "rrrrrrrrr";
    $studentID = $_GET['rbid'];
	echo $studentID;
	echo "</br>";
	if($userFlag == 1)
	{
	    $sql = "INSERT INTO person_courses (person_id, course_id) VALUES (".$studentID.", ".$courseID.")";
	}
    else
    {
		$sql = "INSERT INTO student_courses_books (person_id, course_id, book_id) VALUES (".$userId.", ".$courseID.", ".$bookID.")";
	}	
	echo $sql;		
    @mysql_query($sql)or die(" SQL failed");
}

if(isset($_GET["dcid"]))
{
	//echo "from delete action";
    $recommend_course=$_GET["dcid"];
    $courseID = $_GET["dcid"];
}
if(isset($_GET["dbid"]))
{
	//echo "ddddddd";
    $studentID = $_GET['dbid'];
	echo $studentID;
	//$sql = "INSERT INTO recommend_courses_books (person_id, course_id, book_id) VALUES (".$userId.", ".$courseID.", ".$bookID.")";
    echo "</br>";
	if($userFlag == 1)
	{
		$sql = "DELETE FROM person_courses WHERE
		person_id = $studentID and course_id = $courseID";
	}
	else
	{
		$sql = "DELETE FROM student_courses_books  WHERE
		person_id = $userId and course_id = $courseID and book_id = $bookID";
	}
	echo $sql;		
    @mysql_query($sql)or die(" SQL failed");
}



?>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-book logo"></span>
    </div>
  </div>
</div>
<?php

echo "</br></br></br>";
echo "<h2> <a href=\"courseList.php\">My courses</a></h2>";


while($row = mysql_fetch_array($query))
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

	$subQuery = @mysql_query("select course_name from courses where course_id = $courseID ")or die("SQL failed");
	
	$res = mysql_fetch_array($subQuery);
	echo "</br>";
	//echo $res['course_name'];
	
	$courseName = $res['course_name'];
	
	//echo $courseName;
	//echo "</br>";
	//$linkStr = "<a href='bookView.php?id=".$bookID."&name=".$bookName." '>".$res['book_name'];
	    echo "<div class=\"panel-body\">";
	//$courseLink = "<h2><a href='courseView.php?id=".$courseID."&name=".$courseName." '>".$courseName."</a>";
	//echo $courseLink;
	echo "</div>";
	//$example = "<a href='bookView.php?id=19 '>click me to jump</a>";
	//echo $example;
	
	//showCourseBooks($studentID,$courseID);

	echo "</div>";
	echo "</div>";
	
	/*
	if($userFlag == 1)
	{
	    $studentLink = "<h2><a href='courseView.php?id=".$courseID."&name=".$courseName." '>student management</a>";
	echo $studentLink;
		
	}
	*/
}	

showStudentEnrolled($courseID);

showStudentNotEnrolled($courseID);

function showStudentEnrolled($course_id)
{
	$sql = "select users.ID, users.username from person_courses,  users where
	users.ID = person_courses.person_id
	and
	person_courses.course_id = $course_id";
    echo "</br>";
	echo $sql;
	
	$query = @mysql_query($sql)or die("SQL failed");
	
	while($row = mysql_fetch_array($query))
	{
		echo "<div class=\"col-sm-4 col-xs-12\"> ";
	    echo "<div class=\"panel panel-default text-center\">";
        echo "<div class=\"panel-heading\">";
        echo "<h2>enrolled</h2>";
        echo "</div>";
		 //$bookID = $row['book_id'];
		 //$bookName = $row['book_name'];
		 $studentID = $row['ID'];
		 $studentName = $row['username'];
		 echo "</br>";
		 echo $studentID;
		 echo "</br>";
		 echo $studentName;
		 echo "<form method=\"POST\" action=\"studentList.php?dbid=".$studentID."&dcid=".$course_id."\"></br><input type=\"submit\" name=\"Submit\" value=\"remove\" /></form></br>";
		 echo "</div>";
		 echo "</div>";
	}	


}

function showStudentNotEnrolled($course_id)
{
	
    echo "</br>";
	echo "showStudentNotEnrolled";
	echo "</br>";
	
	$sql = "select users.ID, users.username from person_courses,  users where
	users.ID = person_courses.person_id
	and
	person_courses.course_id = $course_id";
	
	
	$sql = "select users.ID, users.username from users where
	users.ID not in
	(
	    select person_courses.person_id from person_courses
		where person_courses.course_id = $course_id
	)
	";
	
    echo "</br>";
	echo $sql;
	
	$query = @mysql_query($sql)or die("SQL failed");
	
	while($row = mysql_fetch_array($query))
	{
		echo "<div class=\"col-sm-4 col-xs-12\"> ";
	    echo "<div class=\"panel panel-default text-center\">";
        echo "<div class=\"panel-heading\">";
        echo "<h2>Other Students</h2>";
        echo "</div>";
		 //$bookID = $row['book_id'];
		 //$bookName = $row['book_name'];
		 $studentID = $row['ID'];
		 $studentName = $row['username'];
		 echo "</br>";
		 echo $studentID;
		 echo "</br>";
		 echo $studentName;
		 echo "<form method=\"POST\" action=\"studentList.php?rbid=".$studentID."&rcid=".$course_id."\"></br><input type=\"submit\" name=\"Submit\" value=\"enroll\" /></form></br>";
		 echo "</div>";
		 echo "</div>";
	}	


}


function showCourseBooks($student_id,$course_id)
{
	//echo "</br>$student_id";
	//echo "</br>$course_id";
    // $query = @mysql_query("select book_id from student_courses_books where student_id = 8 and course_id = 7 ")or die(" SQL failed");
	
	$query = @mysql_query("select book_id from student_courses_books where person_id = $student_id and course_id = $course_id")or die(" SQL failed");

	while($row = mysql_fetch_array($query))
	{
		echo "</br>";
		//echo $row['book_id'];
		
		$bookID = $row['book_id'];
		
		$subQuery = @mysql_query("select book_name from books where book_id = $bookID ")or die("SQL failed");
	
	    $res = mysql_fetch_array($subQuery);
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
?>
         
 </body>

 
 <footer class="container-fluid text-center col-sm-8">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Made on 2017/9/20</p>
</footer>
</html>