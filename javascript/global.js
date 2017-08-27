function init() 
{	
	
	document.getElementById("getSponsor" ).innerHTML = "Carbery Plastics";
	//document.getElementById("getPRO" ).innerHTML = "Contact ";

	var ClubChampionshipYear = '2017';

	document.getElementById("getClubChampionshipYear" ).innerHTML = ClubChampionshipYear;
	document.getElementById("getClubChampionship" ).innerHTML = ClubChampionshipYear + " Carbery Plastics Club Championship:";	

	//document.getElementById("getYear" ).innerHTML = new Date().getFullYear();
	
	//document.getElementById("upcoming_event").getElementsByTagName("img")[0].src = "images/autotest_2016_flyer_sm.jpg";  /* 290 x 300 */  
 	//document.getElementById("club_championship").getElementsByTagName("img")[0].src = "images/club_championship.png";
	//document.getElementById("setMembership").getElementsByTagName("img")[0].src = "images/join_our_club.png";     
	
	//document.getElementById("setMembership").getElementsByTagName("a")[0].href = "club_membership.html";
	//document.getElementById("club_championship").getElementsByTagName("a")[0].href = "club_championship.html";
	//document.getElementById("upcoming_event").getElementsByTagName("a")[0].href = "autotest.html";

}
document.addEventListener( "DOMContentLoaded" , init , false);


function redirect(value)  
{
	if(value == 'news')
	{ 
		window.location = "http://www.skibbdcc.com/scriptfolder/editor.php" 
	}
	if(value == "email")
	{
		window.location = "http://www.skibbdcc.com/webmail"; 
	}
}

//function checkForMeeting(text, flag)
//{
//	if(flag == 1) 
//	{
//		document.getElementById("header_image_id").src="images/sticky_note.png"; 
//		document.getElementById("setText").innerHTML = "Next Club Meeting:<br />" + text;
		
//		document.getElementById("countdown-nextmeeting").src="images/sticky_note.png"; 
//		document.getElementById("countdown-nextmeeting").innerHTML = "Next Club Meeting:<br />" + text;
//	}
//}

function checkForMeetingBootstrap(text, flag)
{
	if(flag == 1) 
	{
		document.getElementById("header_image_id").src="images/sticky_note.png"; 
		document.getElementById("setText").innerHTML = "Next Club Meeting:<br />" + text;
	}
}

document.addEventListener( "DOMContentLoaded" , checkForMeeting , false); 


function validate(url)
{
	var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match&&match[7].length==11){
        return true;  
    }
	else  
	{
        window.alert("This is not a valid YouTube URL\nOnly desktop URLs can be used!!");   
	    document.getElementById('setvideo').value = ""; 
	    return false; 
    }	
}


//var TabbedContent = {
//	init: function() {	
//		$(".tab_item").mouseover(function() {
		
//			var background = $(this).parent().find(".moving_bg");
			
//			$(background).stop().animate({
//				left: $(this).position()['left']
//			}, {
//				duration: 300
//			});
			
//			TabbedContent.slideContent($(this));
			
//		});
//	},
	
//	slideContent: function(obj) {
		
//		var margin = $(obj).parent().parent().find(".slide_content").width();
//		margin = margin * ($(obj).prevAll().size() - 1);
//		margin = margin * -1;
		
//		$(obj).parent().parent().find(".tabslider").stop().animate({
//			marginLeft: margin + "px"
//		}, {
//			duration: 300
//		});
//	}
//}

//$(document).ready(function() {
//	TabbedContent.init();
//});


//function openMap(value){
//if(value == "0"){
//	window.open("http://www.skibbdcc.com/fastnet_maps.html");
//}else if(value == "1"){
//	window.open("http://www.skibbdcc.com/map_100_isles_night_nav.html");
//}else if(value == "2"){
//	window.open("http://www.skibbdcc.com/map_lsautocross.html");  
//}else if(value == "3"){
//	window.open("http://www.skibbdcc.com/map_autotest.html"); 
//}else if(value == "4"){
//	window.open("http://www.skibbdcc.com/map_economy_run.html"); 
//}else
//	window.open("http://www.skibbdcc.com/map_carbery_night_nav.html");  
//};


//$(function(){
//	var result = $("#newsscroll").outerHeight();
	
//	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
//		if(result <= 1190){
//			newsscroll.style.height="1190px"; 
//		}else{
//			newsscroll.style.height=auto;   
//			pageheader.style.marginLeft="15px";
//			pageheader.style.width="632px";
//			$('#newsscroll').jScrollPane();
//		} 

//	}
//	else
//	{
//		if(result <= 1190){
//			newsscroll.style.height="1190px"; 
//		}else{
//			newsscroll.style.height="1190px";
//			pageheader.style.marginLeft="15px";
//			pageheader.style.width="632px";
//			$('#newsscroll').jScrollPane();
//		} 
//	}
	
//});

//function openImage(e)
//{
//	var newImg=window.open('','','width=615,height=415') 
//	newImg.document.write('<img id="centerimage" src="'+ e +'" width="600" height="400"/>'); 
//	newImg.focus()
//	newImg.document.close() 
//}


