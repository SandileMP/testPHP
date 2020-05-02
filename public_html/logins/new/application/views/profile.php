<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div role="tabpanel">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?= $text_tab_profile; ?></a>
					</li>
					<li role="presentation">
						<a href="#password" aria-controls="password" role="tab" data-toggle="tab"><?= $text_tab_password; ?></a>
					</li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="profile">
						<div class="panel panel-headline">
							<div class="panel-heading">
								<h3 class="panel-title"><?= $text_heading_profile; ?></h3>
							</div>
							<form action="<?= $action ?>" method="post">
							<div class="panel-body">
								<label><?= $entry_name ?></label>
								<input type="text" class="form-control" value="<?= $name ?>" name="name" placeholder="<?= $entry_name ?>">
								<br>
								<label><?= $entry_email ?></label>
								<input type="email" class="form-control" value="<?= $email ?>" name="email" placeholder="<?= $entry_email ?>">
								<?php if($error_email) { ?>
								<div class="text-danger"><?= $error_email ?></div>
								<?php } ?>
								<br>
								<label><?= $entry_type ?></label>
								<div class="label label-success"><?= $type ?></div>
								<br>
								<br>
								<button type="submit" name="update_profile" value="1" class="btn btn-info"><?= $button_update_profile; ?></button>
							</div>
							</form>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="password">
						<div class="panel panel-headline">
							<div class="panel-heading">
								<h3 class="panel-title"><?= $text_heading_password; ?></h3>
							</div>
							<form action="<?= $action ?>" method="post">
							<div class="panel-body">
								<label><?= $entry_old_password ?></label>
								<input type="password" class="form-control" value="<?= $old_password ?>" name="old_password" placeholder="<?= $entry_old_password ?>">
								<?php if($error_old_password) { ?>
								<div class="text-danger"><?= $error_old_password ?></div>
								<?php } ?>
								<br>
								<label><?= $entry_new_password ?></label>
								<input type="password" class="form-control" value="<?= $new_password ?>" name="new_password" placeholder="<?= $entry_new_password ?>">
								<?php if($error_new_password) { ?>
								<div class="text-danger"><?= $error_new_password ?></div>
								<?php } ?>
								<br>
								<label><?= $entry_retype_password ?></label>
								<input type="password" class="form-control" name="retype_password" placeholder="<?= $entry_retype_password ?>">
								<?php if($error_retype_password) { ?>
								<div class="text-danger"><?= $error_retype_password ?></div>
								<?php } ?>
								<br>
								<br>
								<button type="submit" name="change_password" value="1" class="btn btn-info"><?= $button_change_password; ?></button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<div class="clearfix"></div>