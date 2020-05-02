<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?=$text_hr;?></h3>
				</div>
				<div class="pull-left" style="margin-left: 25px;">
					<form action="<?=$action?>" method="post" class="form-inline">
						<input type="text" name="text_search" class="form-control" placeholder="Search Here.." required="" />
						<button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
					</form>
				</div>
				<div class="pull-right">
					<a href="<?=$create?>" class="btn btn-success" data-toggle="tooltip" title="<?=$button_create?>"><i class="fa fa-plus"></i></a>
					<button type="button" onclick="if(!confirm('Are You Sure?')) { return false; } else { $('#auth-list-form').attr('action','<?=$remove_all?>').submit(); }" class="btn btn-danger remove_all" data-toggle="tooltip" title="<?=$button_remove?>"><i class="fa fa-trash"></i></button>
				</div>
				<br><br>
				<div class="panel-body no-padding table-responsive">
					<form action="<?=$action?>" method="post" id="auth-list-form">
						<table class="table">
							<thead>
								<tr>
									<th>
									<label class="fancy-checkbox">
										<input type="checkbox" name="checkall" id="checkall" />
										<span></span>
									</label>
									</th>
									<th><?=$label_hr_client?></th>
									<th><?=$label_hr_name?></th>
									<th><?=$label_hr_email?></th>
									<th><?=$label_hr_phone?></th>
									<th><?=$label_hr_address?></th>
									<th><?=$label_hr_credit?></th>
									<th>Status</th>
									<th><?=$label_action?></th>
								</tr>
							</thead>
							<tbody>
								<?php if ($hrs) {?>
								<?php foreach ($hrs as $hr) {?>
								<tr>
									<td>
									<label class="fancy-checkbox">
										<input type="checkbox" name="removecheck[]" value="<?=$hr->client_id?>" />
										<span></span>
									</label>
									</td>
									<td><?=$hr->client?></td>
									<td><?=$hr->name?></td>
									<td><?=$hr->email?></td>
									<td><?=$hr->phone?></td>
									<td><?=$hr->address?></td>
									<td><?=$hr->credits?></td>
									<td> <btn class="label <?=$hr->status == 1 ? 'label-success' : 'label-danger'?>"><?=$hr->status == 1 ? 'Activate' : 'Deactivate'?></btn> </td>
									<td>
										<a href="<?=$edit?>/<?=$hr->client_id?>" class="btn btn-info" data-toggle="tooltip" title="<?=$button_edit?>"><i class="fa fa-pencil"></i></a>
										<a href="<?=$remove?>/<?=$hr->client_id?>" class="btn btn-danger remove" data-toggle="tooltip" title="<?=$button_remove?>"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php }?>
								<?php } else {?>
								<tr>
									<td colspan="8" class="text-center"><?=$text_empty?></td>
								</tr>
								<?php }?>
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
$('.remove').click(function(){
	if(!confirm('Are You Sure?')){
		return false;
	}else{
		return true;
	}
});
</script>