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
	
	echo loadJs(['assets/vendor/jquery/jquery.min.js']);
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
				<div class="row" style="margin-bottom: 50px;">
					<div class="col-sm-4 col-sm-offset-4 login-box">
						<div class="content">
							<?php if (isset($login_error)) {?>
							<div class="alert alert-danger">
								<?php echo $login_error; ?>
								<button type="button" class="close" data-dismiss="alert">×</button>
								</div>
							<?php }?>
							<div class="header">
								<p class="lead" style="color: white;">Login to your account</p>
							</div>
							<form class="form-auth-small" action="<?=base_url()?>" method="post">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only" required>Email</label>
									<input type="email" class="form-control" name="signin-email" id="signin-email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only" required>Password</label>
									<input type="password" class="form-control" name="signin-password" id="signin-password" placeholder="Password" autocomplete="off">
									<a href="javascript:void(0)" class="pull-right btn_forgot_password" style="padding: 10px;color: white;">Forgot Password?</a>
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="forgot-password">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Forgot Password</h4>
				</div>
				<div class="modal-body">
					<div class="message"></div>
					<form id="forgot-form" method="post">
						<div class="form-group">
							<label class="control-label">Email :</label>
							<input type="email" name="forgot-email" class="form-control" placeholder="Email Address" required="" />
						</div>
						<div class="form-group form-inline hide">
							<label class="control-label">I want to reset my :</label>
							<select name="forgot-account" class="form-control">
								<option value="">Select</option>
								<option value="DISTRIBUTOR">Distributor Login</option>
								<option value="ACCOUNT MANAGER">Account Manager Login</option>
								<option value="MANAGER">Manager Login</option>
								<option value="RATER">Rater Login</option>
							</select>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success submit_forgot_password">SUBMIT</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$('.btn_forgot_password').click(function(){
		$('#forgot-password').modal('show');
	});
	$('.submit_forgot_password').click(function(){
		$.ajax({
			url: '<?=$forgot_action?>',
			type: 'POST',
			data: $('#forgot-form').serialize(),
			dataType: 'json',
			success: function(json) {
				var html = '';
				if(json.error){
					html += '<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Warning: '+json.error+'<button type="button" class="close" data-dismiss="alert">×</button></div>'
				}
				if(json.success){
					html += '<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> Success: '+json.success+'<button type="button" class="close" data-dismiss="alert">×</button></div>'
				}
				$('#forgot-password .modal-body .message').html(html);
				$('#forgot-form input').val('');
			}
		});
	});
	</script>
	<script type="text/javascript" src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
