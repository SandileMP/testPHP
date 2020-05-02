<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_projects; ?></h3>
				</div>
				<div class="pull-left" style="margin-left: 25px;">
					<form action="<?= $action ?>" method="post" class="form-inline">
						<input type="text" name="text_search" class="form-control" placeholder="Search Here.." required="" />
						<button type="submit" class="btn btn-success" data-toggle="tooltip">GO</button>
					</form>
				</div>
				<div class="clearfix"></div>
				<div class="panel-body no-padding table-responsive">
					<form action="<?= $action ?>" method="post" id="project-list-form">
						<table class="table">
							<thead>
								<tr>
									<th><?= $entry_project_name ?></th>
									<th><?= $entry_project_manager ?></th>
									<th><?= $entry_project_start ?></th>
									<th><?= $entry_project_end ?></th>
									<th><?= $entry_active_candidates ?></th>
									<th><?= $entry_test_completed_candidates ?></th>
									<th><?= $entry_project_notify ?></th>
									<th><?= $entry_project_status ?></th>
									<th><?= $entry_action ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if($projects) { ?>
								<?php foreach ($projects as $project) { ?>
								<tr>
									<td><?= $project['project_name'] ?></td>
									<td class="text-capitalize"><?php if(!$project['manager_name']) { echo "No Manager"; } else { ?><?= $project['manager_name'] ?><?php } ?></td>
									<td>
										<?= $project['start_date'] ?>
									</td>
									<td class="text-uppercase">
										<?php if($project['project_type'] == 'open') { ?>
										<?= $project['project_type'] ?>
										<?php } else { ?>
										<?= $project['end_date'] ?>
										<?php } ?>
									</td>
									<td class="text-uppercase"><?= count($project['candidate']) ?></td>
									<td class="text-uppercase"><?= $project['completed'] ?></td>
									<td class="text-uppercase"><?= $project['notification'] ?></td>
									<td class="text-uppercase"><span class="label <?= $project['status'] == 'create' ? 'label-warning' : 'label-success' ?>"><?= $project['status'] ?></span></td>
									<td>
										<a href="<?= $project_candidate ?>/<?= $project['project_id'] ?>" class="btn btn-primary"><i class="fa fa-users"></i></a>
									</td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
									<td colspan="11" class="text-center"><?= $text_empty ?></td>
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