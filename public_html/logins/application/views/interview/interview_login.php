<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title>Login | Interview</title>
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
	]);
	
	echo loadJs(['assets/vendor/jquery/jquery.min.js']);
	?>
</head>
<body>
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle container">
				<div class="row" id="logo">
					<div class="col-sm-4 col-sm-offset-4">
						<div class="logo text-center"><img src="<?= base_url() ?>assets/img/e-interview logo.png" alt="AH Logo" /></div>	
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-sm-offset-4 login-box">
						<div class="content">
							<?php if(isset($login_error)) { ?>
							<div class="alert alert-danger">
								<?php echo $login_error; ?>
								<button type="button" class="close" data-dismiss="alert">×</button>
								</div>
							<?php } ?>
							<div class="header">
								<p class="lead">Login For Interview</p>
							</div>
							<form class="form-auth-small" action="<?= $action ?>" method="post">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only" required>Email</label>
									<input type="email" class="form-control" name="signin-email" id="signin-email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only" required>Password</label>
									<input type="password" class="form-control" name="signin-password" id="signin-password" placeholder="Password" autocomplete="off">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
								<a href="<?= $signup ?>">
									<button type="button" class="btn btn-block btn-default" style="margin-top: 5px;">REGISTER</button>
								</a>
							</form>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
