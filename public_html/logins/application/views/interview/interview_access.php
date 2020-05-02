<div class="container interview-content-div" id="interview_question_div">
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
                    <div class="row" id="question-time-div">
                        <div class="col-sm-9">
                            <div class="question" style="display: none;">
                                <p class="question-label"></p>
                                <h2 class="question-heading text-primary">
                                    <strong></strong>
                                </h2>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="thinking-time"  style="display: none;">
                                <h3 class="panel-title"><?= $text_interview_answer_start ?></h3>
                                <p class="answer-start-counter-time" id="answer-start-counter-time">
                                    <span class="minutes"></span> : <span class="seconds"></span>
                                </p>
                                <!-- <button type="button" class="btn btn-info" id="skip-waiting" style="margin: 0;"><?= $button_skip ?></button> -->
                            </div>
                            <div class="answer-time" style="display: none;">
                                <h3 class="panel-title"><?= $text_interview_question_expire ?></h3>
                                <p class="counter-time" id="counter-time">
                                    <span class="minutes"></span> : <span class="seconds"></span>
                                </p>
                                <div class="next-question-div">
                                    <button type="button" class="btn btn-info" id="next-question" style="margin: 0;"><?= $button_next ?></button>
                                </div>
                                <div id="end_session" style="visibility:hidden;">
                                    <button type="button" class="btn btn-info" id="next-question" style="margin: 0;" onclick="end_interview()">Finish Interview</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel-body" align="center">
						<video id="interviewVideo" muted playsinline style="width: 100%"></video>
						
						<?php /* ?>

						<div id="button-container">
							<button id="init" onclick="initVideo();">init</button>
							<br>
							<button id="start" onclick="startVideo();">start</button>
							<br>
							<button id="pause" onclick="pauseVideo();">pause</button>
							<br>
							<button id="resume" onclick="resumeVideo();">resume</button>
							<br>
							<button id="stop" onclick="stopVideo();">stop</button>
						</div>

						<?php /* */ ?>

						<section class="experiment recordrtc">
                            <div class="upload-progress">
								<div class="upload-progress-data">
									<div class="progress-text text-danger">
										<h2><?= $text_interview_progress_text ?></h2>
									</div>
									<div id="progress" align="left">
									  <div id="progress-bar" class="progress-bar-striped"></div>
									</div>
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
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<form id="submit-interview-form" action="<?= base_url('upload') ?>" method="post" interviewTestType="interview">
    <input type="hidden" name="invite_id" id="invite_id" value="<?= $interview_detail['invite_id'] ?>"/>
    <input type="hidden" name="start_time" id="start_time" value="<?php date('d/m/y H:i:s') ?>"/>
    <input type="hidden" name="end_time" id="end_time" <?php date('d/m/y H:i:s') ?> />
    <input type="hidden" name="frm_question_data" id="frm_question_data" />
    <input type="hidden" name="interviewComplete" id="interviewComplete"  value="0"/>
    <input type="hidden" name="interviewQuestion" id="interviewQuestion"  value=""/>
    <input type="hidden" name="prevInterviewQuestion" id="prevInterviewQuestion"  value=""/>
    
</form>

<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=es6%2Ces5%2Ces2016%2Ces2015%2Cdefault"></script>
<?php 
echo loadJs([
"assets/vendor/mediaRecorder/OpusMediaRecorder.umd.js",
"assets/vendor/mediaRecorder/encoderWorker.umd.js",
"assets/scripts/interview_media_record_new.js",
]); ?>


<script type="text/javascript">

var i = 0;
var start_date = '';
var answer_time = '';
var answer_time_taken = 0;

var question_data = <?= json_encode($interview_detail['questions']) ?>;

