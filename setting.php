<?php
	session_start();
	include_once("include/flash.php");
	include_once("include/db_conx.php");
		function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
	$candonow = false;
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){}
	else{
		flash( 'warning_class', 'Please Login Before You Can Edit Your Settings', 'error' );
		header("Location: index.php");
		exit();
	}

	$userid = (isset($_SESSION["id"])) ? mysqli_real_escape_string($db_conx,$_SESSION["id"]) : NULL;


	if(isset($_POST["submiteditor"])){
		$u = (isset($_POST["username"])) ? mysql_real_escape_string($_POST["username"]) : NULL;
	    $e = (isset($_POST["email"])) ? mysql_real_escape_string($_POST["email"]) : NULL;
	    $p = (isset($_POST["place"])) ? mysql_real_escape_string($_POST["place"]) : NULL;
	    $l = (isset($_POST["language"])) ? mysql_real_escape_string($_POST["language"]) : NULL;
	    $b = (isset($_POST["bio"])) ? mysql_real_escape_string($_POST["bio"]) : NULL;
	    $pass = (isset($_POST["password"])) ? mysql_real_escape_string($_POST["password"]) : NULL;
	    $a = (isset($_FILES["cover"]["name"])) ? mysql_real_escape_string($_FILES["cover"]["name"]) : NULL;
	    $warn = "";
	    if(!$u){
	       // $warn +=  "Username field cannot be left blank\n";
	        flash( 'warning_class', 'Username field cannot be left blank', 'error' );
	    }
	    if(!$e){
	       // $warn += "E-Mail field cannot be left blank\n";
	        flash( 'warning_class', 'E-Mail field cannot be left blank', 'error' );
	    }
	    if(!$p){
	       // $warn += "E-Mail field cannot be left blank\n";
	        flash( 'warning_class', 'Specify where you live', 'error' );
	    }
	    if(!$l){
	       // $warn += "E-Mail field cannot be left blank\n";
	        flash( 'warning_class', 'Specify your Language', 'error' );
	    }
	    if(!$b){
	       // $warn += "E-Mail field cannot be left blank\n";
	        flash( 'warning_class', 'Write Something About Yourself', 'error' );
	    }
	    if(!$pass){
	       // $warn += "E-Mail field cannot be left blank\n";
	        flash( 'warning_class', 'You forgot to type your new Password', 'error' );
	    }

	    // if($u && $e && $p && $l && $b && $pass && !$a){
	    // 	$vimqry = mysqli_query($db_conx,"UPDATE members SET username='$u',password='$pass',updated_at=now(),email='$e',place='$p',language='$l',bio='$b' WHERE id='$userid'");
	    // }else
if($a !=""){

	    	$target_dir = "avatar/";
			$target_file = $target_dir . basename($_FILES["cover"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		    $check = getimagesize($_FILES["cover"]["tmp_name"]);
		    $filename = random_string(50);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
				flash( 'warning_class', 'File is not an image', 'error' );
		        $uploadOk = 0;
		    }
		    if (file_exists($target_file)) {
				flash( 'warning_class', 'Sorry, file already exists', 'error' );
			    $uploadOk = 0;
			}
			if ($_FILES["cover"]["size"] > 500000) {
				flash( 'warning_class', 'Sorry, your file is too large', 'error' );
	    		$uploadOk = 0;
			}
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				flash( 'warning_class', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed', 'error' );
	    		$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				flash( 'warning_class', 'Sorry, your file was not uploaded.', 'error' );
				
			}else {
	    		if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_dir.$filename.".{$imageFileType}")) {
	    			$candonow = true;
					flash( 'success_message', "Successfull" );
	    		}else {
					flash( 'warning_class', 'Sorry, there was an error', 'error' );
	    		}
			}
}
	    
	    if(isset($candonow) && $candonow == true){
	    	if($u && $p && $e && $l && $b && $a){
	    		$vimqry = mysqli_query($db_conx,"UPDATE members SET username='$u',password='$pass',updated_at=now(),email='$e',place='$p',language='$l',bio='$b',avatar='$filename.$imageFileType' WHERE id='$userid'");
			}
		if($vimqry){
			flash( 'success_message', "Your Profile Is Updated" );
		}else{
			$er = 'Could not run query: ' . mysqli_error($db_conx);
			flash( 'warning_class', $er, 'error' );
		}
}
	}
	
	$showqry = mysqli_query($db_conx,"SELECT * FROM members where id='$userid' LIMIT 1");
	$row = mysqli_fetch_row($showqry);

	include_once("include/header.php");
?>
<?php
	// $totalacts = mysqli_query($db_conx,"SELECT * FROM posts WHERE status='1' AND member_id='$userid'");
	// $totalactiveclass = mysqli_num_rows($totalacts);
	// $totaldeacts = mysqli_query($db_conx,"SELECT * FROM posts WHERE status='0' AND member_id='$userid'");
	// $totaldeactiveclass = mysqli_num_rows($totaldeacts);
?>
<div class="content">
	<div class="userset">
		<div class="container useravatar">
			<form action="setting.php" method="POST" enctype="multipart/form-data">
			<div class="col-xs-4">
				<div class="imageback">
					<?php $imgsrc =  "avatar/".$row["7"]; ?>
					<?php echo "<img src=\"{$imgsrc}\">"; ?>
					<div class="fileUpload btn btn-primary useravatarbtn">
    					<span>Upload</span>
    					<input type="file" class="upload" name="cover" value="<?php echo $row["7"]; ?>" />
					</div>
				</div>
			</div>
			<div class="col-xs-8 usereditor">
				<div class="editbtntop pull-right"><i class="fa fa-pencil"></i></div>
				<ul>

					<li><span><i class="fa fa-magic"></i></span><?php echo $row["1"]; ?></li>
					<li><span><i class="fa fa-user"></i></span> <?php echo $row["2"]; ?></li>
					<li><span><i class="fa fa-key"></i></span><?php echo $row["3"]; ?></li>
					<li><span><i class="fa fa-home"></i></span> <?php echo $row["8"]; ?></li>
					<li><span><i class="fa fa-language"></i></span><?php echo $row["9"]; ?></li>
					<li><span><i class="fa fa-newspaper-o"></i></span><?php if($row["10"] != "" || $row["10"] != null){ echo $row["10"]; }else{ echo "About You!"; } ?></li>
				</ul>
			</div>
			<div class="col-xs-8 changeeditor">
				
					<div>
						<input type="email" class="form-control" name="email" placeholder="Edit Your E-mail" value="<?php echo $row["1"]; ?>" />
						<input type="text" class="form-control" name="username" placeholder="Change Your Username" value="<?php echo $row["2"]; ?>" />
						<input type="text" class="form-control" name="place" placeholder="Edit Where You Live" value="<?php echo $row["8"]; ?>" />
						<input type="text" class="form-control" name="language" placeholder="Edit The Language You Speak" value="<?php echo $row["9"]; ?>" />
						<input type="text" class="form-control" name="password" placeholder="Enter Your New Password" value="<?php echo $row["3"]; ?>" />
						<textarea class="form-control" name="bio" placeholder="Write something about yoursef" ><?php echo $row["10"]; ?></textarea>
					</div>
					<div class="pull-right"><button class="btn btn-success" type="submit" name="submiteditor">Done</button></div>
			</div>
				</form>

		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.editbtntop').click(function(event) {
					$(this).parent('div').css('display','none');
					$('.changeeditor').css('display','block');
					$('.useravatarbtn').css('display', 'block');
				});
			});
		</script>
	</div>
</div>


<?php include_once("include/logsign.php"); ?>
