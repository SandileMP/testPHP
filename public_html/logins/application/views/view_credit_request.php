<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?=$title?></h3>
				</div>
				<div class="pull-left" style="margin-left: 25px;">
					<button class="btn btn-danger">Available Credit : <?=$userCredit?></button>
				</div>
				<div class="pull-right">
					<a href="javascript:void(0);" data-target="#credit" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Request Credit</a>
				</div>
				<div class="clearfix"></div>
				<div class="panel-body no-padding table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Credit Request</th>
					            <th>Credit Approved</th>
					            <th>Date</th>
					            <th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($creditResult)) {?>
								<?php foreach ($creditResult as $value) {?>
					                <tr>
					                    <td><?=$value->credit_request;?></td>
					                    <td><?=$value->credit_approved ? $value->credit_approved : '-';?></td>
					                    <td><?=date('d/m/Y', strtotime($value->created_at));?></td>
					                    <td><label class="label label-default"><?=ucfirst($value->status);?></label></td>
								    </tr>
							<?php }} else {?>
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
<div class="modal fade" id="credit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Request Credit</h4>
            </div>
            <form id="credit-form" method="post" action="<?=base_url();?>credit/sendcreditrequest">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Credit*</label>
                        <input type="number" min="1" class="form-control" required="required" name="credit_request">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary  pull-left">Send Credit Request</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div>