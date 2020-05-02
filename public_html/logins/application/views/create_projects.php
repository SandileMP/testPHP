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

                    <?php /* ?>
                    <label><?=$entry_project_rater?></label>
                    <select multiple="" name="project_rater[]" class="project_rater form-control" <?php if($this->uri->segments[1] == 'project' && $this->uri->segments[2] == 'edit') { ?> disabled="" <?php } ?>>
						<option value="0">No Rater</option>
					<?php if ($raters) {?>
					<?php foreach ($raters as $rater) {?>
						<option value="<?=$rater->rater_id?>" <?php if (in_array($rater->rater_id,$rater_id)) {?> selected="selected" <?php }?>><?=$rater->name?></option>
					<?php } ?>
					<?php } ?>
					</select>
                    <?php */ ?>
                    <div><label><?= $entry_project_rater ?></label></div>
                    <?php if ($error_project_rater) {?>
                        <div class="text-danger"><?=$error_project_rater?></div>
                    <?php } ?>
                    <div id="rater_list"></div>
                    <div class="hide">
                        <input id="project_rater" type="hidden" name="project_rater">
                    </div>
                    <br>
					<label><?=$entry_profile_name?></label>
					<select name="profile_id" class="form-control" <?php if($this->uri->segments[1] == 'project' && $this->uri->segments[2] == 'edit') { ?> disabled="" <?php } ?>>
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
					<label><?= 'Launch Email Template';?></label>
					<?php if ($error_email_template_id) {?>
						<div class="text-danger"><?=$error_email_template_id?></div>
					<?php }?>
					<?php echo form_dropdown(['name' => 'email_template_id','id' => 'email_template_id','class' => 'form-control'],$email_template,$email_template_id); ?>

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

<?php
$raters_list = array();
$raters_selected_list = array();

if ($raters){
    foreach ($raters as $rater) {
        if ($rater_id && !empty($rater_id) && in_array($rater->rater_id,$rater_id)){
            $raters_selected_list[] = array('id' => $rater->rater_id,'label' => $rater->name);

        }
        else{
            $raters_list[] = array('id' => $rater->rater_id,'label' => $rater->name);
        }
    }
}

$raters_list                = json_encode($raters_list);
$raters_selected_list       = json_encode($raters_selected_list);
$btnlist                    = array();

if(count($raters_selected_list) < 5 ){
    $btnlist[] = array('action' => 'add','label' => 'Add');
}
$btnlist[] = array('action' => 'remove','label' => 'Remove');

$btnlist = json_encode($btnlist);

?>
<script type="text/javascript">
    $(function () {
        var data = {available: <?= $raters_list?>,selected:<?= $raters_selected_list?>,};
        var list_instance = $('#rater_list').pickList({
            data: data,
            buttons:<?= $btnlist ?>,
            buttonClass: 'btn btn-block btn-primary',
            label: {content: ['Available:', 'Selected:']},
            select: {size: 10 }
        });

        var selected_item = list_instance.pickList('getSelected');
        var selected_item = JSON.stringify(selected_item);
        $("#project_rater").val(selected_item);

        list_instance.on('picklist.remove', function (event, v){
            selected_item = list_instance.pickList('getSelected');

            if(selected_item.length <= 4) {
                $("#rater_list .add").show();
            }

            selected_item = JSON.stringify(selected_item);
            $("#project_rater").val(selected_item);
            setDisableOptions();
        });

        list_instance.on('picklist.add', function (event, v){

            selected_item = list_instance.pickList('getSelected');

            if(selected_item.length >= 5){
                $("#rater_list .add").hide();
            }

            selected_item = JSON.stringify(selected_item);
            $("#project_rater").val(selected_item);



            setDisableOptions();
        });

        setDisableOptions();

    });
    
    function setDisableOptions(){
        var scl_array = <?= $raters_selected_list ?>;
        $("#rater_list .selected select option").each(function (){
            if(scl_array.some(item => item.id == $(this).val())){
                $(this).attr('disabled','disabled');
            }
        });
    }
    
</script>
