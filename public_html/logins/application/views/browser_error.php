<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title>Login | Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>assets/img/icon/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<?php 
	echo loadCss([
	"assets/css/bootstrap.min.css",
	"assets/vendor/font-awesome/css/font-awesome.min.css",
	"assets/vendor/linearicons/style.css",
	"assets/css/main.css",
	]);
	
	echo loadJs(["assets/vendor/jquery/jquery.min.js"]);
	?>		
</head>
<body id="login-body">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle container">
				<div class="row" id="logo">
					<div class="col-sm-4 col-sm-offset-4">
						<div class="logo text-center"><img src="<?=base_url()?>assets/img/e-interview logo.png" alt="AH Logo" /></div>
					</div>
				</div>
				<div class="row" style="margin-bottom: 50px; background-color: #ffffff; padding: 50px 20px">
					<div class="header text-center">
                        <h4> This interview has to be completed on Latest Google chrome, Firefox.<br /> </h4>
						<h4> For iOS, iPad and iPhone please use Safari Browser <br /> </h4>
						<h4> For Android devices please use Chrome browser <br /> </h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
