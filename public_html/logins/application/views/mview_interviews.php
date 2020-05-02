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
.plyr--video.plyr--loading .plyr__progress__buffer {
	background-color: #4eabfe;
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
						<div style="float:right; font-size:18px;"><span class="text-success" ><?=$this->session->flashdata('success');?></span></div>
                        <div style="float:right; font-size:18px;"><span class="text-danger" ><?=$this->session->flashdata('danger');?></span></div>
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
                <?php if ($this->session->userdata['user_type'] == 'MANAGER') {?>
                     <a href="javascript:void(0);" onclick="getEmailTemplate();" class="btn btn-warning" data-toggle="tooltip" title="Send Email">Send Email</a>

                     <button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#interviews-list-form').attr('action','<?=base_url('project/enableSelectedInterview/')?>').submit();" class="btn btn-primary" data-toggle="tooltip" title="Enable">Enable</button>

                     <button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#interviews-list-form').attr('action','<?=base_url('project/disableSelectedInterview/')?>').submit();" class="btn btn-info" data-toggle="tooltip" title="Disable">Disable</button>

                     <button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#interviews-list-form').attr('action','<?=base_url('project/resetSelectedInterview/')?>').submit();" class="btn btn-danger" data-toggle="tooltip" title="Reset">Reset</button>
                     <button type="button" onclick="if(!confirm('Are You Sure?')){return false;}$('#interviews-list-form').attr('action','<?=base_url('project/deleteCandidate/')?>').submit();" class="btn btn-danger" data-toggle="tooltip" title="Delete">Delete</button>
                <?php }?>
                    <a href="<?php echo $cancel ?>" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_cancel ?>"><i class="fa fa-reply"></i></a>
				</div>
				<div class="clearfix"></div>
				<div class="panel-body table-responsive">
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
								<?php
                                    if ($entry_rater_evaluation) {
                                    $raterCounter = 0;
                                ?>

								<?php foreach ($entry_rater_evaluation as $rater_name) {?>
								<th class="text-center"><?=$rater_name?></th>
								<?php $raterCounter++; }?>
								<?php }?>
								<th class="text-center"><?=$entry_manager_evaluation?></th>
							</tr>
						</thead>
						<tbody>
							<?php if ($interviews) { ?>
							<?php foreach ($interviews as $mkey => $interview) { ?>
                            <?php
                                $question = array();
                                if(!empty($interview['question_data'])){
                                    $question = $interview['question_data'];
                                }
                            ?>
							<tr>
                                <td>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" class="intCheck" name="interviewIdCheck[<?=$mkey?>]" value="<?=$interview['interview_id']?>" />
                                        <span></span>
                                    </label>
                                    <input type="hidden" name="candidateId[<?=$mkey?>]" value="<?=$interview['candidate_id']?>" />
                                    <input type="hidden" name="projectId[<?=$mkey?>]" value="<?=$interview['project_id']?>" />
                                    <?php $mmstatus = !empty($interview['path']) ? 1 : 0?>
                                    <input type="hidden" name="mmstatus[<?=$mkey?>]" value="<?=$mmstatus?>" />
                                </td>
								<td><?=$interview['candidate']?></td>
								<td><?=$interview['project']?></td>
								<td>
									<span class="label label_<?= $interview['interview_id'] ?> <?= interviewStatusColor($interview['status']) ?>"><?= interviewStatus($interview['status'])?></span><br>
									<span class="email_type<?=$interview['candidate_id']?> label label-info"><?=$interview['email_type']?></span>
								</td>
								<td>
									<?php if ($interview['interview_id']):?>
										<div class="watch_interview_container <?= ($interview['interview_id'] &&  $interview['status'] != 1 ) ? 'hide' : ''  ?>">
											<button type="button" data-interview=<?= $interview['interview_id'] ?> data-client="<?= $interview['account_manager_id']?>" data-credited="<?= $interview['is_credited']?>" class="btn btn-info watch_interview" data-toggle="tooltip" value="<?= $interview['path']?>" title="<?= $button_watch ?>" data-videoduration="<?= $interview['total_time_taken'] ?>">
												<?=$button_watch?>
											</button>
											<br><br>
											<?php if($interview['interview_id'] && in_array($interview['status'],checkAjaxStatus())): ?>
												<span class="ajax_status_call hide" data-checkInterview="<?=$interview['interview_id']?>" data-status="<?= $interview['status']?>"></span>
											<?php endif ?>
											<button class="btn btn-warning" type="button" onclick="copyThis('<?=$interview['full_path']?>')">Copy</button>
										</div>
									<?php endif ?>

                                    <div class="interview-question hide">
                                        <?php if($question && !empty($question)):?>
                                            <?php $view_time = 0;?>
                                            <?php
                                            foreach ($question as $question_no => $questionInfo) :
                                                $time_taken = isset($questionInfo['time_taken']) ? $questionInfo['time_taken'] : $questionInfo['expire'];
                                            ?>
                                                <button
                                                        class="question btn btn-sm btn-primary"
                                                        data-expire="<?= $time_taken ?>"
                                                        data-question="<?= $questionInfo['question'];?>"
                                                        view-time="<?= $view_time;?>">Question - <?= ($question_no+1) ?>
                                                </button>
                                            <?php
                                            $view_time = ($view_time + $time_taken);
                                            endforeach;
                                            ?>
                                        <?php endif; ?>
                                    </div>
								</td>
								<?php if ($interview['rater_evaluation']) {?>
									<?php foreach ($interview['rater_evaluation'] as $key => $rater) {?>
									<td><?php if ($interview['interview_id']) {?>
											<?php if ($rater['rating'] == 1) {
                                                $class = 'red';
                                            } else if ($rater['rating'] == 2) {
                                                $class = 'orange';
                                            } else if ($rater['rating'] == 3) {
                                                $class = 'green';
                                            } else {
                                                $class = '';
                                            }?>
											<label class=" <?=$class?>">
												<input type="radio"
												class="class_ev_rate"
												value="1"
												style="display: none;"
												disabled
												<?=$rater['rating'] ? 'checked' : ''?>>
												<div class="layer"></div>
		  										<div class="button"><span></span></div>
											</label><br>
											<a href="javascript:void(0)" style="text-decoration: underline;" onclick="viewComment(<?=$interview['interview_id']?>,'RATER',<?=$rater['rater_id']?>)">View Comment</a>
										<?php }?>
									</td>
									<?php }?>
								<?php }?>
								<td><?php if ($interview['interview_id']) {?>
									<label class=" red">
										<input type="radio"
										class="class_ev_rate"
										value="1"
										style="display: none;"
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
										<?=$interview['manager_eva_rating'] == 3 ? 'checked' : ''?>
										onchange="updateRating(this.value,<?=$interview['interview_id']?>)"
										name="optradio[<?=$mkey?>]">
										<div class="button"><span></span></div>
									</label><br>
									<a href="javascript:void(0)" onclick="addComment(<?=$interview['interview_id']?>,'MANAGER','')">Add Comment</a>
									<?php }?>
								</td>
							</tr>
							<?php }?>
							<?php } else {?>
							<tr>
								<td colspan="<?= (6 + $raterCounter)?>" class="text-center"><?=$text_empty?></td>
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
						<div class="media-wrapper" style="width: 100%; ">						
			                <video id="player1" class="video-js custom-video-js" width="100%" height="350" style="max-width:100%;" controls crossorigin playsinline webkit-playsinline data-setup='{ "inactivityTimeout": 0 }'></video>							
			            </div>
			        </div>
			    </div>
                <div class="container text-left modal_question_view"></div>
                <div class="container text-left modal_question_btn_list"></div>
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
        <h4 class="modal-title">Comments</h4>
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
		        <button type="button" class="close close_comment_box" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Add Comment</h4>
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
		        <button type="button" class="btn btn-default close_comment_box" data-dismiss="modal">Close</button>
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

<script>
	$('.close_comment_box').click(function(){
		$('#saveResponse').empty();
	});
	$(document).ready(function(){
		$("#saveCommentFrm").on('submit',function(e){
			e.preventDefault();
			$.ajax({
				url:"<?=base_url('project/saveComment')?>",
				method:"post",
				data:$("#saveCommentFrm").serialize(),
				success:function(data){
					if(data==1){
						$("#saveResponse").html(`
							<div class="alert alert-success fade in alert-dismissable"">
								<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
								<strong>Success!</strong> Your comment has been Added Successfully.
							</div>
							`);
					}
					else
					{
						$("#saveResponse").html(`
							<div class="alert alert-danger fade in alert-dismissable"">
								<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
								<strong>Failed!</strong> Your comment Add Failed.
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
				if(data==0){
					alert("Rating Update Failed");
				}
			}
		})
	}

	function viewComment(x,type,id)	{
		$.ajax({
			url:"<?=base_url('project/viewComment')?>",
			method:"POST",
			data:{
				"interview_id":x,
				"type":type,
				"id":id,
			},
			success:function(data){
				if(data == ""){
					$("#vcModalContent").html('Not Completed Yet!');
				}else{
				$("#vcModalContent").html('<p>'+data+'</p>');
				}
				$("#vcModal").modal({backdrop: 'static', keyboard: false, show: false});
				$("#vcModal").modal('toggle');
			}
		})
	}

	function addComment(x,type,id) {
		$.ajax({
			url:"<?=base_url('project/getComment')?>",
			method:"POST",
			data:{
				"interview_id":x,
				"type":type,
				"id":id,
			},
			success:function(data){
				$("#txt_comment").val(data);
				$("#txt_interview_id").val(x);
				$("#acModal").modal({backdrop: 'static', keyboard: false, show: false});
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
					$("#etModal").modal({backdrop: 'static', keyboard: false, show: false});
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
				dataType: 'json',
				success:function(data){
					$("#etModalContent").html(data.msg);
					if(data.email_type){
						$.each(data.email_type, function(key,value){
							$(".email_type"+key).text(value);
						});
					}
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
		ajaxStatusCall();
	});

	function copyThis(url) {
		var node = document.createElement( "textarea" );
		node.innerHTML = url;
		document.body.appendChild( node );
		node.select();

		document.execCommand( "copy" );
		document.body.removeChild( node );
	}

	function ajaxStatusCall()
	{
		var ajax_count = [];
		var ajax_call_data = [];
		if($('.ajax_status_call').length)
		{
			$('.ajax_status_call').each(function(){
				ajax_call_data.push($(this).attr('data-checkInterview'));
			});			
			if(ajax_call_data.length > 0){
				var ajaxCall = $.ajax({
					url:"<?=base_url('project/getInterviewStatus')?>",
					method:"POST",
					data:{'check_interview': ajax_call_data},
					dataType:"json",
					success:function(interviewData){
						if(interviewData.length){
							jQuery.each( interviewData, function( i, interviewVal ) {															
								$('.label_'+interviewVal.id).html(interviewVal.label);
								$('.label_'+interviewVal.id).attr({'class':'label ' + interviewVal.label_color + ' ' + 'label_'+interviewVal.id});
								if(interviewVal.status == 1){
									$('span[data-checkInterview="'+interviewVal.id+'"]').parents('.watch_interview_container:FIRST').removeClass('hide');
								}
								if(interviewVal.status == 1 || interviewVal.status == 6){
									$('span[data-checkInterview="'+interviewVal.id+'"]').remove();
								}
								
							});							
						}
						setTimeout(ajaxStatusCall, 3000);
					}
				});
			}
		}
	}
</script>
