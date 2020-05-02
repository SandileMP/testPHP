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
                            <h3 class="panel-title"><?= $text_note ?></h3>
                            <p class="panel-subtitle"><?= $interview_detail['note'] ?></p>
                        </div>
                        <div class="col-sm-4">
                            <h3 class="panel-title"><?= $text_project_role_title ?></h3>
                            <p class="panel-subtitle"><?= $interview_detail['role_title'] ?></p>
                        </div>
                    </div>
                    <div class="row" id="question-time-div">
                        <div class="col-sm-10">
                            <div class="question" style="display: none;">
                                <p class="question-label"></p>
                                <h2 class="question-heading text-capitalize text-primary">
                                    <strong></strong>
                                </h2>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="answer-time" style="display: none;">
                                <h3 class="panel-title"><?= $text_interview_question_expire ?></h3>
                                <p class="counter-time" id="counter-time">
                                    <span class="minutes"></span> : <span class="seconds"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel-body" align="center">
                        <div class="interview_start">
                            <p class="interview-start-label"><?= $text_start_interview ?></p>
                            <h2 id="start-interview-counter-time">
                                <strong class="seconds"></strong>
                            </h2>
                        </div>
                        <section class="experiment recordrtc">
                            <h2 class="header" style="margin: 0;display: none;">
                                <select class="recording-media">
                                    <option value="record-audio-plus-video">Microphone+Camera</option>
                                    <option value="record-audio">Microphone</option>
                                    <option value="record-screen">Full Screen</option>
                                    <option value="record-audio-plus-screen">Microphone+Screen</option>
                                </select>

                                <span style="font-size: 15px;">into</span>

                                <select class="media-container-format">
                                    <option>default</option>
                                    <option>vp8</option>
                                    <option>vp9</option>
                                    <option>h264</option>
                                    <option>mkv</option>
                                    <option>opus</option>
                                    <option>ogg</option>
                                    <option>pcm</option>
                                    <option>gif</option>
                                    <option>whammy</option>
                                </select>

                                <input type="checkbox" id="chk-timeSlice" style="margin:0;width:auto;" title="Use intervals based recording">
                                <label for="chk-timeSlice" style="font-size: 15px;margin:0;width: auto;cursor: pointer;-webkit-user-select:none;user-select:none;" title="Use intervals based recording">Use timeSlice?</label>

                                <br>

                                <button id="btn-pause-recording" style="display: none; font-size: 15px;">Pause</button>

                                <hr style="border-top: 0;border-bottom: 1px solid rgb(189, 189, 189);margin: 4px -12px;margin-top: 8px;">
                                <select class="media-resolutions">
                                    <option value="default">Default resolutions</option>
                                    <option value="1920x1080">1080p</option>
                                    <option value="1280x720">720p</option>
                                    <option value="640x480">480p</option>
                                    <option value="3840x2160">4K Ultra HD (3840x2160)</option>
                                </select>

                                <select class="media-framerates">
                                    <option value="default">Default framerates</option>
                                    <option value="5">5 fps</option>
                                    <option value="15">15 fps</option>
                                    <option value="24">24 fps</option>
                                    <option value="30">30 fps</option>
                                    <option value="60">60 fps</option>
                                </select>

                                <select class="media-bitrates">
                                    <option value="default">Default bitrates</option>
                                    <option value="8000000000">1 GB bps</option>
                                    <option value="800000000">100 MB bps</option>
                                    <option value="8000000">1 MB bps</option>
                                    <option value="800000">100 KB bps</option>
                                    <option value="8000">1 KB bps</option>
                                    <option value="800">100 Bytes bps</option>
                                </select>
                            </h2>
                            <div class="upload-progress">
                                <div class="progress-text text-danger">
                                    <h2><?= $text_interview_progress_text ?></h2>
                                </div>
                                <div id="progress" align="left">
                                  <div id="progress-bar" class="progress-bar-striped"></div>
                                </div>
                            </div>
                            <div style="text-align: center; display: none;">
                                <button id="upload-to-php" class="btn btn-info">Upload to PHP</button>
                                <button id="submit-form" onclick="$('#submit-interview-form').submit();" class="btn btn-info">Submit</button>
                                <button id="btn-start-recording">Start Recording</button>
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
<form id="submit-interview-form">
    <input type="hidden" name="invite_id" id="invite_id" value="<?= $interview_detail['invite_id'] ?>"/>
    <input type="hidden" name="start_time" id="start_time" />
    <input type="hidden" name="end_time" id="end_time" />
</form>
<script type="text/javascript">
var i = 0;
var start_date = '';
function questions(i){
    var q = <?= json_encode($interview_detail['questions']) ?>;
    var question = '';
    var time = '';
    if(q.length > i){
        var count = q[i];
        var question = count.question;
        var no = i + 1;
        var time = count.expire;
        console.log(time);
        var deadline = new Date(Date.parse(new Date()) + time * 1000);
        initializeClock('counter-time', deadline);
        $('.question-label').text('Question '+ no + ' :');
        $('.question-heading strong').text(question);
    }else{
        $('#btn-start-recording').trigger('click');
        $('#question-time-div').remove();
        $('#btn-start-recording').remove();
        var d = new Date();
        var end_date = d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
        console.log(end_date);
        $('#submit-interview-form #end_time').val(end_date);
        return false;
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
            questions(i = i + 1);
        }
    }
    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
}
function initializeClock2(id, endtime) {
    var clock = document.getElementById(id);
    var secondsSpan = clock.querySelector('.seconds');
    function updateClock2() {
        var t = getTimeRemaining(endtime);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
        if (t.total <= 0) {
            clearInterval(timeinterval2);
            $('.interview_start').remove();
            $('.answer-time').css('display','initial');
            $('.question').css('display','initial');
            questions(i);
            $('#btn-start-recording').trigger('click');
            var d = new Date();
            start_date = d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
            console.log(start_date);
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
    updateClock2();
    var timeinterval2 = setInterval(updateClock2, 1000);
}
function start_interview(){
    var deadline_start_interview = new Date(Date.parse(new Date()) + 1 * 5 * 1000);
    initializeClock2('start-interview-counter-time', deadline_start_interview);
}
$(function(){
    start_interview();
});
</script>
<script type="text/javascript" src="<?= base_url() ?>assets/scripts/interview.js"></script>
<script src="https://cdn.webrtc-experiment.com/commits.js" async></script>
<script src="https://apis.google.com/js/client:plusone.js"></script>