function questions(i){
    var q = <?= json_encode($interview_detail['questions']) ?>;
    var question = '';
    var time = '';

    if((q.length - 1) <= i ){
        $(".next-question-div").addClass("hide-next-question-div");
        $('#end_session').css('visibility','visible');
    }
    
    if(q.length > i){
        var pre_no = (i > 0) ? (i-1) : 0;
        $('#prevInterviewQuestion').val(q[pre_no].question);
        $('#interviewQuestion').val(q[i].question);

        var count = q[i];
        var question = count.question;
        var no = i + 1;
        var time = count.expire;
        answer_time = time;
        $('.question').css('display','initial');
        $('.question-label').text('Question '+ no + ' :');
        $('.question-heading strong').text(question);
        $('.answer-time').css('display','none');
        $('.thinking-time').css('display','initial');
        start_answer_time();
    }else{
        $('#frm_question_data').val(JSON.stringify(question_data));

        var pre_no = (i > 0) ? (i-1) : 0;
        $('#prevInterviewQuestion').val(q[pre_no].question);
        $('#interviewQuestion').val('');        

        //$('#btn-start-recording').trigger('click');

        $('#question-time-div').remove();
        $('#btn-start-recording').remove();
        var d = new Date();
        var end_date = d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
        $('#submit-interview-form #end_time').val(end_date);
        $('#submit-interview-form #interviewComplete').val("1");
        stopVideo();
        return false;
    }
}

function end_interview(){
    questions(i = i + 1);
}

function start_answer_time(){
    var deadline_start_answer_time = new Date(Date.parse(new Date()) + 15 * 1000);
    initializeClockStartAnswerTime('answer-start-counter-time', deadline_start_answer_time);
}
function initializeClockStartAnswerTime(id, endtime) {
    var clock = document.getElementById(id);
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');
    function updateClockStartAnswerTime() {
        var t = getTimeRemaining(endtime);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
        if (t.total <= 0) {
            clearInterval(timeinterval2);
            /*
            if(i == 0){
                //$('#btn-start-recording').trigger('click');
                //startVideo();
            }else{
                //$('#btn-pause-recording').trigger('click');
                //pauseVideo();
            }
            */
            startVideo();
            $('.thinking-time').css('display','none');
            $('.answer-time').css('display','initial');
            var deadline = new Date(Date.parse(new Date()) + answer_time * 1000);
            initializeClock('counter-time', deadline);
        }
        window.onbeforeunload = function(){
            if(window.clcomplete){
                return;
            }else{
                return 'Are You Sure?';
            }
        }
    }
    updateClockStartAnswerTime();
    var timeinterval2 = setInterval(updateClockStartAnswerTime, 1000);
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

        answer_time_taken = answer_time_taken + 1;

        if (t.total <= 0) {
            saveQuestionData(i);
            clearInterval(timeinterval);
            //$('#btn-pause-recording').trigger('click');
            stopVideo();
            questions(i = i + 1);
        }
    }
    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
    $(document).delegate('#next-question','click',function(){
        clearInterval(timeinterval);
    });
}
$(document).delegate('#next-question','click',function(){

    saveQuestionData(i);

    //$('#btn-pause-recording').trigger('click');
    stopVideo();
    var _this = $(this);
    $(_this).prop('disabled',true);
    setTimeout( function(){
        questions(i = i + 1);
        $(_this).prop('disabled',false);
    },1000);
});

// Interview Start Time Counter
function initializeClockInterviewStartTime(id, endtime) {
    var clock = document.getElementById(id);
    var secondsSpan = clock.querySelector('.seconds');
    function updateClockInterviewStartTime() {
        var t = getTimeRemaining(endtime);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
        if (t.total <= 0) {
            clearInterval(timeinterval2);
            $('.interview_start').remove();
            questions(i);
            var d = new Date();
            start_date = d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
            $('#submit-interview-form #start_time').val(start_date);
        }
        window.onbeforeunload = function(){
            if(window.clcomplete){
                return;
            }else{
                return 'Are You Sure?';
            }
        }
    }
    updateClockInterviewStartTime();
    var timeinterval2 = setInterval(updateClockInterviewStartTime, 1000);
}

function start_interview(){
    var deadline_start_interview = new Date(Date.parse(new Date()) + 1 * 5 * 1000);
    initializeClockInterviewStartTime('start-interview-counter-time', deadline_start_interview);
}
$(function(){
    
    initVideo(function(){
        questions(i);
        var d = new Date();
        start_date = d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
        $('#submit-interview-form #start_time').val(start_date);
    });
});

function saveQuestionData(questionCounter)
{
    question_data[questionCounter].time_taken = answer_time_taken;
    answer_time_taken = 0;
}
</script>
