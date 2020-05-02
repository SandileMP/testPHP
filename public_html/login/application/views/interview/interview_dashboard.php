<div class="container interview-content-div">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <div class="panel-body">
                        <h3 class="text-capitalize text-justify"><strong><?= $text_start_interview_heading1 ?></strong></h3>
                        <p class="text-capitalize text-justify">Please read the following instructions carefully before you begin the interview.</p>
                        <ol class="text-justify" style="margin-left: 100px;margin-top: 10px;">
							<li class="text-info">You have been assigned some questions that you must answer within a specified
							time limit.</li>
							<li class="text-info">You will be presented with an interview question and will have 30 seconds to
							prepare your answer. After 30 seconds, your interview will start recording
							immediately.</li>
							<li class="text-info">Each question has a time limit in which you must answer the question. After the
							time has expired, the system will automatically stop recording and take you to
							the next question. If you responded to the question before your time has
							expired, you may click on “Next question”, you do not have to wait for the time
							to elapse.</li>
                            <li class="text-info">Please start your answer with the interview question, e.g. If you are asked: "What is your greatest strengths", please start your answer by repeating the question.</li>
							<li class="text-danger">Please do not refresh your page or click on Back after you have started with
							the interview. Your interview will be blocked, and you will not be allowed to
							continue.</li>
                        </ol>
                        <input type="hidden" name="invite_id" value="<?= $interview_detail['invite_id'] ?>" />
                        <label class="fancy-checkbox" style="margin-left: 120px;">
							<input type="checkbox" name="check_testing" id="check_testing" />
							<span>I have tested my system and my webcam and microphone is working</span>
                        </label>
                        <button type="button" value="start_interview" id="start_recording" class="btn btn-danger btn-lg pull-right"><?= $button_start_recording ?></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#start_recording,#test_recording').click(function(){
	var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    var isFirefox = typeof InstallTrigger !== 'undefined';
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);
    var isIE = /*@cc_on!@*/false || !!document.documentMode;
    var isEdge = !isIE && !!window.StyleMedia;
    var isChrome = !!window.chrome && !!window.chrome.webstore;
    var isBlink = (isChrome || isOpera) && !!window.CSS;

    if(isEdge == true || isOpera == true || isSafari == true || isIE == true){
    	$.alert({
            title: 'Error',
            icon: 'fa fa-warning',
            type: 'red',
            content: 'Your Browser does not supported video recording!',
        });
        return false;	
    }else{
	    var check = $('#check_testing').prop('checked');
	    if(check == false){
	    	$.alert({
	            title: 'Warning',
	            icon: 'fa fa-warning',
	            type: 'orange',
	            content: 'Please Check Your System!',
	        });
	    	return false;
	    }else{
		    navigator.getUserMedia = navigator.getUserMedia ||
		                            navigator.webkitGetUserMedia ||
		                            navigator.mozGetUserMedia ||
		                            navigator.msGetUserMedia;

		    if (navigator.getUserMedia) {
		        navigator.getUserMedia({ audio: true, video: { width: 1280, height: 720 } },
		            function(stream) {
	                    window.location.href = '<?= $action ?>';
		            },
		            function(err) {
		                $.alert({
			                title: 'Error',
			                icon: 'fa fa-warning',
			                type: 'red',
			                content: 'Web Cam Device Not Found!',
			            });
		                console.log("The following error occurred: " + err.name);
		                return false;
		            }
		        );
		    } else {
		    	$.alert({
	                title: 'Error',
	                icon: 'fa fa-warning',
	                type: 'red',
	                content: 'Your Browser does not supported video recording!',
	            });
				return false;
		    }
	    }
    }
});
</script>