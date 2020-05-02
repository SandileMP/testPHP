<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title>Register | Interview</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/img/icon/favicon.png">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
	<link href="<?= base_url() ?>assets/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<script type="text/javascript" src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.date').datetimepicker({
				pickTime: false
			});
			$('.time').datetimepicker({
				pickDate: false
			});
			$('.datetime').datetimepicker({
				pickDate: true,
				pickTime: true
			});
		})
		$(document).delegate('.date','click',function(){
			$('.date').datetimepicker({
				pickTime: false
			});
		});
		$(document).delegate('.time','click',function(){
			$('.time').datetimepicker({
				pickDate: false
			});
		});
		$(document).delegate('.datetime','click',function(){
			$('.datetime').datetimepicker({
				pickDate: true,
				pickTime: true
			});
		});
		$(document).ready(function(){
			$('#dobselect').click(function(){
				$('.datepicker .datepicker-days table tbody').click(function(){
					var myabc = setInterval(function(){
						var dob = $('#dob').val();
							dob = new Date(dob);
						var today = new Date();
						var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
						$('#age').val(age);
						clearInterval(myabc);
					}, 1000);
				});
			});
			$('#dob').change(function(){
				var myabc = setInterval(function(){
					var dob = $('#dob').val();
						dob = new Date(dob);
					var today = new Date();
					var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
					$('#age').val(age);
					clearInterval(myabc);
				}, 1000);
			});
		})
	</script>
