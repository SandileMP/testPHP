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

						<div class="col-sm-12">
							<div class="answer-time">
								<h3 class="panel-title">Time</h3>
								<p class="counter-time" id="counter_time">
									<span class="minutes">0</span> : <span class="seconds">0</span>
								</p>
							</div>
						</div>

						<div class="col-sm-12">
							<video id="interviewVideo" muted playsinline style="width: 100%"></video>
						</div>


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
										<h2 class="loader-progress-text">Please Wait</h2>
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

					<?php /* ?>
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
					<?php */ ?>

                    <div class="row">
                        <div class="col-sm-12" align="center">
							<?php /*?>
							<video id="interviewVideo" muted playsinline style="width: 100%"></video>
							<div id="player-aspect">
                                <div id="player" class="ogvjs-player">
                                    <div id="spinner-panel"></div>
                                    <div id="control-panel">
                                        <div id="controls" class="hide">
                                            <button class="play" title="Play"><span class="icon-play"></span></button>
                                            <button class="pause" title="Pause" style="display:none"><span class="icon-pause"></span></button>
                                            <button class="mute" title="Mute"><span class="icon-volume-up"></span></button>
                                            <button class="unmute" title="Unmute" style="display:none"><span class="icon-volume-off"></span></button>
                                            <div class="time-elapsed"></div>
                                            <div class="progress">
                                                <div id="progress-total">
                                                    <div id="progress-buffered"></div>
                                                    <div id="progress-processed"></div>
                                                    <div id="progress-played"></div>
                                                </div>
                                                <div id="progress-thumb"></div>
                                            </div>
                                            <div class="time-remaining"></div>
                                            <button class="fullscreen" title="Fullscreen"><span class="icon-resize-full"></span></button>
                                            <button class="unzoom" title="Unzoom" style="display:none"><span class="icon-resize-small"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php */ ?>

                            <button class="btn btn-warning" id="btn-start-test-recording">Test My System</button>
							<button class="btn btn-primary hide" id="btn-play-test-recording" onclick="customPlay()">Play Video</button>
                            <a href="<?= $do_interview ?>"><button type="button" class="btn btn-danger">Do e-interview</button></a>
                            <a href="<?= $back_interview ?>"><button type="button" class="btn btn-info" style="background-color: blue!important;"><?= $button_back ?></button></a>
                        </div>
                    </div>
                    <div class="next-step"><a href="<?php echo site_url('practice'); ?>" class="">Next</a></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<form id="submit-interview-form" action="<?= base_url('test_upload') ?>" method="post" interviewTestType="temp_test">
	<input type="hidden" name="invite_id" id="invite_id" value="temp_"/>
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
        initVideo( function() {
            $('#btn-start-test-recording').on('click', function () {
			 	$("#btn-start-test-recording").hide();
                var intTime = 10000;
                startVideo();
                startTimer((intTime/1000), document.querySelector('#counter_time'));
                setTimeout(function(){
                    stopVideo();
                    $('#submit-interview-form #interviewComplete').val("1");
                    $("#btn-play-test-recording").removeClass("hide").show();
                }, intTime);
            });
        });
    });

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        var interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(interval);
            }
        }, 1000);
    }
</script>


