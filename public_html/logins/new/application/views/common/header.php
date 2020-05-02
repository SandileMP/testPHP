<!doctype html>
<html lang="en">
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/chartist/css/chartist-custom.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/toastr/toastr.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/mediaelementplayer.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/demo.css">
	<link href="<?= base_url() ?>assets/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/icon/favicon.png">
	<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
	<?php if($this->session->userdata['user_type'] != 'ADMIN' && $this->session->userdata['user_type'] != 'CANDIDATE') { ?>
	<script type="text/javascript">
		setInterval(function() {
			$("#navbar-menu .navbar-right").load("<?= base_url() ?>dashboard .navbar-right");
		}, 5000);
	</script>
	<?php } ?>
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="<?= $dashboard ?>"><img src="<?= base_url() ?>assets/img/e-interview logo.png" alt="AH Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<?php if($this->session->userdata['user_type'] != 'ADMIN' && $this->session->userdata['user_type'] != 'CANDIDATE') { ?>
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
										<div class="col-sm-10 text"><?= $interview->candidate_name ?><br>Interview Completed</div>
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