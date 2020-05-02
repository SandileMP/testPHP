<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_candidate_list; ?></h3>
				</div>
				<div class="panel-body no-padding table-responsive">
					<form action="" method="post" id="project-list-form">
						<table class="table">
							<thead>
								<tr>
									<th><?= $entry_candidate_name ?></th>
									<th><?= $entry_candidate_email ?></th>
									<th><?= $entry_candidate_interview ?></th>
									<!-- <th><?= $entry_action ?></th> -->
								</tr>
							</thead>
							<tbody>
								<?php if($candidates) { ?>
								<?php foreach ($candidates as $candidate) { ?>
								<tr>
									<td><?= $candidate['candidate_name'] ?></td>
									<td><?= $candidate['candidate_email'] ?></td>
									<td><small><?= $candidate['candidate_interviews'] ?></small></td>
									<!-- <td class="action_buttons">
										<a href="<?= $remove_candidate ?>/<?= $candidate['candidate_id'] ?>" class="btn btn-danger remove_candidate" data-toggle="tooltip" title="<?= $button_remove ?>"><?= $button_remove ?></a>
									</td> -->
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
$('.remove_candidate').click(function(){
	if(!confirm('Are You Sure!')){
		return false;
	}else{
		return true;
	}
});
</script>