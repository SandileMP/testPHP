var video = document.getElementById('interviewVideo');
var width = 480;
var height = 320;
var workerOptions = {
	OggOpusEncoderWasmPath: siteBaseUrl+'assets/vendor/mediaRecorder/OggOpusEncoder.wasm',
	WebMOpusEncoderWasmPath: siteBaseUrl+'assets/vendor/mediaRecorder/WebMOpusEncoder.wasm'
};

var chunks = [];
var mediaRecorder = null;
var isOpusMediaRecorder = false;
var isVideoStopped = false;
var blobs = [];
var fileList = [];
function initVideo(callback = null) {
	//console.log("video init");
	video.style.height = height;
	video.style.width = width;
	if (!window.MediaRecorder) {
		isOpusMediaRecorder = true;
		window.MediaRecorder = OpusMediaRecorder;
	}
	navigator.mediaDevices
		.getUserMedia({ audio: true, video: { width: width, height: height } })
		.then(function (stream) {
			// var deviceId = stream.getVideoTracks()[0].getSettings().deviceId;
			// var frameRate = stream.getVideoTracks()[0].getSettings().frameRate;
			var VideoHeight = stream.getVideoTracks()[0].getSettings().height;
			var VideoWidth = stream.getVideoTracks()[0].getSettings().width;
			video.style.height = VideoHeight;
			video.style.width = VideoWidth;
			//console.log(VideoWidth);
			//var frameRate = stream.getVideoTracks()[0].getSettings().frameRate;

			video.srcObject = stream.clone();
			mediaRecorder = new MediaRecorder(
				stream,
				{
					mimeType: "video/webm",
					width: VideoWidth,
					height: VideoHeight,
					audioBitsPerSecond: 12000,
					videoBitsPerSecond: 120000
				},
				workerOptions
			);
			if (isOpusMediaRecorder) {
				mediaRecorder.video.style.height = height;
				mediaRecorder.video.style.width = width;

				video.replaceWith(mediaRecorder.video);
				video = mediaRecorder.video;
			}

			mediaRecorder.onstart = function (e) {
				console.time("video");
				console.time("videoMain");
			};

			mediaRecorder.onpause = function (e) {
				console.timeEnd("video");
				console.time("video pause");
			};

			mediaRecorder.onresume = function (e) {
				console.time("video");
				console.timeEnd("video pause");
			};

			mediaRecorder.onstop = function (e) {
				console.timeEnd("video");
				console.timeEnd("videoMain");
				//console.log("sending data");
				if (isVideoStopped) {
					blobs = new Blob(chunks, { 'type': 'video/webm' });
					chunks = [];
					uploadfile(blobs);
				}
			};

			mediaRecorder.ondataavailable = function (e) {
				//console.log("data avalable");
				chunks.push(e.data);
			}
			if (typeof callback === "function") {
				setTimeout(function () {callback();},200);
			}
		}).catch(function (err) {
		//console.log('The following error occurred: ' + err);
	});
}

function startVideo() {
	//console.log("before s- ",mediaRecorder.state);
	video.play();

	if(mediaRecorder.state == "paused"){
		resumeVideo();
	} else if ( mediaRecorder.state != "recording"){
		mediaRecorder.start(10000);
	}
	//console.log("after s- ",mediaRecorder.state);
};

function pauseVideo() {
	//console.log("before p- ",mediaRecorder.state);

	video.pause();
	mediaRecorder.pause();

	//console.log("after p- ",mediaRecorder.state);

};

function resumeVideo() {
	//console.log("before R- ",mediaRecorder.state);
	mediaRecorder.resume();
	video.play();
	//console.log("after R- ",mediaRecorder.state);
};

function stopVideo() {
	//console.log("before St- ",mediaRecorder.state);
	video.pause();
	isVideoStopped = true;

	if(mediaRecorder.state != "inactive"){
		mediaRecorder.stop();
	}	
	//console.log("after st- ",mediaRecorder.state);
};

function generateFilename() {
	return "RecordRTC-video_" + (Math.floor((Math.random() * 100000) + 1)) + ".webm";
}

function uploadfile(blobfile) {
	//console.log("uploading file ");
	var fileName = generateFilename();
	var formData = new FormData();
	var interviewComplete = $('#submit-interview-form #interviewComplete').val();
	fileList.push(fileName);
	// for (let index = 0; index < blobfiles.length; index++) {
	// const blobfile = blobfiles[index];
	formData.append('video-filename', fileName);
	formData.append('video-blob', blobfile);
	formData.append('interviewTestType', $('#submit-interview-form').attr('interviewTestType'));
	formData.append('interviewComplete',$('#submit-interview-form #interviewComplete').val());
	formData.append('fileList',fileList);

	$.ajax({
		xhr: function() {
			var xhr = new window.XMLHttpRequest();
			// Upload progress
			xhr.upload.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					//Do something with upload progress
					//console.log("percentage complete = ",(percentComplete * 100));
					$('#progress #progress-bar').css('width',(percentComplete * 100)+"%");
				}
			}, false);

			// Download progress
			xhr.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					// Do something with download progress
					//console.log(percentComplete);
				}
			}, false);

			return xhr;
		},
		url: $('#submit-interview-form').attr('action'), // point to server-side PHP script
		dataType: 'text',  // what to expect back from the PHP script, if anything
		cache: false,
		contentType: false,
		processData: false,
		data: formData,
		type: 'POST',
		success: function(php_script_response){
			window.onbeforeunload = null;
			$('.upload-progress').css('display','none');
			console.log(php_script_response);
			//console.log("before ");
			//play video code  will be here
			if(php_script_response != 'error'){
				var test = function() {
					$.ajax({
						type: "HEAD",
						async: true,
						url: php_script_response,
					}).error(function() {
						setTimeout(test, 1000);
					}).done(function(a, b, result) {
						if (result.status == "200") {
							var newVideo = document.createElement('video');
							video.replaceWith(newVideo);
							video = newVideo;
							video.src = php_script_response;
							video.autoplay = true;
							video.controls = true; 
							video.load();
						} else {
							setTimeout(test, 1000);
						}
					});
				};

				setTimeout(test, 1000);
			}
			else{
				//console.log("else php_script_response update");
			}
		},
		beforeSend: function() {
			if(interviewComplete == 1){
				$('.upload-progress').css('display','initial');
			}
		}
	});
}

function customPlay(){
	video.play();
}
