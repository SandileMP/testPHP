<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?=$title?></h3>
				</div>
				<?php /* ?>
                <div class="" style="margin-left: 25px; width: 100%;">
                   <form action="" method="get" class="form-inline" style="margin-top: 20px">
                        <input type="text" name="name" class="form-control" placeholder="Name OR Email" value="<?= $this->input->get('name')?>"/>
                        <input type="number" name="credit_request" class="form-control" placeholder="Credit Request" value="<?= $this->input->get('credit_request')?>" />
                        <input type="number" name="credit_approved" class="form-control" placeholder="Credit Approved" value="<?= $this->input->get('credit_approved')?>" />
                        <input type="date" name="date_from" class="form-control" placeholder="Date From" value="<?= $this->input->get('date_from')?>" title="Date From" />
                        <input type="date" name="date_to" class="form-control" placeholder="Date To" value="<?= $this->input->get('date_to')?>" title="Date To" />
                        <input type="text" name="status" class="form-control" placeholder="Status" value="<?= $this->input->get('status')?>" />
                        <button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
                   </form>
				</div>
				<?php */ ?>

				<div class="text-right">
					<?php if(isset($this->session->userdata['msg_error'])) { ?>
					<div class="text-danger" style="font-size: 20px;"><?php echo $this->session->userdata['msg_error']; ?></div>
					<?php } ?>
					<?php if(isset($this->session->userdata['msg_success'])) { ?>
					<div class="text-success" style="font-size: 20px;"><?php echo $this->session->userdata['msg_success']; ?></div>
					<?php } ?>
				</div>
				<br><br>
				<div class="panel-body no-padding table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
					            <th>Message</th>
					            <th>Date</th>           
							</tr>
						</thead>
						<tbody>
						<?php if (!empty($activity)) {
							foreach ($activity as $value) { ?>
						    <tr>
						        <td><?=$value->user_name;?></td>
						        <td><?=$value->activity_message;?></td>
						        <td><?=$value->created_at;?></td>						        
						    </tr>
						<?php }
						} else {?>
							<tr>
								<td colspan="6" class="text-center">No Data Found</td>
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
