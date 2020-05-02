<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?= $dashboard ?>" class="active"><i class="fa fa-dashboard"></i> <span><?= $text_dashboard ?></span></a></li>
				<?php if($userDetail['type'] == 'ADMIN') { ?>
				<li><a href="<?= $create_hr ?>" ><i class="fa fa-user-secret"></i> <span><?= $text_create_hr ?></span></a></li>
				<!-- <li>
					<a href="#admin" data-toggle="collapse" class="collapsed"><i class="fa fa-user-secret"></i> <span><?= $text_admin ?></span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="admin" class="collapse ">
						<ul class="nav">
							<li><a href="<?= $create_hr ?>" class=""><?= $text_create_hr ?></a></li>
						</ul>
					</div>
				</li> -->
				<!-- <li><a href="<?= $admin_view_interview ?>" class=""><i class="fa fa-eye"></i><?= $text_view_interview ?></a></li> -->
				<?php } ?>
				<?php if($userDetail['type'] == 'CLIENT') { ?>
				<!-- <li>
					<a href="#hr" data-toggle="collapse" class="collapsed"><i class="fa fa-user"></i> <span><?= $text_hr ?></span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="hr" class="collapse ">
						<ul class="nav">
							<li><a href="<?= $create_manager ?>" class=""><?= $text_create_manager ?></a></li>
						</ul>
					</div>
				</li> -->
				<li><a href="<?= $create_manager ?>" class=""><i class="fa fa-user-o"></i> <span><?= $text_create_manager ?></span></a></li>
				<li><a href="<?= $create_job_profile ?>" class=""><i class="fa fa-suitcase"></i><span><?= $text_create_job_profile ?></span></a></li>
				<li><a href="<?= $create_project ?>" class=""><i class="fa fa-tasks"></i><span><?= $text_create_project ?></span></a></li>
				<li><a href="<?= $view_interview ?>" class=""><i class="fa fa-eye"></i><span><?= $text_view_interview ?></span></a></li>
				<?php } ?>
				<?php if($userDetail['type'] == 'MANAGER') { ?>
				<!-- <li>
					<a href="#manager" data-toggle="collapse" class="collapsed"><i class="fa fa-user"></i> <span><?= $text_manager ?></span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="manager" class="collapse ">
						<ul class="nav">
							<li><a href="<?= $invite_interview ?>" class=""><?= $text_invite_interview ?></a></li>
							<li><a href="<?= $manage_interview ?>" class=""><?= $text_manage_interview ?></a></li>
						</ul>
					</div>
				</li> -->
				<!-- <li><a href="<?= $invite_interview ?>" class=""><i class="fa fa-vcard"></i><span><?= $text_invite_interview ?></span></a></li> -->
				<li><a href="<?= $manage_interview ?>" class=""><i class="fa fa-tasks"></i><span><?= $text_manage_interview ?></span></a></li>
				<li><a href="<?= $candidate ?>" class=""><i class="fa fa-users"></i><span><?= $text_applicant ?></span></a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>
</div>
