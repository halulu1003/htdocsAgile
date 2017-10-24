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
		echo "</br>";
		echo $row['course_name'];
		$courseID = $row['course_id'];
		echo "</br>is assigned to";
		showAssignedLecturers($courseID);
		echo "</br></br>other lecturers";
		showNotAssignedLecturers($courseID);
	    echo "</br>---------------------------------------------------------";
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