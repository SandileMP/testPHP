<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_candidates; ?></h3>
				</div>
				<div class="pull-right">
					<a href="<?= $cancel ?>" class="btn btn-default" data-toggle="tooltip" title="<?= $button_cancel ?>"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
				<div class="panel-body no-padding table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th><?= $entry_candidate_name ?></th>
								<th><?= $entry_test_completed ?></th>
								<th><?= $entry_status ?></th>
								<th><?= $entry_action ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if($candidates) { ?>
							<?php foreach ($candidates as $candidate) { ?>
							<tr>
								<td><?= $candidate['candidate_name'] ?></td>
								<td><?= $candidate['test_completed'] ?> / <?= $candidate['total_test'] ?></td>
								<td>
									<?php if($candidate['test_completed'] != 0) { ?>
									<label class="label label-success">Completed</label>
									<?php } else { ?>
									<label class="label label-warning">Not Completed</label>
									<?php } ?>
								</td>
								<td>
									<button type="button" name="send_detail" class="btn btn-info send_detail" data-toggle="tooltip" value="<?= $candidate['candidate_id'] ?>" title="<?= $text_resend_login_detail ?>"><i class="fa fa-info"></i></button>
								</td>
							</tr>
							<?php } ?>
							<?php } else { ?>
							<tr>
								<td colspan="4" class="text-center"><?= $text_empty_candidate ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$('.send_detail').click(function(){
	var id = $(this).val();
	var _this = $(this);
	$.ajax({
		url: '<?= $send_login_detail_url ?>',
		type: 'post',
		data: {
			'candidate_id':id,
		},
		dataType: 'text',
		beforeSend:function(){
			$(_this).html('<i class="fa fa-spinner fa-spin"></i>');
		},
		success: function(data) {
			if(data){
				$('#project_link_model').modal('hide');
			}
		},
		complete: function() {
			$(_this).html('<i class="fa fa-info"></i>');
		}
	});
});
</script>