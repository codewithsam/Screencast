<?php
session_start();
ob_start();
$succs = true;
include_once("include/db_conx.php");
include_once("include/flash.php");

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
}else{ 
	flash( 'warning_class', 'Please Login Before You Join A Class', 'error' );
	header("Location: index.php");
	exit();
}
$cid = isset($_GET["cid"]) ? mysqli_real_escape_string($db_conx,$_GET["cid"]) : NULL;

$relqry = mysqli_query($db_conx,"SELECT member_id FROM posts WHERE id='$cid' LIMIT 1");
$relqry = mysqli_fetch_row($relqry);
$ownerid = $_SESSION["id"];
if($ownerid == $relqry[0]){
	if(isset($cid)){
		setcookie("relation", "teacher");
		setcookie("session", $cid);
	}else{
		flash( 'warning_class', 'Something went wrong with the Session, Please try later', 'error' );
		$succs = false;
	}
}else{
	if(isset($cid)){
		setcookie("relation", "student");
		setcookie("session", $cid);
	}else{
		flash( 'warning_class', 'Something went wrong with Session, Please try later', 'error' );
		$succs = false;
	}
}
if(isset($succs) && $succs != true){
	echo '<div class="wallar">Something went wrong.... </div>';
}
else{
		echo '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ScreenCast || Free PHP Based Collaborative Whiteboard</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="socket/js/fabric.js"></script>
	<script src="socket/js/Connection.js"></script>
	<script src="socket/js/canv.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="img/glogo/16x16.png">
	<link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,500italic,700italic,900,900italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Cabin+Condensed:400,700,600,500" rel="stylesheet" type="text/css">

<script type="text/javascript">
		window.renderit = true;
	</script>
</head>
<body>
';

flash( 'success_message' );
        
 flash( 'warning_class' );

 if(isset($msngr) && $msngr != ""){
 	echo '<div class="success">'.$msngr.'</div>';
 }


 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
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
        			<li id="usersetting" data-toggle="dropdown" aria-expanded="true"><img src="avatar/'.$_SESSION['avatar'].'" alt="">'.$_SESSION['username'].' <i class="fa fa-caret-down"></i></li>
        			<ul class="dropdown-menu" role="menu" aria-labelledby="usersetting">
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">New Screencast</a></li>
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Active Cast</a></li>
					    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
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
				<a href="#" class="navbar-brand brand">
					<img src="img/glogo/64x64.png" alt="">
				</a>
			</div>
			<div class="col-xs-7 col-sm-7 pull-right">
				<ul class="nav navbar-nav navbar-right header-right-links">
        			<li class="header-login" data-toggle="modal" data-target="#login"><a><div>Login</div></a></li>
        			<li class="header-signup" data-toggle="modal" data-target="#signup"><a><div>Signup</div></a></li>
        			<li><button class="btn btn-success header-start-selling"><i class="fa fa-user"></i>Start Session</button></li>
        		</ul>
			</div>
		</div>
	</nav>
';
}
echo '<div class="collaboard col-xs-12">
	<div class="colb-leftbar col-xs-3 col-sm-2 col-md-1 col-lg-1">
		<ul>
			<li id="pencil"><i class="fa fa-pencil"></i></li>
			<li id="line"><i class="fa fa-arrows-h"></i></li>
			<li id="circle"><i class="fa fa-circle"></i></li>
			<li id="rect"><i class="fa fa-square"></i></li>
			<li id="remove"><i class="fa fa-trash-o"></i></li>
			<li id="text" data-toggle="modal" data-target="#textModal"><i class="fa fa-text-width"></i></li>
			<li id="image_out"><i class="fa fa-photo"></i></li>
			<li id="pdf"><i class="fa fa-file-pdf-o"></i></li>
		</ul>
	</div>
	<div class="contentWrapper col-xs-9 col-md-11 col-sm-10 col-lg-11">
		<canvas id="c" width="1366" height="700"></canvas>
	</div>
</div>

<div class="modal fade" id="textModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Choose Your Style</h4>
      </div>
      <div class="modal-body">
      	<div class="row texto">
      		<div class="col-xs-12">
	      		<input type="text" class="form-control textstr"  placeholder="Type your text" />      			
      		</div>
			<div class="col-xs-6">
		      	<input type="text" class="form-control textsize" placeholder="Size" />			
			</div>
			<div class="col-xs-6">
				<select name="" class="form-control textcolor" name="textcolor">
		      		<option value="#000000">Black</option>
		      		<option value="#8B0000">Red</option>
		      		<option value="#008000">Green</option>
		      		<option value="#0000FF">Blue</option>
		      		<option value="#FFA500">Orange</option>
		      		<option value="#FFFFFF">White</option>
		      		<option value="#FFC0CB">Pink</option>
		      		<option value="#FFFF00">Yellow</option>
		      		<option value="#A52A2A">Brown</option>
		      	</select>	
			</div>
	      	
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary outtext" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>






';
}
?>



	<?php include_once("include/logsign.php"); ?>

</body>
</html>