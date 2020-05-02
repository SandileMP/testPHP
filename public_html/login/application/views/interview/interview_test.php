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
                    <div class="clearfix"></div>
                    <div class="panel-body" align="center">
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
                            <div style="margin-top: 10px;" id="recording-player"></div>
                            <button id="open-new-tab" class="btn btn-info" style="display: none;">Open New Tab</button>
                        </section>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" align="center">
                            <video id="interviewVideo" muted playsinline style="width: 100%"></video>
                            <button class="btn btn-warning" id="btn-start-recording">Test My System</button>
                            <a href="<?= $do_interview ?>"><button type="button" class="btn btn-danger">Do e-interview</button></a>
                            <a href="<?= $back_interview ?>"><button type="button" class="btn btn-info" style="background-color: blue!important;"><?= $button_back ?></button></a>
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
function initializeClock2(id, endtime) {
    var clock = document.getElementById(id);
    function updateClock2() {
        var t = getTimeRemaining(endtime);
        if (t.total <= 0) {
            clearInterval(timeinterval2);
            $('#btn-start-recording').trigger('click');
            $('.media-box h2').css('display','none');
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
function start_test_interview(){
    var deadline_start_interview = new Date(Date.parse(new Date()) + 1 * 10 * 1000);
    initializeClock2('start-interview-counter-time', deadline_start_interview);
}
</script>
<script type="text/javascript" src="<?= base_url() ?>assets/scripts/interview_test.js"></script>
<script src="https://cdn.webrtc-experiment.com/commits.js" async></script>
<script src="https://apis.google.com/js/client:plusone.js"></script>