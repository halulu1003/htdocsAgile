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
echo "recommeded book list:-------------------------------------------";

showRecommendedBooks($courseID,$userId);
echo "</br>";

echo "other book list:--------------------------------------------------";
echo "</br>";
showNotRecommendedBooks($courseID);

function showRecommendedBooks($course_id,$user_id)
{
	$query = @mysql_query("select books.book_id,books.book_name from recommend_courses_books , books where 
	books.book_id = recommend_courses_books.book_id and
	recommend_courses_books.person_id = $user_id and
	recommend_courses_books.course_id = $course_id")or die("SQL failed");
	while($row = mysql_fetch_array($query))
	{
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
	}	
}

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
		 $bookID = $row['book_id'];
		 $bookName = $row['book_name'];
		 echo "</br>";
		 //echo $bookID;
		 //echo "</br>";
		 echo $bookName;
		 echo "<p align=\"left\"> <form method=\"POST\" action=\"courseView.php?rbid=".$bookID."&rcid=".$course_id."\"><input type=\"submit\" name=\"Submit\" value=\"recommend\" />  </p>";
		 
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

?>

<script language="JavaScript">
function bt_click(){
  <?php show();?>
}
</script>
