<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Courses View</title>
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
		   <li><a href="coursesList.php">CoursesList</a></li>
		   <li><a href="courseView.php">Courses</a></li>
		   <li><a href="bookView.php">Notes</a></li>
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
$userId = $_SESSION['userID'];
$userFlag = $_SESSION['userflag'];
echo "user flag</br>";
//echo $course;

if(isset($_GET["name"]))
{
	$course=$_GET["name"];
	echo $course;
	$_SESSION['courseName'] = $course;
}
if(isset($_GET["id"]))
{
    $courseID = $_GET['id'];
    echo $courseID;
}

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
    $bookID = $_GET['rbid'];
	echo $bookID;
	echo "</br>";
	if($userFlag == 1)
	{
	    $sql = "INSERT INTO recommend_courses_books (person_id, course_id, book_id) VALUES (".$userId.", ".$courseID.", ".$bookID.")";
	}
    else
    {
		$sql = "INSERT INTO student_courses_books (person_id, course_id, book_id) VALUES (".$userId.", ".$courseID.", ".$bookID.")";
	}	
	echo $sql;		
    //@mysql_query($sql)or die(" SQL failed");
    $query = $mysqli->query($sql) or die("SQL execuation fails.");
}

//after delete action
if(isset($_GET["dcid"]))
{
	//echo "from delete action";
    $recommend_course=$_GET["dcid"];
    $courseID = $_GET["dcid"];
}
if(isset($_GET["dbid"]))
{
	//echo "ddddddd";
    $bookID = $_GET['dbid'];
	echo $bookID;
	//$sql = "INSERT INTO recommend_courses_books (person_id, course_id, book_id) VALUES (".$userId.", ".$courseID.", ".$bookID.")";
    echo "</br>";
	if($userFlag == 1)
	{
		$sql = "DELETE FROM recommend_courses_books WHERE person_id = $userId and course_id = $courseID and book_id = $bookID";
	}
	else
	{
		$sql = "DELETE FROM student_courses_books  WHERE person_id = $userId and course_id = $courseID and book_id = $bookID";
	}
	echo $sql;		
    //@mysql_query($sql)or die(" SQL failed");
    $query = $mysqli->query($sql) or die("SQL execuation fails.");
}

echo "</br>";
echo $_SESSION['courseName'];

echo "</br></br></br>";
echo "<h2> <a href=\"courseList.php\">My courses</a></h2>";


echo "</br>";
//echo "<h2>recommeded book list:";
echo "</br>";
if($userFlag == 1)
    showRecommendedBooks($courseID,$userId,$mysqli);
else
{
	$rList = getRecommendedBooksSet($courseID,1,$mysqli);
    echo $rList;
	getSelectedBooks($courseID,$userId,$rList,$mysqli);
}
	echo "</br>";

function getRecommendedBooksSet($course_id,$user_id,$sqlHandle)
{
	$sql = "select books0923.book_id,books0923.book_name from recommend_courses_books, books0923 
	where books0923.book_id = recommend_courses_books.book_id 
	and recommend_courses_books.person_id = $user_id 
	and	recommend_courses_books.course_id = $course_id";

    echo "</br>";
	echo $sql;
	
	//$query = @mysql_query($sql)or die("SQL failed");
	$query = $sqlHandle->query($sql) or die("SQL execuation fails.");
	$index = 0;
	$recmList = Array();
	
	while($row = mysqli_fetch_array($query))
	{
		echo $row['book_id'];
		$recmList[$index] = $row['book_id'];
		$index++;
	}
	
	print_r($recmList);
	return $recmList;
}

function getSelectedBooks($course_id,$user_id,$highlightSet,$sqlHandle)
{
	echo "</br>";
	echo "getSelectedBooks";
	echo "</br>";
	/*
	$sql = "select books0923.book_id,books0923.book_name from recommend_courses_books, books0923 where 
	books0923.book_id = recommend_courses_books.book_id
	and
	recommend_courses_books.person_id = $user_id and
	recommend_courses_books.course_id = $course_id";

	*/
	
	$sql = "select books0923.book_id,books0923.book_name from student_courses_books, books0923 where books0923.book_id = student_courses_books.book_id and student_courses_books.person_id = $user_id and student_courses_books.course_id = $course_id";

    echo "</br>";
	echo $sql;
	
	//$query = @mysql_query($sql)or die("SQL failed");
	$query = $sqlHandle->query($sql) or die("SQL execuation fails.");
	/*
	while($row = mysqli_fetch_array($query))
	{
		echo $row['book_id'];
		$recmList[$index] = $row['book_id'];
		$index++;
	}
	*/
	//print_r($recmList);
	//return $recmList;
	listQueryRes($query,"selected books","remove",$course_id,$highlightSet);

}

