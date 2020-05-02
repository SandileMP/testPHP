<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<!-- OVERVIEW -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_heading_dashboard ?></h3>
				</div>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post">
						<table class="table">
							<thead>
								<tr>
									<th><?= $entry_project_name ?></th>
									<th><?= $entry_job_title ?></th>
									<th><?= $entry_start_date ?></th>
									<th><?= $entry_end_date ?></th>
									<th><?= $entry_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($project) { ?>
								<tr>
									<td><?= $project['project_name'] ?></td>
									<td><?= $project['title'] ?></td>
									<td><?= $project['start_date'] ?></td>
									<td>
										<?php if($project['project_type'] == 'open') { ?>
										<?php echo "OPEN"; ?>
										<?php } else { ?>
										<?= $project['end_date'] ?>
										<?php } ?>
									</td>
									<td>
										<button type="submit" name="begin_interview" class="btn btn-info begin_interview" data-toggle="tooltip" value="<?= $project['project_code'] ?>" title="<?= $button_begin ?>"><?= $button_begin ?></button>
									</td>
								</tr>
								<?php } else { ?>
								<tr>
									<td colspan="3" class="text-center"><?= $text_empty_candidate ?></td>
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
