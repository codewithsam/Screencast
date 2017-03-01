<?php
	session_start();
	ob_start();
	require( 'include/flash.php' ); 
	include_once('include/header.php')

?>

	<div class="content">
		<div class="content-giglist">
			<div class="container">
				<div class="row giglist-topicsearch">
					<h1>Search Result For article</h1>
					<h5>Search for <span><a href="#">user containing 'Article'</a></span></h5>
				</div>
				<div class="row giglist-section">
					<div class="categorybar col-sm-3">
						<div class="category-head">Shop Category</div>
						<ul>
							<!-- <li>All Categories <span class="pull-right badge">22</span></li>
							<li>Graphics And Designing <span class="pull-right badge">12</span></li>
							<li>Online Marketing <span class="pull-right badge">123</span></li>
							<li>Mobiles <span class="pull-right badge">8</span></li>
							<li>Repairs <span class="pull-right badge">14</span></li>
							<li>Computer <span class="pull-right badge">60</span></li>
							<li>Transport <span class="pull-right badge">5</span></li>
							<li>Service <span class="pull-right badge">2</span></li> -->
							<?php
								$query = mysqli_query($db_conx,"SELECT * FROM category");

							while($row = mysqli_fetch_assoc($query)){
								$catid = $row["id"];
								$totalcatq = mysqli_query($db_conx,"SELECT count(*) FROM posts where category_id='$catid'");
								$cattot = mysqli_fetch_row($totalcatq);
								echo '<li>'.$row["catname"].' <span class="pull-right badge">'.$cattot["0"].'</span></li>';
							}
								?>
						</ul>
						<div class="category-head">Delivery Time</div>
						<ul>
							<li>
								<label class="fake-check-black check-text">
									<input type="checkbox" value="na" name="seller_level" class="deliverytime">
									<span class="chk-img"></span>
									Upto 24 Hours
								</label>
							 <span class="pull-right badge">22</span></li>
							<li>
								<label class="fake-check-black check-text">
									<input type="checkbox" value="na" name="seller_level" class="deliverytime">
									<span class="chk-img"></span>
									Upto 3 Days
								</label>
							 <span class="pull-right badge">22</span></li><li>
								<label class="fake-check-black check-text">
									<input type="checkbox" value="na" name="seller_level" class="deliverytime">
									<span class="chk-img"></span>
									Upto 1 Week
								</label>
							 <span class="pull-right badge">22</span></li><li>
								<label class="fake-check-black check-text">
									<input type="checkbox" value="na" name="seller_level" class="deliverytime">
									<span class="chk-img"></span>
									Any Time
								</label>
							 <span class="pull-right badge">22</span></li>
						</ul>
						<div class="category-head">Seller Level</div>
						<ul>
							<li>
								<label class="fake-check-black check-text">
									<input type="checkbox" value="na" name="seller_level" class="deliverytime">
									<span class="chk-img"></span>
									New Seller
								</label>
							 <span class="pull-right badge">22</span></li>
							<li>
								<label class="fake-check-black check-text">
									<input type="checkbox" value="na" name="seller_level" class="deliverytime">
									<span class="chk-img"></span>
									Level 1 Seller
								</label>
							 <span class="pull-right badge">22</span></li><li>
								<label class="fake-check-black check-text">
									<input type="checkbox" value="na" name="seller_level" class="deliverytime">
									<span class="chk-img"></span>
									Level 2 Seller
								</label>
							 <span class="pull-right badge">22</span></li><li>
								<label class="fake-check-black check-text">
									<input type="checkbox" value="na" name="seller_level" class="deliverytime">
									<span class="chk-img"></span>
									Top Rated Seller
								</label>
							 <span class="pull-right badge">22</span></li>
						</ul>
					</div>
					<div class="giglistbar col-sm-9">
						<div class="giglistbar-head">
							<ul class="nav nav-tabs">
								<li role="presentation" class="active"><a href="#">Top Rated</a></li>
								<li role="presentation"><a href="#">Recommended</a></li>
								<li role="presentation"><a href="#">New</a></li>
							</ul>
						</div>
						<div class="glb-gigrid">

							<?php

							$qry = mysqli_query($db_conx, 'SELECT p.*,m.username from posts p,members m where p.member_id = m.id');
							while($arr = mysqli_fetch_assoc($qry)){
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
							}

							?>
							
					</div>
					<div class="row col-xs-12 loadmoregig">
						<span>LOAD MORE</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once("include/logsign.php"); ?>
	<script type="text/javascript">
	
	</script>
</body>
</html>