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
	                <div class='col-xs-12 edit-profile-each'>
	                    <label class='col-xs-4'>
	                        STORE NAME
	                    </label>
	                    <input type='text' class='col-xs-5 form-control1 ' id="edit-store-name" />
						<!--
	                    <button type='button' class='col-xs-2 spe-button pull-right'>
	                        REQUEST
	                    </button>
-->
	                </div>
	                <div class='col-xs-12 edit-profile-each'>
	                    <label class='col-xs-4'>
	                       STORE COUNTRY
	                    </label>
	                    <select id="edit-shop-country-dropdown" class='col-xs-5 form-control1'>
		                    <option value="Malaysia">Malaysia</option>
		                    <option value="Thailand">Thailand</option>
	                    </select>
						<!--
	                    <button type='button' class='col-xs-2 spe-button pull-right'>
	                        UPDATE
	                    </button>
-->
	                </div>
	                <div class='col-xs-12 edit-profile-each'>
	                    <label class='col-xs-4'>
	                       STORE URL
	                    </label>
	                    <input type='text' class='col-xs-5 form-control1 ' id="edit-store-url" />
						<!--
	                    <button type='button' class='col-xs-2 spe-button pull-right'>
	                        UPDATE
	                    </button>
-->
	                </div>
	                <div class='col-xs-4'>
	                    
	                </div>
	                <div class='col-xs-8 edit-profile-each'>
	                    <button type='button' class=' spe-button edit-store-update-btn' style='text-align: center'>
	                        UPDATE
	                    </button>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="xs-hidden sm-hidden col-md-2">
	            
	</div>

	
	<script type="text/javascript" src="js/store.js"></script>
	
	<?php require_once('_includeJs.php'); ?>
</body>
</html>



