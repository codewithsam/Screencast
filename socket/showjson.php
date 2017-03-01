<?php
session_start();
include_once("../db_conx.php");
if(isset($_SESSION["cursessname"]) || isset($_SESSION["studentsessname"])){
	$sess = isset($_SESSION["cursessname"]) ? mysqli_real_escape_string($db_conx,$_SESSION["cursessname"]): mysqli_real_escape_string($db_conx,$_SESSION["studentsessname"]);

	if(isset($sess)){
		$fp = file_get_contents('json/'.$sess.'.json');
		echo $fp;
	}else{ echo "Session failed"; die(); }
}else{ echo "failed miserably!!!"; };
	
		
?>