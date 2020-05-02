<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $text_heading_dashboard ?></h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<?php 
						if($this->session->userdata['user_type'] === 'ADMIN' || $this->session->userdata['user_type'] === 'DISTRIBUTOR' || $this->session->userdata['user_type'] === 'ACCOUNT MANAGER') { 
							$class = 'col-md-6';
						}else if($this->session->userdata['user_type'] === 'MANAGER'){
							$class = 'col-md-6';
						}else if($this->session->userdata['user_type'] === 'RATER'){
							$class = 'col-md-12';
						}?>
						<?php if($this->session->userdata['user_type'] === 'ADMIN' || $this->session->userdata['user_type'] === 'DISTRIBUTOR' || $this->session->userdata['user_type'] === 'ACCOUNT MANAGER' || $this->session->userdata['user_type'] === 'MANAGER') { ?>
						<div class="<?= $class ?>">
							<div class="metric">
								<a href="<?= $link_box1 ?>"><span class="icon"><i class="fa fa-universal-access"></i></span></a>
								<p>
									<span class="number"><?= count($box1) ?></span>
									<span class="title"><?= $text_total_box1 ?></span>
								</p>
							</div>
						</div>
						<?php } ?>
						<?php if($this->session->userdata['user_type'] === 'ADMIN' || $this->session->userdata['user_type'] === 'DISTRIBUTOR' || $this->session->userdata['user_type'] === 'ACCOUNT MANAGER' || $this->session->userdata['user_type'] === 'MANAGER') { ?>
						<div class="<?= $class ?>">
							<div class="metric">
								<a href="<?= $link_box2 ?>"><span class="icon"><i class="fa fa-suitcase"></i></span></a>
								<p>
									<span class="number"><?= count($box2) ?></span>
									<span class="title"><?= $text_total_box2 ?></span>
								</p>
							</div>
						</div>
						<?php } ?>
						<?php if($this->session->userdata['user_type'] === 'MANAGER' || $this->session->userdata['user_type'] === 'RATER') { ?>
						<div class="<?= $class ?>">
							<div class="metric">
								<a href="<?= $link_box3 ?>"><span class="icon"><i class="fa fa-tasks"></i></span></a>
								<p>
									<span class="number"><?= count($box3) ?></span>
									<span class="title"><?= $text_total_box3 ?></span>
								</p>
							</div>
						</div>
						<?php } ?>

                        <?php if($this->session->userdata['user_type'] === 'MANAGER') { ?>
                            <div class="<?= $class ?>">
                                <div class="metric">
                                    <a href="Javascript:void(0)"><span class="icon"><i class="fa fa-tasks"></i></span></a>
                                    <p>
                                        <?php $total_credit = isset($user_info['profile']['credits']) ? $user_info['profile']['credits'] : 0 ?>
                                        <span class="number"><?= $total_credit ?></span>
                                        <span class="title"><?= $this->lang->line('Credit') ? $this->lang->line('Credit') : 'Credit'?></span>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>