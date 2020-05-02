<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<?php if($warning) { ?>
				<div class="alert alert-danger">
					<?= $warning ?>
					<button class="close" data-dismiss="alert"></button>
				</div>
				<?php } ?>
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_create_auth; ?></h3>
				</div>
				<div class="pull-right">
					<button type="button" onclick="$('#create-auth-form').submit();" class="btn btn-success" data-toggle="tooltip" title="<?= $button_save ?>"><i class="fa fa-save"></i></button>
					<a href="<?= $cancel ?>" class="btn btn-default" data-toggle="tooltip" title="<?= $button_cancel ?>"><i class="fa fa-reply"></i></a>
				</div>
				<br><br>
				<form action="<?= $action ?>" method="post" id="create-auth-form">
				<div class="panel-body">
					<label><?= $entry_auth_name ?></label>
					<input type="text" name="auth_name" class="form-control" value="<?= $auth_name ?>" placeholder="<?= $entry_auth_name ?>" />
					<?php if($error_name) { ?>
					<div class="text-danger"><?= $error_name ?></div>
					<?php } ?>
					<br>
					<label><?= $entry_auth_email ?></label>
					<input type="email" name="auth_email" class="form-control" value="<?= $auth_email ?>" placeholder="<?= $entry_auth_email ?>" />
					<?php if($error_email) { ?>
					<div class="text-danger"><?= $error_email ?></div>
					<?php } ?>
					<br>
					<?php if($this->uri->segments['2'] == 'edit_hr' || $this->uri->segments['2'] == 'edit_manager') { ?>
					<label><?= $entry_auth_password ?></label>
					<div class="input-group">
						<input type="text" name="auth_password" class="form-control" value="<?= $auth_password ?>" placeholder="<?= $entry_auth_password ?>" />
						<span class="input-group-btn">
							<button type="button" class="btn btn-danger button_generate_password"><?= $button_generate ?></button>
						</span>
					</div>
					<?php if($error_password) { ?>
					<div class="text-danger"><?= $error_password ?></div>
					<?php } ?>
					<br>
					<?php } ?>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php if($this->uri->segments['2'] == 'edit_hr' || $this->uri->segments['2'] == 'edit_manager') { ?>
<script type="text/javascript">
$('.button_generate_password').click(function(){
	$.ajax({
		url: '<?= $generate_password_url ?>',
		type: 'post',
		dataType: 'html',
		data: {},
		success: function(pass) {
			$('input[name=\'auth_password\']').val(pass);
		}
	});
});
</script>
<?php } ?>