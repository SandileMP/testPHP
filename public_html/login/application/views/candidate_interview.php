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
										<?php if($interview_completed) { ?>
										<button type="button" name="watch_interview" class="btn btn-info watch_interview" data-toggle="tooltip" value="<?= $interview_completed['path'] ?>" title="<?= $button_watch ?>"><?= $button_watch ?></button>
										<?php } else { ?>
										<button type="submit" name="begin_interview" class="btn btn-info begin_interview" data-toggle="tooltip" value="<?= $project['project_code'] ?>" title="<?= $button_begin ?>"><?= $button_begin ?></button>
										<?php } ?>
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
			            <div class="media-wrapper" style="width: 100%">
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
