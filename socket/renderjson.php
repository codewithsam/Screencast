<?php
session_start();
include_once("../db_conx.php");
$dta = $_POST["json"];
if(isset($_SESSION["cursessname"]) || isset($_SESSION["studentsessname"])){
	$sess = isset($_SESSION["cursessname"]) ? mysqli_real_escape_string($db_conx,$_SESSION["cursessname"]): mysqli_real_escape_string($db_conx,$_SESSION["studentsessname"]);

	if(isset($sess)){
		echo "entering";
		$fp = fopen('json/'.$sess.'.json', 'w+');
		fwrite($fp, $dta);
		fclose($fp);
	}else{ echo "Session failed"; die(); }
}else{ echo "failed miserably!!!"; };
	
		
?>