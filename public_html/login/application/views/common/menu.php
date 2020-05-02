<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=$dashboard?>" <?php if ($this->uri->segments[1] == 'dashboard' || $this->uri->segments[1] == 'candidate_dashboard') {?> class="active" <?php }?>><i class="fa fa-dashboard"></i> <span><?=$text_dashboard?></span></a></li>
				<?php if ($userDetail['type'] == 'ADMIN') {?>
				<li><a href="<?=$create_hr?>" <?php if ($this->uri->segments[1] == 'hr') {?> class="active" <?php }?>><i class="fa fa-user-secret"></i> <span><?=$text_create_hr?></span></a></li>

				<li>
					<a href="<?=base_url('credit/managecreditrequest')?>" <?php if ($this->uri->segments[1] == 'credit') {?> class="active" <?php }?>>
						<i class="fa fa-credit-card"></i> <span>Credit Requests</span>
					</a>
				</li>

				<?php }?>
				<?php if ($userDetail['type'] == 'CLIENT') {?>
				<li><a href="<?=$create_manager?>" <?php if ($this->uri->segments[1] == 'manager') {?> class="active" <?php }?>><i class="fa fa-user-o"></i> <span><?=$text_create_manager?></span></a></li>
				<li><a href="<?=$create_job_profile?>" <?php if ($this->uri->segments[1] == 'job_profile') {?> class="active" <?php }?>><i class="fa fa-suitcase"></i><span><?=$text_create_job_profile?></span></a></li>
				<li><a href="<?=$create_project?>" <?php if (!isset($this->uri->segments[2]) && $this->uri->segments[1] == 'project') {?> class="active" <?php }?>><i class="fa fa-tasks"></i><span><?=$text_create_project?></span></a></li>
				<li><a href="<?=base_url('project/dinterviews')?>" <?php if (isset($this->uri->segments[2]) && ($this->uri->segments[2] == 'interview_project' || $this->uri->segments[2] == 'dinterviews')) {?> class="active" <?php }?>><i class="fa fa-eye"></i><span><?=$text_view_interview?></span></a></li>

				<li>
					<a href="<?=base_url('credit/managecredit')?>" <?php if ($this->uri->segments[1] == 'credit') {?> class="active" <?php }?>>
						<i class="fa fa-credit-card"></i> <span>Credit</span>
					</a>
				</li>
                <li>
					<a href="<?=base_url('eTemplate')?>" <?php if ($this->uri->segments[1] == 'eTemplate') {?> class="active" <?php }?>>
						<i class="fa fa-envelope"></i> <span>Email Templates
</span>
					</a>
				</li>

				<?php }?>
				<?php if ($userDetail['type'] == 'MANAGER') {?>
				<li><a href="<?=base_url('project/dinterviews')?>" <?php if ($this->uri->segments[1] == 'manage_project') {?> class="active" <?php }?>><i class="fa fa-tasks"></i><span><?=$text_manage_interview?></span></a></li>
				<?php }?>
				<?php if ($userDetail['type'] == 'CANDIDATE') {?>
				<li id="test_recording"><a href="javascript:void(0)"><i class="fa fa-eye"></i><span><?=$test_interview?></span></a></li>
				<li><a href="<?=$candidate_interview?>" <?php if ($this->uri->segments[1] == 'candidate_interview') {?> class="active" <?php }?>><i class="fa fa-eye"></i><span><?=$text_candidate_interview?></span></a></li>
				<?php }?>
			</ul>
		</nav>
	</div>
</div>
<?php if ($user_type === 'CANDIDATE') {
$class = new Device_detect();
$info = $class->getInfo()['browser'];
?>
<script type="text/javascript">
$(document).delegate('#test_recording','click',function(){
	var browser = '<?php echo $info; ?>';
   if(browser !== "Chrome" && browser !== "Firefox"){
    	$.alert({
            title: 'Error',
            icon: 'fa fa-warning',
            type: 'red',
            content: 'Your Browser does not supported video recording!',
        });
        return false;	
    }else{
	    navigator.getUserMedia = navigator.getUserMedia ||
	                            navigator.webkitGetUserMedia ||
	                            navigator.mozGetUserMedia ||
	                            navigator.msGetUserMedia;

	    if (navigator.getUserMedia) {
	        navigator.getUserMedia({ audio: true, video: { width: 1280, height: 720 } },
	            function(stream) {
	                window.location.href = '<?=$test_action?>';
	            },
	            function(err) {
	                $.alert({
		                title: 'Error',
		                icon: 'fa fa-warning',
		                type: 'red',
		                content: 'Web Cam Device Not Found!',
		            });
	                console.log("The following error occurred: " + err.name);
	                return false;
	            }
	        );
	    } else {
	    	if(browser !== "Chrome"){
		        $.alert({
		            title: 'Error',
		            icon: 'fa fa-warning',
		            type: 'red',
		            content: 'Your Browser does not supported User Media!',
		        });
		        return false;
		    }
	    }
    }
});
</script>
<?php }?>