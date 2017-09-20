<?php
$first=$_POST["first"];
$v=$_POST["s"];
$second=$_POST["second"];
if($v=="+"){
echo $first+$second;
}elseif($v=="-"){
echo $first-$second;
}elseif($v=="*"){
echo $first*$second;
}elseif($v=="/"){
echo $first/$second;
}
?>