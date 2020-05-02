basePath = siteBaseUrl + 'application/controllers/interview/uploads/';
videoduration = 0;
var player;

$(function(){
var is_firefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;

//$('.watch_interview:FIRST').trigger('click');

// if (!is_firefox){
// 	var videoDomObj = videotag.get(0);

//     videotag.on('click', function(e){
//         if (videoDomObj.paused){
//             videoDomObj.play();
//         } else{
//             videoDomObj.pause();
//         }
//     });
//     $('.btn-close-video').click(function(){
//     	videoDomObj.pause();
//     })
// }

$('.watch_interview').click(function()
{
    console.log("test");
	var flag = false;
	var $button = $(this);
	var client_id = $button.attr('data-client');
	var interview_id = $button.attr('data-interview');
	videoduration =  $button.attr('data-videoduration');
	
    $('.modal_question_btn_list').html($button.parents('td:FIRST').find('.interview-question').html());

	if($button.attr('data-credited') == 0)
	{
		$.ajax({
			url: siteBaseUrl + 'credit/deductAjaxCredit',
			data:"client_id="+client_id+"&interview_id="+interview_id,
			method:"POST",
			async: false,
			success:function(data){
				if(data==1)
				{
                    $button.attr('data-credited',1);
                    var path = $button.val();
                    webmPath = basePath+path;
                    mp4Paths = webmPath.replace(".webm",".mp4");
                    resetPlayer(webmPath,mp4Paths);					
				}
				else if(data==0)
				{
					alert("Not Enough Credit!");
					return false;
				}
				else
				{
					alert("Some Internal Error!");
					return false;
				}
			}
		})
	}
	else
	{
		var path = $button.val();
		webmPath = basePath+path;
		mp4Paths = webmPath.replace(".webm",".mp4");
        resetPlayer(webmPath,mp4Paths);
	}

});

});
$(document).delegate('.modal_question_btn_list .question','click',function(){
    $('.modal_question_view').html($(this).attr('data-question'));
    player.currentTime($(this).attr('view-time'))
    // videotag.currentTime = $(this).attr('view-time');
    player.play();
});

$(document).delegate('.seekbarpoint','mouseenter',function(){
    $(this).css('z-index','1');
});

$(document).delegate('.seekbarpoint','mouseleave',function(){
    $(this).css('z-index','2');
});

$(document).delegate('.btn-close-video','click',function(){
    $('#watch_interview_model .modal-body video').html('');
    $('.modal_question_view').html('');
    $('.modal_question_btn_list').html('');
    $('.seekbarpoint').html('');
    player.pause();    
});

function resetPlayer(webmPath,mp4Paths)
{    
    var videotag = document.getElementById('player1');

    player = videojs('player1');

    webmPath =  webmPath.replace(/ /g,'');
    mp4Paths =  mp4Paths.replace(/ /g,'');
    
	// $('#player1').html('<source src="'+mp4Paths+'" type="video/mp4"/> <source src="'+webmPath+'" type="video/webm" />');       
    $('#watch_interview_model').modal({backdrop: 'static'});
    
	player.src([{ type: "video/mp4", src: mp4Paths }, { type: "video/webm", src: webmPath }]);
    player.play();
    
    // display first question
    $('.modal_question_view').html($('.modal_question_btn_list .question:FIRST').attr('data-question'));

    player.on('timeupdate', function(){
        playerUpdateTimeEvent(player.currentTime());        
    });
	addSeekbarPoint(videoduration);
	
    // resetPlayerTime();
}
function resetPlayerTime()
{
    videotag.currentTime = videoduration;
    player.play();
    addSeekbarPoint(videoduration);
}

function addSeekbarPoint(videolength)
{
    var seekbartexthtml = '<div class="seekbartext">';
    var setseekpostion = 0;

    $(".modal_question_btn_list button").each(function (e){
        var question_duration =  $(this).attr('data-expire');
        var seekpostion = ((question_duration * 100) / videolength);
        setseekpostion = (setseekpostion + seekpostion);
        seekbartexthtml += '<span class="seekbarpoint" style="left: '+setseekpostion+'%"></span>';
    });
    seekbartexthtml += '</div>';
    $(".custom-video-js").find('.vjs-progress-control:FIRST').find('.seekbartext').remove();
    $(".custom-video-js").find('.vjs-progress-control:FIRST').append(seekbartexthtml);    
}
function playerUpdateTimeEvent(playerCurrentTime)
{    
    var questionData;
    var view_question = '';    
    $('.modal_question_btn_list .question ').each(function (qobj) {
        questionData = $(this).attr('view-time');        
        if(+playerCurrentTime >= +questionData){            
            view_question = $(this).attr('data-question');            
            //$('.modal_question_view').html(view_question);
        }
    });

    if(view_question != $('.modal_question_view').html()){
        $('.modal_question_view').html(view_question);
    }   

    //$('.modal_question_view').html($('.modal_question_btn_list .question:FIRST').attr('data-question'));
}

function log(msg) {
  document.getElementById('events').innerHTML += '<div>'+ msg + '</div>';
}

// var video = document.getElementsByTagName('video')[0];

// videotag.addEventListener('waiting', function() {log('waiting')});

// videotag.addEventListener('playing', function() {log('playing')});

// videotag.addEventListener('pause', function() {log('pause')});

// videotag.addEventListener('play', function() {log('play')});

// videotag.addEventListener('stalled', function() {log('stalled')});

// videotag.addEventListener('seeking', function() {log('seeking')});

// videotag.addEventListener('seeked', function() {log('seeked')});

// document.getElementById('seek_btn').addEventListener('click', function() {
//   videotag.currentTime = 30;
//   // videojs('#my-video').currentTime(30); // leads to the sampe behavior
//   // videotag.pause(); videotag.play(); // workaround
// })