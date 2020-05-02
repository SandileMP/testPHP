<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_create_job_profiles; ?></h3>
				</div>
				<div class="pull-right">
					<button type="button" onclick="$('#create-job_profile-form').submit();" class="btn btn-success" data-toggle="tooltip" title="<?= $button_save ?>"><i class="fa fa-save"></i></button>
					<a href="<?= $cancel ?>" class="btn btn-default" data-toggle="tooltip" title="<?= $button_cancel ?>"><i class="fa fa-reply"></i></a>
				</div>
				<br><br>
				<form action="<?= $action ?>" method="post" id="create-job_profile-form">
				<div class="panel-body">
					<label><?= $entry_job_profile_title ?></label>
					<input type="text" name="job_profile_title" class="form-control" value="<?= $job_profile_title ?>" placeholder="<?= $entry_job_profile_title ?>" />
					<?php if($error_job_profile_title) { ?>
					<div class="text-danger"><?= $error_job_profile_title ?></div>
					<?php } ?>
					<br>
					<label><?= $entry_job_profile_role_title ?></label>
					<input type="text" name="job_profile_role_title" class="form-control" value="<?= $job_profile_role_title ?>" placeholder="<?= $entry_job_profile_role_title ?>" />
					<?php if($error_job_profile_role_title) { ?>
					<div class="text-danger"><?= $error_job_profile_role_title ?></div>
					<?php } ?>
					<br>
					<label><?= $entry_job_profile_question_list ?></label><span class="pull-right"><button type="button" id="create_question" class="btn btn-primary"><i class="fa fa-plus"></i></button></span>
					<br>
					<?php if($error_job_profile_question) { ?>
					<div class="text-danger"><?= $error_job_profile_question ?></div>
					<?php } ?>
					<br>
					<div class="question_list">
						<?php if($question) { ?>
						<?php foreach ($question as $key => $value) { ?>
						<div class="row question_list_row">
							<div class="col-sm-6">
								<textarea name="question[<?= $key ?>][question]" class="form-control static" value="<?= $key ?>" rows="3" placeholder="<?= $entry_job_profile_question ?>" style="resize: none;"><?= $value['question'] ?></textarea>
							</div>
							<div class="col-sm-5">
								<div class="input-group">
									<input type="number" name="question[<?= $key ?>][expire]" value="<?= $value['expire'] ?>" placeholder="<?= $entry_job_profile_expire_time ?>" class="form-control" autocomplete="off" />
									<span class="input-group-btn">
										<label class="btn btn-info">SECONDS</label>
									</span>
								</div>
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-danger delete_question"><i class="fa fa-close"></i></button>
							</div>
						</div>
						<?php } ?>
						<?php } ?>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
var ii = '<?= $i ?>';
$('#create_question').click(function(){
	var html = '<div class="row question_list_row">';
		html += '<div class="col-sm-6">';
		html += '<textarea name="question['+ii+'][question]" class="form-control" rows="3" placeholder="<?= $entry_job_profile_question ?>" style="resize: none;"></textarea>';
		html += '</div>';
		html += '<div class="col-sm-5">';
		html += '<div class="input-group">';
		html += '<input type="number" name="question['+ii+'][expire]" value="" placeholder="<?= $entry_job_profile_expire_time ?>" class="form-control" autocomplete="off" />';
		html += '<span class="input-group-btn">';
		html += '<label class="btn btn-info">SECONDS</label>';
		html += '</span>';
		html += '</div>';
		html += '</div>';
		html += '<div class="col-sm-1">';
		html += '<button type="button" class="btn btn-danger delete_question"><i class="fa fa-close"></i></button>';
		html += '</div>';
		html += '</div>';
	$('.question_list').append(html);
	ii++;
});
$(document).delegate('.delete_question','click',function(){
	$(this).parents('.question_list_row').remove();
});
</script>