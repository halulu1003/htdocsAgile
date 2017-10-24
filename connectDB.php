<?php
function initPermanentConnection()
{
    //$permanentConnection = initEnv(true);
	$permanentConnection = initEnv(false);
	return $permanentConnection; 
}

function initEnv($bluemix)
{
    if($bluemix == true)
    {
	    if($_ENV["VCAP_SERVICES"]) {
	        $vcap_services = json_decode($_ENV["VCAP_SERVICES" ]);
	        if($vcap_services->{'mysql'}){ 
	            $db = $vcap_services->{'mysql'}[0]->credentials;
	        } 
	        else if($vcap_services->{'cleardb'}){
	            $db = $vcap_services->{'cleardb'}[0]->credentials;
	        } 
	        else{ 
	            echo "Error: No suitable MySQL database bound to the application. <br>";
	            die();
	        }
			$mysql_database = $db->name;
			$mysql_port=$db->port;
			$mysql_server_name =$db->hostname . ':' . $db->port;
			$mysql_username = $db->username; 
			$mysql_password = $db->password;
	    }
	    
	}
	else
	{
		$mysql_server_name = "localhost";
		$mysql_username = "root";
		$mysql_password = '';
		$mysql_database = "yx";
	}
	
	$mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
	if ($mysqli->connect_errno) 
    {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		die();
	}
		
	return $mysqli;
	
}
?>