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
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>Comston Online Study Hub</h1> 
  <p>Welcome to our Study Hub</p> 
</div>

<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">    
  
<?php
//include("courseList.php");

session_start();
@mysql_connect("localhost","root",'')
or die("data base connected failed");
@mysql_select_db("yx")
or die("data base selected failed");

$studentId = $_SESSION['userID'];

if(isset($_GET["name"]))
{
	//echo "from get";
$book=$_GET["name"];
}
if(isset($_GET["id"]))
$bookID = $_GET['id'];

if(isset($_POST["name"]))
{
	echo "from post";
$book=$_POST["name"];
}
if(isset($_POST["id"]))
$bookID = $_POST['id'];
echo "<h2>".$book."</h2>";
// $sqltest = "INSERT INTO student_books_notes (note_id, person_id, book_id, value) VALUES (NULL, 8, 71, \"haha1002\")";

// echo "</br>sql test";
// echo $sqltest;
// echo "</br>";
// @mysql_query($sqltest)or die(" SQL failed");


if(isset($_POST["MSG"]))
{
    $MSG = $_POST['MSG'];
	echo "</br>";
	echo "</br>";
    //echo $MSG;
	echo "</br>";
	if($MSG != "")
	{
		//$sql = "INSERT INTO student_books_notes (note_id, person_id, book_id, value) VALUES (NULL, $studentId, $bookID, $MSG)";
		
		$sql = "INSERT INTO student_books_notes (note_id, person_id, book_id, value) VALUES (NULL, 8, 71, \"".$MSG."\")";
		
        //echo $sql;		
		@mysql_query($sql)or die(" SQL failed");
		// $success = mysql_affected_rows();
		// if($success === -1)
		// echo"fail".mysql_error();
		// else
		// echo"success";
	}
}


//after delete action
if(isset($_GET["dnid"]))
{
	//echo "ddddddd";
    $noteID = $_GET['dnid'];
	//echo $noteID;
	echo "</br>";
	$sql = "DELETE FROM student_books_notes WHERE
	note_id = $noteID";
	
	//echo $sql;		
    @mysql_query($sql)or die(" SQL failed");
}

/*
echo $book;
echo "</br>";
echo $bookID;
echo "</br>";
*/


showBookNotes($studentId,$bookID,$book);

function showBookNotes($student_id,$book_id,$book_name)
{
	/*
	echo "</br>enter showBookNotes";
	echo "</br>";
	echo $student_id;
	echo "</br>";
	echo $book_id;
	echo "</br>";
	*/

	$query = @mysql_query("select * from student_books_notes")or die(" SQL failed");
	
	while($row = mysql_fetch_array($query))
	{
		 echo "<div class=\"row text-center slideanim\">";
         echo "<div class=\"col-sm-4\">";
         echo "<div class=\"thumbnail\">";
	
		echo "</br>";
		echo "<p><strong>".$row['note_id'];
		echo "</br>";
		echo "<p>".$row['value'];
		echo "</br>";
		$noteId = $row['note_id'];
		/*
		$sql = "DELETE FROM recommend_courses_books WHERE
	person_id = $userId and course_id = $courseID and book_id = $bookID";
	
		@mysql_query($sql)or die(" SQL failed");
	 $linkStr = "<a href='courseView.php?dbid=".$bookID."&dcid=".$course_id." '>"."delete</a>";
	*/
	$linkStr = "<a href='bookView.php?dnid=".$noteId."&id=".$book_id."&name=".$book_name." '>"."delete</a>";
	
		//$linkStr = "<a href='bookView.php?dsid = "'>verify</a>";
		echo "</br>";
        echo $linkStr."</br>";
		echo"</div>";
		echo"</div>";
	}
	
}
?>
</div>
<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
<?php
echo "<form method=\"POST\" action=\"bookView.php?id=".$bookID."&name=".$book."\">
<div>
<textarea name=\"MSG\" cols=40 rows=4>
welcome adding notes
</textarea>
<br>
<input type=\"submit\" value=\"add note\" />
</div>
</form>";


?>
    </div>
  </div>
</div>
 </body>

 
 <footer class="container-fluid text-center col-sm-8">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Made on 2017/9/20</p>
</footer>
</html>