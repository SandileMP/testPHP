<!doctype html>
<html lang="en">
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/icon/favicon.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
	<link href="//vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
	<?php 
	echo loadCss([
	"assets/vendor/bootstrap/css/bootstrap.min.css",
	"assets/vendor/font-awesome/css/font-awesome.min.css",
	"assets/vendor/linearicons/style.css",
	"assets/vendor/chartist/css/chartist-custom.css",
	"assets/vendor/toastr/toastr.min.css",
	"assets/css/main.css",
	"assets/css/mediaelementplayer.css",
	"assets/css/demo.css",
	"assets/datetimepicker/bootstrap-datetimepicker.min.css",
	"assets/css/jquery-confirm.css",
    "assets/vendor/jQuery-Picklist/dist/css/picklist.css",
	"assets/vendor/plyr/dist/plyr.css",
	"assets/css/custom_new.css"]
	);
	?>
	
	<?php 
	echo loadJs([
		"assets/vendor/jquery/jquery.min.js",
		"assets/scripts/jquery-confirm.js"]
	);
	?>

	<?php if($this->session->userdata['user_type'] != 'ADMIN' && $this->session->userdata['user_type'] != 'CANDIDATE') { ?>
	<script type="text/javascript">
		setInterval(function() {
			//$("#navbar-menu .navbar-right").load("<?= base_url() ?>dashboard .navbar-right");
		}, 5000);
		var siteBaseUrl = "<?= base_url() ?>";
	</script>
	<?php } ?>
</head>
<body>
	<div id="wrapper" class="e-interview-page">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="mobile-logo hidden-lg hidden-md hidden-sm">
					<a href="<?= $dashboard ?>"><img src="<?= base_url() ?>assets/img/e-interview logo.png" alt="AH Logo" class="img-responsive logo"></a>
				</div>
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth">
                        <i class="lnr lnr-arrow-left-circle"></i>
                        <span class="menu-text">Menu</span>
                    </button>
				</div>
				<div class="brand">
					<a href="<?= $dashboard ?>"><img src="<?= base_url() ?>assets/img/e-interview logo.png" alt="AH Logo" class="img-responsive logo"></a>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<?php if(isset($this->session->userdata['switch_role']) && !empty($this->session->userdata['switch_role'])) :?>
						<li>
							<form action="<?php echo base_url('dashboard/switchRole')?>" method="post" style="padding: 28px 20px">
								<?php echo form_dropdown(array('name' => 'role','class' => 'form-control','onchange' => 'this.form.submit()'), $this->session->userdata['switch_role'], $this->session->userdata['user_type']) ?>
							</form>
						</li>
						<?php endif;?>

						<?php if($this->session->userdata['user_type'] != 'ADMIN' && $this->session->userdata['user_type'] != 'DISTRIBUTOR' && $this->session->userdata['user_type'] != 'RATER' && $this->session->userdata['user_type'] != 'CANDIDATE') { ?>
						<li class="dropdown" id="notification-dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<?php if($interviewCompleted) { ?>
								<span class="badge bg-danger"><?= count($interviewCompleted) ?></span>
								<?php } else { ?>
								<span class="badge bg-danger"></span>
								<?php } ?>
							</a>
							<ul class="dropdown-menu notifications">
								<?php if($interviewCompleted) { ?>
								<?php foreach ($interviewCompleted as $interview) { ?>
								<li><a href="<?= base_url() ?>project" class="notification-item">
									<div class="row">
										<div class="col-sm-1 icon"><i class="dot bg-success"></i></div>
										<div class="col-sm-10 text"><?= $interview->firstname ?>&nbsp;<?= $interview->lastname ?><br>Interview Completed</div>
									</div>
								</a></li>
								<?php } ?>
								<?php } else { ?>
								<li><a href="javascript:void(0);" class="notification-item">
									<div class="row">
										<div class="col-sm-12 more">No More Notification!!</div>
									</div>
								</a></li>
								<?php } ?>
							</ul>
						</li>
						<?php } ?>
						<li title="<?= $text_profile ?>"><a href="<?= $profile ?>"><i class="fa fa-user-o"></i> <span><?= $userDetail['name'] ?></span></a></li>
						<li title="<?= $text_logout ?>"><a href="<?= $logout ?>"><i class="fa fa-power-off text-danger"></i></a></li>
					</ul>
				</div>
			</div>
		</nav>
