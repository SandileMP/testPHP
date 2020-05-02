<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<!-- OVERVIEW -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_heading_dashboard ?></h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<?php 
						if($this->session->userdata['user_type'] === 'ADMIN') { 
							$class = 'col-md-6';
						}else{
							$class = 'col-md-4';
						} ?>
						<div class="<?= $class ?>">
							<div class="metric">
								<a href="<?= $user_link ?>"><span class="icon"><i class="fa fa-universal-access"></i></span></a>
								<p>
									<span class="number"><?= count($users) ?></span>
									<span class="title"><?= $text_total_users ?></span>
								</p>
							</div>
						</div>
						<div class="<?= $class ?>">
							<div class="metric">
								<a href="<?= $link_job_profile ?>"><span class="icon"><i class="fa fa-suitcase"></i></span></a>
								<p>
									<span class="number"><?= count($job_profiles) ?></span>
									<span class="title"><?= $text_total_job_profiles ?></span>
								</p>
							</div>
						</div>
						<?php if($this->session->userdata['user_type'] !== 'ADMIN') { ?>
						<div class="<?= $class ?>">
							<div class="metric">
								<a href="<?= $link_project ?>"><span class="icon"><i class="fa fa-tasks"></i></span></a>
								<p>
									<span class="number"><?= count($projects) ?></span>
									<span class="title"><?= $text_total_projects ?></span>
								</p>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php if($user_type == 'CLIENTS') { ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><?= $text_job_profiles ?></h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body">
							<ul class="list-unstyled todo-list">
								<?php if($job_profiles) { ?>
								<?php foreach ($job_profiles as $job_profile) { ?>
								<li style="padding: 10px;">
									<span class="title"><?= $job_profile->title ?> (<?= $job_profile->role_title ?>)</span>
									<ol>
									<?php foreach (json_decode($job_profile->question_list) as $question) { ?>
										<li>
											<span class="date text-danger" style="float: right;color: red;"><?= $question->expire ?> SECONDS</span>
											<span class="short-description"><?= $question->question ?></span>
										</li>
									<?php } ?>
									</ol>
								</li>
								<?php } ?>
								<?php } else { ?>
								<li>
									<span class="date text-danger">No Profile Found!!</span>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<div class="clearfix"></div>