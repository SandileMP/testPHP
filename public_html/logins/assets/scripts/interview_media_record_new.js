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
var isInitialized =  null;
function initVideo(callback = null) {
	video.style.height = height;
	video.style.width = width;
	isInitialized = true;
	if (!window.MediaRecorder) {
		isOpusMediaRecorder = true;
		window.MediaRecorder = OpusMediaRecorder;
	}
	if(!navigator.mediaDevices){
		return;
	}
	navigator.mediaDevices
		.getUserMedia({ audio: true, video: { width: width, height: height } })
		.then(function (stream) {
			streamGlobal = stream;
			// var deviceId = stream.getVideoTracks()[0].getSettings().deviceId;
			// var frameRate = stream.getVideoTracks()[0].getSettings().frameRate;
			var VideoHeight = stream.getVideoTracks()[0].getSettings().height;
			var VideoWidth = stream.getVideoTracks()[0].getSettings().width;
			video.style.height = VideoHeight;
			video.style.width = VideoWidth;			
			//var frameRate = stream.getVideoTracks()[0].getSettings().frameRate;
			video.srcObject = streamGlobal;
			if (isOpusMediaRecorder) {
				mediaRecorder = new MediaRecorder(
					streamGlobal,
					{
						mimeType: "video/webm",
						width: VideoWidth,
						height: VideoHeight,
						bitsPerSecond: 1200
					},
					workerOptions
				);
			} else {
				mediaRecorder = new MediaRecorder(
					streamGlobal,
					{
						mimeType: "video/webm",
						width: VideoWidth,
						height: VideoHeight
					},
					workerOptions
				);
			}
			if (isOpusMediaRecorder) {
				mediaRecorder.video.style.height = height;
				mediaRecorder.video.style.width = width;

				video.replaceWith(mediaRecorder.video);
				video = mediaRecorder.video;
			}

			mediaRecorder.onstop = function (e) {				
				isInitialized = false;
				if (isVideoStopped) {
					blobs = new Blob(chunks, { 'type': 'video/webm' });
					chunks = [];					
					uploadfile(blobs);
				}
			};

			mediaRecorder.ondataavailable = function (e) {				
				chunks.push(e.data);
			}
			if (typeof callback === "function") {
				callback();
			}
		}).catch(function (err) {
			//window.location.reload();			
		});
}

function startVideo() {	
	if (!isInitialized) {		
		initVideo(function(){
			video.play();
			if (mediaRecorder.state != "recording") {
				mediaRecorder.start(1000);
			}
		});
	} else {		
		video.play();
		if (mediaRecorder.state != "recording") {
			mediaRecorder.start(1000);
		}
	}
};

function stopVideo() {
	video.pause();
	isVideoStopped = true;

	if(mediaRecorder.state != "inactive"){
		mediaRecorder.stop();
	}	
};

function generateFilename() {
	return "RecordRTC-video_" + (Math.floor((Math.random() * 100000) + 1)) + ".webm";
}

function uploadfile(blobfile) {	
	var fileName = generateFilename();
	var formData = new FormData();
	var interviewComplete = $('#submit-interview-form #interviewComplete').val();
	var interviewTestType = $('#submit-interview-form').attr('interviewTestType');
	var uploadUrl = $('#submit-interview-form').attr('action');

	fileList.push(fileName);

	// for (let index = 0; index < blobfiles.length; index++) {
		// const blobfile = blobfiles[index];
		formData.append('video-filename', fileName);
		formData.append('video-blob', blobfile);
	// }
	formData.append('invite_id',$('#submit-interview-form #invite_id').val());
	formData.append('start_time',$('#submit-interview-form #start_time').val());
	formData.append('end_time',$('#submit-interview-form #end_time').val());
	formData.append('frm_question_data',$('#submit-interview-form #frm_question_data').val());
	formData.append('interviewComplete',$('#submit-interview-form #interviewComplete').val());
	formData.append('fileList',fileList);
	formData.append('interviewTestType', interviewTestType);
	formData.append('interviewQuestion', $('#interviewQuestion').val());
	formData.append('prevInterviewQuestion', $('#prevInterviewQuestion').val());
	

	$.ajax({
		xhr: function() {
			var xhr = new window.XMLHttpRequest();
			// Upload progress
			xhr.upload.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					//Do something with upload progress					
					$('#progress #progress-bar').css('width',(percentComplete * 100)+"%");
				}
			}, false);

			// Download progress
			xhr.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					// Do something with download progress					
				}
			}, false);

			return xhr;
		},
		url: uploadUrl, // point to server-side PHP script
		dataType: 'text',  // what to expect back from the PHP script, if anything
		cache: false,
		contentType: false,
		processData: false,
		data: formData,
		type: 'POST',
		success: function(php_script_response){
			window.onbeforeunload = null;			
			if(interviewTestType == "interview"){ // if part for interview
				if(interviewComplete == 1){					
					//$('#cl').html("complete uuu ------ "+php_script_response);
					window.location.href = location.origin + '/logins/complete';
				}
				else{
					//$('#cl').html("next qqqqq" + fileName);
				}
			}
			else // else part is for test  and pre.; interview
			{
				//play video code  will be here
				if(php_script_response && php_script_response != '00' && php_script_response != '0')
				{
					var lastContentLength = 500;
					var test = function() {
						$.ajax({
							type: "HEAD",
							async: true,
							url: php_script_response,
						}).error(function() {
							setTimeout(test, 1000);
						}).done(function(a, b, result) {
							var newContentLength = parseInt(result.getResponseHeader('Content-Length'));
							if (newContentLength > lastContentLength) {
								lastContentLength = newContentLength;
								setTimeout(test, 2000);
							} else if (result.status == "200" && result.getResponseHeader('Content-Length') == lastContentLength) {
								$('.upload-progress').css('display','none');
								var newVideo = document.createElement('video');
								newVideo.setAttribute('style',video.getAttribute('style'));								
								video.replaceWith(newVideo);
								video = newVideo;
								video.src = php_script_response;
								video.autoplay = true;
								video.controls = true;
								video.load();								
							} else {
								setTimeout(test, 2000);
							}
						});
					};
					setTimeout(test, 1000);
				}
			}

		},
		beforeSend: function() {			
			if(interviewComplete == 1){
				$('.upload-progress').css('display','initial');

				if($('#submit-interview-form').attr('interviewTestType') == 'temp_test' || $('#submit-interview-form').attr('interviewTestType') == 'temp_practice'){
					$('.loader-progress-text').html('Converting Video');
				}

			}
			else{
				//$('#cl').html("upload file "+fileName);
			}
		}
	});
}
function customPlay(){
	video.play();	
}