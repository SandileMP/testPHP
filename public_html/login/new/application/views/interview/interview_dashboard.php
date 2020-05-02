<div class="container interview-content-div">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-headline">
				<div class="panel-heading" align="center">
					<div class="row" id="interview-detail-panel">
						<div class="col-sm-4">
							<h3 class="panel-title"><?= $text_project_title ?></h3>
							<p class="panel-subtitle"><?= $interview_detail['title'] ?></p>
						</div>
						<div class="col-sm-4">
							<h3 class="panel-title"><?= $text_note ?></h3>
							<p class="panel-subtitle"><?= $interview_detail['note'] ?></p>
						</div>
						<div class="col-sm-4">
							<h3 class="panel-title"><?= $text_project_role_title ?></h3>
							<p class="panel-subtitle"><?= $interview_detail['role_title'] ?></p>
						</div>
					</div>
					<div class="clearfix"></div>
					<br>
				</div>
				<div class="panel-body" align="center">
					<h1 class="text-capitalize text-primary"><strong><?= $text_start_interview_heading1 ?></strong></h1>
					<h4 class="text-info"><?= $text_start_interview_description ?></h4>
					<div class="icon"><i class="fa fa-laptop"></i></div>
					<div class="row">
						<div class="col-sm-12" align="center">
							<a href="<?= $start_interview ?>"><button type="button" class="btn btn-success btn-lg" name="start_interview" id="start_interview"><?= $button_start_interview ?></button></a>
						</div>
					</div>
					<br>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
