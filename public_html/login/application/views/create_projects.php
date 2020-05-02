<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<?php if ($warning) {?>
				<div class="alert alert-danger">
					<?=$warning?>
					<button class="close" data-dismiss="alert"></button>
				</div>
				<?php }?>
				<div class="panel-heading">
					<h3 class="panel-title"><?=$text_create_projects;?></h3>
				</div>
				<div class="pull-right">
					<a href="<?=$cancel?>" class="btn btn-default" data-toggle="tooltip" title="<?=$button_cancel?>"><i class="fa fa-reply"></i></a>
				</div>
				<br><br>
				<form action="<?=$action?>" method="post" id="create-project-form">
				<div class="panel-body">
					<label><?=$entry_project_name?></label>
					<input type="text" name="project_name" class="form-control" value="<?=$project_name?>" placeholder="<?=$entry_project_name?>" />
					<?php if ($error_project_name) {?>
					<div class="text-danger"><?=$error_project_name?></div>
					<?php }?>
					<br>

					<label><?=$entry_project_manager?></label>
					<select name="profile_manager" class="form-control">
						<option value="0"><?= $text_no_manager ?></option>
					<?php if ($managers) {?>
					<?php foreach ($managers as $manager) {?>
						<option value="<?=$manager->manager_id?>" <?php if ($manager->manager_id == $manager_id) {?> selected="selected" <?php }?>><?=$manager->name?></option>
					<?php }?>
					<?php } else {?>
						<option value=""><?=$note_create_manager?></option>
					<?php }?>
					</select>
					<?php if ($error_profile_manager) {?>
					<div class="text-danger"><?=$error_profile_manager?></div>
					<?php }?>
					<br>

					<label><?=$entry_profile_name?></label>
					<select name="profile_name" class="form-control">
					<?php if ($job_profiles) {?>
					<?php foreach ($job_profiles as $profile) {?>
						<option value="<?=$profile->job_profile_id?>" <?php if ($profile->job_profile_id == $profile_id) {?> selected="selected" <?php }?> ><?=$profile->title?></option>
					<?php }?>
					<?php } else {?>
						<option value=""><?=$note_create_job_profile?></option>
					<?php }?>
					</select>
					<?php if ($error_profile_name) {?>
					<div class="text-danger"><?=$error_profile_name?></div>
					<?php }?>
					<br>
					
					<label class="fancy-checkbox">
					<input type="checkbox" name="open_project" id="open_project" <?php if ($open_project == 'on') {?> checked="checked" <?php }?> />
					<span><?=$text_open_project?></span>
					</label>
					<?php if ($error_project_type) {?>
					<div class="text-danger"><?=$error_project_type?></div>
					<?php }?>
					<div class="row" id="project_type_expire">
						<div class="col-sm-6 start_date">
							<label><?=$entry_start_date?></label>
							<div class="input-group date">
		                    <input type="text" name="start_date" value="<?=$start_date?>" placeholder="<?=$entry_start_date?>" data-date-format="YYYY-MM-DD" id="input-start-date" class="form-control">
		                    <span class="input-group-btn">
		                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
		                    </span></div>
						</div>
						<div class="col-sm-6 end_date">
							<label><?=$entry_end_date?></label>
							<div class="input-group date">
		                    <input type="text" name="end_date" value="<?=$end_date?>" placeholder="<?=$entry_end_date?>" data-date-format="YYYY-MM-DD" id="input-end-date" class="form-control">
		                    <span class="input-group-btn">
		                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
		                    </span></div>
						</div>
					</div>
					<br>

					<?php if ($this->uri->segments[1] == 'project' && $this->uri->segments[2] == 'create') { ?>
					<div class="candidate_list">
						<?php if ($candidate) {?>
						<?php foreach ($candidate as $key => $value) {?>
						<div class="row candidate_list_row" style="margin-bottom:5px;">
							<div class="col-sm-6">
								<input type="text" name="candidate[<?=$key?>][name]" value="<?=$value['name']?>" placeholder="<?=$entry_candidate_name?>" class="form-control">
							</div>
							<div class="col-sm-5">
								<input type="email" name="candidate[<?=$key?>][email]" value="<?=$value['email']?>" placeholder="<?=$entry_candidate_email?>" class="form-control">
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-danger delete_candidate"><i class="fa fa-close"></i></button>
							</div>
						</div>
						<?php }?>
						<?php }?>
					</div>
					<button type="button" id="create_candidate" class="btn btn-primary"><?=$text_create_candidate?></button>
					<?php if ($error_candidate) {?>
					<div class="text-danger"><?=$error_candidate?></div>
					<?php }?>
					<?php if ($error_credit) {?>
					<div class="text-danger"><?=$error_credit?></div>
					<?php }?>
					<br>
					<?php } else { ?>
					<?php if ($register_candidate) {?>
					<?php foreach ($register_candidate as $key => $value) {?>
					<div class="row candidate_list_row" style="margin-bottom:5px;">
						<div class="col-sm-6">
							<input type="text" value="<?= $value['candidate_name']?>" class="form-control" disabled>
						</div>
						<div class="col-sm-5">
							<input type="email" value="<?= $value['candidate_email']?>" class="form-control" disabled>
						</div>
					</div>
					<?php }?>
					<?php }?>
					<div class="candidate_list">
						<?php if ($candidate) {?>
						<?php foreach ($candidate as $key => $value) {?>
						<div class="row candidate_list_row" style="margin-bottom:5px;">
							<div class="col-sm-6">
								<input type="text" name="candidate[<?=$key?>][name]" value="<?=$value['name']?>" placeholder="<?=$entry_candidate_name?>" class="form-control">
							</div>
							<div class="col-sm-5">
								<input type="email" name="candidate[<?=$key?>][email]" value="<?=$value['email']?>" placeholder="<?=$entry_candidate_email?>" class="form-control">
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-danger delete_candidate"><i class="fa fa-close"></i></button>
							</div>
						</div>
						<?php }?>
						<?php }?>
					</div>
					<button type="button" id="create_candidate" class="btn btn-primary"><?=$text_create_candidate?></button>
					<?php if ($error_candidate) {?>
					<div class="text-danger"><?=$error_candidate?></div>
					<?php }?>
					<?php if ($error_credit) {?>
					<div class="text-danger"><?=$error_credit?></div>
					<?php }?>
					<?php }?>
					<br>
					<br>

					<label><?=$entry_notification;?></label>
					<label class="fancy-radio">
					<input type="radio" name="notification" value="on" <?php if ($notification == 'on') {?> checked="checked" <?php }?> />
					<span><i></i><?=$text_notification_on?></span>
					</label>
					<label class="fancy-radio">
					<input type="radio" name="notification" value="off" <?php if ($notification == 'off') {?> checked="checked" <?php }?> />
					<span><i></i><?=$text_notification_off?></span>
					</label>
					<?php if ($error_notification) {?>
					<div class="text-danger"><?=$error_notification?></div>
					<?php }?>
					<br>
					<?php if (!$project_status) {?>
						<button type="submit" name="project_status" value="create" class="btn btn-warning" data-toggle="tooltip" title="<?=$button_create?>"><?=$button_create?></button>
						<button type="submit" name="project_status" value="launch" class="btn btn-success" data-toggle="tooltip" title="<?=$button_launch?>"><?=$button_launch?></button>
					<?php } else if ($project_status == 'create') {?>
						<button type="submit" name="project_status" value="launch" class="btn btn-success" data-toggle="tooltip" title="<?=$button_launch?>"><?=$button_launch?></button>
					<?php } else {?>
						<button type="submit" name="project_status" value="launch" class="btn btn-info" title="<?=$button_update?>"><?=$button_update?></button>
					<?php }?>
					<br>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$(function(){
	if($('#open_project').prop('checked') == true){
		$('.end_date').css('display', 'none');
	}else{
		$('.end_date').css('display', 'block');
	}
});
$('#open_project').change(function(){
	if($('#open_project').prop('checked')){
		$('.end_date').css('display', 'none');
	}else{
		$('.end_date').css('display', 'block');
	}
});

var ii = '<?=$i?>';
$('#create_candidate').click(function(){
	var html = '<div class="row candidate_list_row" style="margin-bottom:5px;">';
		html += '<div class="col-sm-6">';
		html += '<input type="text" name="candidate['+ii+'][name]" placeholder="<?=$entry_candidate_name?>" class="form-control">';
		html += '<div class="text-danger error_candidate_name"></div>';
		html += '</div>';
		html += '<div class="col-sm-5">';
		html += '<input type="email" name="candidate['+ii+'][email]" placeholder="<?=$entry_candidate_email?>" class="form-control">';
		html += '<div class="text-danger error_candidate_email"></div>';
		html += '</div>';
		html += '<div class="col-sm-1">';
		html += '<button type="button" class="btn btn-danger delete_candidate"><i class="fa fa-close"></i></button>';
		html += '</div>';
		html += '</div>';
	$('.candidate_list').append(html);
	ii++;
});
$(document).delegate('.delete_candidate','click',function(){
	$(this).parents('.candidate_list_row').remove();
});
</script>