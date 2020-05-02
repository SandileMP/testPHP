<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<?php if ($warning) {?>
				<div class="alert alert-danger">
					<?=$warning?>
					<button class="close" data-dismiss="alert"></button>
				</div>
				<?php }?>
				<div class="panel-heading">
					<h3 class="panel-title"><?=$heading_title;?></h3>
				</div>
				<div class="pull-right">
					<button type="button" onclick="$('#create-form').submit();" class="btn btn-success" data-toggle="tooltip" title="<?=$button_save?>"><i class="fa fa-save"></i></button>
					<a href="<?=$cancel?>" class="btn btn-default" data-toggle="tooltip" title="<?=$button_cancel?>"><i class="fa fa-reply"></i></a>
				</div>
				<br><br>
				<form action="<?=$action?>" method="post" id="create-form">
				<div class="panel-body">
					<label><?=$entry_client?></label>
					<input type="text" name="client" class="form-control" value="<?=$client?>" placeholder="<?=$entry_client?>" />
					<?php if ($error_client) {?>
					<div class="text-danger"><?=$error_client?></div>
					<?php }?>
					<br>

					<label><?=$entry_name?></label>
					<input type="email" name="name" class="form-control" value="<?=$name?>" placeholder="<?=$entry_name?>" />
					<?php if ($error_name) {?>
					<div class="text-danger"><?=$error_name?></div>
					<?php }?>
					<br>

					<label><?=$entry_email?></label>
					<input type="email" name="email" class="form-control" value="<?=$email?>" placeholder="<?=$entry_email?>" />
					<?php if ($error_email) {?>
					<div class="text-danger"><?=$error_email?></div>
					<?php }?>
					<br>

					<label><?=$entry_phone?></label>
					<input type="text" name="phone" class="form-control" value="<?=$phone?>" placeholder="<?=$entry_phone?>" />
					<?php if ($error_phone) {?>
					<div class="text-danger"><?=$error_phone?></div>
					<?php }?>
					<br>

					<label><?=$entry_address?></label>
					<textarea name="address" class="form-control" rows="5" placeholder="<?=$entry_address?>"><?=$address?></textarea>
					<?php if ($error_address) {?>
					<div class="text-danger"><?=$error_address?></div>
					<?php }?>
					<br>

					<label><?=$entry_credit?></label>
					<input type="number" min="0" name="credits" class="form-control" placeholder="<?=$entry_credit?>" value="<?=$credits?>" />
					<?php if ($error_credit) {?>
					<div class="text-danger"><?=$error_credit?></div>
					<?php }?>
					<br>

					<label>Status</label>
					<select class="form-control" name="status">
						<option value="0">Deactivate</option>
						<option value="1" <?=$status == 1 ? 'selected' : ''?>>Activate</option>
					</select>
					<br>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>