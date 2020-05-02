<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=$dashboard?>" <?php if ($this->uri->segments[1] == 'dashboard' || $this->uri->segments[1] == 'candidate_dashboard') {?> class="active" <?php }?>><i class="fa fa-dashboard"></i> <span><?=$text_dashboard?></span></a></li>
				
				<?php if ($userDetail['type'] == 'ADMIN') {?>
				<li><a href="<?=$create_distributor?>" <?php if ($this->uri->segments[1] == 'distributor') {?> class="active" <?php }?>><i class="fa fa-user-secret"></i> <span><?=$text_create_distributor?></span></a></li>
				<li><a href="<?=base_url('credit/managecreditrequest')?>" <?php if ($this->uri->segments[1] == 'credit' && $this->uri->segments[2] == 'managecreditrequest') {?> class="active" <?php }?>><i class="fa fa-credit-card"></i> <span>Credit Requests</span></a></li>
				<?php } ?>
				<?php if ($userDetail['type'] == 'DISTRIBUTOR') {?>
				<li><a href="<?=$create_account_manager?>" <?php if ($this->uri->segments[1] == 'account_manager') {?> class="active" <?php }?>><i class="fa fa-user-secret"></i> <span><?=$text_create_account_manager?></span></a></li>
				<li><a href="<?=base_url('credit/managecredit')?>" <?php if ($this->uri->segments[1] == 'credit' && $this->uri->segments[2] == 'managecredit') {?> class="active" <?php }?>><i class="fa fa-credit-card"></i> <span>My Credits</span></a></li>
				<li><a href="<?=base_url('credit/managecreditrequest')?>" <?php if ($this->uri->segments[1] == 'credit' && $this->uri->segments[2] == 'managecreditrequest') {?> class="active" <?php }?>><i class="fa fa-credit-card"></i> <span>Client Credit Requests</span></a></li>
				<?php } ?>
				<?php if ($userDetail['type'] == 'ACCOUNT MANAGER') {?>
				<li><a href="<?=$create_manager?>" <?php if ($this->uri->segments[1] == 'manager') {?> class="active" <?php }?>><i class="fa fa-user-o"></i> <span><?=$text_create_manager?></span></a></li>
				<li><a href="<?=$account_manager_project?>" <?php if ($this->uri->segments[1] == 'account_manager_project') {?> class="active" <?php }?>><i class="fa fa fa-tasks"></i> <span><?=$text_account_manager_project?></span></a></li>
				<li><a href="<?=base_url('credit/managecredit')?>" <?php if ($this->uri->segments[1] == 'credit' && $this->uri->segments[2] == 'managecredit') {?> class="active" <?php }?>><i class="fa fa-credit-card"></i> <span>My Credit</span></a></li>
				<?php }?>
				<?php if ($userDetail['type'] == 'MANAGER') {?>
				<li><a href="<?=$create_rater?>" <?php if ($this->uri->segments[1] == 'rater') {?> class="active" <?php }?>><i class="fa fa-user-o"></i> <span><?=$text_create_rater?></span></a></li>
				<li><a href="<?=$create_job_profile?>" <?php if ($this->uri->segments[1] == 'job_profile') {?> class="active" <?php }?>><i class="fa fa-suitcase"></i><span><?=$text_create_job_profile?></span></a></li>
				<li><a href="<?=$create_project?>" <?php if (!isset($this->uri->segments[2]) && $this->uri->segments[1] == 'project') {?> class="active" <?php }?>><i class="fa fa-tasks"></i><span><?=$text_create_project?></span></a></li>
				<li><a href="<?=$all_project?>" <?php if (isset($this->uri->segments[2]) && $this->uri->segments[2] == 'all') {?> class="active" <?php }?>><i class="fa fa-tasks"></i><span><?=$text_all_project?></span></a></li>
				<!-- <li><a href="<?=base_url('project/dinterviews')?>" <?php if (isset($this->uri->segments[2]) && ($this->uri->segments[2] == 'interview_project' || $this->uri->segments[2] == 'dinterviews')) {?> class="active" <?php }?>><i class="fa fa-eye"></i><span><?=$text_view_interview?></span></a></li> -->
				<li><a href="<?=base_url('eTemplate')?>" <?php if ($this->uri->segments[1] == 'eTemplate') {?> class="active" <?php }?>><i class="fa fa-envelope"></i> <span>Email Templates</span></a></li>
				<?php }?>
				<?php if ($userDetail['type'] == 'RATER') {?>
				<li><a href="<?=$rater_project?>" <?php if ($this->uri->segments[1] == 'rater_project') {?> class="active" <?php }?>><i class="fa fa-user-o"></i> <span><?=$text_rater_project?></span></a></li>
				<?php }?>
				<?php if ($userDetail['type'] == 'CANDIDATE') {?>
				<li class="test_recording"><a href="<?= $test_action ?>"><i class="fa fa-eye"></i><span><?=$test_interview?></span></a></li>
				<?php if ($practice_now) {?>
				<li><a href="<?= $practice_action ?>" class="<?= ($this->uri->segments[1] == 'practice') ? "active" : "" ?>"><i class="fa fa-eye"></i><span><?=$practice_interview?></span></a></li>
				<?php } ?>
				<li><a href="<?=$candidate_interview?>" <?php if ($this->uri->segments[1] == 'candidate_interview') {?> class="active" <?php }?>><i class="fa fa-eye"></i><span><?=$text_candidate_interview?></span></a></li>
				<?php }?>
			</ul>
		</nav>
	</div>
</div>
<?php if ($user_type === 'CANDIDATE') {?>
<?php /*?>
<script type="text/javascript">

$(document).delegate('.test_recording','click',function(event){
	event.preventDefault();
	var url = $(this).find('a').attr('href');
    var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    var isFirefox = typeof InstallTrigger !== 'undefined';
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);
    var isIE = /*@cc_on!@*/ /* false || !!document.documentMode;
    var isEdge = !isIE && !!window.StyleMedia;
    var isChrome = !!window.chrome && !!window.chrome.webstore;
    var isBlink = (isChrome || isOpera) && !!window.CSS;

   if(isEdge == true || isOpera == true || isSafari == true || isIE == true){
        return false;	
    }else{
	    navigator.getUserMedia = navigator.getUserMedia ||
	                            navigator.webkitGetUserMedia ||
	                            navigator.mozGetUserMedia ||
	                            navigator.msGetUserMedia;

	    if (navigator.getUserMedia) {
	        navigator.getUserMedia({ audio: true, video: { width: 1280, height: 720 } },
	            function(stream) {
	                window.location.href = url;
	            },
	            function(err) {
	                console.log("The following error occurred: " + err.name);
	                return false;
	            }
	        );
	    } else {
	        return false;
	    }
    }
});
</script>
 <?php */?>
<?php }?>
