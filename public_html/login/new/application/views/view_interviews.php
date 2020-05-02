<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_interviews; ?></h3>
				</div>
				<div class="pull-right">
					<a href="<?= $cancel ?>" class="btn btn-default" data-toggle="tooltip" title="<?= $button_cancel ?>"><i class="fa fa-reply"></i></a>
				</div>
				<br><br>
				<div class="panel-body no-padding table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th><?= $entry_project_name ?></th>
								<th><?= $entry_interview_candidate ?></th>
								<th><?= $entry_interview_start ?></th>
								<th><?= $entry_interview_end ?></th>
								<th><?= $entry_action ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if($interviews) { ?>
							<?php foreach ($interviews as $interview) { ?>
							<tr>
								<td><?= $interview['project'] ?></td>
								<td><?= $interview['candidate'] ?></td>
								<td><?= $interview['start'] ?></td>
								<td><?= $interview['end'] ?></td>
								<td>
									<button type="button" name="watch_interview" class="btn btn-info watch_interview" data-toggle="tooltip" value="<?= $interview['path'] ?>" title="<?= $button_watch ?>"><?= $button_watch ?></button>
								</td>
							</tr>
							<?php } ?>
							<?php } else { ?>
							<tr>
								<td colspan="8" class="text-center"><?= $text_empty ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
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