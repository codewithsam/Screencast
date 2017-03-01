<?php
	session_start();
	ob_start();
	
require( 'include/flash.php' );
$candonow = false;
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
	if(isset($_POST["submitpost"])){
		$t = (isset($_POST["title"])) ? mysql_real_escape_string($_POST["title"]) : NULL;
		$c = (isset($_POST["cat"])) ? mysql_real_escape_string($_POST["cat"]) : NULL;
		$d = (isset($_POST["descr"])) ? mysql_real_escape_string($_POST["descr"]) : NULL;
		$memid = (isset($_SESSION["id"])) ? mysql_real_escape_string($_SESSION["id"]) : NULL;

		if(!isset($t)){
			flash( 'warning_class', 'Add the title for your class', 'error' );
		}
		if(!isset($c)){
			flash( 'warning_class', 'Select the category for your class', 'error' );
		}
		if(!isset($_FILES["cover"])){
			flash( 'warning_class', 'Select atleast one cover photo for your class', 'error' );
		}
		if(!isset($d)){
			flash( 'warning_class', 'Add a small description about your class', 'error' );
		}
	}
	if(isset($_POST["submitpost"]) && isset($t) && isset($c) && isset($d)){
		$target_dir = "postupload/";
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
				flash( 'success_message', "The file has been uploaded. Redirecting you to the Showcase" );
    		}else {
				flash( 'warning_class', 'Sorry, there was an error uploading your file.', 'error' );
    		}
		}

	}
}else{
	flash( 'warning_class', 'Please Login Before You Add A New Class', 'error' );
	header("Location: index.php");
	exit();
}
include_once("include/header.php");

if(isset($candonow) && $candonow == true){
	$sql = "INSERT INTO posts(title,category_id,coverimg,description,status,member_id,created_at,updated_at) VALUES('I Can $t','$c','$filename.$imageFileType','$d','1','$memid',now(),now())";
	$qry = mysqli_query($db_conx,$sql);
	if($qry){
		flash( 'success_message', "Class Successfully Created" );
	}else{
		$er = 'Could not run query: ' . mysqli_error($db_conx);
		flash( 'warning_class', $er, 'error' );
	}
}
?>
	<div class="content">
		<div class="contentWrapper">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="container">
					<div class="crgig-header">
						<span>Create A New Gig Post</span>
					</div>
					<div class="gigglebox">
						<div class="gigb-whattodo row">
							<div class="col-sm-2 ican">I Can: </div>
							<div class="col-sm-10 icaninput">
								<input class="form-control" type="text" name="title" placeholder="Type The Work You Want To Do" />
							</div>
						</div>




						<div class="gigb-cat row">
							<div class="col-sm-2 choosecat">Category </div>
							<div class="col-sm-10 cc-ccd">
								<div class="col-xs-6 col-sm-5 col-md-4">

									<select id="" class="ccd-drop cat" name="cat">
										<?php
											$sql = "SELECT * FROM category";
											$q = mysqli_query($db_conx,$sql);
											if(!$q){
												$er = 'Could not run query: ' . mysqli_error($db_conx);
									            flash( 'warning_class', $er, 'error' );
											}else{
												while($row = mysqli_fetch_assoc($q)){
													echo '<option value="'.$row["id"].'">'.$row["catname"].'</option>';
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>

						<div class="gig-uploadcover row">
							<div class="col-sm-2 upc-tit">
								Upload Cover
							</div>
							<div class="uploadbtn col-sm-10">
								<div class="fileUpload btn btn-default">
								    <span>Upload</span>
								    <input type="file" class="upload" name="cover" />
								</div>
								<div>JPEG | JPG | PNG | GIF file, 5 MB Max, you own the copyrights</div>
							</div>
						</div>
						<div class="gigdesc row">
							<div class="col-sm-2 upc-tit">
								DESCRIPTION
							</div>
							<div class="col-sm-10">
								<textarea class="form-control" name="descr"></textarea>
							</div>
						</div>
						<div class="savecontinue row">
							<button class="btn btn-success" type="submit" name="submitpost">Save & Continue</button>
						</div>
					</div>
				</div>	
			</form>
			
		</div>
	</div>
	<?php include_once("include/logsign.php"); ?>
	<script>
		
	</script>
</body>
</html>
