
<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
				$getLastestDell = $product->getLastestDell();
					if ($getLastestDell) {
						while($resultdell = $getLastestDell->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/uploads/<?php echo $resultdell['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Dell</h2>
						<p><?php echo $resultdell['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>

			   <?php
					}
				}
			   ?>
			   <?php
				$getLastestMsi = $product->getLastestMsi();
					if ($getLastestMsi) {
						while($resultmsi = $getLastestMsi->fetch_assoc()){
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/uploads/<?php echo $resultmsi['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Msi</h2>
						  <p><?php echo $resultmsi['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultmsi['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
					}
				}
			   ?>
			</div>
			<div class="section group">
				<?php
				$getLastestAsus = $product->getLastestAsus();
					if ($getLastestAsus) {
						while($resultasus = $getLastestAsus->fetch_assoc()){
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/uploads/<?php echo $resultasus['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Asus</h2>
						<p><?php echo $resultasus['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultasus['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php
					}
				}
			   ?>
			   <?php
				$getLastestApple = $product->getLastestApple();
					if ($getLastestApple) {
						while($resultapple = $getLastestApple->fetch_assoc()){
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/uploads/<?php echo $resultapple['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Apple</h2>
						  <p><?php echo $resultapple['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultapple['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				  <?php
					}
				}
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	