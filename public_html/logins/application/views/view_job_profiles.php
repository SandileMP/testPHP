<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_job_profiles; ?></h3>
				</div>
				<div class="pull-left" style="margin-left: 25px;">
					<form action="<?= $action ?>" method="post" class="form-inline">
						<input type="text" name="text_search" class="form-control" placeholder="Search Here.." required="" />
						<button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
					</form>
				</div>
				<div class="pull-right">
					<a href="<?= $create_job_profile ?>" class="btn btn-success" data-toggle="tooltip" title="<?= $button_create ?>"><i class="fa fa-plus"></i></a>
					<button type="button" onclick="$('#job_profile-list-form').attr('action','<?= $copy_job_profile ?>').submit();" class="btn btn-info" data-toggle="tooltip" title="<?= $button_copy ?>"><i class="fa fa-files-o"></i></button>
					<button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#job_profile-list-form').attr('action','<?= $remove_all_job_profile ?>').submit();" class="btn btn-danger" data-toggle="tooltip" title="<?= $button_remove ?>"><i class="fa fa-trash"></i></button>
				</div>
				<div class="clearfix"></div>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post" id="job_profile-list-form">
						<table class="table">
							<thead>
								<tr>
									<th>
										<label class="fancy-checkbox">
											<input type="checkbox" name="checkall" id="checkall" />
											<span></span>
										</label>
									</th>
									<th><?= $entry_job_profile_title ?></th>
									<th><?= $entry_job_profile_role_title ?></th>
									<th><?= $entry_job_profile_question ?></th>
									<th><?= $entry_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($job_profiles) { ?>
								<?php foreach ($job_profiles as $job_profile) { ?>
								<tr>
									<td>
										<label class="fancy-checkbox">
											<input type="checkbox" name="removecheck[]" value="<?= $job_profile->job_profile_id ?>" />
											<span></span>
										</label>
									</td>
									<td><?= $job_profile->title ?></td>
									<td><?= $job_profile->role_title ?></td>
									<td>
										<?php $question_list = json_decode($job_profile->question_list); ?>
										<?= count($question_list) ?>
									</td>
									<td>
										<a href="<?= $edit_job_profile ?>/<?= $job_profile->job_profile_id ?>" class="btn btn-info" data-toggle="tooltip" title="<?= $button_edit ?>"><i class="fa fa-pencil"></i></a>
										<a href="<?= $remove_job_profile ?>/<?= $job_profile->job_profile_id ?>" class="btn btn-danger remove_project" data-toggle="tooltip" title="<?= $button_remove ?>"><i class="fa fa-trash"></i></a>
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
$('.remove_project').click(function(){
	if(!confirm('Are You Sure?')){
		return false;
	}else{
		return true;
	}
});
</script>