<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_invite_interview; ?></h3>
				</div>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post" id="project-list-form">
						<table class="table">
							<thead>
								<tr>
									<th><?= $entry_project_id ?></th>
									<th><?= $entry_project_name ?></th>
									<th><?= $entry_job_profile_name ?></th>
									<th><?= $entry_project_candidate ?></th>
									<th><?= $entry_project_type ?></th>
									<th><?= $entry_project_notification ?></th>
									<th><?= $entry_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($projects) { ?>
								<?php foreach ($projects as $project) { ?>
								<tr>
									<td><?= $project['project_id'] ?></td>
									<td><?= $project['project_name'] ?></td>
									<td><?= $project['profile_name'] ?></td>
									<td>
										<?php foreach ($project['candidate'] as $candidate_name) { ?>
										<small class="text-capitalize"><?= $candidate_name ?></small><br>
										<?php } ?>
									</td>
									<td class="text-uppercase">
										<?php if($project['project_type'] == 'open') { ?>
										<?= $project['project_type'] ?>
										<br>
										<small><?= $project['start_date'] ?></small>
										<?php } else { ?>
										<?= $project['project_type'] ?>
										<br>
										<small><?= $project['start_date'] ?></small>
										<br>
										<small><?= $project['end_date'] ?></small>
										<?php } ?>
									</td>
									<td class="text-uppercase"><?= $project['notification'] ?></td>
									<td class="action_buttons">
										<?php if(!in_array($project['project_id'],$invited_projects)){ ?>
										<button type="button" class="btn btn-info invite_button" value="<?= $project['project_id'] ?>" data-toggle="tooltip" title="<?= $button_invite ?>"><?= $button_invite ?></button>
										<?php } else { ?>
										<button type="button" class="btn btn-info" disabled><?= $button_invited ?></button>
										<?php } ?>
									</td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td colspan="7" class="text-center"><?= $text_empty ?></td>
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
<div class="modal fade" id="invite-model">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?= $text_invite_model ?></h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="invite_project_id" id="invite_project_id" />
				<div class="form-group">
					<label><?= $entry_invite_basic_note ?></label>
					<textarea name="basic_note" id="basic_note" class="form-control" rows="7" placeholder="<?= $entry_invite_basic_note ?>" style="resize: none;"></textarea>
					<div class="text-danger error_basic_note"></div>
				</div>
				<button type="button" id="invite" name="invite" class="btn btn-success"><?= $button_invite ?></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="invite-model-success">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body" align="center">
				<h3 class="text-center text-success"></h3>
				<button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true">OK</button>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$('#projectcheckall').change(function(){
	if($('#projectcheckall').prop('checked') == true){
		$('input[name=\'projectremovecheck[]\']').prop('checked', true);
	}else{
		$('input[name=\'projectremovecheck[]\']').prop('checked', false);
	}
});
$('.remove_project').click(function(){
	if(!confirm('Are You Sure!')){
		return false;
	}else{
		return true;
	}
});
$('.invite_button').click(function(){
	var id = $(this).val();
	$('.this-invited').parents('.action_buttons').removeClass('this-invited');
	$(this).parents('.action_buttons').addClass('this-invited');
	$('#invite_project_id').val(id);
	$('#invite-model').modal('show');
});
$('#invite').click(function(){
	var _this = $('.this-invited');
	var id = $('#invite_project_id').val();
	var basic_note = $('#basic_note').val();
	$.ajax({
		url: '<?= $invite ?>',
		type: 'POST',
		dataType: 'json',
		data: {
			'project_id' : id,
			'note' : basic_note,
		},
		beforeSend: function(){
			$('#invite').text('Loading...');
		},
		success: function(data) {
			if(data.error_basic_note){
				$('.error_basic_note').text(data.error_basic_note);
			}else{
				$('#basic_note').val('');
				$('#invite-model').modal('hide');
				$('#invite-model-success h3').text(data.success);
				$('#invite-model-success').modal('show');
				$(_this).empty();
				$(_this).html('<button type="button" class="btn btn-info" disabled><?= $button_invited ?></button>')
				$(_this).removeClass('this-invited');
			}
		},
		complete: function(){
			$('#invite').text('Invite');
		}
	});
});
</script>