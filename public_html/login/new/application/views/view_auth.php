<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_auths; ?></h3>
				</div>
				<div class="pull-right">
					<a href="<?= $create_auth ?>" class="btn btn-success" data-toggle="tooltip" title="<?= $button_create ?>"><i class="fa fa-plus"></i></a>
					<button type="button" onclick="if(!confirm('Are You Sure!')) { return false; } else { $('#auth-list-form').attr('action','<?= $remove_all_auth ?>').submit(); }" class="btn btn-danger remove_all_auth" data-toggle="tooltip" title="<?= $button_remove ?>"><i class="fa fa-trash"></i></button>
				</div>
				<br><br>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post" id="auth-list-form">
						<table class="table">
							<thead>
								<tr>
									<th>
									<label class="fancy-checkbox">
										<input type="checkbox" name="authcheckall" id="authcheckall" />
										<span></span>
									</label>
									</th>
									<th><?= $entry_auth_id ?></th>
									<th><?= $entry_auth_name ?></th>
									<th><?= $entry_auth_email ?></th>
									<th><?= $entry_auth_type ?></th>
									<th><?= $entry_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($auths) { ?>
								<?php foreach ($auths as $auth) { ?>
								<tr>
									<td>
									<label class="fancy-checkbox">
										<input type="checkbox" name="authremovecheck[]" value="<?= $auth->auth_id ?>" />
										<span></span>
									</label>
									</td>
									<td><?= $auth->auth_id ?></td>
									<td><?= $auth->name ?></td>
									<td><?= $auth->email ?></td>
									<td><?= $auth->type ?></td>
									<td>
										<a href="<?= $edit_auth ?>/<?= $auth->auth_id ?>" class="btn btn-info" data-toggle="tooltip" title="<?= $button_edit ?>"><?= $button_edit ?></a>
										<a href="<?= $remove_auth ?>/<?= $auth->auth_id ?>" class="btn btn-danger remove_auth" data-toggle="tooltip" title="<?= $button_remove ?>"><?= $button_remove ?></a>
									</td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td colspan="8" class="text-center"><?= $text_empty ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$('#authcheckall').change(function(){
	if($('#authcheckall').prop('checked') == true){
		$('input[name=\'authremovecheck[]\']').prop('checked', true);
	}else{
		$('input[name=\'authremovecheck[]\']').prop('checked', false);
	}
});
$('.remove_auth').click(function(){
	if(!confirm('Are You Sure!')){
		return false;
	}else{
		return true;
	}
});
</script>