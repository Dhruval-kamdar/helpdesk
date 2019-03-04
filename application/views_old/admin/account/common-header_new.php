
			<header>
				<div class="container">
					<h1 class="logo">
						<?php $images->image1($dbCon); ?>
					</h1>
					<?php if(isset($searchBar)) { echo $searchBar; } ?>
					<nav>
						<ul class="nav nav-pills nav-top">
							<li class="phone">
								<span style="color:#f0f0f0;font-weight:700;margin-right:25px;"><i class="icon-phone"></i> (619) 427-9154</span>
							</li>
							<li>
								<a style="color:#fff;font-weight:600;" href="https://www.google.com/maps/place/Chula+Vista+Coins+%26+Stamps/@32.635773,-117.0822674,14z/">
									Google Maps: Visit Us
								</a>
							</li>
							<?php
								if(!isset($username)){
									echo "<li>
										<a style=\"color:#fff;font-weight:600;\" href=\"../../log-in.php\">Log In</a>
									</li>";
								} else {
									echo "<li>
										<a style=\"color:#fff;font-weight:600;\" href=\"../../logout.php\">Log Out</a>
									</li>";
								}
							?>
							<li>
								<a style="color:#fff;font-weight:600;" href="<?php echo htmlspecialchars("active-shopping-cart.php?custId=$custId"); ?>">View Cart</a>
							</li>
							<li>
								<form action="<?php echo htmlspecialchars('/product-search-processor.php'); ?>" method="POST">
									<input style="width:180px; height:20px; line-height:10px; background-color:#fff;" type="text" id="search" name="search" placeholder="Search Products" class="search-box" value=""  />
									<button type="submit" id="submit" name="submit" style="box-shadow:none; border:none; height:29px; position:absolute; top:10px; right:0px; float:right; z-index:999999;" class="search-submit btn" value="submit" />Submit</button>
								</form>
							</li>
						</ul>
					</nav>
					<div class="social-icons">
					</div>
					<nav>
						<?php include ('common-menu.php'); ?>
					</nav>
				</div>
			</header>