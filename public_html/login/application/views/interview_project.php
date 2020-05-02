<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_manage_interview; ?></h3>
				</div>
				<div class="pull-left" style="margin-left: 25px;">
					<form action="<?=$search_action?>" method="post" class="form-inline">
						<input type="text" name="text_search" class="form-control" placeholder="Search Here.." required="" />
						<button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
					</form>
				</div>
				<br><br>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post">
						<table class="table">
							<thead>
								<tr>
									<th><?= $entry_candidate ?></th>
									<th><?= $entry_project_name ?></th>
									<th><?= $entry_profile ?></th>
									<th><?= $entry_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($projects) { ?>
								<?php foreach ($projects as $project) { ?>
								<tr>
									<td>
										<?php if($project['candidate']) { ?>
										<?php foreach ($project['candidate'] as $candidate) { ?>
										<small><?= $candidate ?></small><br>
										<?php } ?>
										<?php } else { ?>
										No Candidates
										<?php } ?>
									</td>
									<td><?= $project['project_name'] ?></td>
									<td><?= $project['profile'] ?></td>
									<td>
										<a href="<?= $action ?>/<?= $project['project_id'] ?>"><button type="button" name="view_interview" class="btn btn-info" title="<?= $button_view ?>"><?= $button_view ?></button></a>
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
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>