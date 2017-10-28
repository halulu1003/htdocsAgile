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

/*
@mysql_connect("localhost","root",'')
or die("data base connected failed");
@mysql_select_db("yx")
or die("data base selected failed");
*/
require_once('connectDB.php');
$mysqli = initPermanentConnection();

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

if(isset($_POST["BOOK"]))
{
    $BOOK = $_POST['BOOK'];
	
	if(isset($_POST["YEAR"]))
        $YEAR = $_POST['YEAR'];

    echo "</br>";
	echo $BOOK;
	echo "</br>";
    echo $YEAR;
	echo "</br>";
	if($MSG != "")
	{
		$sql = "INSERT INTO student_books_notes (note_id, person_id, book_id, value) VALUES (0, $studentId, $bookID, \"$MSG\")";
		
		echo $sql."</br></br>";		
			
        //echo $sql;		
		//@mysql_query($sql)or die(" SQL failed");
		//$query = $mysqli->query($sql) or die("SQL execuation fails.");

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
    //@mysql_query($sql)or die(" SQL failed");
	//$query = $mysqli->query($sql) or die("SQL execuation fails.");
}

/*
echo $book;
echo "</br>";
echo $bookID;
echo "</br>";
*/


showBookSets($mysqli);

function showBookSets($sqlHandle)
{
	
	$sql = "select books0923.book_id,books0923.book_name from  books0923";
	
	$query = $sqlHandle->query($sql) or die("SQL execuation fails.");
//echo $sql."</br>";
	while($row = mysqli_fetch_array($query))
	{
		//echo "</br>in while showBookNotes";
		
		 echo "<div class=\"row text-center slideanim\">";
         echo "<div class=\"col-sm-4\">";
         echo "<div class=\"thumbnail\">";
	
		echo "</br>";
		echo "<p><strong>".$row['book_name'];
		echo "</br>";
		
		echo "</br>";
		//$noteId = $row['note_id'];
		
	//$linkStr = "<a href='bookManage.php?dnid=".$noteId."&id=".$book_id."&name=".$book_name." '>"."delete</a>";
	
		//$linkStr = "<a href='bookView.php?dsid = "'>verify</a>";
		echo "</br>";
        //echo $linkStr."</br>";
		echo"</div>";
		echo"</div>";
	}
	//echo "calm calm </br>";
	
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
echo "<form method=\"POST\" action=\"bookManage.php?id=".$bookID."&name=".$book."\">
<div>
<textarea name=\"YEAR\" cols=40 rows=1>
year
</textarea>
<br>
<textarea name=\"BOOK\" cols=40 rows=2>
book name
</textarea>
<br>
<input type=\"submit\" value=\"add book\" />
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