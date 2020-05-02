<footer>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<p class="copyright"><?=$text_footer?></p>
			</div>
			<div class="col-sm-2">
				<!-- <img src="<?=base_url()?>assets/img/footer_logo.png" class="footer-logo" height="50px;" /> -->
			</div>
		</div>
	</div>
</footer>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="<?=base_url()?>assets/scripts/mediaelement-and-player.js"></script>
<script src="<?=base_url()?>assets/scripts/demo.js"></script>
<script src="<?=base_url()?>assets/scripts/klorofil-common.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/datetimepicker/moment.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="<?=base_url()?>assets/vendor/chartist/js/chartist.min.js"></script>
<script src="<?=base_url()?>assets/vendor/toastr/toastr.min.js"></script>
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

var video = $('#player1');
var videoDomObj = video.get(0);
var is_firefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;

if (!is_firefox){
    video.on('click', function(e){
        if (videoDomObj.paused){
            videoDomObj.play();
        } else{
            videoDomObj.pause();
        }
    });
    $('.btn-close-video').click(function(){
    	videoDomObj.pause();
    })
}
$('.watch_interview').click(function(){
	var flag = false;
	var $button = $(this);
	var client_id = $button.attr('data-client');
	var interview_id = $button.attr('data-interview');
	if($button.attr('data-credited')==0)
	{
		$.ajax({
			url:"<?=base_url('credit/deductAjaxCredit')?>",
			data:"client_id="+client_id+"&interview_id="+interview_id,
			method:"POST",
			async: false,
			success:function(data){
				if(data==1)
				{
					$button.attr('data-credited',1);
					var path = $button.val();
					$('#watch_interview_model .modal-body video').html('<source src="<?=base_url()?>application/controllers/interview/uploads/'+path+'" type="video/webm">');
					$('#watch_interview_model .modal-body #player1_html5').attr('src','<?=base_url()?>application/controllers/interview/uploads/'+path);
					$('#watch_interview_model').modal({backdrop: 'static'});
				}
				else if(data==0)
				{
					alert("Not Enough Credit!");
					return false;
				}
				else
				{
					alert("Some Internal Error!");
					return false;
				}
			}
		})
	}
	else
	{
		var path = $button.val();
		$('#watch_interview_model .modal-body video').html('<source src="<?=base_url()?>application/controllers/interview/uploads/'+path+'" type="video/webm">');
		$('#watch_interview_model .modal-body #player1_html5').attr('src','<?=base_url()?>application/controllers/interview/uploads/'+path);
		$('#watch_interview_model').modal({backdrop: 'static'});
	}
});
</script>
</body>
</html>