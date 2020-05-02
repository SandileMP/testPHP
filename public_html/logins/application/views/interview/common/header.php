<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/icon/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

	<?php 
	echo loadCss([
	"assets/css/bootstrap.min.css",
	"assets/vendor/font-awesome/css/font-awesome.min.css",
	"assets/vendor/linearicons/style.css",
	"assets/css/main.css",
	"assets/css/jquery-confirm.css",
    "assets/css/custom_new.css",
	]);
	?>

	<?php 
	echo loadJs([
		"assets/vendor/jquery/jquery.min.js",
		"assets/scripts/jquery-confirm.js",
	]);
	?>
	<script type="text/javascript">
        var siteBaseUrl = "<?= base_url() ?>";
	</script>
</head>
<body>
<div id="wrapper" class="e-interview-access-page">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-btn">
				<a href="<?= $dashboard ?>" class="btn-toggle-fullwidth navbar-btn-button"><i class="lnr lnr-arrow-left-circle"></i><span class="menu-text"><?= 'Home' ?></span></a>

                <?php /* ?>
                <button type="button" class="btn-toggle-fullwidth "><i class="lnr lnr-arrow-left-circle"></i><span class="menu-text"><?= 'Home' ?></span></button>
                <? */ ?>
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
