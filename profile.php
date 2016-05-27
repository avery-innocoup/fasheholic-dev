<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once('_includeHead.php'); ?>
</head>

<body>
	<?php require_once('_includeMainNavi.php'); ?>
	
	
	<div class="xs-hidden sm-hidden col-md-2">
	            
	</div>
	<div class="main-body col-md-8 col-sm-12 col-xs-12">
		<div id="profile-banner"></div>
		
	    <div class="col-xs-12 noo-yoo">
	        <div class="col-xs-12">
	            <div class="col-sm-3 col-xs-12 no-padding" id="profile-logo">
					
	            </div>
	            <div class="col-sm-9 col-xs-12 noo-yoo-text">
	                <h5 class="col-xs-12" id="profile-shop-name"></h5>
	                <h6 class="col-xs-12" id="profile-desc"></h6>
	            </div>
	        </div>
	        <div class="col-xs-12">
	            <div class="col-sm-3 col-xs-12">
	                <div class="col-xs-12">
		                <a href="edit_profile.php">
	                    	<button class="col-xs-12 edit-button">EDIT</button>
		                </a>
	                </div>
	            </div>
				<!--
	            <div class="col-sm-9 col-xs-12">
	                <div class="col-xs-12">
	                    <img src="images/social_media.png" style="max-width: 100%"/>
	                </div>
	            </div>
-->
	        </div>
	        
	    </div>
	    <div class="col-xs-12 products-button-text-area ">
	              <button type="button" class="btn btn-default">PRODUCTS</button>
	        </div>
	    <div class="col-xs-12 product-container " id="profile-product-container">
	        
	    </div>
	</div>
	<div class="xs-hidden sm-hidden col-md-2">
	            
	</div>

	
	<script type="text/javascript" src="js/profile.js"></script>
	
	<?php require_once('_includeJs.php'); ?>
</body>
</html>



