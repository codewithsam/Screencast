<?php
	session_start();
	ob_start();
	require( 'include/flash.php' ); 
	include_once('include/header.php');
?>

	<div class="content">
		<div class="content-giglist">
			<?php

$searchsrt = isset($_GET["search"]) ? mysqli_real_escape_string($db_conx,$_GET["search"]) : '';
$searchcat = isset($_GET["cat"]) ? mysqli_real_escape_string($db_conx,$_GET["cat"]) : NULL;
if(!isset($searchcat)){
	$sqry = mysqli_query($db_conx,"SELECT p.*,m.username from posts p,members m where p.member_id = m.id AND p.status='1' AND p.title LIKE '%".$searchsrt."%'");
}else{
	$sqry = mysqli_query($db_conx,"SELECT p.*,m.username from posts p,members m where p.member_id = m.id AND p.status='1' AND p.title LIKE '%".$searchsrt."%' AND p.category_id = '$searchcat'");
}

			?>
			<div class="container">
				<div class="row giglist-topicsearch">
					<h1>Search Result For <?php echo $searchsrt;?></h1>
				</div>
				<div class="row giglist-section">
					<div class="categorybar col-sm-3">
						<div class="category-head">Shop Category</div>
						<ul>
							<?php
								$query = mysqli_query($db_conx,"SELECT * FROM category");
								echo '<a href="search.php?search="><li>All Categories</li></a>';
							while($row = mysqli_fetch_assoc($query)){
								$catid = $row["id"];
								$totalcatq = mysqli_query($db_conx,"SELECT count(*) FROM posts where category_id='$catid' AND status='1'");
								$cattot = mysqli_fetch_row($totalcatq);
								$totalwa = mysqli_num_rows($totalcatq);
									
								if($row["id"] == $searchcat){
									echo '<a href="search.php?search='.$searchsrt.'&cat='.$catid.'"><li class="active">'.$row["catname"].' <span class="pull-right badge">'.$cattot["0"].'</span></li></a>';
								}else{
									echo '<a href="search.php?search='.$searchsrt.'&cat='.$catid.'"><li>'.$row["catname"].' <span class="pull-right badge">'.$cattot["0"].'</span></li></a>';
								}
							}
								?>
						</ul>
					</div>
					<div class="giglistbar col-sm-9">
						<!-- <div class="giglistbar-head">
							<ul class="nav nav-tabs">
								<li role="presentation" class="active"><a href="#">Top Rated</a></li>
								<li role="presentation"><a href="#">Recommended</a></li>
								<li role="presentation"><a href="#">New</a></li>
							</ul>
						</div> -->
						<div class="glb-gigrid">

							<?php
							$arrlen = mysqli_num_rows($sqry);
							$count = 1;
							while($arr = mysqli_fetch_assoc($sqry)){
									if($count%3 == 0){
										echo '<div class="row"><a href="post.php?id='.$arr["id"].'"><div class="col-xs-4 gig-grid-style">
											<div class="glb-grid-container">
												<div class="glb-grid-head">
													<span><b>By </b>'.$arr["username"].'</span>
													<span class="pull-right glb-gh-total">(30)</span>
													<span class="pull-right">
														<ul>
															<li><i class="fa fa-circle"></i></li>
															<li><i class="fa fa-circle"></i></li>
															<li><i class="fa fa-circle"></i></li>
															<li><i class="fa fa-circle"></i></li>
															<li><i class="fa fa-circle"></i></li>
														</ul>
													</span>
												</div>
												<div class="glb-gig-img-vid">
													<img src="postupload/'.$arr["coverimg"].'" alt="">
												</div>
												<div class="glb-title">
													<span>'.$arr["title"].'</span>
												</div>
												<div class="glb-footer">
													<span class="glb-fab"><i class="fa fa-heart"></i></span>
													<span class="pull-right glb-amout"><i class="fa fa-inr"></i> Free</span>
												</div>
											</div>
										</div></div>';
										$count++;
									}else{
										echo '<a href="post.php?id='.$arr["id"].'"><div class="col-xs-4 gig-grid-style">
											<div class="glb-grid-container">
												<div class="glb-grid-head">
													<span><b>By </b>'.$arr["username"].'</span>
													<span class="pull-right glb-gh-total">(30)</span>
													<span class="pull-right">
														<ul>
															<li><i class="fa fa-circle"></i></li>
															<li><i class="fa fa-circle"></i></li>
															<li><i class="fa fa-circle"></i></li>
															<li><i class="fa fa-circle"></i></li>
															<li><i class="fa fa-circle"></i></li>
														</ul>
													</span>
												</div>
												<div class="glb-gig-img-vid">
													<img src="postupload/'.$arr["coverimg"].'" alt="">
												</div>
												<div class="glb-title">
													<span>'.$arr["title"].'</span>
												</div>
												<div class="glb-footer">
													<span class="glb-fab"><i class="fa fa-heart"></i></span>
													<span class="pull-right glb-amout"><i class="fa fa-inr"></i> Free</span>
												</div>
											</div>
										</div>';
										$count++;
									}
								
							}

							?>
							
					</div>
<!-- 					<div class="row col-xs-12 loadmoregig">
						<span>LOAD MORE</span>
					</div> -->
				</div>
			</div>
		</div>

<?php include_once("include/logsign.php"); ?>
		
	</div>
</body>
</html>