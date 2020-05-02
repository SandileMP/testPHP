var video = document.getElementById('interviewVideo');
var width = 320;
var height = 480;
var workerOptions = {
	OggOpusEncoderWasmPath: 'https://96278261.ngrok.io/demo/OggOpusEncoder.wasm',
	WebMOpusEncoderWasmPath: 'https://96278261.ngrok.io/demo/WebMOpusEncoder.wasm'
};

var chunks = [];
var mediaRecorder = null;

function initVideo() {
	//console.log("video init");
	video.style.height = height;
	video.style.width = width;
	window.MediaRecorder = OpusMediaRecorder;
	navigator.mediaDevices
		.getUserMedia({ audio: true, video: { width: width, height: height } })
		.then(function (stream) {
			// var deviceId = stream.getVideoTracks()[0].getSettings().deviceId;
			// var frameRate = stream.getVideoTracks()[0].getSettings().frameRate;
			var VideoHeight = stream.getVideoTracks()[0].getSettings().height;
			var VideoWidth = stream.getVideoTracks()[0].getSettings().width;
			//console.log(VideoWidth);
			//var frameRate = stream.getVideoTracks()[0].getSettings().frameRate;

			video.srcObject = stream.clone();
			mediaRecorder = new MediaRecorder(
				stream,
				{ mimeType: "video/webm", width: VideoWidth, height: VideoHeight, bitsPerSecond: 1200 },
				workerOptions
			);
			mediaRecorder.video.style.height = height;
			mediaRecorder.video.style.width = width;

			video.replaceWith(mediaRecorder.video);
			video = mediaRecorder.video;
			mediaRecorder.onstop = function (e) {
				var blob = new Blob(chunks, { 'type': 'video/webm' });
				chunks = [];
				uploadfile(blob);
			};

			mediaRecorder.ondataavailable = function (e) {
				//console.log("data avalable");
				chunks.push(e.data);
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
	 }
	 else if ( mediaRecorder.state != "recording"){
		mediaRecorder.start();
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
	video.play();
	mediaRecorder.resume();
	//console.log("after R- ",mediaRecorder.state);
};

function stopVideo() {
	//console.log("before St- ",mediaRecorder.state);
	mediaRecorder.stop();
	video.pause();
	//console.log("after st- ",mediaRecorder.state);
};

function generateFilename() {
	return "RecordRTC-video_"+Math.floor((Math.random() * 100000) + 1)+".webm";
}

function uploadfile(blobfile) {
	//console.log("uploading file ");
	var fileName = generateFilename();
	var formData = new FormData();
	formData.append('video-filename', fileName);
	formData.append('video-blob', blobfile);
	formData.append('invite_id',$('#submit-interview-form #invite_id').val());
	formData.append('start_time',$('#submit-interview-form #start_time').val());
	formData.append('end_time',$('#submit-interview-form #end_time').val());
	formData.append('frm_question_data',$('#submit-interview-form #frm_question_data').val());

	$.ajax({
		xhr: function() {
			var xhr = new window.XMLHttpRequest();
			// Upload progress
			xhr.upload.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					//Do something with upload progress
					console.log(percentComplete);
					$('#progress #progress-bar').css('width',percentComplete+"%");
				}
			}, false);

			// Download progress
			xhr.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					// Do something with download progress
					console.log(percentComplete);
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
			//console.log("uploading complete");
			window.location.href = location.origin + '/logins/complete';
		},
		beforeSend: function() {
			$('.upload-progress').css('display','initial');
		}
	});
}
