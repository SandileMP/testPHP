<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/icon/favicon.png">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-confirm.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<script type="text/javascript" src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/scripts/jquery-confirm.js"></script>
    <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <script src="https://cdn.webrtc-experiment.com/DetectRTC.js"> </script>
    <script src="https://cdn.webrtc-experiment.com/getHTMLMediaElement.js"></script>
</head>
<body>
<div id="wrapper">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-btn">
				<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
			</div>
			<div class="brand">
				<a href="<?= $dashboard ?>"><img src="<?= base_url() ?>assets/img/e-interview logo.png" alt="AH Logo" class="img-responsive logo"></a>
			</div>
			<div id="navbar-menu">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="<?= $logout ?>"><i class="lnr lnr-exit"></i> <span><?= $text_logout ?></span></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>