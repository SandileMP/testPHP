<style>
.button {
  display: inline-block;
  position: relative;
  width: 30px;
  height: 30px;
  margin: 10px;
  cursor: pointer;
}

.button span {
  display: block;
  position: absolute;
  width: 30px;
  height: 30px;
  padding: 0;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  border-radius: 100%;
  background: #eeeeee;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
  transition: ease .3s;
}

.red input:checked ~ .button span {
  background: red;
}

.orange input:checked ~ .button span {
  background: orange;
}

.green input:checked ~ .button span {
  background: green;
}



.button span:hover {
  padding: 10px;
}
</style>

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?=$text_interviews;?>
						<div style="float:right; font-size:18px;"><span class="text-success" ><?= $this->session->flashdata('success'); ?></span></div>
                        <div style="float:right; font-size:18px;"><span class="text-danger" ><?= $this->session->flashdata('danger'); ?></span></div>
                    </h3>
                   
				</div>
				<?php if (@$action != "") {?>
					<div class="pull-left" style="margin-left: 25px;">
						<form action="<?=$action?>" method="post" class="form-inline">
						<input type="text" name="text_search" class="form-control" placeholder="Search Here.."  />
						<button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
						</form>
					</div>
					<?php }?>
				<div class="pull-right">
                <?php if ($this->session->userdata['user_type'] != 'MANAGER') {?>
                     <a href="javascript:void(0);" onclick="getEmailTemplate();" class="btn btn-warning" data-toggle="tooltip" title="Send Email">Send Email</a>

                     <button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#interviews-list-form').attr('action','<?= base_url('project/enableSelectedInterview/') ?>').submit();" class="btn btn-primary" data-toggle="tooltip" title="Enable">Enable</button>

                     <button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#interviews-list-form').attr('action','<?= base_url('project/disableSelectedInterview/') ?>').submit();" class="btn btn-info" data-toggle="tooltip" title="Disable">Disable</button>
                     
                     <button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#interviews-list-form').attr('action','<?= base_url('project/resetSelectedInterview/') ?>').submit();" class="btn btn-danger" data-toggle="tooltip" title="Reset">Reset</button>                     
                <?php } ?>
                    <a href="<?php //$cancel?>" class="btn btn-default" data-toggle="tooltip" title="<?php //$button_cancel?>"><i class="fa fa-reply"></i></a>
				</div>
				<br><br>
				<div class="panel-body no-padding table-responsive">
                <form action="#" method="post" id="interviews-list-form">
					<table class="table table-striped table-bordered table-primary">
						<thead>
							<tr>
                            	<th>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="interviewCheckAll" id="interviewCheckAll" />
                                        <span></span>
                                    </label>
                                </th>
								<th class="text-center"><?=$entry_interview_candidate?></th>
								<th class="text-center"><?=$entry_project_name?></th>
								<th class="text-center"><?=$entry_interview_status?></th>
								<th class="text-center"><?=$text_interview?></th>
								<th class="text-center" colspan="2"><?=$manager_evaluation?></th>
								<th class="text-center" colspan="2"><?=$client_evaluation?></th>
								<?php /*if ($this->session->userdata['user_type'] != 'MANAGER') {?><th class="text-center"><?=$entry_action?></th><?php } */?>

								<!-- <th><?=$entry_interview_start?></th>
								<th><?=$entry_interview_end?></th> -->
							</tr>
						</thead>
						<tbody>
							<?php if ($interviews) {
	?>
							<?php foreach ($interviews as $mkey => $interview) {
		?>
							<tr>
                                <td>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" class="intCheck" name="interviewIdCheck[<?= $mkey?>]" value="<?= $interview['interview_id'] ?>" />
                                        <span></span>
                                    </label>
                                    <input type="hidden" name="candidateId[<?= $mkey?>]" value="<?= $interview['candidate_id'] ?>" />
                                    <input type="hidden" name="projectId[<?= $mkey?>]" value="<?= $interview['project_id'] ?>" />
                                    <?php $mmstatus = !empty($interview['path']) ? 1 : 0?>
                                    <input type="hidden" name="mmstatus[<?= $mkey?>]" value="<?= $mmstatus ?>" />                                    
                                </td>                            
								<td><?=$interview['candidate']?></td>
								<td><?=$interview['project']?></td>
								<td>
									<span class="label <?=$interview['status'] == 1 ? 'label-success' : 'label-danger'?>"><?=getStatus($interview['status'])?></span>
								</td>
								<td>
									<button type="button" data-interview=<?=$interview['interview_id']?> data-client="<?=$interview['client_id']?>" data-credited="<?=$interview['is_credited']?>" name="watch_interview" class="btn btn-info watch_interview" data-toggle="tooltip" value="<?=$interview['path']?>" title="<?=$button_watch?>"><?=$button_watch?></button>
								</td>

								<td style="display: inline-flex;">
									<label class=" red">
										<input type="radio"
										class="class_ev_rate"
										value="1"
										style="display: none;"
										<?=$this->session->userdata['user_type'] == 'CLIENT' ? 'disabled' : ''?>
										<?=$interview['manager_eva_rating'] == 1 ? 'checked' : ''?>
										onchange="updateRating(this.value,<?=$interview['interview_id']?>)"
										name="optradio[<?=$mkey?>]">
										<div class="layer"></div>
  										<div class="button"><span></span></div>
									</label>


									<label class=" orange">
										<input
										type="radio"
										class="class_ev_rate"
										value="2"
										style="display: none;"
										<?=$this->session->userdata['user_type'] == 'CLIENT' ? 'disabled' : ''?>
										<?=$interview['manager_eva_rating'] == 2 ? 'checked' : ''?>
										onchange="updateRating(this.value,<?=$interview['interview_id']?>)"
										name="optradio[<?=$mkey?>]">
										<div class="button"><span></span></div>
									</label>

									<label class=" green">
										<input type="radio"
										class="class_ev_rate"
										value="3"
										style="display: none;"
										<?=$this->session->userdata['user_type'] == 'CLIENT' ? 'disabled' : ''?>
										<?=$interview['manager_eva_rating'] == 3 ? 'checked' : ''?>
										onchange="updateRating(this.value,<?=$interview['interview_id']?>)"
										name="optradio[<?=$mkey?>]">
										<div class="button"><span></span></div>
									</label>
								</td>

								<td>
									<?php if ($this->session->userdata['user_type'] != 'CLIENT') {?>
										<a href="javascript:void(0)" onclick="addComment(<?=$interview['interview_id']?>)">Add Comment</a>
									<?php } else {?>
										<a href="javascript:void(0)" onclick="viewComment(<?=$interview['interview_id']?>)">View <?=$interview['manager_details']['name']?>'s Comment</a>
									<?php }?>
								</td>

								<td style="display: inline-flex;">
									<label class=" red">
										<input type="radio"
										class="class_ev_rate"
										value="1"
										style="display: none;"
										<?=$this->session->userdata['user_type'] == 'MANAGER' ? 'disabled' : ''?>
										<?=$interview['client_eva_rating'] == 1 ? 'checked' : ''?>
										onchange="updateRating(this.value,<?=$interview['interview_id']?>)"
										name="coptradio[<?=$mkey?>]">
										<div class="layer"></div>
  										<div class="button"><span></span></div>
									</label>


									<label class=" orange">
										<input
										type="radio"
										class="class_ev_rate"
										value="2"
										style="display: none;"
										<?=$this->session->userdata['user_type'] == 'MANAGER' ? 'disabled' : ''?>
										<?=$interview['client_eva_rating'] == 2 ? 'checked' : ''?>
										onchange="updateRating(this.value,<?=$interview['interview_id']?>)"
										name="coptradio[<?=$mkey?>]">
										<div class="button"><span></span></div>
									</label>

									<label class=" green">
										<input type="radio"
										class="class_ev_rate"
										value="3"
										style="display: none;"
										<?=$this->session->userdata['user_type'] == 'MANAGER' ? 'disabled' : ''?>
										<?=$interview['client_eva_rating'] == 3 ? 'checked' : ''?>
										onchange="updateRating(this.value,<?=$interview['interview_id']?>)"
										name="coptradio[<?=$mkey?>]">
										<div class="button"><span></span></div>
									</label>
								</td>
								<td>
									<?php if ($this->session->userdata['user_type'] != 'MANAGER') {?>
										<a href="javascript:void(0)" onclick="addComment(<?=$interview['interview_id']?>)">Add Comment</a>
									<?php } else {?>
										<a href="javascript:void(0)" onclick="viewComment(<?=$interview['interview_id']?>)">View <?=$interview['client_details']['name']?>'s Comment</a>
									<?php }?>
								</td>
								<?php /*if ($this->session->userdata['user_type'] != 'MANAGER') {?>
								<td>

									<?php	if ($interview['status'] == 1) {?>
										<a href="<?=base_url('project/resetInterview/' . $interview['interview_id'] . '/' . $interview['candidate_id'] . '/' . $interview['project_id'])?>">Reset</a>&nbsp;|&nbsp;
										<a href="<?=base_url('project/disableInterview/' . $interview['interview_id'] . '/' . $interview['candidate_id'])?>">Disable</a>&nbsp;|&nbsp;
										<a href="<?=base_url('project/rejectInterview/' . $interview['interview_id'] . '/' . $interview['candidate_id'])?>" onclick="return confirm('Are you sure you want to Reject this candidate ?')" >Reject</a>
									<?php } else {?>
									<?php $mmstatus = !empty($interview['path']) ? 1 : 0?>
									<a href="<?=base_url('project/enableInterview/' . $interview['interview_id'] . '/' . $interview['candidate_id'] . '/' . $mmstatus)?>">Enable</a>&nbsp;|&nbsp;
									<a href="<?=base_url('project/resetInterview/' . $interview['interview_id'] . '/' . $interview['candidate_id'] . '/' . $interview['project_id'])?>">Reset</a>&nbsp;|&nbsp;
									<a href="<?=base_url('project/rejectInterview/' . $interview['interview_id'] . '/' . $interview['candidate_id'])?>" onclick="return confirm('Are you sure you want to Reject this candidate ?')" >Reject</a>
									<?php }?>

								</td>
								<?php } */?>
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
<div class="modal fade" id="watch_interview_model">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body" style="padding: 0px;">
				<div id="container">
			        <div class="players" id="player1-container">
			            <div class="media-wrapper" style="width: 100%;">
			                <video id="player1" width="640" height="360" style="max-width:100%;" preload="none" controls playsinline webkit-playsinline>
			                    <source src="" type="video/webm">
			                    <track srclang="en" kind="subtitles" src="mediaelement.vtt">
			                    <track srclang="en" kind="chapters" src="chapters.vtt">
			                </video>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="modal-footer" style="border: none;">
				<button type="button" class="btn btn-default btn-close-video" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Models -->

<!-- View Comment Modal -->
<div id="vcModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View <?=$this->session->userdata['user_type'] == "CLIENT" ? 'Maneger' : 'Client'?> Comment</h4>
      </div>
      <div class="modal-body" id="vcModalContent">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Add Comment Modal -->
<div id="acModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form id="saveCommentFrm" class="form-horizontal">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Add <?=$this->session->userdata['user_type']?> Comment</h4>
		    </div>
		    <div class="modal-body">
		    	<div id="saveResponse"></div>
				<div class="form-group">
			    	<label class="control-label col-sm-2" for="txt_comment">Comment</label>
			    	<div class="col-sm-10">
			      		<textarea required="required" class="form-control" name="txt_comment" id="txt_comment" placeholder="Enter comment"></textarea>
			      		<input type="hidden" name="txt_interview_id" id="txt_interview_id">
			    	</div>
			  	</div>
		    </div>
		    <div class="modal-footer">
		    	<button type="submit" class="btn btn-success">Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
  		</form>
    </div>

  </div>
</div>

<!-- Email Templates Modal -->
<div id="etModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Email Templates List</h4>
      </div>
      <div class="modal-body" id="etModalContent">
      </div>
      <div class="modal-footer">
        <button type="button" id="sendEmailBtn" class="btn btn-success" onclick="sendEmail();">Submit</button>      
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php
function getStatus($status) {
	switch ($status) {
	case '0':
		return 'Not Completed';
		break;

	case '1':
		return 'Completed';
		break;

	case '2':
		return 'Disabled';
		break;

	case '3':
		return 'Rejected';
		break;

	default:
		return '-';
		break;
	}
}

?>
<script>
	$(document).ready(function(){
		$("#saveCommentFrm").on('submit',function(e){
			e.preventDefault();
			$.ajax({
				url:"<?=base_url('project/saveComment')?>",
				method:"post",
				data:$("#saveCommentFrm").serialize(),
				success:function(data){
					if(data==1)
					{
						$("#saveResponse").html(`
							<div class="alert alert-success fade in alert-dismissable"">
								<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
								<strong>Success!</strong> Comment Add Successfully.
							</div>
							`);
					}
					else
					{
						$("#saveResponse").html(`
							<div class="alert alert-danger fade in alert-dismissable"">
								<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
								<strong>Failed!</strong> Comment Add Failed.
							</div>
							`);
					}
				}
			})
		})
	});

	function updateRating(val,interview_id)	{
		$.ajax({
			url:"<?=base_url('project/updateEvoRate')?>",
			method:"POST",
			data:"rate="+val+"&interview_id="+interview_id,
			success:function(data){
				if(data==0)
				{
					alert("Rating Update Failed");
				}
			}
		})
	}

	function viewComment(x)	{
		$.ajax({
			url:"<?=base_url('project/viewComment')?>",
			method:"POST",
			data:"interview_id="+x,
			success:function(data){
				if(data == ""){
					$("#vcModalContent").html('Not Completed Yet!');
				}else{
				$("#vcModalContent").html('<p>'+data+'</p>');
				}
				$("#vcModal").modal('toggle');
			}
		})
	}

	function addComment(x) {
		$.ajax({
			url:"<?=base_url('project/getComment')?>",
			method:"POST",
			data:"interview_id="+x,
			success:function(data){
				$("#txt_comment").val(data);
				$("#txt_interview_id").val(x);
				$("#acModal").modal('toggle');
			}
		})
	}
	
	function getEmailTemplate() {
		var interviewId = $(".intCheck:checked").val();
		if(interviewId == undefined){
			alert('Please select candidate!');
		}else{
			$("#etModalContent").html('<img src="<?=base_url()?>assets/img/preload.gif" style="margin-left:45%;">');
			$.ajax({
				url:"<?=base_url('eTemplate/index/1')?>",
				method:"POST",
				data:"",
				success:function(data){
					if(data == ""){
						$("#etModalContent").html('Not Completed Yet!');
					}else{
						$("#etModalContent").html(data);
						$("#sendEmailBtn").show();
					}
					$("#etModal").modal('toggle');
				}
			})
		}
	}	
	
	function sendEmail() {
		var templateId = $("input[name=emailTemplate]:checked").val();
		if(templateId == undefined){
			alert('Please select template!');
		}else{
			$("#sendEmailBtn").hide();
			$("#etModalContent").html('<img src="<?=base_url()?>assets/img/preload.gif" style="margin-left:45%;">');
			$.ajax({
				url:"<?=base_url('project/sendEmailToSelectedTemplate/')?>"+templateId,
				method:"POST",
				data: $('#interviews-list-form').serialize(),
				success:function(data){	
					$("#etModalContent").html(data);
				}
			})
		}
		
	}
	
	$('#interviewCheckAll').change(function(){
		if($('#interviewCheckAll').prop('checked') == true){
			$('input[type=\'checkbox\']').prop('checked', true);
		}else{
			$('input[type=\'checkbox\']').prop('checked', false);
		}
	});
	
	$(function(){

		// if all checkbox are selected, check the selectall checkbox
		// and viceversa
		$(".intCheck").click(function(){
	
			if($(".intCheck").length == $(".intCheck:checked").length) {
				$("#interviewCheckAll").attr("checked", "checked");
			} else {
				$("#interviewCheckAll").removeAttr("checked");
			}
	
		});
	});
</script>