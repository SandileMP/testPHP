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
                        </div>
                        <div class="col-sm-4">
                            <h3 class="panel-title"><?= $text_project_role_title ?></h3>
                            <p class="panel-subtitle"><?= $interview_detail['role_title'] ?></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="panel-body" align="center">
                        <h1 class="text-capitalize text-primary"><strong><?= $text_start_interview_heading2 ?></strong></h1>
                        <ol class="text-uppercase" style="width: 60%;margin-top: 40px;margin-bottom: 40px;">
                            <li class="text-info"><?= $text_start_interview_instructions ?></li>
                            <li class="text-danger"><?= $text_start_interview_instructions2 ?></li>
                        </ol>
                        <div class="icon"><i class="fa fa-laptop"></i></div>
                        <input type="hidden" name="invite_id" value="<?= $interview_detail['invite_id'] ?>" />
                        <button type="button" value="start_interview" id="start_recording" class="btn btn-success btn-lg"><?= $button_start_recording ?></button>
                        <button type="button" value="test_interview" id="test_recording" class="btn btn-success btn-lg"><?= $button_test_interview ?></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php 
$class = new Device_detect();
$info = $class->getInfo()['browser'];
?>
<script type="text/javascript">
$('#start_recording,#test_recording').click(function(){
    var browser = '<?php echo $info; ?>';
   if(browser !== "Chrome" && browser !== "Firefox"){
        $.alert({
            title: 'Error',
            icon: 'fa fa-warning',
            type: 'red',
            content: 'Your Browser does not supported video recording!',
        });
        return false;   
    }else{
        var button = $(this).val();
        navigator.getUserMedia = navigator.getUserMedia ||
                                navigator.webkitGetUserMedia ||
                                navigator.mozGetUserMedia ||
                                navigator.msGetUserMedia;

        if (navigator.getUserMedia) {
            navigator.getUserMedia({ audio: true, video: { width: 1280, height: 720 } },
                function(stream) {
                    if(button === 'start_interview'){
                        window.location.href = '<?= $action ?>';
                    }else{
                        window.location.href = '<?= $test_action ?>';
                    }
                },
                function(err) {
                    $.alert({
                        title: 'Error',
                        icon: 'fa fa-warning',
                        type: 'red',
                        content: 'Web Cam Device Not Found!',
                    });
                    console.log("The following error occurred: " + err.name);
                    return false;
                }
            );
        } else {
            if(browser !== "Chrome"){
                $.alert({
                    title: 'Error',
                    icon: 'fa fa-warning',
                    type: 'red',
                    content: 'Your Browser does not supported User Media!',
                });
                return false;
            }
        }
    }
});
</script>