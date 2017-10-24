
<?php
echo "<form method=\"POST\" action=\"showMySql.php?\">
<div>
<textarea name=\"MSG\" cols=40 rows=4>
welcome adding notes
</textarea>
<br>
<input type=\"submit\" value=\"add note\" />
</div>
</form>";
?>

<?php

require_once('connectDB.php');
$mysqli = initPermanentConnection();

if(isset($_POST["MSG"]))
	$MSG = $_POST['MSG'];

		
$sql = $MSG;
echo $sql;

$query = $mysqli->query($sql) or die("SQL execuation fails.");


while($row = mysqli_fetch_array($query))
{
	print_r($row);
	print_r("</br>");
}

/*
if you want to create a table with auto_increment column

CREATE TABLE  student_books_notes  
(
   note_id  int(10) NOT NULL AUTO_INCREMENT primary key,
  
 person_id  int(10) NOT NULL DEFAULT  0 ,
  
 book_id  int(10) NOT NULL DEFAULT  0 ,
  
 value  varchar(4000) NOT NULL DEFAULT ""  
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
?>


