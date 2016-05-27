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
	            <div class='col-xs-4'>
		            <div id="edit-profile-logo"></div>
		            
					<input id="fash-profile-image" name="file" type="file" accept=".jpg,.png,.jpeg">
					<label for="fash-profile-image" id="fash-profile-image-label">
<!-- 	                Logo -->
					</label>
<!-- 	                <button type='button' class='col-xs-12 spe-button' style='margin-top: 5px'>EDIT LOGO</button> -->
	            </div>
	            <div class='col-xs-8'>
	                <div class='col-xs-12 edit-profile-each'>
	                    <label class='col-xs-4'>
	                        USERNAME
	                    </label>
	                    <input type='text' class='col-xs-8 form-control1' id='edit-profile-username'/>
	                </div>
	                <div class='col-xs-12 edit-profile-each'>
	                    <label class='col-xs-4'>
	                        NAME
	                    </label>
	                    <input type='text' class='col-xs-8 form-control1' id='edit-profile-name'/>
	                </div>
	                <div class='col-xs-12 edit-profile-each'>
	                    <label class='col-xs-4'>
	                        EMAIL
	                    </label>
	                    <input type='text' class='col-xs-8 form-control1' id='edit-profile-email'/>
	                </div>
	                <div class='col-xs-12 edit-profile-each'>
	                    <label class='col-xs-4'>
	                        DESCRIPTION
	                    </label>
	                    <textarea class='col-xs-8 form-control1' id='edit-profile-desc' style='height: 80px'></textarea>
	                </div>
	                <div class='col-xs-12 edit-profile-each'>
	                    <button type='button' class=' spe-button edit-profile-update-btn' style='text-align: center'>
	                        UPDATE
	                    </button>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	
	<div class="xs-hidden sm-hidden col-md-2">
		
	</div>

	
	<script type="text/javascript" src="js/member.js"></script>
	
	<?php require_once('_includeJs.php'); ?>
</body>
</html>



