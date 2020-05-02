<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_templates; ?></h3>
				</div>
				<div class="pull-left" style="margin-left: 25px;">
					<form action="<?= $action ?>" method="post" class="form-inline">
						<input type="text" name="text_search" class="form-control" placeholder="Search Here.." required="" />
						<button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
					</form>
				</div>
				<div class="pull-right">
					<a href="<?= $create_template ?>" class="btn btn-success" data-toggle="tooltip" title="<?= $button_create ?>"><i class="fa fa-plus"></i></a>
					<button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#template-list-form').attr('action','<?= $remove_all_template ?>').submit();" class="btn btn-danger" data-toggle="tooltip" title="<?= $button_remove ?>"><i class="fa fa-trash"></i></button>
				</div>
				<br><br>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post" id="template-list-form">
						<table class="table">
							<thead>
								<tr>
									<th width="3%">
									<label class="fancy-checkbox">
										<input type="checkbox" name="templatecheckall" id="templatecheckall" />
										<span></span>
									</label>
									</th>
									<th><?= $entry_template_name ?></th>
									<th><?= $entry_interview_status ?></th>
									<th width="25%"><?= $entry_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($templates) { ?>
								<?php foreach ($templates as $template) { ?>
								<tr>
									<td>
										<label class="fancy-checkbox">
											<input type="checkbox" class="tempCheck" name="templateremovecheck[]" value="<?= $template['template_id'] ?>" />
											<span></span>
										</label>
									</td>
									<td><?= $template['template_name'] ?></td>
									<td class="text-capitalize"><?= $template['interview_status'] ?></td>
									<td>
										<a href="<?= $edit_template ?>/<?= $template['template_id'] ?>" class="btn btn-info" data-toggle="tooltip" title="<?= $button_edit ?>"><i class="fa fa-pencil"></i></a>
										<a href="<?= $remove_template ?>/<?= $template['template_id'] ?>" class="btn btn-danger remove_template" data-toggle="tooltip" title="<?= $button_remove ?>"><i class="fa fa-trash"></i></a>
                                        <a href="<?= $clone_template ?>/<?= $template['template_id'] ?>" class="btn btn-primary clone_template" data-toggle="tooltip" title="<?= $button_clone ?>"><i class="fa fa-copy"></i></a>
									</td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td colspan="11" class="text-center"><?= $text_empty ?></td>
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

<script type="text/javascript">
$('#templatecheckall').change(function(){
	if($('#templatecheckall').prop('checked') == true){
		$('input[name=\'templateremovecheck[]\']').prop('checked', true);
	}else{
		$('input[name=\'templateremovecheck[]\']').prop('checked', false);
	}
});
	
$(function(){

	// if all checkbox are selected, check the selectall checkbox
	// and viceversa
	$(".tempCheck").click(function(){

		if($(".tempCheck").length == $(".tempCheck:checked").length) {
			$("#templatecheckall").attr("checked", "checked");
		} else {
			$("#templatecheckall").removeAttr("checked");
		}

	});
});

$('.remove_template').click(function(){
	if(!confirm('Are You Sure?')){
		return false;
	}else{
		return true;
	}
});

$('.clone_template').click(function(){
	if(!confirm('Are You Sure?')){
		return false;
	}else{
		return true;
	}
});
</script>