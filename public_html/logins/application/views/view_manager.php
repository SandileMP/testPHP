<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_manager; ?></h3>
				</div>
				<div class="pull-left" style="margin-left: 25px;">
					<form action="<?= $action ?>" method="post" class="form-inline">
						<input type="text" name="text_search" class="form-control" placeholder="Search Here.." required="" />
						<button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
					</form>
				</div>
				<div class="pull-right">
					<a href="<?= $create ?>" class="btn btn-success" data-toggle="tooltip" title="<?= $button_create ?>"><i class="fa fa-plus"></i></a>
					<button type="button" onclick="if(!confirm('Are You Sure?')) { return false; } else { $('#auth-list-form').attr('action','<?= $remove_all ?>').submit(); }" class="btn btn-danger remove_all" data-toggle="tooltip" title="<?= $button_remove ?>"><i class="fa fa-trash"></i></button>
				</div>
				<div class="clearfix"></div>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post" id="auth-list-form">
						<table class="table">
							<thead>
								<tr>
									<th>
									<label class="fancy-checkbox">
										<input type="checkbox" name="checkall" id="checkall" />
										<span></span>
									</label>
									</th>
									<th><?= $label_manager_name ?></th>
									<th><?= $label_manager_department ?></th>
									<th><?= $label_manager_email ?></th>
									<th><?= $label_manager_status ?></th>
									<th><?= $label_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($managers) { ?>
								<?php foreach ($managers as $manager) { ?>
								<tr>
									<td>
									<label class="fancy-checkbox">
										<input type="checkbox" name="removecheck[]" value="<?= $manager->manager_id ?>" />
										<span></span>
									</label>
									</td>
									<td><?= $manager->name ?></td>
									<td><?= $manager->department ?></td>
									<td><?= $manager->email ?></td>
									<td> <btn class="label <?=$manager->status == 1 ? 'label-success' : 'label-danger'?>"><?=$manager->status == 1 ? 'Activate' : 'Deactivate'?></btn> </td>
									<td>
										<a href="<?= $edit ?>/<?= $manager->manager_id ?>" class="btn btn-info" data-toggle="tooltip" title="<?= $button_edit ?>"><i class="fa fa-pencil"></i></a>
										<a href="<?= $remove ?>/<?= $manager->manager_id ?>" class="btn btn-danger remove" data-toggle="tooltip" title="<?= $button_remove ?>"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td colspan="6" class="text-center"><?= $text_empty ?></td>
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
$('#checkall').change(function(){
	if($('#checkall').prop('checked') == true){
		$('input[name=\'removecheck[]\']').prop('checked', true);
	}else{
		$('input[name=\'removecheck[]\']').prop('checked', false);
	}
});
$('.remove').click(function(){
	if(!confirm('Are You Sure?')){
		return false;
	}else{
		return true;
	}
});
</script>