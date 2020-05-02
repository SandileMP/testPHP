<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_projects; ?></h3>
				</div>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post" id="project-list-form">
						<table class="table">
							<thead>
								<tr>
									<th><?= $entry_project_start ?></th>
									<th><?= $entry_project_end ?></th>
									<th><?= $entry_project_name ?></th>
									<th><?= $entry_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($projects) { ?>
								<?php foreach ($projects as $project) { ?>
								<tr>
									<td>
										<?= $project['start_date'] ?>
									</td>
									<td class="text-uppercase">
										<?php if($project['project_type'] == 'open') { ?>
										<?= $project['project_type'] ?>
										<?php } else { ?>
										<?= $project['end_date'] ?>
										<?php } ?>
									</td>
									<td><?= $project['project_name'] ?></td>
									<td>
										<a href="<?= $project_candidate ?>/<?= $project['project_id'] ?>" class="btn btn-primary"><i class="fa fa-users"></i></a>
									</td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td colspan="4" class="text-center"><?= $text_empty ?></td>
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
<div class="modal fade" id="interview_status_model">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?= $text_interview_status ?></h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="project_link_model">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Confirm</h4>
			</div>
			<div class="modal-body" align="center" style="padding: 15px 0px!important;">
				<span class="label label-info well-sm"></span>
				<br><br>
				<button type="button" class="btn btn-success send_link_mail">Send</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#projectcheckall').change(function(){
	if($('#projectcheckall').prop('checked') == true){
		$('input[name=\'projectremovecheck[]\']').prop('checked', true);
	}else{
		$('input[name=\'projectremovecheck[]\']').prop('checked', false);
	}
});
$('.remove_project').click(function(){
	if(!confirm('Are You Sure?')){
		return false;
	}else{
		return true;
	}
});
$('.project_link_model').click(function(){
	var text = $(this).attr('data-text');
	$('#project_link_model .modal-body span').text(text);
	$('#project_link_model .modal-body button').attr('data-text',text);
	$('#project_link_model').modal('show');
});
$('.send_link_mail').click(function(){
	var text = $(this).attr('data-text');
	var _this = $(this);
	$.ajax({
		url: '<?= $send_link_mail_url ?>',
		type: 'post',
		data: {
			'text':text,
		},
		dataType: 'text',
		success: function (data) {
			if(data){
				$('#project_link_model').modal('hide');
			}
		}
	});
});
$('.interview_status').click(function(){
	var id = $(this).val();
	var _this = $(this);
	$.ajax({
		url: '<?= $interview_status_url ?>',
		type: 'post',
		data: {
			'id':id,
		},
		dataType: 'json',
		beforeSend:function(){
			$(_this).html('<i class="fa fa-spinner fa-spin"></i>');
		},
		success: function (data) {
			if(data.msg){
				$('#interview_status_model .modal-body').html('<h3 class="text-center text-info">'+data.msg+'</h3>');
			}else{
				html = '<table class="table table-bordered"><tr><th class="text-center">Name</th><th class="text-center">Status</th></tr>';
				$.each(data,function(k,v){
					html += '<tr><td class="text-center">'+v.candidate+'</td>';
					if(v.status == 'pending'){
						html += '<td class="text-center"><span class="label label-warning">Pending</span></td>';
					} else if(v.status == 'cancel'){
						html += '<td class="text-center"><span class="label label-danger">Cancel</span></td>';
					} else {
						html += '<td class="text-center"><span class="label label-success">Complete</span></td>';
					}
					html += '</tr>';
				})
				html += '</table>';
				$('#interview_status_model .modal-body').html(html);
			}
			$('#interview_status_model').modal('show');
		},
		complete:function(){
			$(_this).html('<i class="fa fa-info"></i>');
		}
	});
})
</script>