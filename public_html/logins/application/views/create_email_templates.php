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
					<h3 class="panel-title"><?=$text_create_templates;?></h3>
				</div>
				<div class="pull-right">
					<a href="<?=$cancel?>" class="btn btn-default" data-toggle="tooltip" title="<?=$button_cancel?>"><i class="fa fa-reply"></i></a>
				</div>
				<br><br>
				<form action="<?=$action?>" method="post" id="create-project-form">
				<div class="panel-body">
					<label><?=$entry_template_name?></label>
					<input type="text" name="template_name" class="form-control" value="<?=$template_name?>" placeholder="<?=$entry_template_name?>" />
					<?php if ($error_template_name) {?>
					<div class="text-danger"><?=$error_template_name?></div>
					<?php }?>
					<br>
                                        
					<label><?=$entry_interview_status;?></label>
					<label class="fancy-radio">
					<input type="radio" name="interview_status" value="Invitation" <?php if ($interview_status == 'Invitation') {?> checked="checked" <?php }?> />
					<span><i></i><?=$text_intStatus_invitation?></span>
					</label>
					<label class="fancy-radio">
					<input type="radio" name="interview_status" value="Rejection" <?php if ($interview_status == 'Rejection') {?> checked="checked" <?php }?> />
					<span><i></i><?=$text_intStatus_rejection?></span>
					</label>
					<label class="fancy-radio">
					<input type="radio" name="interview_status" value="Reminder" <?php if ($interview_status == 'Reminder') {?> checked="checked" <?php }?> />
					<span><i></i><?=$text_intStatus_reminder?></span>
					</label>                    
					<?php if ($error_interview_status) {?>
					<div class="text-danger"><?=$error_interview_status?></div>
					<?php }?>
					<br>

					<label><?=$entry_subject?></label>
					<input type="text" name="subject" class="form-control" value="<?=$subject?>" placeholder="<?=$entry_subject?>" />
					<?php if ($error_subject) {?>
					<div class="text-danger"><?=$error_subject?></div>
					<?php }?>
					<br>
                    
					<label><?=$entry_email_content?></label>
					<textarea name="email_content" class="form-control"><?=html_entity_decode($email_content)?></textarea>
					<?php if ($error_email_content) {?>
					<div class="text-danger"><?=$error_email_content?></div>
					<?php }?>
					<br>

					<?php if ($template_id > 0) {?>
						<button type="submit" name="submitTemplate" value="launch" class="btn btn-info" title="<?=$button_update?>"><?=$button_update?></button>
					<?php } else {?>
						<button type="submit" name="submitTemplate" value="create" class="btn btn-warning" data-toggle="tooltip" title="<?=$button_create?>"><?=$button_create?></button>
					<?php }?>
					<br>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<!-- CK Editor -->
<script src="<?=base_url()?>assets/vendor/ckeditor/ckeditor.js"></script>
<style>
.cke_button__image{
	display:none !important;
}
</style>
<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace( 'email_content', {
		height: 200,
        //filebrowserUploadUrl : '<?php echo base_url(); ?>myAdmin/commanAction/ckUploader',
		//filebrowserImageUploadUrl: '<?php echo base_url(); ?>myAdmin/commanAction/ckUploader',
	});		

});
</script>
<!--END PAGE LEVEL SCRIPTS -->