function getUnSelectedBooks($course_id,$user_id,$highlightSet,$sqlHandle)
{
	echo "</br>";
	echo "getUnSelectedBooks";
	echo "</br>";
	/*
	$sql = "select books0923.book_id,books0923.book_name from recommend_courses_books, books0923 where 
	books0923.book_id = recommend_courses_books.book_id
	and
	recommend_courses_books.person_id = $user_id and
	recommend_courses_books.course_id = $course_id";
*/

    $sql = "select books0923.book_id,books0923.book_name from books0923 
	where books0923.book_id not in 
	(
	    select student_courses_books.book_id from student_courses_books
		where person_id = $user_id
		and course_id = $course_id
	)";
    
	echo "</br>";
	echo $sql;
	echo "</br>";
	
	//$query = @mysql_query($sql)or die("SQL failed");
	$query = $sqlHandle->query($sql) or die("SQL execuation fails.");
	listQueryRes($query,"left books","select",$course_id,$highlightSet);

}
function listQueryRes($query,$lable,$action,$course_id,$highlightSet)
{
	while($row = mysqli_fetch_array($query))
	{
		echo "<div class=\"col-sm-4 col-xs-12\"> ";
	    echo "<div class=\"panel panel-default text-center\">";
        echo "<div class=\"panel-heading\">";
        //echo "<h2>Recommeded Books</h2>";
		echo "<h2>".$lable."</h2>";
		
        echo "</div>";
		$bookID = $row['book_id'];
		 //$bookID = 3;
		$bookName = $row['book_name'];
		echo "</br>";
		
		echo $bookName;
	
	    //print_r($highlightSet);
		if($action == "select")
		{
			if (in_array($bookID, $highlightSet))
			{
                echo "</br>it is rec</br>";
			}
			$postStr = 	"rbid=".$bookID."&rcid=".$course_id;
		}
		else{
		    $postStr = 	"dbid=".$bookID."&dcid=".$course_id;
		
		    //courseView.php?rbid=".$bookID."&rcid=".$course_id."
		}
		$linkStr = "<a href='courseView.php?".$postStr." '>".$action."</a>";
		echo "</br>";

		echo $linkStr."</br>";
		echo "</div>";
		echo "</div>";
	}
}

function showRecommendedBooks($course_id,$sqlHandle)
{
	/*
	$sql = "select books0923.book_id,books0923.book_name from recommend_courses_books , books0923 where 
	books0923.book_id = recommend_courses_books.book_id and
	recommend_courses_books.person_id = $user_id and
	recommend_courses_books.course_id = $course_id";
*/
$sql = "select books0923.book_id,books0923.book_name from recommend_courses_books, books0923 where 
	books0923.book_id = recommend_courses_books.book_id
	and
	recommend_courses_books.person_id = $user_id and
	recommend_courses_books.course_id = $course_id";

    echo "</br>";
	//echo $sql;
	
	//$query = @mysql_query($sql)or die("SQL failed");
	$query = $sqlHandle->query($sql) or die("SQL execuation fails.");
	while($row = mysqli_fetch_array($query))
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
		 
		 $linkStr = "<a href='courseView.php?dbid=".$bookID."&dcid=".$course_id." '>"."delete</a>";
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

<?php
if($userFlag == 1)
    showNotRecommendedBooks($courseID);
else
    //getUnSelectedBooks($courseID,);    
getUnSelectedBooks($courseID,$userId,$rList,$mysqli);

function showNotRecommendedBooks($course_id)
{
	/*
	$sql = "select books0923.book_id,books0923.book_name from recommend_courses_books, books0923 where 
	books0923.book_id = recommend_courses_books.book_id";
	*/
	
	/*
	$sql = "select books0923.book_id,books0923.book_name from books where 
	books0923.book_id not in
	(
	    select book_id from recommend_courses_books where
		recommend_courses_books.course_id = $course_id
	)
	"
	*/
	
	$sql = "select books0923.book_id,books0923.book_name from books0923 where 
	books0923.book_id not in
	(
	    select book_id from recommend_courses_books where
		recommend_courses_books.course_id = $course_id
	)";
	
    echo "</br>";
	echo $sql;
	
	//$query = @mysql_query($sql)or die("SQL failed");
	$query = $mysqli->query($sql) or die("SQL execuation fails.");
	while($row = mysqli_fetch_array($query))
	{
		echo "<div class=\"col-sm-4 col-xs-12\"> ";
	    echo "<div class=\"panel panel-default text-center\">";
        echo "<div class=\"panel-heading\">";
        echo "<h2>Other Books</h2>";
        echo "</div>";
		 $bookID = $row['book_id'];
		 $bookName = $row['book_name'];
		 echo "</br>";
		 echo $bookID;
		 echo "</br>";
		 echo $bookName;
		 echo "<form method=\"POST\" action=\"courseView.php?rbid=".$bookID."&rcid=".$course_id."\"></br><input type=\"submit\" name=\"Submit\" value=\"recommend\" /></form></br>";
		 echo "</div>";
		 echo "</div>";
	}	
}

function forceUpdate()
{
	echo "<script>location:r
	
	
	eload();</script>";
}


function show()
{
	echo "this is show";
}
echo "</div>";
echo "</div>";

$query->close();
mysqli_close();
?>

<script language="JavaScript">
function bt_click(){
  <?php show();?>
}
</script>

 <footer class="container-fluid text-center col-sm-8">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Made on 2017/10/16</p>
</footer>

</body>
</html>