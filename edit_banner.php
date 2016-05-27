<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once('_includeHead.php'); ?>
</head>

<body>
	<?php require_once('_includeMainNavi.php'); ?>
	
	
	<div class="xs-hidden sm-hidden col-md-2">
		
	</div>
	<div class="main-body profile-body col-md-8 col-sm-12 col-xs-12 no-padding">
	    
		<?php require_once('_includeSideBar.php'); ?>
	
	
		<div class='col-sm-9 col-xs-12 profile-sub-body'>
	        <div class='col-xs-12' style='padding-bottom: 20px'>
	            <div class='col-xs-12'>
		            
		            <div id="edit-shop-banner"></div>
		            
					<input id="fash-banner-image" name="file" type="file" accept=".jpg,.png,.jpeg">
					<label for="fash-banner-image" id="fash-banner-image-label">
<!-- 	                Logo -->
					</label>
					
	                <div class='col-xs-12' style='text-align: center'>
	                    <button type='button' class='btn btn-success btn-xs edit-banner-update-btn' style='margin: 10px'>UPDATE BANNER</button>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	
	<div class="xs-hidden sm-hidden col-md-2">
		
	</div>

	
	<script type="text/javascript" src="js/shop_banner.js"></script>
	
	<?php require_once('_includeJs.php'); ?>
</body>
</html>



