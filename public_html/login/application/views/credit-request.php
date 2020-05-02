<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?=$title?></h3>
				</div>
				<div class="pull-left" style="margin-left: 25px;">
					<!-- <form action="<?=$action?>" method="post" class="form-inline">
						<input type="text" name="text_search" class="form-control" placeholder="Search Here.." required="" />
						<button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
					</form> -->
				</div>
				<div class="pull-right">

					<!-- <button type="button" onclick="if(!confirm('Are You Sure?')) { return false; } else { $('#auth-list-form').attr('action','<?=$remove_all?>').submit(); }" class="btn btn-danger remove_all" data-toggle="tooltip" title="<?=$button_remove?>"><i class="fa fa-trash"></i></button> -->
				</div>
				<br><br>
				<div class="panel-body no-padding table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
					            <th>Email</th>
					            <th>Credit Request</th>
					            <th>Credit Approved</th>
					            <th>Date</th>
					            <th>Status</th>
					            <th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($creditResult)) {
	foreach ($creditResult as $value) {?>
					                <tr>
					                    <td><?=$value->name;?></td>
					                    <td><?=$value->email;?></td>
					                    <td><?=$value->credit_request;?></td>
					                    <td><?=$value->credit_approved ? $value->credit_approved : '-';?></td>
					                    <td><?=date('d/m/Y', strtotime($value->created_at));?></td>
					                    <td><u><?=ucfirst($value->status);?></u></td>
					                    <td>
					                        <ul  class="list-inline">
					                        <?php if ($value->status == 'active') {?>
					                            <li><a href="javascript:void(0);" data-target="#credit-approve" data-toggle="modal" class="btn btn-success" onclick="approvePopup(<?=$value->id;?>);">Approve</a></li>
					                            <li><a href="<?=base_url() . 'credit/declinecreditrequest/' . $value->id;?>" onclick="return confirm('Are you sure you want to decline this credit request?')" class="btn btn-danger">Decline</a></li>
					                        <?php } else {?>
					                        <li><a href="#"><i class="fa fa-trash"></i></a></li>
					                       <?php }?>
					                        </ul>
					                    </td>
					                </tr>
					            <?php
}
} else {?>
							<tr>
								<td colspan="8" class="text-center">No Data Found</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="modal fade" id="credit-approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Approve Credit</h4>
            </div>
            <form id="credit-approve-form" method="post" action="<?=base_url();?>credit/approvecreditrequest">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Credit*</label>
                        <input type="number" min="1" required="required" class="form-control" id="credit_approved" name="credit_approved">
                        <input type="hidden" name="credit_request_id" id="credit-request-id" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary  pull-left">Approve Credit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div>

<script>
	function approvePopup(requestId) {
        $('#credit-request-id').val(requestId);
    }
</script>