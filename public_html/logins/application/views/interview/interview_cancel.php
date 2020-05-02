<div class="container interview-content-div" id="interview_question_div">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-headline">
                <div class="panel-heading" align="center">
                    <div class="pull-left">
                        <h3 class="panel-title"><?= $text_project_title ?></h3>
                        <p class="panel-subtitle"><?= $interview_detail['title'] ?></p>
                    </div>
                    <div class="pull-right">
                        <h3 class="panel-title"><?= $text_project_role_title ?></h3>
                        <p class="panel-subtitle"><?= $interview_detail['role_title'] ?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel-body" align="center">
                        <div class="status-icon">
                            <img src="<?= $status_img ?>" class="img-responsive" width="200px" height="200px"/>
                        </div>
                        <div class="status-text">
                            <h1 style="font-variant: all-petite-caps;" class="text-danger"><?= $status_text ?></h1>
                            <strong id="logout-counter-time" style="color: red;">Window Close After <b id="timeout"></b> Seconds.</strong>
                        </div>
                        <div class="form-group">
                            <a href="<?php echo base_url().'logout'; ?>"><button type="button" class="btn btn-danger">Window Close</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    return {
        'total': t,
        'seconds': seconds
    };
}
function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    var secondsSpan = clock.querySelector('#timeout');
    function updateClock() {
        var t = getTimeRemaining(endtime);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
        if (t.total <= 0) {
            clearInterval(timeinterval);
            window.location.href = '<?php echo base_url().'logout'; ?>';
        }
    }
    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
}
var deadline = new Date(Date.parse(new Date()) + 1 * 15 * 1000);
initializeClock('logout-counter-time', deadline);
</script>