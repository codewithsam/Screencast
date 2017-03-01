<?php
include_once("include/db_conx.php");
	echo '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ScreenCast || Free PHP Based Collaborative Whiteboard</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="img/glogo/16x16.png">
	<link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,500italic,700italic,900,900italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Cabin+Condensed:400,700,600,500" rel="stylesheet" type="text/css">
</head>
<body>
';

flash( 'success_message' );
        
 flash( 'warning_class' );

 if(isset($msngr) && $msngr != ""){
 	echo '<div class="success">'.$msngr.'</div>';
 }


 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
 	$heluser = $_SESSION['id'];
 	$headusrqery = mysqli_query($db_conx,"SELECT avatar FROM members WHERE id='$heluser' LIMIT 1");
 	$usrheadblaqr = mysqli_fetch_row($headusrqery);
 	echo '
 	<nav class="navbar navbar-default header">
		<div class="container-fluid header-fluid">
			<div class="col-xs-5 col-sm-4 col-sm-offset-1">
				<a href="index.php" class="navbar-brand brand">
					<img src="img/glogo/64x64.png" alt="">
				</a>
			</div>
			<div class="col-xs-7 col-sm-7 pull-right">
				<ul class="nav navbar-nav navbar-right header-right-links">
        			<li id="usersetting" data-toggle="dropdown" aria-expanded="true"><img src="avatar/'.$usrheadblaqr[0].'" alt="">'.$_SESSION['username'].' <i class="fa fa-caret-down"></i></li>
        			<ul class="dropdown-menu" role="menu" aria-labelledby="usersetting">
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="newgig.php">New Screencast</a></li>
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="activecast.php">Active Cast</a></li>
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="setting.php">Settings</a></li>
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Logout</a></li>
					</ul>
        		</ul>
			</div>
		</div>
	</nav>';
 }
else{
	echo '
	<nav class="navbar navbar-default header">
		<div class="container-fluid header-fluid">
			<div class="col-xs-5 col-sm-4 col-sm-offset-1">
				<a href="index.php" class="navbar-brand brand">
					<img src="img/glogo/64x64.png" alt="">
				</a>
			</div>
			<div class="col-xs-7 col-sm-7 pull-right">
				<ul class="nav navbar-nav navbar-right header-right-links">
        			<li class="header-login" data-toggle="modal" data-target="#login"><a><div>Login</div></a></li>
        			<li class="header-signup" data-toggle="modal" data-target="#signup"><a><div>Signup</div></a></li>
        			<li><button class="btn btn-success header-start-selling"><i class="fa fa-user"></i>Start Selling</button></li>
        		</ul>
			</div>
		</div>
	</nav>
';
}
?>
