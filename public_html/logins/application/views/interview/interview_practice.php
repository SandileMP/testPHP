<div class="main" id="candidate-welcome">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title"><?= $heading_title ?></h3>
                </div>
                <div class="panel-body">
                    <p>You will now have the opportunity to answer two general questions to prepare for your e-interview. You will be able to record your interview and also view the recording after you have answered the two questions. You can then either practice these questions again, or start with the actual e-interview. Please note that the questions you will be practicing here is not the same questions you will be asked in the e-interview. </p>
                    <p>As you are practicing these questions and watching your own video, please make sure that you can see and hear yourself clearly. If you can't see and/or hear yourself clearly, the company who requested the e-interview will also not see and/or hear you clearly. You have the opportunity now to ensure you understand how the e-interview system works and how your e-interview will be conducted. </p>
                    <p>The company requesting the e-interview will not see your practice interview answers. They will only have access to your answers from the e-interview. </p>
                    <p>Good luck with your interview </p>

                    <div class="text-center">
                        <button type="button" value="start_interview" id="start_recording" class="btn btn-danger btn-lg" data-redirect="<?= base_url('practice/access') ?>">Start Practicing</button>
                    </div>
                    <div class="next-step"><a href="<?php echo site_url('candidate_interview'); ?>" class="">Next</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$('#start_recording').click(function()
{
    var url = $(this).attr('data-redirect');

    window.location.href = url;
    return;
    /// TODO check browser camera here

    if (navigator.getUserMedia) {
        navigator.getUserMedia({ audio: true, video: { width: 1280, height: 720 } },
            function(stream) {
                window.location.href = url;
            },
            function(err) {
                $.alert({
                    title: 'Error',
                    icon: 'fa fa-warning',
                    type: 'red',
                    content: 'Web Cam Device Not Found! OR Web Cam Permission not given',
                });
                return false;
            }
        );
    } else {
        $.alert({
            title: 'Error',
            icon: 'fa fa-warning',
            type: 'red',
            content: 'Browser issue Please use other browser',
        });
        return false;
    }
});
</script>
