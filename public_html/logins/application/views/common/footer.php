<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
				<p class="copyright" style="float: right;"><?=$text_footer?></p>
			</div>
		</div>
	</div>
</footer>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>

<?php 
echo loadJs([
	"assets/scripts/mediaelement-and-player.js",
	"assets/scripts/demo.js",
	"assets/scripts/klorofil-common.js",
	"assets/vendor/bootstrap/js/bootstrap.min.js",
	"assets/datetimepicker/moment.js",
	"assets/datetimepicker/bootstrap-datetimepicker.min.js",
	"assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js",
	"assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js",
	"assets/vendor/chartist/js/chartist.min.js",
	"assets/vendor/toastr/toastr.min.js",
	"assets/vendor/jQuery-Picklist/dist/js/picklist.min.js",
	"assets/scripts/play_interview_media_new.js",
]);
?>

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
});
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
</script>
</body>
</html>