</head>
<body>
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1 login-box register-form">
						<div class="content">
							<?php if(isset($register_error)) { ?>
							<div class="alert alert-danger">
								<?php echo $register_error; ?>
								<button type="button" class="close" data-dismiss="alert">×</button>
								</div>
							<?php } ?>
							<div class="header">
								<p class="lead">Register For Interview</p>
							</div>
							<form class="form-auth-small" action="<?= $action ?>" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="firstname" class="control-label" required>First Name</label>
											<input type="text" class="form-control" name="firstname" value="<?= $firstname ?>" id="firstname" placeholder="First Name">
										</div>
										<?php if($firstname_error) { ?>
										<div class="text-danger"><?= $firstname_error ?></div>
										<?php } ?>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="lastname" class="control-label" required>Last Name</label>
											<input type="text" class="form-control" name="lastname" value="<?= $lastname ?>" id="lastname" placeholder="Last Name" autocomplete="off">
										</div>
										<?php if($lastname_error) { ?>
										<div class="text-danger"><?= $lastname_error ?></div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="control-label" required>Email</label>
									<input type="email" class="form-control" name="email" value="<?= $email ?>" id="email" placeholder="Email">
								</div>
								<?php if($email_error) { ?>
								<div class="text-danger"><?= $email_error ?></div>
								<?php } ?>
								<div class="form-group">
									<label for="id" class="control-label" required>ID / Passport</label>
									<input type="text" class="form-control" name="id" value="<?= $id ?>" id="id" placeholder="ID / Passport">
								</div>
								<?php if($id_error) { ?>
								<div class="text-danger"><?= $id_error ?></div>
								<?php } ?>
								<div class="form-group">
								<label>Date Of Birth</label>
									<div class="input-group date">
									<input type="text" class="form-control" name="dob" value="<?= $dob ?>" id="dob" placeholder="Date Of Birth">
				                    <span class="input-group-btn">
				                    <button class="btn btn-default" id="dobselect" type="button"><i class="fa fa-calendar"></i></button>
				                    </span>
			                	</div>
							</div>
								<?php if($dob_error) { ?>
								<div class="text-danger"><?= $dob_error ?></div>
								<?php } ?>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="gender" class="control-label" required>Gender</label>
											<select name="gender" class="form-control">
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="age" class="control-label" required>Age</label>
											<input type="number" name="age" id="age" value="<?= $age ?>" class="form-control" placeholder="Age" />
										</div>
										<?php if($age_error) { ?>
										<div class="text-danger"><?= $age_error ?></div>
										<?php } ?>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nationality" class="control-label" required>Nationality</label>
											<select name="nationality" class="form-control">
												<?php foreach ($nationality as $key => $value) { ?>
												<option value="<?= $value->alpha_3_code ?>" <?php if($value->alpha_3_code == 'ZAF') { ?> selected="selected" <?php } ?>><?= $value->nationality ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="ethnicity" class="control-label" required>Ethnicity</label>
											<select name="ethnicity" class="form-control">
                                                <option value="white">White</option>
                                                <option value="hispanic_or_latino">Hispanic or Latino</option>
                                                <option value="black_or_african">Black or African</option>
                                                <option value="native_american_or_american_indian">Native American or American Indian</option>
                                                <option value="asian">Asian</option>
                                                <option value="coloured">Coloured</option>
                                                <option value="other">Other</option>
                                            </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="highest_education" class="control-label" required>Highest Education</label>
											<select name="highest_education" class="form-control">
                                                <option value="high_school">High School</option>
                                                <option value="college_certificate">College Certificate</option>
                                                <option value="college_diploma">College Diploma</option>
                                                <option value="trade/technical/vocational_training">Trade/Technical/Vocational Training</option>
                                                <option value="bachelors_degree">Bachelors Degree</option>
                                                <option value="honours_degree">Honours Degree</option>
                                                <option value="masters_degree">Masters Degree</option>
                                                <option value="doctorate_degree">Doctorate Degree</option>
                                            </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="marital_status" class="control-label" required>Marital Status</label>
											<select name="marital_status" class="form-control">
                                                <option value="single_never_married">Single, Never Married</option>
                                                <option value="married_or_domestic_partnership">Married or Domestic Partnership</option>
                                                <option value="widowed">Widowed</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="separated">Separated</option>
                                            </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="employeement_status" class="control-label" required>Employment Status</label>
											<select name="employeement_status" class="form-control">
                                                <option value="employed_full_time">Employed Full Time</option>
                                                <option value="employed_part_time">Employed Part Time</option>
                                                <option value="self-employed">Self-Employed</option>
                                                <option value="out_of_work_and_looking_for_work">Out of work and looking for work</option>
                                                <option value="a_homemaker">A homemaker</option>
                                                <option value="a_student">A student</option>
                                                <option value="retired">Retired</option>
                                                <option value="unable_to_work">Unable to work</option>
                                            </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="phone" class="control-label" required>Phone Number</label>
											<input type="number" name="phone" value="<?= $phone ?>" class="form-control" placeholder="Phone Number" />
										</div>
										<?php if($phone_error) { ?>
										<div class="text-danger"><?= $phone_error ?></div>
										<?php } ?>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="home_language" class="control-label" required>Home Language</label>
											<select name="home_language" class="form-control">
		                                        <option value="other">Other</option>
		                                        <option value="afrikaans">Afrikaans</option>
		                                        <option value="english">English</option>
		                                        <option value="hindi">Hindi</option>
		                                        <option value="ndebele">Ndebele</option>
		                                        <option value="northern_sotho">Northern Sotho</option>
		                                        <option value="sotho">Sotho</option>
		                                        <option value="swazi">Swazi</option>
		                                        <option value="tsonga">Tsonga</option>
		                                        <option value="tswana">Tswana</option>
		                                        <option value="venda">Venda</option>
		                                        <option value="xhosa">Xhosa</option>
		                                        <option value="zulu">Zulu</option>
		                                        <option value="chinese">Chinese</option>
		                                        <option value="spanish">Spanish</option>
		                                        <option value="arabic">Arabic</option>
		                                        <option value="portuguese">Portuguese</option>
		                                        <option value="russian">Russian</option>
		                                        <option value="japanese">Japanese</option>
		                                        <option value="german">German</option>
		                                        <option value="korean">Korean</option>
		                                        <option value="french">French</option>
	                                        </select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="current_job_level" class="control-label" required>Current Job Level</label>
											<select name="current_job_level" class="form-control">
                                                <option value="administration/entry_level">Administration/Entry level</option>
                                                <option value="junior_management/supervisory">Junior Management/Supervisory</option>
                                                <option value="middle_management">Middle Management</option>
                                                <option value="senior_management">Senior Management</option>
                                                <option value="executive_management">Executive Management</option>
                                                <option value="professional/specialist">Professional/Specialist</option>
                                            </select>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary">SUBMIT</button>
							</form>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="row login_footer">
					<div class="col-sm-12">
						<img src="<?= base_url() ?>assets/img/footer_logo.png" height="50px" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/datetimepicker/moment.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
</body>
</html>