<div class="container interview-content-div" id="interview_question_div">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-headline">
                <div class="panel-heading" align="center">
                    <div class="row" id="question-time-div">
                        <div class="col-sm-9">
                            <div class="question" style="display: none;">
                                <p class="question-label"></p>
                                <h3 class="question-heading text-capitalize text-primary">
                                    <strong></strong>
                                </h3>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="answer-time">
                                <h3 class="panel-title"><?= $text_interview_question_expire ?></h3>
                                <p class="counter-time" id="counter-time">
                                    <span class="minutes"></span> : <span class="seconds"></span>
                                </p>
                                <div class="next-question-div">
                                    <button type="button" class="btn btn-info" id="next-question" style="margin: 0;"><?= $button_next ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel-body" align="center">
						<div class="panel-body" align="center">
							<video id="interviewVideo" muted playsinline style="width: 100%"></video>
							<section class="experiment recordrtc">
								<div class="upload-progress">
									<div class="upload-progress-data">
										<div class="progress-text text-danger">
											<h2 class= "loader-progress-text">Please Wait</h2>
										</div>
										<div id="progress" align="left">
											<div id="progress-bar" class="progress-bar-striped"></div>
										</div>
                                        <div style="text-align: center;"><img src="<?php echo base_url()."assets/img/spinner.gif" ?>" style="height: 50px; width: 50px;"></div>
									</div>
								</div>
								<div style="text-align: center; display: none;">
									<button id="upload-to-php" class="btn btn-info">Upload to PHP</button>
									<button id="submit-form" onclick="$('#submit-interview-form').submit();" class="btn btn-info">Submit</button>
									<button id="btn-start-recording">Start Recording</button>
									<button id="btn-pause-recording">Pause</button>
								</div>
								<div style="margin-top: 10px;" id="recording-player"></div>
							</section>
						</div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<form id="submit-interview-form" action="<?= base_url('test_upload') ?>" method="post" interviewTestType="temp_practice">
	<input type="hidden" name="invite_id" id="invite_id" value="test_"/>
    <input type="hidden" name="interviewComplete" id="interviewComplete"  value="0"/>    
</form>

<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=es6%2Ces5%2Ces2016%2Ces2015%2Cdefault"></script>

<?php 
echo loadJs([
"assets/vendor/mediaRecorder/OpusMediaRecorder.umd.js",
"assets/vendor/mediaRecorder/encoderWorker.umd.js",
"assets/scripts/interview_media_record_new.js",
]); ?>

<script type="text/javascript">
    $(function(){
        initVideo(function() {
            setTimeout(function (){
                questions(i);
                startVideo();
            },100);
        });
        
    });
</script>

<script type="text/javascript">
var i = 0;
var answer_time = '';
var timeinterval = '';

function questions(i){
    var q = <?= json_encode($interview_detail['questions']) ?>;
    var question = '';
    var time = '';
    if(q.length > i){
        var count = q[i];
        var question = count.question;
        var no = i + 1;
        answer_time = count.expire;
        $('.question').css('display','initial');
        $('.question-label').text('Question '+ no + ' :');
        $('.question-heading strong').text(question);
        start_answer_time(answer_time);
    }else{        
        $('#next-question').hide();
        $('#btn-start-recording').trigger('click');
        $('.media-box h2').css('display','none');
        $("#question-time-div").remove();
        $('#buttons').show();
        $('#submit-interview-form #interviewComplete').val("1");
        stopVideo();
        return false;
    }
}
function start_answer_time(answer_time){
    if(i == 0){
        $('#btn-start-recording').trigger('click');
    }
    var deadline = new Date(Date.parse(new Date()) + answer_time * 1000);
    initializeClock('counter-time', deadline);

    window.onbeforeunload = function(){
        if(window.clcomplete){
            return;
        }else{
            return 'Are You Sure?';
        }
    }
}
function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

// Answer Time Counter
function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');
    function updateClock() {
        var t = getTimeRemaining(endtime);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
        if (t.total <= 0) {
            clearInterval(timeinterval);
            $('#next-question').trigger('click');
        }
    }
    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
    $(document).delegate('#next-question','click',function(){
        clearInterval(timeinterval);
    });
}
$(document).delegate('#next-question','click',function(){
    var _this = $(this);
    questions(i = i + 1);
});
</script>
