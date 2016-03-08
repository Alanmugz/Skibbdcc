<?php
error_reporting(0);
session_start();
include("configs.php");
include("language_admin.php");


if(isset($_REQUEST["act"])) {
  if ($_REQUEST["act"]=='logout') {
			$_SESSION["ProFiAnTsNeWsPRoLoGin"] = "";
			unset($_SESSION["ProFiAnTsNeWsPRoLoGin"]);
 } elseif ($_REQUEST["act"]=='login') {
  	if ($_REQUEST["user"] == $CONFIG["admin_user"] and $_REQUEST["pass"] == $CONFIG["admin_pass"]) {
		$md_sum=md5($CONFIG["admin_user"].$CONFIG["admin_pass"]);
		$sess_id=$md_sum.strtotime("+3 hours");
		$_SESSION["ProFiAnTsNeWsPRoLoGin"] = $sess_id;		
 		$_REQUEST["act"]='news';
  	} else {
		$message = $lang['Message_Incorrect_login_details'];
  	}
  }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $lang['News_Script_PHP_Pro_Administration']; ?></title>

<script language="javascript" src="include/functions.js"></script>
<script language="javascript" src="include/color_pick.js"></script>
<script type="text/javascript" src="include/datetimepicker_css.js"></script>
<link href="styles/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>

<body>
<center>
<div class="logo"><?php echo $lang['News_Script_PHP_Pro_Administration']; ?></div>
<div style="clear:both"></div>

<?php  
$Logged = false;
if (isset($_SESSION["ProFiAnTsNeWsPRoLoGin"])) $temp_sid=$_SESSION["ProFiAnTsNeWsPRoLoGin"];
$md_sum=md5($CONFIG["admin_user"].$CONFIG["admin_pass"]);
$md_res=substr($temp_sid,0,strlen($md_sum));
if (strcmp($md_sum,$md_res)==0) {
	$ts=substr($temp_sid,strlen($md_sum));
	if ($ts>time()) $Logged = true;
}
if ( $Logged ){

if ($_REQUEST["act"]=='updateOptionsNews') {
	
	if (!isset($_REQUEST["time_offset"]) or $_REQUEST["time_offset"]=='') $_REQUEST["time_offset"] = '0 hour';
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `per_page`		='".SaveDB($_REQUEST["per_page"])."',
				`shownews`		='".SaveDB($_REQUEST["shownews"])."',
				`news_top_num`	='".SaveDB($_REQUEST["news_top_num"])."', 
				`shownews_top`	='".SaveDB($_REQUEST["shownews_top"])."',
				`news_slid_num`	='".SaveDB($_REQUEST["news_slid_num"])."',
				`news_link`		='".SaveDB($_REQUEST["news_link"])."',
				`showsearch`	='".SaveDB($_REQUEST["showsearch"])."',
				`publishon`		='".SaveDB($_REQUEST["publishon"])."',
				`time_offset`	='".SaveDB($_REQUEST["time_offset"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$_REQUEST["act"]='news_options'; 
  	$message = $lang['Message_News_options_saved'];
	
} elseif ($_REQUEST["act"]=='updateOptionsComments') {

	if (!isset($_REQUEST["approval"]) or $_REQUEST["approval"]=='') $_REQUEST["approval"] = 'false';
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `email`				='".SaveDB($_REQUEST["email"])."',
				`approval`			='".SaveDB($_REQUEST["approval"])."',
				`ban_words`			='".SaveDB($_REQUEST["ban_words"])."', 
				`ban_ips`			='".SaveDB($_REQUEST["ban_ips"])."', 
				`comments_order`	='".SaveDB($_REQUEST["comments_order"])."', 
				`captcha`			='".SaveDB($_REQUEST["captcha"])."', 
				`captcha_theme`		='".SaveDB($_REQUEST["captcha_theme"])."', 
				`verify_question`	='".SaveDB($_REQUEST["verify_question"])."',  
				`verify_answer`		='".SaveDB($_REQUEST["verify_answer"])."', 
				`commentsoff`		='".SaveDB($_REQUEST["commentsoff"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$_REQUEST["act"]='comments_options'; 
  	$message = $lang['Message_Comments_options_saved'];

} elseif ($_REQUEST["act"]=='updateOptionsVisual') {
	
	$visual['gen_font_family'] 	= $_REQUEST['gen_font_family']; 
	$visual['gen_font_size'] 	= $_REQUEST['gen_font_size']; 
	$visual['gen_font_color']	= $_REQUEST['gen_font_color'];
	$visual['gen_bgr_color'] 	= $_REQUEST['gen_bgr_color'];
	$visual['gen_line_height'] 	= $_REQUEST['gen_line_height'];
	$visual['gen_width'] 		= $_REQUEST['gen_width'];
	
	// title in the news content
	$visual['title_color'] 		= $_REQUEST['title_color']; 
	$visual['title_font'] 		= $_REQUEST['title_font']; 
	$visual['title_size'] 		= $_REQUEST['title_size']; 
	$visual['title_font_weight']= $_REQUEST['title_font_weight']; 
	$visual['title_font_style'] = $_REQUEST['title_font_style']; 
	$visual['title_text_align'] = $_REQUEST['title_text_align']; 
	
	// title in the news summary
	$visual['summ_title_color'] 	 = $_REQUEST['summ_title_color']; 
	$visual['summ_title_font'] 		 = $_REQUEST['summ_title_font']; 
	$visual['summ_title_size']		 = $_REQUEST['summ_title_size']; 
	$visual['summ_title_font_weight']= $_REQUEST['summ_title_font_weight']; 
	$visual['summ_title_font_style'] = $_REQUEST['summ_title_font_style']; 
	$visual['summ_title_text_align'] = $_REQUEST['summ_title_text_align']; 
	
	// summary date style
	$visual['summ_show_date'] 		= $_REQUEST['summ_show_date'];
	$visual['summ_date_color'] 		= $_REQUEST['summ_date_color']; 
	$visual['summ_date_font'] 		= $_REQUEST['summ_date_font']; 
	$visual['summ_date_size'] 		= $_REQUEST['summ_date_size']; 
	$visual['summ_date_font_style'] = $_REQUEST['summ_date_font_style']; 
	$visual['summ_date_text_align'] = $_REQUEST['summ_date_text_align']; 
	$visual['summ_date_format'] 	= $_REQUEST['summ_date_format']; 
	$visual['summ_showing_time'] 	= $_REQUEST['summ_showing_time'];
	
	// news content date style
	$visual['show_date'] 		= $_REQUEST['show_date'];
	$visual['date_color'] 		= $_REQUEST['date_color']; 
	$visual['date_font'] 		= $_REQUEST['date_font']; 
	$visual['date_size'] 		= $_REQUEST['date_size']; 
	$visual['date_font_style'] 	= $_REQUEST['date_font_style']; 
	$visual['date_text_align'] 	= $_REQUEST['date_text_align']; 
	$visual['date_format'] 		= $_REQUEST['date_format']; 
	$visual['showing_time'] 	= $_REQUEST['showing_time']; 
	$visual['show_author'] 		= $_REQUEST['show_author'];
		
	// visual options for the news content 
	$visual['cont_color'] 		= $_REQUEST['cont_color']; 
	$visual['cont_font'] 		= $_REQUEST['cont_font']; 
	$visual['cont_size'] 		= $_REQUEST['cont_size']; 
	$visual['cont_font_style'] 	= $_REQUEST['cont_font_style']; 
	$visual['cont_text_align'] 	= $_REQUEST['cont_text_align']; 
	$visual['cont_line_height'] = $_REQUEST['cont_line_height'];
	
	// visual options for the news summary 
	$visual['summ_color'] 		= $_REQUEST['summ_color']; 
	$visual['summ_font'] 		= $_REQUEST['summ_font']; 
	$visual['summ_size'] 		= $_REQUEST['summ_size']; 
	$visual['summ_font_style'] 	= $_REQUEST['summ_font_style']; 
	$visual['summ_text_align'] 	= $_REQUEST['summ_text_align']; 
	$visual['summ_line_height'] = $_REQUEST['summ_line_height']; 
	$visual['summ_show_image'] 	= $_REQUEST['summ_show_image'];
	$visual['summ_img_width'] 	= $_REQUEST['summ_img_width']; 
	$visual['summ_img_height'] 	= $_REQUEST['summ_img_height']; 
	
	
	$visual['hl_bgr_color'] = $_REQUEST['hl_bgr_color']; 
	$visual['hl_padding'] 	= $_REQUEST['hl_padding'];
	
	/////////// pagination style ///////////
	$visual['pag_align_to'] 		= $_REQUEST['pag_align_to'];
	$visual['pag_font_color'] 		= $_REQUEST['pag_font_color'];
	$visual['pag_bord_color'] 		= $_REQUEST['pag_bord_color'];
	$visual['pag_bgr_color'] 		= $_REQUEST['pag_bgr_color'];
	// pagination style on hover
	$visual['pag_font_color_hover'] = $_REQUEST['pag_font_color_hover'];
	$visual['pag_bord_color_hover'] = $_REQUEST['pag_bord_color_hover'];
	$visual['pag_bgr_color_hover'] 	= $_REQUEST['pag_bgr_color_hover'];
	// pgination style for selected page
	$visual['pag_font_color_sel'] 	= $_REQUEST['pag_font_color_sel'];
	$visual['pag_bord_color_sel'] 	= $_REQUEST['pag_bord_color_sel'];
	$visual['pag_bgr_color_sel'] 	= $_REQUEST['pag_bgr_color_sel'];
	// pagination styles for active newxt/previous button
	$visual['pag_font_color_prn'] 	= $_REQUEST['pag_font_color_prn'];
	$visual['pag_bord_color_prn'] 	= $_REQUEST['pag_bord_color_prn'];
	$visual['pag_bgr_color_prn'] 	= $_REQUEST['pag_bgr_color_prn'];
	$visual['pag_bgr_color_prn_hover'] 	= $_REQUEST['pag_bgr_color_prn_hover'];	
	// pagination styles for inactive next/previous button
	$visual['pag_font_color_ina'] 	= $_REQUEST['pag_font_color_ina'];
	$visual['pag_bord_color_ina'] 	= $_REQUEST['pag_bord_color_ina'];
	$visual['pag_bgr_color_ina'] 	= $_REQUEST['pag_bgr_color_ina'];
	// pagination font-family, font-size, font-style and font-weight
	$visual['pag_font_family'] 		= $_REQUEST['pag_font_family']; 
	$visual['pag_font_size'] 		= $_REQUEST['pag_font_size']; 	 
	$visual['pag_font_style'] 		= $_REQUEST['pag_font_style'];
	$visual['pag_font_weight'] 		= $_REQUEST['pag_font_weight']; 
	
	$visual['link_font_size'] 	= $_REQUEST['link_font_size']; 
	$visual['link_color'] 		= $_REQUEST['link_color']; 
	$visual['link_font_weight'] = $_REQUEST['link_font_weight']; 
	$visual['link_align'] 		= $_REQUEST['link_align'];
	
	$visual['show_share_this']  = $_REQUEST['show_share_this'];
	$visual['share_this_align'] = $_REQUEST['share_this_align']; 
	
	$visual['dist_title_date'] 		= $_REQUEST['dist_title_date'];
	$visual['summ_dist_title_date'] = $_REQUEST['summ_dist_title_date'];
	$visual['dist_date_text'] 		= $_REQUEST['dist_date_text'];
	$visual['summ_dist_date_text'] 	= $_REQUEST['summ_dist_date_text'];
	$visual['dist_btw_news'] 		= $_REQUEST['dist_btw_news'];	
	$visual['dist_link_title'] 		= $_REQUEST['dist_link_title'];
		
	$visual = serialize($visual);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `visual`='".mysql_escape_string($visual)."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$_REQUEST["act"]='visual_options'; 
  	$message = $lang['Message_Visual_options_saved']; 

} elseif ($_REQUEST["act"]=='updateOptionsVisualTop') {
	
	$visual['top_gen_font_family'] 	= $_REQUEST['top_gen_font_family']; 
	$visual['top_gen_font_size'] 	= $_REQUEST['top_gen_font_size']; 
	$visual['top_gen_font_color'] 	= $_REQUEST['top_gen_font_color'];
	$visual['top_gen_bgr_color'] 	= $_REQUEST['top_gen_bgr_color'];
	$visual['top_gen_bgr_color'] 	= $_REQUEST['top_gen_bgr_color'];
	$visual['top_gen_line_height'] 	= $_REQUEST['top_gen_line_height'];
	$visual['top_gen_width'] 		= $_REQUEST['top_gen_width'];
	
	// top news title style
	$visual['top_title_color'] 		= $_REQUEST['top_title_color']; 
	$visual['top_title_font'] 		= $_REQUEST['top_title_font']; 
	$visual['top_title_size'] 		= $_REQUEST['top_title_size']; 
	$visual['top_title_font_weight']= $_REQUEST['top_title_font_weight']; 
	$visual['top_title_font_style'] = $_REQUEST['top_title_font_style']; 
	$visual['top_title_text_align'] = $_REQUEST['top_title_text_align']; 
	
	// top news summary title style
	$visual['top_summ_title_color'] 	 = $_REQUEST['top_summ_title_color']; 
	$visual['top_summ_title_font'] 		 = $_REQUEST['top_summ_title_font']; 
	$visual['top_summ_title_size'] 		 = $_REQUEST['top_summ_title_size']; 
	$visual['top_summ_title_font_weight']= $_REQUEST['top_summ_title_font_weight']; 
	$visual['top_summ_title_font_style'] = $_REQUEST['top_summ_title_font_style']; 
	$visual['top_summ_title_text_align'] = $_REQUEST['top_summ_title_text_align']; 
	
	// top news date and time style
	$visual['top_show_date'] 		= $_REQUEST['top_show_date'];
	$visual['top_date_color'] 		= $_REQUEST['top_date_color']; 
	$visual['top_date_font'] 		= $_REQUEST['top_date_font']; 
	$visual['top_date_size'] 		= $_REQUEST['top_date_size']; 
	$visual['top_date_font_style'] 	= $_REQUEST['top_date_font_style']; 
	$visual['top_date_text_align'] 	= $_REQUEST['top_date_text_align']; 
	$visual['top_date_format'] 		= $_REQUEST['top_date_format']; 
	$visual['top_showing_time']	  	= $_REQUEST['top_showing_time'];
	$visual['top_show_author'] 		= $_REQUEST['top_show_author'];
	
	// top news summary date and time style
	$visual['top_summ_show_date'] 		= $_REQUEST['top_summ_show_date'];
	$visual['top_summ_date_color'] 		= $_REQUEST['top_summ_date_color']; 
	$visual['top_summ_date_font'] 		= $_REQUEST['top_summ_date_font']; 
	$visual['top_summ_date_size'] 		= $_REQUEST['top_summ_date_size']; 
	$visual['top_summ_date_font_style'] = $_REQUEST['top_summ_date_font_style']; 
	$visual['top_summ_date_text_align'] = $_REQUEST['top_summ_date_text_align']; 
	$visual['top_summ_date_format'] 	= $_REQUEST['top_summ_date_format']; 
	$visual['top_summ_showing_time'] 	= $_REQUEST['top_summ_showing_time'];
	
	// top news content text style
	$visual['top_cont_color'] 		= $_REQUEST['top_cont_color']; 
	$visual['top_cont_font'] 		= $_REQUEST['top_cont_font']; 
	$visual['top_cont_size'] 		= $_REQUEST['top_cont_size']; 
	$visual['top_cont_font_style'] 	= $_REQUEST['top_cont_font_style']; 
	$visual['top_cont_text_align'] 	= $_REQUEST['top_cont_text_align']; 
	$visual['top_cont_line_height'] = $_REQUEST['top_cont_line_height']; 
	
	$visual['top_summ_color'] 		= $_REQUEST['top_summ_color']; 
	$visual['top_summ_font'] 		= $_REQUEST['top_summ_font']; 
	$visual['top_summ_size'] 		= $_REQUEST['top_summ_size']; 
	$visual['top_summ_font_style'] 	= $_REQUEST['top_summ_font_style']; 
	$visual['top_summ_text_align'] 	= $_REQUEST['top_summ_text_align']; 
	$visual['top_summ_line_height'] = $_REQUEST['top_summ_line_height']; 
	$visual['top_summ_show_image'] 	= $_REQUEST['top_summ_show_image'];
	$visual['top_summ_img_width'] 	= $_REQUEST['top_summ_img_width']; 
	$visual['top_summ_img_height'] 	= $_REQUEST['top_summ_img_height']; 
	
	$visual['top_hl_bgr_color'] = $_REQUEST['top_hl_bgr_color']; 
	$visual['top_hl_padding'] 	= $_REQUEST['top_hl_padding'];
		
	$visual['top_link_font_size'] 	= $_REQUEST['top_link_font_size']; 
	$visual['top_link_color'] 		= $_REQUEST['top_link_color']; 
	$visual['top_link_font_weight'] = $_REQUEST['top_link_font_weight']; 
	$visual['top_link_align'] 		= $_REQUEST['top_link_align'];
	
	$visual['top_show_share_this'] 	= $_REQUEST['top_show_share_this'];
	$visual['top_share_this_align'] = $_REQUEST['top_share_this_align']; 
	
	$visual['top_dist_title_date'] 		= $_REQUEST['top_dist_title_date'];
	$visual['top_summ_dist_title_date'] = $_REQUEST['top_summ_dist_title_date'];
	$visual['top_dist_date_text'] 		= $_REQUEST['top_dist_date_text']; 
	$visual['top_summ_dist_date_text'] 	= $_REQUEST['top_summ_dist_date_text'];
	$visual['top_dist_btw_news'] 		= $_REQUEST['top_dist_btw_news'];	
	$visual['top_dist_link_title'] 		= $_REQUEST['top_dist_link_title'];
	
	//////// news slider visual options ////////
	$visual['sl_gen_width'] 	 = $_REQUEST['sl_gen_width']; 
	$visual['sl_gen_bordercolor']= $_REQUEST['sl_gen_bordercolor']; 
	$visual['sl_gen_number'] 	 = $_REQUEST['sl_gen_number']; 
	$visual['sl_gen_interval'] 	 = $_REQUEST['sl_gen_interval']; 
	$visual['sl_gen_bgr_color']  = $_REQUEST['sl_gen_bgr_color'];	
	
	// slider headline image
	$visual['sl_img_width'] = $_REQUEST['sl_img_width'];
	$visual['sl_img_height']= $_REQUEST['sl_img_height'];
	
	// slider headline title
	$visual['sl_title_font_family'] = $_REQUEST['sl_title_font_family']; 
	$visual['sl_title_font_size'] 	= $_REQUEST['sl_title_font_size']; 
	$visual['sl_title_color'] 		= $_REQUEST['sl_title_color'];
	
	// slider headline summary
	$visual['sl_show_summ_text'] 	= $_REQUEST['sl_show_summ_text']; 
	$visual['sl_summ_font_family'] 	= $_REQUEST['sl_summ_font_family']; 
	$visual['sl_summ_font_size'] 	= $_REQUEST['sl_summ_font_size']; 
	$visual['sl_summ_color'] 		= $_REQUEST['sl_summ_color'];
	$visual['sl_summ_num_char'] 	= $_REQUEST['sl_summ_num_char'];
	
	// sliding images
	$visual['sl_bottom_bgrcolor'] 	= $_REQUEST['sl_bottom_bgrcolor'];
	$visual['sl_bottom_bgrcolsel'] 	= $_REQUEST['sl_bottom_bgrcolsel'];
	$visual['sl_bottom_height'] 	= $_REQUEST['sl_bottom_height']; 
	$visual['sl_keep_proportion'] 	= $_REQUEST['sl_keep_proportion'];
	
	// titles under the sliding images
	$visual['title_im_font_family'] = $_REQUEST['title_im_font_family']; 
	$visual['title_im_font_size'] 	= $_REQUEST['title_im_font_size']; 
	$visual['title_im_color'] 		= $_REQUEST['title_im_color'];
		
	$visual_top = serialize($visual);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `visual_top`='".mysql_escape_string($visual_top)."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$_REQUEST["act"]='visual_options_top'; 
  	$message = $lang['Message_Visual_options_Top_and_Slider']; 	
	
	
} elseif ($_REQUEST["act"]=='updateOptionsComm') {
		
	// comments visual options
	$visual['comm_bord_sides'] = $_REQUEST['comm_bord_sides'];
	$visual['comm_bord_style'] = $_REQUEST['comm_bord_style'];
	$visual['comm_bord_width'] = $_REQUEST['comm_bord_width'];
	$visual['comm_bord_color'] = $_REQUEST['comm_bord_color'];
	$visual['comm_padding']    = $_REQUEST['comm_padding'];
	$visual['comm_bgr_color']  = $_REQUEST['comm_bgr_color'];
	
	$visual['name_font_color'] 	= $_REQUEST['name_font_color'];
	$visual['name_font_size']  	= $_REQUEST['name_font_size']; 	 
	$visual['name_font_style'] 	= $_REQUEST['name_font_style'];
	$visual['name_font_weight'] = $_REQUEST['name_font_weight']; 
	
	$visual['comm_date_font'] 		= $_REQUEST['comm_date_font']; 
	$visual['comm_date_color'] 		= $_REQUEST['comm_date_color']; 
	$visual['comm_date_size'] 		= $_REQUEST['comm_date_size']; 
	$visual['comm_date_font_style'] = $_REQUEST['comm_date_font_style'];
	$visual['comm_date_format'] 	= $_REQUEST['comm_date_format']; 
	$visual['comm_showing_time'] 	= $_REQUEST['comm_showing_time'];
	
	$visual['comm_font_color'] 	= $_REQUEST['comm_font_color'];
	$visual['comm_font_size'] 	= $_REQUEST['comm_font_size']; 	 
	$visual['comm_font_style'] 	= $_REQUEST['comm_font_style'];
	$visual['comm_font_weight'] = $_REQUEST['comm_font_weight']; 
	
	$visual['dist_btw_comm'] = $_REQUEST['dist_btw_comm'];
	
		
	$visual_comm = serialize($visual);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `visual_comm`='".mysql_escape_string($visual_comm)."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$_REQUEST["act"]='visual_options_comm'; 
  	$message = $lang['Message_Visual_options_comments_saved']; 
	
 
} elseif ($_REQUEST["act"]=='updateOptionsLanguage') {
	
	$language['Back_to_home'] 		= $_REQUEST['Back_to_home']; 
	$language['Read_more'] 			= $_REQUEST['Read_more'];
	$language['Search_button'] 		= $_REQUEST['Search_button'];
	$language['Previous'] 			= $_REQUEST['Previous']; 
	$language['Next'] 				= $_REQUEST['Next'];  
	$language['No_news_published'] 	= $_REQUEST['No_news_published']; 
	$language['Author'] 			= $_REQUEST['Author'];
	
	// days of the week in the dates
	$language['Monday'] 	= $_REQUEST['Monday']; 
	$language['Tuesday'] 	= $_REQUEST['Tuesday'];
	$language['Wednesday'] 	= $_REQUEST['Wednesday'];
	$language['Thursday'] 	= $_REQUEST['Thursday']; 
	$language['Friday'] 	= $_REQUEST['Friday']; 
	$language['Saturday'] 	= $_REQUEST['Saturday'];
	$language['Sunday'] 	= $_REQUEST['Sunday'];
	
	// month names in the dates
	$language['January'] 	= $_REQUEST['January']; 
	$language['February'] 	= $_REQUEST['February'];
	$language['March'] 		= $_REQUEST['March'];
	$language['April'] 		= $_REQUEST['April']; 
	$language['May'] 		= $_REQUEST['May']; 
	$language['June'] 		= $_REQUEST['June'];
	$language['July'] 		= $_REQUEST['July'];
	$language['August'] 	= $_REQUEST['August'];
	$language['September'] 	= $_REQUEST['September']; 
	$language['October'] 	= $_REQUEST['October']; 
	$language['November'] 	= $_REQUEST['November'];
	$language['December'] 	= $_REQUEST['December'];
	
	$language['Word_Comments'] 			= $_REQUEST['Word_Comments'];
	$language['No_comments_posted'] 	= $_REQUEST['No_comments_posted'];
	$language['Leave_Comment'] 			= $_REQUEST['Leave_Comment'];
	$language['Comment_Name'] 			= $_REQUEST['Comment_Name'];	
	$language['Comment_Email'] 			= $_REQUEST['Comment_Email']; 
	$language['Enter_verification_code']= $_REQUEST['Enter_verification_code']; 
	$language['Reqiured_fields'] 		= $_REQUEST['Reqiured_fields']; 
	$language['Submit_Comment'] 		= $_REQUEST['Submit_Comment'];
	
	$language['Banned_ip_used'] 			= $_REQUEST['Banned_ip_used'];
	$language['Banned_word_used'] 			= $_REQUEST['Banned_word_used'];
	$language['Incorrect_verification_code']= $_REQUEST['Incorrect_verification_code']; 
	$language['Post_Submitted'] 			= $_REQUEST['Post_Submitted']; 
	$language['Comment_Submitted'] 			= $_REQUEST['Comment_Submitted'];
	$language['After_Approval_Admin'] 		= $_REQUEST['After_Approval_Admin'];
	
	$language['required_fields']= $_REQUEST['required_fields']; 
	$language['correct_email'] 	= $_REQUEST['correct_email']; 
	$language['field_code'] 	= $_REQUEST['field_code'];  	
	$language['wrong_answer'] 	= $_REQUEST['wrong_answer'];
	
	$language['New_post_posted'] 	= $_REQUEST['New_post_posted']; 
	$language['New_comment_posted'] = $_REQUEST['New_comment_posted'];
	
	
	$language = serialize($language);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `language`='".mysql_escape_string($language)."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$_REQUEST["act"]='language_options'; 
  	$message = $lang['Message_Language_options_saved']; 
 

} elseif ($_REQUEST["act"] == "addNews"){
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	if (!isset($_REQUEST["topnews"]) or $_REQUEST["topnews"]=='') $_REQUEST["topnews"] = 'false';
	if (!isset($_REQUEST["highlight"]) or $_REQUEST["highlight"]=='') $_REQUEST["highlight"] = 'false';
	if (!isset($_REQUEST["slider"]) or $_REQUEST["slider"]=='') $_REQUEST["slider"] = 'no';
	if (!isset($_REQUEST["news_comments"]) or $_REQUEST["news_comments"]=='') $_REQUEST["news_comments"] = 'false';
	
	$sql = "INSERT INTO ".$TABLE["News"]." 
			SET `publish_date` 	= '".SaveDB($_REQUEST["publish_date"])."',
				`status` 		= '".SaveDB($_REQUEST["status"])."',	
				`cat_id` 		= '".SaveDB($_REQUEST["cat_id"])."',			
				`editor_id` 	= '".SaveDB($_REQUEST["editor_id"])."',				
				`topnews` 		= '".SaveDB($_REQUEST["topnews"])."',
				`highlight` 	= '".SaveDB($_REQUEST["highlight"])."',
				`slider` 		= '".SaveDB($_REQUEST["slider"])."',
				`title` 		= '".SaveDB($_REQUEST["title"])."',
				`summary` 		= '".SaveDB($_REQUEST["summary"])."',
				`content` 		= '".SaveDB($_REQUEST["content"])."',
				`imgpos` 		= '".SaveDB($_REQUEST["imgpos"])."',
				`imgwidth` 		= '".SaveDB($_REQUEST["imgwidth"])."',
				`imgheight` 	= '".SaveDB($_REQUEST["imgheight"])."',
				`news_comments` = '".SaveDB($_REQUEST["news_comments"])."',  
				`reviews` 		= '0'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
	
	$index_id = mysql_insert_id();
	
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) {
		
		$format = end(explode(".", $_FILES["image"]['name']));
		$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");
			
		if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {
		
			$uploaddir = $CONFIG["upload_folder"];
			$name = $_FILES['image']['name'];
			$name = ereg_replace(" ", "_", $name); 
			$name = ereg_replace("%20", "_", $name);
			$name = $index_id . "_" . $name;

			
			$filePath = $uploaddir . $name;
			$thumbPath = $CONFIG["upload_thumbs"] . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
				chmod($filePath, 0777);
				$imgwidth = str_replace("px","",$_REQUEST["imgwidth"]);
				Resize_File($filePath, $imgwidth, 0); 
				Resize_File($filePath, $OptionsVis["summ_img_width"], 0, $thumbPath);

				$sql = "UPDATE ".$TABLE["News"]."  
						SET `image` = '".$name."'  
						WHERE id='".$index_id."'";
				$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
				$message = '';
			} else {
				$message = 'Cannot copy uploaded file to '.$filePath.'. Try to set the right permissions (CHMOD 777) to '.$CONFIG["upload_folder"]. " folder in the script directory. ";  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	} else { $message = $lang['Message_Image_file_is_not_uploaded']; }
		
	include('rss_generate_xml.php');	
	
	$_REQUEST["act"] = "news";		
	$message .= $lang['Message_News_created'];
	

} elseif ($_REQUEST["act"]=='updateNews') {
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	if (!isset($_REQUEST["topnews"]) or $_REQUEST["topnews"]=='') $_REQUEST["topnews"] = 'false';
	if (!isset($_REQUEST["highlight"]) or $_REQUEST["highlight"]=='') $_REQUEST["highlight"] = 'false';
	if (!isset($_REQUEST["slider"]) or $_REQUEST["slider"]=='') $_REQUEST["slider"] = 'no';
	if (!isset($_REQUEST["news_comments"]) or $_REQUEST["news_comments"]=='') $_REQUEST["news_comments"] = 'false';

	$sql = "UPDATE ".$TABLE["News"]." 
			SET `publish_date` 	= '".SaveDB($_REQUEST["publish_date"])."',
				`status` 		= '".SaveDB($_REQUEST["status"])."',	
				`cat_id` 		= '".SaveDB($_REQUEST["cat_id"])."',				
				`editor_id` 	= '".SaveDB($_REQUEST["editor_id"])."',	
				`topnews` 		= '".SaveDB($_REQUEST["topnews"])."',
				`highlight` 	= '".SaveDB($_REQUEST["highlight"])."',
				`slider` 		= '".SaveDB($_REQUEST["slider"])."',
                `title` 		= '".SaveDB($_REQUEST["title"])."',
				`summary` 		= '".SaveDB($_REQUEST["summary"])."',
				`content` 		= '".SaveDB($_REQUEST["content"])."',
				`imgpos` 		= '".SaveDB($_REQUEST["imgpos"])."', 
				`imgwidth` 		= '".SaveDB($_REQUEST["imgwidth"])."',
				`imgheight` 	= '".SaveDB($_REQUEST["imgheight"])."',
				`news_comments` = '".SaveDB($_REQUEST["news_comments"])."'  
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$imageArr = mysql_fetch_assoc($sql_result);
	$image = stripslashes($imageArr["image"]);
	
	$index_id = $_REQUEST["id"];
		
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) { 
	
		$format = end(explode(".", $_FILES["image"]['name']));					
		$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");
			
		if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {	
		
			if($image != "") unlink($CONFIG["upload_folder"].$image);
			if($image != "") unlink($CONFIG["upload_thumbs"].$image);
			
			$name = $_FILES['image']['name'];
			$name = ereg_replace(" ", "_", $name); 
			$name = ereg_replace("%20", "_", $name);
			
			$filename = $CONFIG["upload_folder"] . $index_id . "_" . $name;
			$thumbPath = $CONFIG["upload_thumbs"] . $index_id . "_" . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filename)) {
				chmod($filename,0777); 
				$imgwidth = str_replace("px","",$_REQUEST["imgwidth"]);
				Resize_File($filename, $imgwidth, 0); 
				Resize_File($filename, $OptionsVis["summ_img_width"], 0, $thumbPath);
				
				$sql = "UPDATE `".$TABLE["News"]."` 
						SET `image` = '".mysql_escape_string($index_id . "_" . $name) ."' 
						WHERE id = '".$index_id."'";
				$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
			} else {
				$message = 'Cannot copy uploaded file to '.$filePath.'. Try to set the right permissions (CHMOD 777) to '.$CONFIG["upload_folder"]. " folder in the script directory. ";  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	}
	
	include('rss_generate_xml.php');
	
	if($_REQUEST["updatepreview"]=='Update and Preview') {
		$_REQUEST["act"]='viewNews'; 		
	} else {
		$_REQUEST["act"]='news'; 
	}
	$message .= $lang['Message_News_updated'];
	
	
} elseif ($_REQUEST["act"]=='updateArchive') {
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	if (!isset($_REQUEST["news_comments"]) or $_REQUEST["news_comments"]=='') $_REQUEST["news_comments"] = 'false';

	$sql = "UPDATE ".$TABLE["Archives"]." 
			SET `publish_date` 	= '".SaveDB($_REQUEST["publish_date"])."',
				`status` 		= '".SaveDB($_REQUEST["status"])."', 			
				`editor_id` 	= '".SaveDB($_REQUEST["editor_id"])."',
                `title` 		= '".SaveDB($_REQUEST["title"])."',
				`summary` 		= '".SaveDB($_REQUEST["summary"])."',
				`content` 		= '".SaveDB($_REQUEST["content"])."',
				`imgpos` 		= '".SaveDB($_REQUEST["imgpos"])."', 
				`imgwidth` 		= '".SaveDB($_REQUEST["imgwidth"])."',
				`imgheight` 	= '".SaveDB($_REQUEST["imgheight"])."',
				`news_comments` = '".SaveDB($_REQUEST["news_comments"])."'  
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	$sql = "SELECT * FROM ".$TABLE["Archives"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$imageArr = mysql_fetch_assoc($sql_result);
	$image = stripslashes($imageArr["image"]);
	
	$index_id = $_REQUEST["id"];
		
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) { 
	
		$format = end(explode(".", $_FILES["image"]['name']));					
		$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");
			
		if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {	
		
			if($image != "") unlink($CONFIG["upload_folder"].$image);
			if($image != "") unlink($CONFIG["upload_thumbs"].$image);
			
			$name = $_FILES['image']['name'];
			$name = ereg_replace(" ", "_", $name); 
			$name = ereg_replace("%20", "_", $name);
			
			$filename = $CONFIG["upload_folder"] . $index_id . "_a_" . $name;
			$thumbPath = $CONFIG["upload_thumbs"] . $index_id . "_a_" . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filename)) {
				chmod($filename,0777); 
				$imgwidth = str_replace("px","",$_REQUEST["imgwidth"]);
				Resize_File($filename, $imgwidth, 0); 
				Resize_File($filename, $OptionsVis["summ_img_width"], 0, $thumbPath);
				
				$sql = "UPDATE `".$TABLE["Archives"]."` 
						SET `image` = '".mysql_escape_string($index_id . "_a_" . $name) ."' 
						WHERE id = '".$index_id."'";
				$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
			} else {
				$message = 'Cannot copy uploaded file to '.$filePath.'. Try to set the right permissions (CHMOD 777) to '.$CONFIG["upload_folder"]. " folder in the script directory. ";  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	}
	
	if($_REQUEST["updatepreview"]=='Update and Preview') {
		$_REQUEST["act"]='viewArchive'; 		
	} else {
		$_REQUEST["act"]='archive'; 
	}
	$message .= $lang['Message_Archived_News_updated'];

	
} elseif ($_REQUEST["act"]=='delNews') {
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	$imageArr = mysql_fetch_assoc($sql_result);
	$image = stripslashes($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);
	if($image != "") unlink($CONFIG["upload_thumbs"].$image);
	
	$sql = "DELETE FROM ".$TABLE["Comments"]." WHERE news_id='".$_REQUEST["id"]."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());

	$sql = "DELETE FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
 	$_REQUEST["act"]='news'; 
	$message = $lang['Message_News_deleted'];
	
} elseif ($_REQUEST["act"]=='delArchive') {
	
	$sql = "SELECT * FROM ".$TABLE["Archives"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	$imageArr = mysql_fetch_assoc($sql_result);
	$image = stripslashes($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);
	if($image != "") unlink($CONFIG["upload_thumbs"].$image);
	
	$sql = "DELETE FROM ".$TABLE["Comments"]." WHERE archive_id='".$_REQUEST["id"]."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());

	$sql = "DELETE FROM ".$TABLE["Archives"]." WHERE id='".$_REQUEST["id"]."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
 	$_REQUEST["act"]='archive'; 
	$message = $lang['Message_News_deleted'];
	
} elseif ($_REQUEST["act"]=="delImage") { 
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	$imageArr = mysql_fetch_assoc($sql_result);
	$image = stripslashes($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);
	if($image != "") unlink($CONFIG["upload_thumbs"].$image);
	
	$sql = "UPDATE `".$TABLE["News"]."` SET `image` = '' WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	
	$message = $lang['Message_Image_deleted'];
	$_REQUEST["act"] = "editNews";
	
} elseif ($_REQUEST["act"]=="delArchImage") { 
	
	$sql = "SELECT * FROM ".$TABLE["Archives"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	$imageArr = mysql_fetch_assoc($sql_result);
	$image = stripslashes($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);
	if($image != "") unlink($CONFIG["upload_thumbs"].$image);
	
	$sql = "UPDATE `".$TABLE["Archives"]."` SET `image` = '' WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	
	$message = $lang['Message_Image_deleted'];
	$_REQUEST["act"] = "editArchive";



} elseif ($_REQUEST["act"] == "toArchive"){
	
	foreach($_REQUEST['toarchive'] as $id) {
		$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".$id."'";
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
		$News = mysql_fetch_assoc($sql_result);
		
		// copy news to archives
		$sql = "INSERT INTO ".$TABLE["Archives"]." 
				SET `publish_date`	= '".$News["publish_date"]."',
					`status` 		= '".$News["status"]."',	
					`cat_id` 		= '".$News["cat_id"]."',			
					`editor_id` 	= '".$News["editor_id"]."',				
					`topnews` 		= '".$News["topnews"]."',
					`highlight` 	= '".$News["highlight"]."',
					`slider` 		= '".$News["slider"]."',
					`title` 		= '".mysql_real_escape_string(ReadDB($News["title"]))."',
					`summary` 		= '".mysql_real_escape_string(ReadDB($News["summary"]))."',
					`content` 		= '".mysql_real_escape_string(ReadDB($News["content"]))."',
					`image` 		= '".$News["image"]."', 
					`imgpos` 		= '".$News["imgpos"]."',
					`imgwidth` 		= '".$News["imgwidth"]."',
					`imgheight` 	= '".$News["imgheight"]."',
					`news_comments` = '".$News["news_comments"]."',  
					`reviews` 		= '".$News["reviews"]."'";
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
		
		$archive_id = mysql_insert_id();
		
		// changing news_id to archive_id
		$sql = "UPDATE ".$TABLE["Comments"]." 
				SET `news_id` 	= '',
					`archive_id`= '".$archive_id."' 
				WHERE news_id='".$id."'";
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
		
		// delete news from news list
		$sql = "DELETE FROM ".$TABLE["News"]." WHERE id='".$id."'";
   		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	}
			
	$_REQUEST["act"] = "news";		
	$message .= $lang['Message_News_moved_to_archive_list'];
	
} elseif ($_REQUEST["act"] == "toNews"){
	
	foreach($_REQUEST['tonews'] as $id) {
		$sql = "SELECT * FROM ".$TABLE["Archives"]." WHERE id = '".$id."'";
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
		$News = mysql_fetch_assoc($sql_result);
		
		// copy archives to news 
		$sql = "INSERT INTO ".$TABLE["News"]." 
				SET `publish_date` 	= '".$News["publish_date"]."',
					`status` 		= '".$News["status"]."',	
					`cat_id`		= '".$News["cat_id"]."',			
					`editor_id` 	= '".$News["editor_id"]."',				
					`topnews` 		= '".$News["topnews"]."',
					`highlight` 	= '".$News["highlight"]."',
					`slider` 		= '".$News["slider"]."',
					`title` 		= '".mysql_real_escape_string(ReadDB($News["title"]))."',
					`summary` 		= '".mysql_real_escape_string(ReadDB($News["summary"]))."',
					`content` 		= '".mysql_real_escape_string(ReadDB($News["content"]))."',
					`image` 		= '".$News["image"]."', 
					`imgpos` 		= '".$News["imgpos"]."',
					`imgwidth` 		= '".$News["imgwidth"]."',
					`imgheight` 	= '".$News["imgheight"]."',
					`news_comments` = '".$News["news_comments"]."',  
					`reviews` 		= '".$News["reviews"]."'";
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
		
		$news_id = mysql_insert_id();
		
		// changing news_id to archive_id 
		$sql = "UPDATE ".$TABLE["Comments"]." 
				SET `news_id` 	= '".$news_id."',
					`archive_id`= '' 
				WHERE archive_id='".$id."'";
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
		
		// delete news from archives list 	
		$sql = "DELETE FROM ".$TABLE["Archives"]." WHERE id='".$id."'";
   		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	}
		
	$_REQUEST["act"] = "archive";		
	$message .= $lang['Message_Archived_news_moved_to_News_list'];
	

} elseif ($_REQUEST["act"] == "addCat"){
	
	$sql = "INSERT INTO ".$TABLE["Categories"]." 
			SET `cat_name` = '".SaveDB($_REQUEST["cat_name"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
		
	$_REQUEST["act"] = "cats";		
	$message .= $lang['Message_Category_created'];
	
	
} elseif ($_REQUEST["act"] == "updateCat"){
	
	$sql = "UPDATE ".$TABLE["Categories"]." 
			SET `cat_name` = '".SaveDB($_REQUEST["cat_name"])."' 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
		
	$_REQUEST["act"] = "cats";		
	$message .= $lang['Message_Category_updated'];
	
} elseif ($_REQUEST["act"]=='delCat') {
	
	$sql = "DELETE FROM ".$TABLE["Categories"]." WHERE id='".$_REQUEST["id"]."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
 	$_REQUEST["act"]='cats'; 
	$message = $lang['Message_Category_deleted'];

	
} elseif ($_REQUEST["act2"]=="change_status_comm") { 
	
	$sql = "UPDATE ".$TABLE["Comments"]." 
			SET `status` = '".SaveDB($_REQUEST["status"])."' 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	$message = $lang['Message_Comment_Status_Updated'];
	$_REQUEST["act"] = "comments";

} elseif ($_REQUEST["act"]=='updateComment') {

	$sql = "UPDATE ".$TABLE["Comments"]." 
			SET `status`	='".$_REQUEST["status"]."', 
				`name`		='".SaveDB($_REQUEST["name"])."', 
				`email`		='".SaveDB($_REQUEST["email"])."', 
				`comment`	='".SaveDB($_REQUEST["comment"])."' 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$_REQUEST["act"]='comments'; 
	$message = $lang['Message_Comment_updated'];
	
} elseif ($_REQUEST["act"]=='BanIP') {

	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `ban_ips` =  CONCAT(`ban_ips`, ', ".SaveDB($_REQUEST["ip_addr"])."')";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	$_REQUEST["act"]='comments'; 
	$message = 'IP '.$_REQUEST["ip_addr"].' banned! ';
	
	
} elseif ($_REQUEST["act"]=='delComment') {
	
	$sql = "DELETE FROM ".$TABLE["Comments"]." WHERE id='".$_REQUEST["id"]."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
 	$_REQUEST["act"]='comments'; 
	$message = $lang['Message_Comment_deleted'];


} elseif ($_REQUEST["act"] == "addEditor"){
	
	$sql = "INSERT INTO ".$TABLE["Editors"]." 
			SET `editor_name` 		= '".SaveDB($_REQUEST["editor_name"])."',
				`editor_email` 		= '".SaveDB($_REQUEST["editor_email"])."',
				`editor_username` 	= '".SaveDB($_REQUEST["editor_username"])."',
				`editor_password` 	= '".SaveDB($_REQUEST["editor_password"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
		
	$_REQUEST["act"] = "editors";		
	$message .= $lang['Message_Editor_created'];
	
	
} elseif ($_REQUEST["act"] == "updateEditor"){
	
	$sql = "UPDATE ".$TABLE["Editors"]." 
			SET `editor_name` 		= '".SaveDB($_REQUEST["editor_name"])."',
				`editor_email` 		= '".SaveDB($_REQUEST["editor_email"])."',
				`editor_username` 	= '".SaveDB($_REQUEST["editor_username"])."',
				`editor_password` 	= '".SaveDB($_REQUEST["editor_password"])."' 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
		
	$_REQUEST["act"] = "editors";		
	$message .= $lang['Message_Editor_updated'];

} elseif ($_REQUEST["act"]=='delEditor') {
	
	$sql = "DELETE FROM ".$TABLE["Editors"]." WHERE id='".$_REQUEST["id"]."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
 	$_REQUEST["act"]='editors'; 
	$message = $lang['Message_Editor_deleted'];

}

if ($_REQUEST["act"]=='' or !isset($_REQUEST["act"])) $_REQUEST["act"]='news';
?> 

	<div class="blue_line"></div>
    
	<div class="divMenu">	
      <div class="menuButtons">
   	  	<div class="menuButton"><a<?php if($_REQUEST['act']=='news' or $_REQUEST['act']=='newNews' or $_REQUEST['act']=='viewNews' or $_REQUEST['act']=='editNews' or $_REQUEST['act']=='rss') echo ' class="selected"'; ?> href="admin.php?act=news"><?php echo $lang['menu_News']; ?></a></div>
        <div class="menuButton"><a<?php if($_REQUEST['act']=='cats' or $_REQUEST['act']=='newCat' or $_REQUEST['act']=='editCat' or $_REQUEST['act']=='HTML_Cat') echo ' class="selected"'; ?> href="admin.php?act=cats"><?php echo $lang['menu_Categories']; ?></a></div>
        <div class="menuButton"><a<?php if($_REQUEST['act']=='comments' or $_REQUEST['act']=='editComment') echo ' class="selected"'; ?> href="admin.php?act=comments"><?php echo $lang['menu_Comments'] ?></a></div>
        <div class="menuButton"><a<?php if($_REQUEST['act']=='editors' or $_REQUEST['act']=='newEditor' or $_REQUEST['act']=='editEditor') echo ' class="selected"'; ?> href="admin.php?act=editors"><?php echo $lang['menu_Editors']; ?></a></div>
        <div class="menuButton"><a<?php if($_REQUEST["act"]=='archive' or $_REQUEST['act']=='editArchive') echo ' class="selected"'; ?> href="admin.php?act=archive"><?php echo $lang['menu_Archive']; ?></a></div>
        <div class="menuButton"><a<?php if($_REQUEST['act']=='news_options' or $_REQUEST['act']=='comments_options' or $_REQUEST['act']=='visual_options' or $_REQUEST['act']=='visual_options_top' or $_REQUEST['act']=='visual_options_comm' or $_REQUEST['act']=='language_options') echo ' class="selected"'; ?> href="admin.php?act=news_options"><?php echo $lang['menu_Options']; ?></a></div>
        <div class="menuButton"><a<?php if($_REQUEST['act']=='html') echo ' class="selected"'; ?> href="admin.php?act=html"><?php echo $lang['menu_Put_on_WebPage'] ?></a></div>
        <div class="menuButtonLogout"><a href="admin.php?act=logout"><?php echo $lang['menu_Logout']; ?></a></div>
        <div class="clear"></div>        
      </div>
	</div>
	
    <div class="blue_line"></div>


<?php
if ($_REQUEST["act"]=='news' or $_REQUEST["act"]=='newNews' or $_REQUEST["act"]=='editNews' or $_REQUEST["act"]=='viewNews' or $_REQUEST["act"]=='rss') {
?>
<div class="divSubMenu">	
    <div class="menuSubButtons">
   	  <div class="menuSubButton"><a<?php if($_REQUEST['act']=='news' or $_REQUEST['act']=='editNews' or $_REQUEST["act"]=='viewNews') echo ' class="selected"'; ?> href="admin.php?act=news"><?php echo $lang['menu_News_List']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newNews') echo ' class="selected"'; ?> href="admin.php?act=newNews"><?php echo $lang['menu_Create_News']; ?></a></div>
      <div class="menuSubButton"><a href="preview.php" target="_blank"><?php echo $lang['menu_News_Preview']; ?></a></div>
      <div class="menuSubButton"><a href="preview_top.php" target="_blank"><?php echo $lang['menu_TopNews_Preview']; ?></a></div>
      <div class="menuSubButton"><a href="preview_slider.php" target="_blank"><?php echo $lang['menu_Slider_Preview']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='rss') echo ' class="selected"'; ?> href="admin.php?act=rss"><?php echo $lang['menu_RSS_feed']; ?></a></div>
      <div class="clear"></div>        
    </div>
</div>
<?php
} elseif ($_REQUEST["act"]=='cats' or $_REQUEST["act"]=='newCat' or $_REQUEST["act"]=='editCat' or $_REQUEST['act']=='HTML_Cat') {
?>
<div class="divSubMenu">	
    <div class="menuSubButtons">
   	  <div class="menuSubButton"><a<?php if($_REQUEST['act']=='cats') echo ' class="selected"'; ?> href="admin.php?act=cats"><?php echo $lang['menu_Categories_List']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newCat') echo ' class="selected"'; ?> href="admin.php?act=newCat"><?php echo $lang['menu_Create_Category']; ?></a></div>
      <div class="clear"></div>        
    </div>
</div>
<?php
} elseif ($_REQUEST["act"]=='editors' or $_REQUEST["act"]=='newEditor' or $_REQUEST["act"]=='editEditor') {
?>
<div class="divSubMenu">	
    <div class="menuSubButtons">
   	  <div class="menuSubButton"><a<?php if($_REQUEST['act']=='editors') echo ' class="selected"'; ?> href="admin.php?act=editors"><?php echo $lang['menu_Editors_List']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newEditor') echo ' class="selected"'; ?> href="admin.php?act=newEditor"><?php echo $lang['menu_Create_Editor']; ?></a></div>
      <div class="menuSubButton"><a href="editor.php" target="_blank"><?php echo $lang['menu_Editor_Login']; ?></a></div>
      <div class="clear"></div>        
    </div>
</div>
<?php
} elseif ($_REQUEST["act"]=='archive' or $_REQUEST['act']=='editArchive' or $_REQUEST["act"]=='viewArchive') {
?>
<div class="divSubMenu">	
    <div class="menuSubButtons">
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='archive' or $_REQUEST['act']=='editArchive' or $_REQUEST["act"]=='viewArchive') echo ' class="selected"'; ?> href="admin.php?act=archive"><?php echo $lang['menu_Archive_List']; ?></a></div>
      <div class="menuSubButton"><a href="preview_archive.php" target="_blank"><?php echo $lang['menu_Archive_Preview']; ?></a></div>
      <div class="clear"></div>        
    </div>
</div>
<?php 
} elseif ($_REQUEST["act"]=='news_options' or $_REQUEST["act"]=='comments_options' or $_REQUEST["act"]=='visual_options' or $_REQUEST["act"]=='visual_options_top' or $_REQUEST["act"]=='visual_options_comm' or $_REQUEST["act"]=='language_options') { 
?>
<div class="divSubMenu">	
    <div class="menuSubButtons">
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='news_options') echo ' class="selected"'; ?> href="admin.php?act=news_options" style="padding-left:0px;"><?php echo $lang['menu_Main_options']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='comments_options') echo ' class="selected"'; ?> href="admin.php?act=comments_options"><?php echo $lang['menu_Comments_options']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='visual_options') echo ' class="selected"'; ?> href="admin.php?act=visual_options"><?php echo $lang['menu_Visual_options']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='visual_options_top') echo ' class="selected"'; ?> href="admin.php?act=visual_options_top"><?php echo $lang['menu_Visual_Top_Slider_News']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='visual_options_comm') echo ' class="selected"'; ?> href="admin.php?act=visual_options_comm"><?php echo $lang['menu_Visual_options_Comments']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='language_options') echo ' class="selected"'; ?> href="admin.php?act=language_options" style="padding-right:0px;background:none;"><?php echo $lang['menu_Language']; ?></a></div>
      <div class="clear"></div>        
    </div>
</div>
<?php } ?>

<div class="wrap_body">

	<?php if(isset($message)) {?>
    <div class="message"><?php echo $message; ?></div>
    <?php } ?>
    

<?php 
if ($_REQUEST["act"]=='news') {
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) mysql_real_escape_string(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("title", "publish_date", "status", "cat_id", "editor_id", "reviews");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "publish_date";
	}
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "DESC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
	
	$sqlPublished   = "SELECT id FROM ".$TABLE["News"]." WHERE status='Published'";
	$sql_resultPublished = mysql_query ($sqlPublished, $conn ) or die ('MySQL query error: '.$sqlPublished.'. Error: '.mysql_error());
	$NewsPublished = mysql_num_rows($sql_resultPublished);
	
	$sqlCount   = "SELECT id FROM ".$TABLE["News"];
	$sql_resultCount = mysql_query ($sqlCount, $conn ) or die ('MySQL query error: '.$sqlCount.'. Error: '.mysql_error());
	$NewsCount = mysql_num_rows($sql_resultCount);
?>
	<div class="pageDescr"><?php echo $lang['List_Below_is_a_list']; ?> <strong style="font-size:16px"><?php echo $NewsPublished; ?></strong> <?php echo $lang['List_news_published']; ?> <strong style="font-size:16px"><?php echo $NewsCount; ?></strong>.</div>
    
    <div class="searchForm">
    <form action="admin.php?act=news" method="post" name="form" class="formStyle">
      <input type="text" name="search" onfocus="searchdescr(this.value);" value="<?php if(isset($_REQUEST["search"])) echo $_REQUEST["search"]; else echo 'enter part of news title'; ?>" class="searchfield" />
      <input type="submit" value="<?php echo $lang['List_Search_for_news']; ?>" class="submitButton" />
    </form>
    </div>
    
    <form action="admin.php" method="post" name="form1" class="formStyle">
    <input type="hidden" name="act" value="toArchive" />
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=title"><?php echo $lang['List_Title']; ?></a></td>
        <td width="13%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['List_Date_published']; ?></a></td>
        <td width="8%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['List_Status']; ?></a></td>
        <td width="8%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=cat_id"><?php echo $lang['List_Category']; ?></a></td>
        <td width="8%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=editor_id"><?php echo $lang['List_Editor']; ?></a></td>
        <td width="7%" class="headlist"><?php echo $lang['List_Comments']; ?></td>
        <td width="5%" class="headlist"><a href="admin.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=reviews"><?php echo $lang['List_Reviews']; ?></a></td>
        <td width="9%" class="headlist"><?php echo $lang['List_To_archive']; ?></td>
        <td class="headlist" colspan="3" width="15%">&nbsp;</td>
  	  </tr>
      
  	<?php 
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
	  $findMe = mysql_escape_string($_REQUEST["search"]);
	  $search = "WHERE title LIKE '%".$findMe."%'";
	} else {
	  $search = '';
	}

	$sql   = "SELECT count(*) as total FROM ".$TABLE["News"]." ".$search;
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$row   = mysql_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/20);

	$sql = "SELECT * FROM ".$TABLE["News"]." ".$search." 
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*20 . ",20";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	if (mysql_num_rows($sql_result)>0) {
		$i=1;	
		while ($News = mysql_fetch_assoc($sql_result)) {	
			$sqlC   = "SELECT count(*) as total FROM ".$TABLE["Comments"]." WHERE news_id='".$News["id"]."'";
			$sql_resultC = mysql_query ($sqlC, $conn ) or die ('MySQL query error: '.$sqlC);
			$countComm = mysql_fetch_array($sql_resultC);		
	?>
  	  <tr>
        <td class="bodylist"><?php echo ReadDB($News["title"]); ?></td>
        <td class="bodylist"><?php echo admin_date($News["publish_date"]); ?></td>
        <td class="bodylist"><?php echo ReadDB($News["status"]); ?></td>        
        <td class="bodylist">
        	<?php 
			$sqlCat = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$News["cat_id"]."'";
			$sql_resultCat = mysql_query ($sqlCat, $conn ) or die ('MySQL query error: '.$sqlCat.'. Error: '.mysql_error());
			$Cat = mysql_fetch_assoc($sql_resultCat);	
			if($Cat["id"]>0) echo ReadDB($Cat["cat_name"]); else echo "------"; ?>
        </td>
        <td class="bodylist">
        	<?php 
			$sqlEd = "SELECT * FROM ".$TABLE["Editors"]." WHERE id='".$News["editor_id"]."'";
			$sql_resultEd = mysql_query ($sqlEd, $conn ) or die ('MySQL query error: '.$sqlEd.'. Error: '.mysql_error());
			$Editor = mysql_fetch_assoc($sql_resultEd);	
			if($Editor["id"]>0) echo ReadDB($Editor["editor_name"]); else echo "------"; ?>
        </td>
        <td class="bodylist"><a style="text-decoration:none" href="admin.php?act=comments&news_id=<?php echo $News["id"]; ?>"><?php echo $countComm["total"]; ?></a> <?php if($News["news_comments"]=='false') echo "<sub>(not allowed)</sub>"; ?></td>
        <td class="bodylist"><?php if($News["reviews"]=='') echo "0"; else echo $News["reviews"]; ?></td>
        <td class="bodylist"><input name="toarchive[]" type="checkbox" value="<?php echo $News["id"]; ?>" /></td>
        <td class="bodylistAct"><a class="view" href='admin.php?act=viewNews&id=<?php echo $News["id"]; ?>'><?php echo $lang['List_Preview']; ?></a></td>
        <td class="bodylistAct"><a href='admin.php?act=editNews&id=<?php echo $News["id"]; ?>'><?php echo $lang['List_Edit']; ?></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delNews&id=<?php echo $News["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');"><?php echo $lang['List_DELETE']; ?></a></td>
  	  </tr>
  	<?php 
			$i++;
		}
	} else {
	?>
      <tr>
      	<td colspan="11" style="border-bottom:1px solid #CCCCCC"><?php echo $lang['List_No_News']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>0) {
    ?>
  	  <tr>
      	<td colspan="7" class="bottomlist"><div class='paging'><?php echo $lang['List_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=news&p=".$i."&search=".$_REQUEST["search"]."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
        <td colspan="4" class="bottomlist">
        	<div style="text-align:left;"><input name="submit" type="submit" value="<?php echo $lang['List_To_Archive']; ?>" /></div>
        </td>
      </tr>
	<?php
    }
    ?>
	</table>
    </form>

<?php 
} elseif ($_REQUEST["act"]=='newNews') { 
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	mysql_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="addNews" />
  	<div class="pageDescr"><?php echo $lang['Create_News_To_create_news']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Create_News']; ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Create_News_Status']; ?></td>
      	<td>
            <select name="status">
              <option value="Published"><?php echo $lang['Create_News_Published']; ?></option>
              <option value="Hidden"><?php echo $lang['Create_News_Hidden']; ?></option>
            </select>
      	</td>
      </tr>
      <tr>
      	<td><?php echo $lang['Create_News_Category']; ?> </td>
      	<td>
        	<select name="cat_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
            if (mysql_num_rows($sql_result)>0) {
              while ($Cat = mysql_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Cat["id"]; ?>"><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>  
      <tr>
      	<td><?php echo $lang['Create_News_Editor']; ?> </td>
      	<td>
        	<select name="editor_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Editors"]." ORDER BY editor_name ASC";
            $sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
            if (mysql_num_rows($sql_result)>0) {
              while ($Editor = mysql_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Editor["id"]; ?>"><?php echo ReadDB($Editor["editor_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>   
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Top_Slider_News']; ?></td>
        <td>
        	<div style="float:left"><input name="topnews" type="checkbox" value="true" /> <?php echo $lang['Create_News_check_if_you_want']; ?></div>
			<div style="float:left;padding-left:60px;"><input name="slider" type="checkbox" value="yes" /> <?php echo $lang['Create_News_check_if_you_want_slider']; ?></div>
		</td>
      </tr>  
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Highlight_News']; ?></td>
        <td><input name="highlight" type="checkbox" value="true" /> <?php echo $lang['Create_News_want_this_highlighted']; ?></td>
      </tr>  
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Title']; ?></td>
        <td><input type="text" name="title" size="100" maxlength="250" /></td>
      </tr>
      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Create_News_Summary']; ?></td>
        <td><textarea name="summary" cols="80" rows="3"></textarea></td>
      </tr>
      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Create_News_Content']; ?></td>
        <td>
        	<textarea name="content" id="content" class="content" cols="85" rows="20"></textarea>
            <?php 
			$full_url = 'http';
			if ($_SERVER["HTTPS"] == "on") {$full_url .= "s";}
			$full_url .= "://";
			$full_url .= $_SERVER["SERVER_NAME"].$CONFIG["folder_name"];
			?>
                
            <script type="text/javascript">
				CKEDITOR.replace( 'content',
                {	
                    filebrowserBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
					filebrowserUploadUrl  :'<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=File',
					filebrowserImageUploadUrl : '<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=Image',
					filebrowserFlashUploadUrl : '<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
					
					height: 400, width: 800

				});
			</script>
            <div style="font-size:11px;font-style:italic;"><?php echo $lang['Create_News_For_best_performance']; ?></div>
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Photo']; ?></td>
        <td><input type="file" name="image" size="80" /> <sub><?php echo $lang['Create_News_Limit_Mb']; ?></sub></td>
      </tr> 
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Image_location_in_the_text']; ?></td>
        <td>
        	<select name="imgpos">
            	<option value="left">left</option>
                <option value="right">right</option>
                <option value="top">top</option>
                <option value="bottom">bottom</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Image width']; ?></td>
        <td>
        	<select name="imgwidth">
            	<option value="700px">700px</option>
                <option value="680px">680px</option>
                <option value="660px">660px</option>
                <option value="650px">650px</option>
                <option value="640px">640px</option>
                <option value="620px">620px</option>
            	<option value="600px">600px</option>
                <option value="580px">580px</option>
                <option value="560px">560px</option>
                <option value="540px">540px</option>
                <option value="520px">520px</option>
                <option value="500px">500px</option>
                <option value="480px">480px</option>
                <option value="460px">460px</option>
            	<option value="440px">440px</option>
            	<option value="420px">420px</option>
                <option value="400px">400px</option>
                <option value="380px">380px</option>
                <option value="360px">360px</option>
                <option value="340px">340px</option>
            	<option value="320px">320px</option>
                <option value="300px">300px</option>
                <option value="280px">280px</option>
                <option value="260px">260px</option>
                <option value="240px">240px</option>
                <option value="220px">220px</option>
                <option value="200px">200px</option>
                <option value="180px">180px</option>
                <option value="160px">160px</option>
                <option value="140px">140px</option>
                <option value="120px">120px</option>
                <option value="110px">110px</option>
                <option value="100px">100px</option>
                <option value="90px">90px</option>
                <option value="80px">80px</option>
                <option value="70px" selected="selected">70px</option>
            </select>
        </td>
      </tr>
      
      
      <tr>
        <td class="formLeft">Image height</td>
        <td>
        	<select name="imgheight">
            	<option value="">not fixed</option>
                <option value="680px">680px</option>
                <option value="660px">660px</option>
                <option value="650px">650px</option>
                <option value="640px">640px</option>
                <option value="620px">620px</option>
            	<option value="600px">600px</option>
                <option value="580px">580px</option>
                <option value="560px">560px</option>
                <option value="540px">540px</option>
                <option value="520px">520px</option>
                <option value="500px">500px</option>
                <option value="480px">480px</option>
                <option value="460px">460px</option>
            	<option value="440px">440px</option>
            	<option value="420px">420px</option>
                <option value="400px">400px</option>
                <option value="380px">380px</option>
                <option value="360px">360px</option>
                <option value="340px">340px</option>
            	<option value="320px">320px</option>
                <option value="300px">300px</option>
                <option value="280px">280px</option>
                <option value="260px">260px</option>
                <option value="240px">240px</option>
                <option value="220px">220px</option>
                <option value="200px">200px</option>
                <option value="180px">180px</option>
                <option value="160px">160px</option>
                <option value="140px">140px</option>
                <option value="120px">120px</option>
                <option value="110px">110px</option>
                <option value="100px">100px</option>
                <option value="90px">90px</option>
                <option value="80px">80px</option>
                <option value="70px" selected="selected">70px</option>
                <option value="60px">60px</option>
                <option value="50px">50px</option>
                <option value="40px">40px</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Publish date']; ?></td>
        <td>
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." " .$Options["time_offset"])); ?>" readonly="readonly" /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a>
        </td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Create_News_Allow_comments_posting']; ?></td>
      	<td><input name="news_comments" type="checkbox" value="true"<?php if ($Options["commentsoff"]!='yes') echo ' checked="checked"'; ?> /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="<?php echo $lang['Create_News_button']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>

<?php 
} elseif ($_REQUEST["act"]=='editNews') {
	
	$_REQUEST["id"]= (int) mysql_real_escape_string($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$News = mysql_fetch_assoc($sql_result);
	mysql_free_result($sql_result);
	
	$sqlC   = "SELECT count(*) FROM ".$TABLE["Comments"]." WHERE news_id='".$News["id"]."'";
	$sql_resultC = mysql_query ($sqlC, $conn ) or die ('MySQL query error: '.$sqlC.'. Error: '.mysql_error());
	$count = mysql_fetch_array($sql_resultC);
	mysql_free_result($sql_result);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="updateNews" />
  	<input type="hidden" name="id" value="<?php echo $News["id"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['edit_News_To_edit_news']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['edit_News']; ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['edit_News_Status']; ?></td>
      	<td>
        <select name="status">
          <option value="Published"<?php if ($News["status"]=='Published') echo ' selected="selected"'; ?>><?php echo $lang['edit_News_Published']; ?></option>
          <option value="Hidden"<?php if ($News["status"]=='Hidden') echo ' selected="selected"'; ?>><?php echo $lang['edit_News_Hidden']; ?></option>
        </select>
      	</td>
      </tr>
      <tr>
      	<td><?php echo $lang['edit_News_Category']; ?> </td>
      	<td>
        	<select name="cat_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
            if (mysql_num_rows($sql_result)>0) {
              while ($Cat = mysql_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Cat["id"]; ?>"<?php if($Cat["id"]==$News["cat_id"]) echo ' selected="selected"'; ?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>     
      <tr>
      	<td><?php echo $lang['edit_News_Editor']; ?> </td>
      	<td>
        	<select name="editor_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Editors"]." ORDER BY editor_name ASC";
            $sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
            if (mysql_num_rows($sql_result)>0) {
              while ($Editor = mysql_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Editor["id"]; ?>"<?php if($Editor["id"]==$News["editor_id"]) echo ' selected="selected"'; ?>><?php echo ReadDB($Editor["editor_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>    
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Top_and_Slider_News']; ?></td>
        <td>
        	<div style="float:left"><input name="topnews" type="checkbox" value="true"<?php if($News["topnews"]=='true') echo ' checked="checked"'; ?> /> <?php echo $lang['edit_News_check_top_news_section']; ?></div>
			<div style="float:left;padding-left:60px;"><input name="slider" type="checkbox" value="yes"<?php if($News["slider"]=='yes') echo ' checked="checked"'; ?> /> <?php echo $lang['edit_News_check_slider_news']; ?></div>
		</td>
      </tr>   
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Highlight_News']; ?></td>
        <td>
        	<input name="highlight" type="checkbox" value="true"<?php if($News["highlight"]=='true') echo ' checked="checked"'; ?> /> <?php echo $lang['edit_News_check_to_be_highlighted']; ?>
        </td>
      </tr>  
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Title']; ?></td>
        <td><input type="text" name="title" size="100" maxlength="250" value="<?php echo ReadHTML($News["title"]); ?>" /></td>
      </tr>
      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['edit_News_Summary']; ?></td>
        <td><textarea name="summary" cols="80" rows="4"><?php echo ReadDB($News["summary"]); ?></textarea></td>
      </tr>
      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['edit_News_Content']; ?></td>
        <td>
        	<textarea name="content" id="content" class="content" cols="85" rows="20"><?php echo ReadDB($News["content"]); ?></textarea>
            <?php 
			$full_url = 'http';
			if ($_SERVER["HTTPS"] == "on") {$full_url .= "s";}
			$full_url .= "://";
			$full_url .= $_SERVER["SERVER_NAME"].$CONFIG["folder_name"];
			?>
                
            <script type="text/javascript">
				CKEDITOR.replace( 'content',
                {	
                    filebrowserBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
					filebrowserUploadUrl  :'<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=File',
					filebrowserImageUploadUrl : '<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=Image',
					filebrowserFlashUploadUrl : '<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
					
					height: 400, width: 800

				});
			</script> 
            <div style="font-size:11px;font-style:italic;"><?php echo $lang['edit_News_For_best_performance']; ?></div>     
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Photo']; ?></td>
        <td>
        <?php if(stripslashes($News["image"]) != "") { ?>
			<img src="<?php echo $CONFIG["upload_folder"].ReadDB($News["image"]); ?>" border="0" width="160" /> 			&nbsp;&nbsp;<a href="<?php $_SERVER["PHP_SELF"]; ?>?act=delImage&id=<?php echo $News["id"]; ?>"><?php echo $lang['edit_News_delete']; ?></a><br /> 
            <?php echo $lang['edit_News_If_you_upload']; ?> <br />
            <?php } ?>
          	<input type="file" name="image" size="70" /> <sub><?php echo $lang['edit_News_Limit_2Mb']; ?></sub>
        </td>
      </tr> 
      
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Image_location_in_the_text']; ?></td>
        <td>
        	<select name="imgpos">
            	<option value="left"<?php if($News["imgpos"]=='left') echo ' selected="selected"' ?>>left</option>
                <option value="right"<?php if($News["imgpos"]=='right') echo ' selected="selected"' ?>>right</option>
                <option value="top"<?php if($News["imgpos"]=='top') echo ' selected="selected"' ?>>top</option>
                <option value="bottom"<?php if($News["imgpos"]=='bottom') echo ' selected="selected"' ?>>bottom</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Image_width']; ?></td>
        <td>
        	<select name="imgwidth">
            	<option value="700px"<?php if($News["imgwidth"]=='700px') echo ' selected="selected"' ?>>700px</option>
                <option value="680px"<?php if($News["imgwidth"]=='680px') echo ' selected="selected"' ?>>680px</option>
                <option value="660px"<?php if($News["imgwidth"]=='660px') echo ' selected="selected"' ?>>660px</option>
                <option value="650px"<?php if($News["imgwidth"]=='650px') echo ' selected="selected"' ?>>650px</option>
                <option value="640px"<?php if($News["imgwidth"]=='640px') echo ' selected="selected"' ?>>640px</option>
                <option value="620px"<?php if($News["imgwidth"]=='620px') echo ' selected="selected"' ?>>620px</option>
            	<option value="600px"<?php if($News["imgwidth"]=='600px') echo ' selected="selected"' ?>>600px</option>
                <option value="580px"<?php if($News["imgwidth"]=='580px') echo ' selected="selected"' ?>>580px</option>
                <option value="560px"<?php if($News["imgwidth"]=='560px') echo ' selected="selected"' ?>>560px</option>
                <option value="540px"<?php if($News["imgwidth"]=='540px') echo ' selected="selected"' ?>>540px</option>
                <option value="520px"<?php if($News["imgwidth"]=='520px') echo ' selected="selected"' ?>>520px</option>
                <option value="500px"<?php if($News["imgwidth"]=='500px') echo ' selected="selected"' ?>>500px</option>
                <option value="480px"<?php if($News["imgwidth"]=='480px') echo ' selected="selected"' ?>>480px</option>
            	<option value="480px"<?php if($News["imgwidth"]=='480px') echo ' selected="selected"' ?>>480px</option>
                <option value="460px"<?php if($News["imgwidth"]=='460px') echo ' selected="selected"' ?>>460px</option>
                <option value="440px"<?php if($News["imgwidth"]=='440px') echo ' selected="selected"' ?>>440px</option>
                <option value="420px"<?php if($News["imgwidth"]=='420px') echo ' selected="selected"' ?>>420px</option>
                <option value="400px"<?php if($News["imgwidth"]=='400px') echo ' selected="selected"' ?>>400px</option>
                <option value="380px"<?php if($News["imgwidth"]=='380px') echo ' selected="selected"' ?>>380px</option>
                <option value="360px"<?php if($News["imgwidth"]=='360px') echo ' selected="selected"' ?>>360px</option>
                <option value="340px"<?php if($News["imgwidth"]=='340px') echo ' selected="selected"' ?>>340px</option>
                <option value="320px"<?php if($News["imgwidth"]=='320px') echo ' selected="selected"' ?>>320px</option>
                <option value="300px"<?php if($News["imgwidth"]=='300px') echo ' selected="selected"' ?>>300px</option>
                <option value="280px"<?php if($News["imgwidth"]=='280px') echo ' selected="selected"' ?>>280px</option>
                <option value="260px"<?php if($News["imgwidth"]=='260px') echo ' selected="selected"' ?>>260px</option>
                <option value="240px"<?php if($News["imgwidth"]=='240px') echo ' selected="selected"' ?>>240px</option>
                <option value="220px"<?php if($News["imgwidth"]=='220px') echo ' selected="selected"' ?>>220px</option>
                <option value="200px"<?php if($News["imgwidth"]=='200px') echo ' selected="selected"' ?>>200px</option>
                <option value="180px"<?php if($News["imgwidth"]=='180px') echo ' selected="selected"' ?>>180px</option>
                <option value="160px"<?php if($News["imgwidth"]=='160px') echo ' selected="selected"' ?>>160px</option>
                <option value="140px"<?php if($News["imgwidth"]=='140px') echo ' selected="selected"' ?>>140px</option>
                <option value="120px"<?php if($News["imgwidth"]=='120px') echo ' selected="selected"' ?>>120px</option>
                <option value="110px"<?php if($News["imgwidth"]=='110px') echo ' selected="selected"' ?>>110px</option>
                <option value="100px"<?php if($News["imgwidth"]=='100px') echo ' selected="selected"' ?>>100px</option>
                <option value="90px"<?php if($News["imgwidth"]=='90px') echo ' selected="selected"' ?>>90px</option>
                <option value="80px"<?php if($News["imgwidth"]=='80px') echo ' selected="selected"' ?>>80px</option>
                <option value="70px"<?php if($News["imgwidth"]=='70px') echo ' selected="selected"' ?>>70px</option>
            </select>
        </td>
      </tr>
      
      
      <tr>
        <td class="formLeft">Image Height</td>
        <td>
        	<select name="imgheight">
            	<option value="">not fixed</option>
                <option value="680px"<?php if($News["imgheight"]=='680px') echo ' selected="selected"' ?>>680px</option>
                <option value="660px"<?php if($News["imgheight"]=='660px') echo ' selected="selected"' ?>>660px</option>
                <option value="650px"<?php if($News["imgheight"]=='650px') echo ' selected="selected"' ?>>650px</option>
                <option value="640px"<?php if($News["imgheight"]=='640px') echo ' selected="selected"' ?>>640px</option>
                <option value="620px"<?php if($News["imgheight"]=='620px') echo ' selected="selected"' ?>>620px</option>
            	<option value="600px"<?php if($News["imgheight"]=='600px') echo ' selected="selected"' ?>>600px</option>
                <option value="580px"<?php if($News["imgheight"]=='580px') echo ' selected="selected"' ?>>580px</option>
                <option value="560px"<?php if($News["imgheight"]=='560px') echo ' selected="selected"' ?>>560px</option>
                <option value="540px"<?php if($News["imgheight"]=='540px') echo ' selected="selected"' ?>>540px</option>
                <option value="520px"<?php if($News["imgheight"]=='520px') echo ' selected="selected"' ?>>520px</option>
                <option value="500px"<?php if($News["imgheight"]=='500px') echo ' selected="selected"' ?>>500px</option>
                <option value="480px"<?php if($News["imgheight"]=='480px') echo ' selected="selected"' ?>>480px</option>
            	<option value="480px"<?php if($News["imgheight"]=='480px') echo ' selected="selected"' ?>>480px</option>
                <option value="460px"<?php if($News["imgheight"]=='460px') echo ' selected="selected"' ?>>460px</option>
                <option value="440px"<?php if($News["imgheight"]=='440px') echo ' selected="selected"' ?>>440px</option>
                <option value="420px"<?php if($News["imgheight"]=='420px') echo ' selected="selected"' ?>>420px</option>
                <option value="400px"<?php if($News["imgheight"]=='400px') echo ' selected="selected"' ?>>400px</option>
                <option value="380px"<?php if($News["imgheight"]=='380px') echo ' selected="selected"' ?>>380px</option>
                <option value="360px"<?php if($News["imgheight"]=='360px') echo ' selected="selected"' ?>>360px</option>
                <option value="340px"<?php if($News["imgheight"]=='340px') echo ' selected="selected"' ?>>340px</option>
                <option value="320px"<?php if($News["imgheight"]=='320px') echo ' selected="selected"' ?>>320px</option>
                <option value="300px"<?php if($News["imgheight"]=='300px') echo ' selected="selected"' ?>>300px</option>
                <option value="280px"<?php if($News["imgheight"]=='280px') echo ' selected="selected"' ?>>280px</option>
                <option value="260px"<?php if($News["imgheight"]=='260px') echo ' selected="selected"' ?>>260px</option>
                <option value="240px"<?php if($News["imgheight"]=='240px') echo ' selected="selected"' ?>>240px</option>
                <option value="220px"<?php if($News["imgheight"]=='220px') echo ' selected="selected"' ?>>220px</option>
                <option value="200px"<?php if($News["imgheight"]=='200px') echo ' selected="selected"' ?>>200px</option>
                <option value="180px"<?php if($News["imgheight"]=='180px') echo ' selected="selected"' ?>>180px</option>
                <option value="160px"<?php if($News["imgheight"]=='160px') echo ' selected="selected"' ?>>160px</option>
                <option value="140px"<?php if($News["imgheight"]=='140px') echo ' selected="selected"' ?>>140px</option>
                <option value="120px"<?php if($News["imgheight"]=='120px') echo ' selected="selected"' ?>>120px</option>
                <option value="110px"<?php if($News["imgheight"]=='110px') echo ' selected="selected"' ?>>110px</option>
                <option value="100px"<?php if($News["imgheight"]=='100px') echo ' selected="selected"' ?>>100px</option>
                <option value="90px"<?php if($News["imgheight"]=='90px') echo ' selected="selected"' ?>>90px</option>
                <option value="80px"<?php if($News["imgheight"]=='80px') echo ' selected="selected"' ?>>80px</option>
                <option value="70px"<?php if($News["imgheight"]=='70px') echo ' selected="selected"' ?>>70px</option>
                <option value="60px"<?php if($News["imgheight"]=='60px') echo ' selected="selected"' ?>>60px</option>
                <option value="50px"<?php if($News["imgheight"]=='50px') echo ' selected="selected"' ?>>50px</option>
                <option value="40px"<?php if($News["imgheight"]=='40px') echo ' selected="selected"' ?>>40px</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['edit_News_Publish_date']; ?></td>
        <td>
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo $News["publish_date"]; ?>" readonly="readonly" /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" ></a>
        </td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['edit_News_Allow_comments_posting']; ?></td>
      	<td><input name="news_comments" type="checkbox" value="true"<?php if($News["news_comments"]=='true') echo ' checked="checked"'; ?> /></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['edit_News_Comments']; ?></td>
      	<td><?php echo $count["count(*)"]; ?> (<a href="admin.php?act=comments&news_id=<?php echo $News["id"]; ?>"><?php echo $lang['edit_News_view']; ?></a>)</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>
        	<input name="submit" type="submit" value="<?php echo $lang['edit_News_Update_News']; ?>" class="submitButton" /> &nbsp; &nbsp; &nbsp; &nbsp; 
        	<input name="updatepreview" type="submit" value="<?php echo $lang['edit_News_Update_and_Preview']; ?>" class="submitButton" />
        </td>
      </tr>
  	</table>
	</form>
    
    
<?php 
} elseif ($_REQUEST["act"]=='viewNews') {
	
	$_REQUEST["id"]= (int) mysql_real_escape_string($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	mysql_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	$OptionsLang = unserialize($Options['language']);
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$News = mysql_fetch_assoc($sql_result);
	mysql_free_result($sql_result);
?>
	<div style="clear:both;padding-left:40px;padding-top:10px;padding-bottom:10px;"><a href="admin.php?act=editNews&id=<?php echo ReadDB($News['id']); ?>"><?php echo $lang['Preview_News_Edit_Article']; ?></a></div>
    
	<div style="font-family:<?php echo $OptionsVis["gen_font_family"];?>; font-size:<?php echo $OptionsVis["gen_font_size"];?>;margin:0 auto;width:<?php echo $OptionsVis["gen_width"];?>px; color:<?php echo $OptionsVis["gen_font_color"];?>;line-height:<?php echo $OptionsVis["gen_line_height"];?>;">
    
    
	<?php if($OptionsLang["Back_to_home"]!='') { ?>
    <div style="text-align:<?php echo $OptionsVis["link_align"]; ?>">
    	<a href="admin.php?act=news" style='font-weight:<?php echo $OptionsVis["link_font_weight"]; ?>;color:<?php echo $OptionsVis["link_color"]; ?>;font-size:<?php echo $OptionsVis["link_font_size"]; ?>;text-decoration:underline'><?php echo $OptionsLang["Back_to_home"]; ?></a>
    </div>    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_link_title"];?>;"></div>    
    <?php } ?>
    
	<div style="color:<?php echo $OptionsVis["title_color"];?>;font-family:<?php echo $OptionsVis["title_font"];?>;font-size:<?php echo $OptionsVis["title_size"];?>;font-weight:<?php echo $OptionsVis["title_font_weight"];?>;font-style:<?php echo $OptionsVis["title_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;">	  
            <?php echo ReadDB($News["title"]); ?>     
    </div>
    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_title_date"];?>;"></div>
    
    <?php if($OptionsVis["show_date"]=='yes') { ?>
    <div style="color:<?php echo $OptionsVis["date_color"];?>; font-family:<?php echo $OptionsVis["date_font"];?>; font-size:<?php echo $OptionsVis["date_size"];?>;font-style: <?php echo $OptionsVis["date_font_style"];?>;text-align:<?php echo $OptionsVis["date_text_align"];?>;"><?php echo date($OptionsVis["date_format"],strtotime($News["publish_date"])); ?> <?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($News["publish_date"])); ?></div>
    <?php } ?>
    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_date_text"];?>;"></div>
    
    <div style="color:<?php echo $OptionsVis["cont_color"];?>; font-family:<?php echo $OptionsVis["cont_font"];?>;font-size:<?php echo $OptionsVis["cont_size"];?>;font-style:<?php echo $OptionsVis["cont_font_style"];?>;text-align:<?php echo $OptionsVis["cont_text_align"];?>;line-height:<?php echo $OptionsVis["cont_line_height"];?>;">
      <?php if(ReadDB($News["image"])!='') { ?>
		<?php if(ReadDB($News["imgpos"])=='left') { ?><div style="float:left"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-right:14px; padding-bottom:6px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
        <?php if(ReadDB($News["imgpos"])=='right') { ?><div style="float:right"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-left:14px; padding-bottom:6px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
        <?php if(ReadDB($News["imgpos"])=='top') { ?><div style="clear:both; text-align:center"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
      <?php } ?>
        <?php echo ReadDB($News["content"]); ?> 
      <?php if(ReadDB($News["image"])!='') { ?>
        <?php if(ReadDB($News["imgpos"])=='bottom') { ?><div style="clear:both; text-align:center"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:10px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
      <?php } ?>
    </div>
    
    <div style="clear:both; height: 12px;"></div>
    </div>
    
    
<?php 
} elseif ($_REQUEST["act"]=='archive') {
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) mysql_real_escape_string(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("title", "publish_date", "status", "editor_id", "reviews");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "publish_date";
	}	
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "DESC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
	
	$sqlPublished   = "SELECT id FROM ".$TABLE["Archives"]." WHERE status='Published'";
	$sql_resultPublished = mysql_query ($sqlPublished, $conn ) or die ('MySQL query error: '.$sqlPublished.'. Error: '.mysql_error());
	$NewsPublished = mysql_num_rows($sql_resultPublished);
	
	$sqlCount   = "SELECT id FROM ".$TABLE["Archives"];
	$sql_resultCount = mysql_query ($sqlCount, $conn ) or die ('MySQL query error: '.$sqlCount.'. Error: '.mysql_error());
	$NewsCount = mysql_num_rows($sql_resultCount);
?>
	<div class="pageDescr"><?php echo $lang['arch_News_list_archived']; ?> <strong style="font-size:16px"><?php echo $NewsPublished; ?></strong>  <?php echo $lang['arch_News_Total_number']; ?> <strong style="font-size:16px"><?php echo $NewsCount; ?></strong>.</div>
    
    <div class="searchForm">
    <form action="admin.php?act=archive" method="post" name="form" class="formStyle">
      <input type="text" name="search" onfocus="searchdescr(this.value);" value="<?php if(isset($_REQUEST["search"])) echo $_REQUEST["search"]; else echo 'enter part of news title'; ?>" class="searchfield" />
      <input type="submit" value="<?php echo $lang['arch_News_Search_for_news']; ?>" class="submitButton" />
    </form>
    </div>
    
    <form action="admin.php" method="post" name="form1" class="formStyle">
    <input type="hidden" name="act" value="toNews" />
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td class="headlist"><a href="admin.php?act=archive&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=title"><?php echo $lang['arch_News_Title']; ?></a></td>
        <td width="13%" class="headlist"><a href="admin.php?act=archive&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['arch_News_Date_published']; ?></a></td>
        <td width="8%" class="headlist"><a href="admin.php?act=archive&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['arch_News_Status']; ?></a></td>
        <td width="8%" class="headlist"><a href="admin.php?act=archive&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=editor_id"><?php echo $lang['arch_News_Editor']; ?></a></td>
        <td width="8%" class="headlist"><?php echo $lang['arch_News_Comments']; ?></td>
        <td width="7%" class="headlist"><a href="admin.php?act=archive&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=reviews"><?php echo $lang['arch_News_Views']; ?></a></td>
        <td width="7%" class="headlist"><?php echo $lang['arch_News_To_News']; ?></td>
        <td class="headlist" colspan="3">&nbsp;</td>
  	  </tr>
      
  	<?php 
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
	  $findMe = mysql_escape_string($_REQUEST["search"]);
	  $search = "WHERE title LIKE '%".$findMe."%'";
	} else {
	  $search = '';
	}

	$sql   = "SELECT count(*) as total FROM ".$TABLE["Archives"]." ".$search;
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$row   = mysql_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/20);

	$sql = "SELECT * FROM ".$TABLE["Archives"]." ".$search." 
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*20 . ",20";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	if (mysql_num_rows($sql_result)>0) {
		$i=1;	
		while ($News = mysql_fetch_assoc($sql_result)) {	
			$sqlC   = "SELECT count(*) as total FROM ".$TABLE["Comments"]." WHERE archive_id='".$News["id"]."'";
			$sql_resultC = mysql_query ($sqlC, $conn ) or die ('MySQL query error: '.$sqlC.'. Error: '.mysql_error());
			$countComm = mysql_fetch_array($sql_resultC);		
	?>
  	  <tr>
        <td class="bodylist"><?php echo ReadDB($News["title"]); ?></td>
        <td class="bodylist"><?php echo admin_date($News["publish_date"]); ?></td>
        <td class="bodylist"><?php echo ReadDB($News["status"]); ?></td>
        <td class="bodylist">
        	<?php 
			$sqlEd = "SELECT * FROM ".$TABLE["Editors"]." WHERE id='".$News["editor_id"]."'";
			$sql_resultEd = mysql_query ($sqlEd, $conn ) or die ('MySQL query error: '.$sqlEd.'. Error: '.mysql_error());
			$Editor = mysql_fetch_assoc($sql_resultEd);	
			if($Editor["id"]>0) echo ReadDB($Editor["editor_name"]); else echo "------"; ?>
        </td>
        <td class="bodylist"><a style="text-decoration:none" href="admin.php?act=comments&archive_id=<?php echo $News["id"]; ?>"><?php echo $countComm["total"]; ?></a> <?php if($News["news_comments"]=='false') echo "<sub>(not allowed)</sub>"; ?></td>
        <td class="bodylist"><?php if($News["reviews"]=='') echo "0"; else echo $News["reviews"]; ?></td>
        <td class="bodylist"><input name="tonews[]" type="checkbox" value="<?php echo $News["id"]; ?>" /></td>
        <td class="bodylistAct"><a class="view" href='admin.php?act=viewArchive&id=<?php echo $News["id"]; ?>'><?php echo $lang['arch_News_Preview']; ?></a></td>
        <td class="bodylistAct"><a href='admin.php?act=editArchive&id=<?php echo $News["id"]; ?>'><?php echo $lang['arch_News_Edit']; ?></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delArchive&id=<?php echo $News["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');"><?php echo $lang['arch_News_DELETE']; ?></a></td>
  	  </tr>
  	<?php 
			$i++;
		}
	} else {
	?>
      <tr>
      	<td colspan="11" style="border-bottom:1px solid #CCCCCC"><?php echo $lang['arch_News_No_News'] ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>0) {
    ?>
  	  <tr>
      	<td colspan="6" class="bottomlist"><div class='paging'><?php echo $lang['arch_News_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=archive&p=".$i."&search=".$_REQUEST["search"]."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
        <td colspan="4" class="bottomlist">
        	<div style="text-align:left;"><input name="submit" type="submit" value="<?php echo $lang['arch_News_To_News'] ?>" /></div>
        </td>
      </tr>
	<?php
    }
    ?>
	</table>
    </form>
    
    
<?php 
} elseif ($_REQUEST["act"]=='editArchive') {
	$sql = "SELECT * FROM ".$TABLE["Archives"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$News = mysql_fetch_assoc($sql_result);
	
	$sqlC   = "SELECT count(*) FROM ".$TABLE["Comments"]." WHERE archive_id='".$News["id"]."'";
	$sql_resultC = mysql_query ($sqlC, $conn ) or die ('MySQL query error: '.$sqlC.'. Error: '.mysql_error());
	$count = mysql_fetch_array($sql_resultC);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="updateArchive" />
  	<input type="hidden" name="id" value="<?php echo $News["id"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['Edit_Arch_To_edit_news_change']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Edit_Arch_Edit_Archived_News']; ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Edit_Arch_Status']; ?></td>
      	<td>
        <select name="status">
          <option value="Published"<?php if ($News["status"]=='Published') echo ' selected="selected"'; ?>><?php echo $lang['Edit_Arch_Published']; ?></option>
          <option value="Hidden"<?php if ($News["status"]=='Hidden') echo ' selected="selected"'; ?>><?php echo $lang['Edit_Arch_Hidden']; ?></option>
        </select>
      	</td>
      </tr>
      <tr>
      	<td><?php echo $lang['Edit_Arch_Editor']; ?> </td>
      	<td>
        	<select name="editor_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Editors"]." ORDER BY editor_name ASC";
            $sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
            if (mysql_num_rows($sql_result)>0) {
              while ($Editor = mysql_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Editor["id"]; ?>"<?php if($Editor["id"]==$News["editor_id"]) echo ' selected="selected"'; ?>><?php echo ReadDB($Editor["editor_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>     
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Arch_Title']; ?></td>
        <td><input type="text" name="title" size="100" maxlength="250" value="<?php echo ReadHTML($News["title"]); ?>" /></td>
      </tr>
      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Edit_Arch_Summary']; ?></td>
        <td><textarea name="summary" cols="80" rows="4"><?php echo ReadDB($News["summary"]); ?></textarea></td>
      </tr>
      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Edit_Arch_Content']; ?></td>
        <td>
        	<textarea name="content" id="content" class="content" cols="85" rows="20"><?php echo ReadDB($News["content"]); ?></textarea>
            <?php 
			$full_url = 'http';
			if ($_SERVER["HTTPS"] == "on") {$full_url .= "s";}
			$full_url .= "://";
			$full_url .= $_SERVER["SERVER_NAME"].$CONFIG["folder_name"];
			?>
                
            <script type="text/javascript">
				CKEDITOR.replace( 'content',
                {	
                    filebrowserBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl : 'ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/connector.php',
					filebrowserUploadUrl  :'<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=File',
					filebrowserImageUploadUrl : '<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=Image',
					filebrowserFlashUploadUrl : '<?php echo $full_url; ?>ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
					
					height: 400, width: 800

				});
			</script>   
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Arch_Image']; ?></td>
        <td>
        <?php if(stripslashes($News["image"]) != "") { ?>
			<img src="<?php echo $CONFIG["upload_folder"].ReadDB($News["image"]); ?>" border="0" width="160" /> 			&nbsp;&nbsp;<a href="<?php $_SERVER["PHP_SELF"]; ?>?act=delArchImage&id=<?php echo $News["id"]; ?>"><?php echo $lang['Edit_Arch_delete']; ?></a><br /> 
            <?php echo $lang['Edit_Arch_If_you_upload']; ?> <br />
            <?php } ?>
          	<input type="file" name="image" size="70" /> <sub><?php echo $lang['Edit_Arch_Limit_Mb']; ?></sub>
        </td>
      </tr> 
      
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Arch_Image_location_in_the_text']; ?></td>
        <td>
        	<select name="imgpos">
            	<option value="left"<?php if($News["imgpos"]=='left') echo ' selected="selected"' ?>>left</option>
                <option value="right"<?php if($News["imgpos"]=='right') echo ' selected="selected"' ?>>right</option>
                <option value="top"<?php if($News["imgpos"]=='top') echo ' selected="selected"' ?>>top</option>
                <option value="bottom"<?php if($News["imgpos"]=='bottom') echo ' selected="selected"' ?>>bottom</option>
            </select>
        </td>
      </tr>
      
      
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Arch_Image_width']; ?></td>
        <td>
        	<select name="imgwidth">
            	<option value="700px"<?php if($News["imgwidth"]=='700px') echo ' selected="selected"' ?>>700px</option>
                <option value="680px"<?php if($News["imgwidth"]=='680px') echo ' selected="selected"' ?>>680px</option>
                <option value="660px"<?php if($News["imgwidth"]=='660px') echo ' selected="selected"' ?>>660px</option>
                <option value="650px"<?php if($News["imgwidth"]=='650px') echo ' selected="selected"' ?>>650px</option>
                <option value="640px"<?php if($News["imgwidth"]=='640px') echo ' selected="selected"' ?>>640px</option>
                <option value="620px"<?php if($News["imgwidth"]=='620px') echo ' selected="selected"' ?>>620px</option>
            	<option value="600px"<?php if($News["imgwidth"]=='600px') echo ' selected="selected"' ?>>600px</option>
                <option value="580px"<?php if($News["imgwidth"]=='580px') echo ' selected="selected"' ?>>580px</option>
                <option value="560px"<?php if($News["imgwidth"]=='560px') echo ' selected="selected"' ?>>560px</option>
                <option value="540px"<?php if($News["imgwidth"]=='540px') echo ' selected="selected"' ?>>540px</option>
                <option value="520px"<?php if($News["imgwidth"]=='520px') echo ' selected="selected"' ?>>520px</option>
                <option value="500px"<?php if($News["imgwidth"]=='500px') echo ' selected="selected"' ?>>500px</option>
                <option value="480px"<?php if($News["imgwidth"]=='480px') echo ' selected="selected"' ?>>480px</option>
            	<option value="480px"<?php if($News["imgwidth"]=='480px') echo ' selected="selected"' ?>>480px</option>
                <option value="460px"<?php if($News["imgwidth"]=='460px') echo ' selected="selected"' ?>>460px</option>
                <option value="440px"<?php if($News["imgwidth"]=='440px') echo ' selected="selected"' ?>>440px</option>
                <option value="420px"<?php if($News["imgwidth"]=='420px') echo ' selected="selected"' ?>>420px</option>
                <option value="400px"<?php if($News["imgwidth"]=='400px') echo ' selected="selected"' ?>>400px</option>
                <option value="380px"<?php if($News["imgwidth"]=='380px') echo ' selected="selected"' ?>>380px</option>
                <option value="360px"<?php if($News["imgwidth"]=='360px') echo ' selected="selected"' ?>>360px</option>
                <option value="340px"<?php if($News["imgwidth"]=='340px') echo ' selected="selected"' ?>>340px</option>
                <option value="320px"<?php if($News["imgwidth"]=='320px') echo ' selected="selected"' ?>>320px</option>
                <option value="300px"<?php if($News["imgwidth"]=='300px') echo ' selected="selected"' ?>>300px</option>
                <option value="280px"<?php if($News["imgwidth"]=='280px') echo ' selected="selected"' ?>>280px</option>
                <option value="260px"<?php if($News["imgwidth"]=='260px') echo ' selected="selected"' ?>>260px</option>
                <option value="240px"<?php if($News["imgwidth"]=='240px') echo ' selected="selected"' ?>>240px</option>
                <option value="220px"<?php if($News["imgwidth"]=='220px') echo ' selected="selected"' ?>>220px</option>
                <option value="200px"<?php if($News["imgwidth"]=='200px') echo ' selected="selected"' ?>>200px</option>
                <option value="180px"<?php if($News["imgwidth"]=='180px') echo ' selected="selected"' ?>>180px</option>
                <option value="160px"<?php if($News["imgwidth"]=='160px') echo ' selected="selected"' ?>>160px</option>
                <option value="140px"<?php if($News["imgwidth"]=='140px') echo ' selected="selected"' ?>>140px</option>
                <option value="120px"<?php if($News["imgwidth"]=='120px') echo ' selected="selected"' ?>>120px</option>
                <option value="110px"<?php if($News["imgwidth"]=='110px') echo ' selected="selected"' ?>>110px</option>
                <option value="100px"<?php if($News["imgwidth"]=='100px') echo ' selected="selected"' ?>>100px</option>
                <option value="90px"<?php if($News["imgwidth"]=='90px') echo ' selected="selected"' ?>>90px</option>
                <option value="80px"<?php if($News["imgwidth"]=='80px') echo ' selected="selected"' ?>>80px</option>z
                <option value="70px"<?php if($News["imgwidth"]=='70px') echo ' selected="selected"' ?>>70px</option>
            </select>
        </td>
      </tr>
      
      
      <tr>
        <td class="formLeft">Image Height</td>
        <td>
        	<select name="imgheight">
            	<option value="">not fixed</option>
                <option value="680px"<?php if($News["imgheight"]=='680px') echo ' selected="selected"' ?>>680px</option>
                <option value="660px"<?php if($News["imgheight"]=='660px') echo ' selected="selected"' ?>>660px</option>
                <option value="650px"<?php if($News["imgheight"]=='650px') echo ' selected="selected"' ?>>650px</option>
                <option value="640px"<?php if($News["imgheight"]=='640px') echo ' selected="selected"' ?>>640px</option>
                <option value="620px"<?php if($News["imgheight"]=='620px') echo ' selected="selected"' ?>>620px</option>
            	<option value="600px"<?php if($News["imgheight"]=='600px') echo ' selected="selected"' ?>>600px</option>
                <option value="580px"<?php if($News["imgheight"]=='580px') echo ' selected="selected"' ?>>580px</option>
                <option value="560px"<?php if($News["imgheight"]=='560px') echo ' selected="selected"' ?>>560px</option>
                <option value="540px"<?php if($News["imgheight"]=='540px') echo ' selected="selected"' ?>>540px</option>
                <option value="520px"<?php if($News["imgheight"]=='520px') echo ' selected="selected"' ?>>520px</option>
                <option value="500px"<?php if($News["imgheight"]=='500px') echo ' selected="selected"' ?>>500px</option>
                <option value="480px"<?php if($News["imgheight"]=='480px') echo ' selected="selected"' ?>>480px</option>
            	<option value="480px"<?php if($News["imgheight"]=='480px') echo ' selected="selected"' ?>>480px</option>
                <option value="460px"<?php if($News["imgheight"]=='460px') echo ' selected="selected"' ?>>460px</option>
                <option value="440px"<?php if($News["imgheight"]=='440px') echo ' selected="selected"' ?>>440px</option>
                <option value="420px"<?php if($News["imgheight"]=='420px') echo ' selected="selected"' ?>>420px</option>
                <option value="400px"<?php if($News["imgheight"]=='400px') echo ' selected="selected"' ?>>400px</option>
                <option value="380px"<?php if($News["imgheight"]=='380px') echo ' selected="selected"' ?>>380px</option>
                <option value="360px"<?php if($News["imgheight"]=='360px') echo ' selected="selected"' ?>>360px</option>
                <option value="340px"<?php if($News["imgheight"]=='340px') echo ' selected="selected"' ?>>340px</option>
                <option value="320px"<?php if($News["imgheight"]=='320px') echo ' selected="selected"' ?>>320px</option>
                <option value="300px"<?php if($News["imgheight"]=='300px') echo ' selected="selected"' ?>>300px</option>
                <option value="280px"<?php if($News["imgheight"]=='280px') echo ' selected="selected"' ?>>280px</option>
                <option value="260px"<?php if($News["imgheight"]=='260px') echo ' selected="selected"' ?>>260px</option>
                <option value="240px"<?php if($News["imgheight"]=='240px') echo ' selected="selected"' ?>>240px</option>
                <option value="220px"<?php if($News["imgheight"]=='220px') echo ' selected="selected"' ?>>220px</option>
                <option value="200px"<?php if($News["imgheight"]=='200px') echo ' selected="selected"' ?>>200px</option>
                <option value="180px"<?php if($News["imgheight"]=='180px') echo ' selected="selected"' ?>>180px</option>
                <option value="160px"<?php if($News["imgheight"]=='160px') echo ' selected="selected"' ?>>160px</option>
                <option value="140px"<?php if($News["imgheight"]=='140px') echo ' selected="selected"' ?>>140px</option>
                <option value="120px"<?php if($News["imgheight"]=='120px') echo ' selected="selected"' ?>>120px</option>
                <option value="110px"<?php if($News["imgheight"]=='110px') echo ' selected="selected"' ?>>110px</option>
                <option value="100px"<?php if($News["imgheight"]=='100px') echo ' selected="selected"' ?>>100px</option>
                <option value="90px"<?php if($News["imgheight"]=='90px') echo ' selected="selected"' ?>>90px</option>
                <option value="80px"<?php if($News["imgheight"]=='80px') echo ' selected="selected"' ?>>80px</option>
                <option value="70px"<?php if($News["imgheight"]=='70px') echo ' selected="selected"' ?>>70px</option>
                <option value="60px"<?php if($News["imgheight"]=='60px') echo ' selected="selected"' ?>>60px</option>
                <option value="50px"<?php if($News["imgheight"]=='50px') echo ' selected="selected"' ?>>50px</option>
                <option value="40px"<?php if($News["imgheight"]=='40px') echo ' selected="selected"' ?>>40px</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_Arch_Publish_date'] ?></td>
        <td>
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo $News["publish_date"]; ?>" readonly="readonly" /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" ></a>
        </td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Edit_Arch_Allow_comments_posting']; ?></td>
      	<td><input name="news_comments" type="checkbox" value="true"<?php if($News["news_comments"]=='true') echo ' checked="checked"'; ?> /></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Edit_Arch_Comments']; ?></td>
      	<td><?php echo $count["count(*)"]; ?> (<a href="admin.php?act=comments&archive_id=<?php echo $News["id"]; ?>">view</a>)</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>
        	<input name="submit" type="submit" value="<?php echo $lang['Edit_Arch_Update_Archived_News']; ?>" class="submitButton" /> &nbsp; &nbsp; &nbsp; &nbsp; 
        	<input name="updatepreview" type="submit" value="<?php echo $lang['Edit_Arch_Update_and_Preview']; ?>" class="submitButton" />
        </td>
      </tr>
  	</table>
	</form>
    
    
<?php 
} elseif ($_REQUEST["act"]=='viewArchive') {
	
	$_REQUEST["id"]= (int) mysql_real_escape_string($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	mysql_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	$OptionsLang = unserialize($Options['language']);
	
	$sql = "SELECT * FROM ".$TABLE["Archives"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$News = mysql_fetch_assoc($sql_result);
	mysql_free_result($sql_result);
?>
	<div style="clear:both;padding-left:40px;padding-top:10px;padding-bottom:10px;"><a href="admin.php?act=editArchive&id=<?php echo ReadDB($News['id']); ?>">Edit Article</a></div>
    
	<div style="font-family:<?php echo $OptionsVis["gen_font_family"];?>; font-size:<?php echo $OptionsVis["gen_font_size"];?>;margin:0 auto;width:<?php echo $OptionsVis["gen_width"];?>px; color:<?php echo $OptionsVis["gen_font_color"];?>;line-height:<?php echo $OptionsVis["gen_line_height"];?>;">
    
    
	<?php if($OptionsLang["Back_to_home"]!='') { ?>
    <div style="text-align:<?php echo $OptionsVis["link_align"]; ?>">
    	<a href="admin.php?act=archive" style='font-weight:<?php echo $OptionsVis["link_font_weight"]; ?>;color:<?php echo $OptionsVis["link_color"]; ?>;font-size:<?php echo $OptionsVis["link_font_size"]; ?>;text-decoration:underline'><?php echo $OptionsLang["Back_to_home"]; ?></a>
    </div>    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_link_title"];?>;"></div>    
    <?php } ?>
    
	<div style="color:<?php echo $OptionsVis["title_color"];?>;font-family:<?php echo $OptionsVis["title_font"];?>;font-size:<?php echo $OptionsVis["title_size"];?>;font-weight:<?php echo $OptionsVis["title_font_weight"];?>;font-style:<?php echo $OptionsVis["title_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;">	  
            <?php echo ReadDB($News["title"]); ?>     
    </div>
    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_title_date"];?>;"></div>
    
    <?php if($OptionsVis["show_date"]=='yes') { ?>
    <div style="color:<?php echo $OptionsVis["date_color"];?>; font-family:<?php echo $OptionsVis["date_font"];?>; font-size:<?php echo $OptionsVis["date_size"];?>;font-style: <?php echo $OptionsVis["date_font_style"];?>;text-align:<?php echo $OptionsVis["date_text_align"];?>;"><?php echo date($OptionsVis["date_format"],strtotime($News["publish_date"])); ?> <?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($News["publish_date"])); ?></div>
    <?php } ?>
    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_date_text"];?>;"></div>
    
    <div style="color:<?php echo $OptionsVis["cont_color"];?>; font-family:<?php echo $OptionsVis["cont_font"];?>;font-size:<?php echo $OptionsVis["cont_size"];?>;font-style:<?php echo $OptionsVis["cont_font_style"];?>;text-align:<?php echo $OptionsVis["cont_text_align"];?>;line-height:<?php echo $OptionsVis["cont_line_height"];?>;">
      <?php if(ReadDB($News["image"])!='') { ?>
		<?php if(ReadDB($News["imgpos"])=='left') { ?><div style="float:left"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-right:14px; padding-bottom:6px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
        <?php if(ReadDB($News["imgpos"])=='right') { ?><div style="float:right"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-left:14px; padding-bottom:6px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
        <?php if(ReadDB($News["imgpos"])=='top') { ?><div style="clear:both; text-align:center"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
      <?php } ?>
        <?php echo ReadDB($News["content"]); ?> 
      <?php if(ReadDB($News["image"])!='') { ?>
        <?php if(ReadDB($News["imgpos"])=='bottom') { ?><div style="clear:both; text-align:center"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:10px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
      <?php } ?>
    </div>
    
    <div style="clear:both; height: 12px;"></div>
    </div>



<?php 
} elseif ($_REQUEST["act"]=='cats') {
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) mysql_real_escape_string(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("cat_name");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "cat_name";
	}	
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "ASC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
?>
	<div class="pageDescr"><?php echo $lang['Category_Below_is_a_list']; ?></div>
        
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td width="33%" class="headlist"><a href="admin.php?act=cats&orderType=<?php echo $norderType; ?>&orderBy=cat_name"><?php echo $lang['Category_Category']; ?></a></td>
        <td width="33%" class="headlist"><?php echo $lang['Category_Put_this_category']; ?></td>
        <td class="headlist" colspan="2">&nbsp;</td>
  	  </tr>
      
  	<?php 
	$sql   = "SELECT count(*) as total FROM ".$TABLE["Categories"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$row   = mysql_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/20);

	$sql = "SELECT * FROM ".$TABLE["Categories"]."   
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*20 . ",20";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	if (mysql_num_rows($sql_result)>0) {	
		while ($Cat = mysql_fetch_assoc($sql_result)) {			
	?>
  	  <tr>
        <td class="bodylist"><?php echo ReadDB($Cat["cat_name"]); ?></td>
        <td class="bodylist"><a href='admin.php?act=HTML_Cat&id=<?php echo $Cat["id"]; ?>'><?php echo $lang['Category_Copy_the_code']; ?></a></td>
        <td class="bodylistAct"><a href='admin.php?act=editCat&id=<?php echo $Cat["id"]; ?>'><?php echo $lang['Category_Edit']; ?></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delCat&id=<?php echo $Cat["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');"><?php echo $lang['Category_DELETE']; ?></a></td>
  	  </tr>
  	<?php 
			$i++;
		}
	} else {
	?>
      <tr>
      	<td colspan="8" style="border-bottom:1px solid #CCCCCC"><?php echo $lang['Category_No_Categories']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>0) {
    ?>
  	  <tr>
      	<td colspan="8" class="bottomlist"><div class='paging'><?php echo $lang['Category_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=cats&p=".$i."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
      </tr>
	<?php
    }
    ?>
	</table>


<?php 
} elseif ($_REQUEST["act"]=='newCat') { 
?>
	<form action="admin.php" method="post" name="form">
  	<input type="hidden" name="act" value="addCat" />
  	<div class="pageDescr"><?php echo $lang['Category_To_create_Category']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Category_Create_Category']; ?></td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Category_Category_name']; ?></td>
        <td><input type="text" name="cat_name" size="40" maxlength="250" /></td>
      </tr>      
            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="<?php echo $lang['Category_Create_Category_but']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>
    
<?php 
} elseif ($_REQUEST["act"]=='editCat') {
	$sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Cat = mysql_fetch_assoc($sql_result);	
?>
	<form action="admin.php" method="post" name="form">
  	<input type="hidden" name="act" value="updateCat" />
  	<input type="hidden" name="id" value="<?php echo $Cat["id"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['Category_change_details']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Category_Edit_Category']; ?></td>
      </tr>
       
      <tr>
        <td class="formLeft"><?php echo $lang['Category_Category_name_edit']; ?></td>
        <td><input type="text" name="cat_name" size="40" maxlength="250" value="<?php echo ReadHTML($Cat["cat_name"]); ?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>
        	<input name="submit" type="submit" value="<?php echo $lang['Category_Update_Category']; ?>" class="submitButton" />
        </td>
      </tr>
  	</table>
	</form>


<?php 
} elseif ($_REQUEST["act"]=='HTML_Cat') { 
	$sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Cat = mysql_fetch_assoc($sql_result);	
?>
	
    <div style="clear:both; padding-top: 20px;">
    
    <div class="pageDescr">There is one easy way to put <strong>'<?php echo $Cat['cat_name']; ?>'</strong> category on your webpage.</div> 
        
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode"><strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the news to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php $_REQUEST['cat_id']=<?php echo $_REQUEST["id"]; ?>; $_REQUEST['hide_cat']='yes'; include(&quot;<?php echo $CONFIG["server_path"]; ?>news.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	At the top of the php page (first line) you should put this line of code too so captcha image verification can work on the comment form.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php session_start(); ?&gt;</div>     
        </td>
      </tr>
            
    </table>
    
    </div>



<?php 
} elseif ($_REQUEST["act"]=='comments') {
    if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) mysql_real_escape_string(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("publish_date", "name", "status");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "publish_date";
	}	
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "DESC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
?>
	<div class="pageDescr"><?php echo $lang['Comments_Below_are']; ?> </div>
    
    <div class="searchForm">
    <form action="admin.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>&archive_id=<?php echo $_REQUEST["archive_id"]; ?>" method="post" name="form" class="formStyle">
      <input type="text" name="search" onfocus="searchdescr1(this.value);" value="<?php if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') echo $_REQUEST["search"]; else echo 'enter poster Name or Email'; ?>" class="searchfield" />
      <input type="submit" value="<?php echo $lang['Comments_Search']; ?>" class="submitButton" />
    </form>
	</div>
    
	<?php
	if ($_REQUEST["news_id"]>0) {
	  $sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["news_id"]."'";
	  $sql_resultP = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	  $News = mysql_fetch_assoc($sql_resultP);
	?>
	<div class="pageDescr"><?php echo $lang['Comments_list_of_comments'] ?> <em>"<?php echo ReadDB($News["title"]); ?>"</em>. <a href="admin.php?act=comments"><?php echo $lang['Comments_click_here_to'] ?></a>.</div>
	<?php	
    } elseif($_REQUEST["archive_id"]>0) {
	  $sql = "SELECT * FROM ".$TABLE["Archives"]." WHERE id='".$_REQUEST["archive_id"]."'";
	  $sql_resultP = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	  $News = mysql_fetch_assoc($sql_resultP);
    ?>
    <div class="pageDescr"><?php echo $lang['Comments_comments_only']; ?> <em>"<?php echo ReadDB($News["title"]); ?>"</em>. <a href="admin.php?act=comments"><?php echo $lang['Comments_view_all']; ?></a>.</div>
    <?php	
    }
    ?>
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
      	<td width="20%" class="headlist"><a href="admin.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>&archive_id=<?php echo $_REQUEST["archive_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['Comments_Date_published']; ?></a></td>
      	<td width="18%" class="headlist"><a href="admin.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>&archive_id=<?php echo $_REQUEST["archive_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=name"><?php echo $lang['Comments_Name']; ?></a></td>
      	<td width="12%" class="headlist"><a href="admin.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>&archive_id=<?php echo $_REQUEST["archive_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['Comments_Status']; ?></a></td>
      	<td class="headlist"><?php echo $lang['Comments_Comment_on_article']; ?></td>
        <td width="14%" class="headlist"><?php echo $lang['Comments_IP_address']; ?></td>
      	<td colspan="2" class="headlist">&nbsp;</td>
      </tr>
      
    <?php 
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
		$find = mysql_escape_string($_REQUEST["search"]);
		$search = "WHERE (name LIKE '%".$find."%' OR email LIKE '%".$find."%')";
		if ($_REQUEST["news_id"]>0) {
			$search .= " AND news_id='".$_REQUEST["news_id"]."'";
		} elseif ($_REQUEST["archive_id"]>0) {
			$search .= "WHERE archive_id='".$_REQUEST["archive_id"]."'";
		}
	} else {
		if ($_REQUEST["news_id"]>0) {
			$search .= "WHERE news_id='".$_REQUEST["news_id"]."'";
		} elseif ($_REQUEST["archive_id"]>0) {
			$search .= "WHERE archive_id='".$_REQUEST["archive_id"]."'";
		} else {
			$search = '';
		}
	}
	
	$sql   = "SELECT count(*) as total FROM ".$TABLE["Comments"]." ".$search;
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$row   = mysql_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/30);

	$sql = "SELECT * FROM ".$TABLE["Comments"]." ".$search." 
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*30 . ",30";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	if (mysql_num_rows($sql_result)>0) {
		$i=1;
		while ($Comments = mysql_fetch_assoc($sql_result)) {
			$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$Comments["news_id"]."'";
			$sql_resultP = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
			if(mysql_num_rows($sql_resultP)>0) {
				$News = mysql_fetch_assoc($sql_resultP);
			} else {
				$sql = "SELECT * FROM ".$TABLE["Archives"]." WHERE id='".$Comments["archive_id"]."'";
				$sql_resultP = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
				if(mysql_num_rows($sql_resultP)>0) {
					$News = mysql_fetch_assoc($sql_resultP);
				}
			}
	?>
      <tr>
        <td class="bodylist"><?php echo admin_date($Comments["publish_date"]); ?></td>
        <td class="bodylist"><?php echo ReadHTML($Comments["name"]); ?></td>
        <td class="bodylist">
        	<form action="admin.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>&archive_id=<?php echo $_REQUEST["archive_id"]; ?>" method="post" name="form<?php echo $i; ?>" class="formStyle">
            <input type="hidden" name="act2" value="change_status_comm" />
            <input type="hidden" name="id" value="<?php echo $Comments["id"]; ?>" />
            <select name="status" onChange="document.form<?php echo $i; ?>.submit()">
				<option value="Approved" <?php if($Comments['status']=='Approved') echo "selected='selected'"; ?>><?php echo $lang['Comments_Approved']; ?></option>
				<option value="Not approved" <?php if($Comments['status']=='Not approved') echo "selected='selected'"; ?>><?php echo $lang['Comments_Not_approved']; ?></option>
            </select>
            </form>			
        </td>
        <td class="bodylist"><?php echo cutText(ReadDB($News["title"]),70); ?></td>
        <td class="bodylist"><?php echo ReadDB($Comments["ipaddress"]); ?> - <a class="view" href='admin.php?act=BanIP&ip_addr=<?php echo ReadDB($Comments["ipaddress"]); ?>' onclick="return confirm('Are you sure you want to ban IP - <?php echo ReadDB($Comments["ipaddress"]); ?> ?');"><?php echo $lang['Comments_Ban']; ?></a></td>
        <td class="bodylistAct"><a href='admin.php?act=editComment&id=<?php echo $Comments["id"]; ?>&search=<?php echo $_REQUEST["search"]; ?>&news_id=<?php echo $_REQUEST["news_id"]; ?>&archive_id=<?php echo $_REQUEST["archive_id"]; ?>'><?php echo $lang['Comments_Edit']; ?></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delComment&id=<?php echo $Comments["id"]; ?>&search=<?php echo $_REQUEST["search"]; ?>&news_id=<?php echo $_REQUEST["news_id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');"><?php echo $lang['Comments_DELETE']; ?></a></td>
      </tr>
    <?php 
			$i++;
		}
	} else {
	?>
      <tr>
      	<td colspan="7" style="border-bottom:1px solid #CCCCCC"><?php echo $lang['Comments_No_comments']; ?></td>
      </tr>
    <?php	
	}
	?>

	<?php
    if ($pages>0) {
    ?>
      <tr>
    	<td colspan="7" class="bottomlist"><div class='paging'><?php echo $lang['Comments_Page']; ?> </div> 
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=comments&p=".$i."&search=".$_REQUEST["search"]."&news_id=".$_REQUEST["news_id"]."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        } 
        ?>
		</td>
  	  </tr>
	<?php
    }
    ?>
  </table>

<?php 
} elseif ($_REQUEST["act"]=='editComment') {
	$sql = "SELECT * FROM ".$TABLE["Comments"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Comments = mysql_fetch_assoc($sql_result);
?>


    <form action="admin.php" method="post" style="margin:0px; padding:0px" name="form">
    <input type="hidden" name="act" value="updateComment" />
    <input type="hidden" name="id" value="<?php echo $Comments["id"]; ?>" />
    
    <div class="pageDescr"><a href="admin.php?act=comments&search=<?php echo $_REQUEST["search"]; ?>&news_id=<?php echo $_REQUEST["news_id"]; ?>&archive_id=<?php echo $_REQUEST["archive_id"]; ?>"><?php echo $lang['Edit_comment_back_to_comments']; ?></a></div>    

	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
  	  <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Edit_comment']; ?></td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_comment_Published_on']; ?></td>
        <td><?php echo admin_date($Comments["publish_date"]); ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Edit_comment_Status']; ?></td>
      	<td>
        <select name="status" id="status">
          <option value="Not approved"<?php if ($Comments["status"]=='Not approved') echo ' selected="selected"'; ?>><?php echo $lang['Edit_comment_Not_approved']; ?></option>
          <option value="Approved"<?php if ($Comments["status"]=='Approved') echo ' selected="selected"'; ?>><?php echo $lang['Edit_comment_Approved']; ?></option>
        </select>
      	</td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Edit_comment_Name']; ?></td>
        <td><input name="name" type="text" size="40" maxlength="250" value="<?php echo ReadHTML($Comments["name"]); ?>" /></td>
	  </tr>
  	  <tr>
        <td class="formLeft"><?php echo $lang['Edit_comment_Email']; ?></td>
        <td><input name="email" type="text" size="40" maxlength="250" value="<?php echo ReadHTML($Comments["email"]); ?>" /></td>
      </tr>
  	  <tr>
    	<td class="formLeft" valign="top"><?php echo $lang['Edit_comment_Comment']; ?></td>
    	<td><textarea name="comment" cols="80" rows="10"><?php echo ReadDB($Comments["comment"]); ?></textarea></td>
  	  </tr>
  	  <tr>
        <td class="formLeft" align="left">&nbsp;</td>
        <td>
          <input type="submit" name="button2" id="button2" value="<?php echo $lang['Edit_comment_Update']; ?>" class="submitButton" />
        </td>
  	  </tr>
    </table>
    </form>


<?php 
} elseif ($_REQUEST["act"]=='editors') {
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) mysql_real_escape_string(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("editor_name", "editor_email", "editor_username");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "editor_name";
	}	
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "ASC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
?>
	<div class="pageDescr"><?php echo $lang['Editors_Below_is_the_list']; ?></div>
        
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td width="15%" class="headlist"><a href="admin.php?act=editors&orderType=<?php echo $norderType; ?>&orderBy=editor_name"><?php echo $lang['Editors_name']; ?></a></td>
        <td width="16%" class="headlist"><a href="admin.php?act=editors&orderType=<?php echo $norderType; ?>&orderBy=editor_email"><?php echo $lang['Editors_email']; ?></a></td>
        <td width="14%" class="headlist"><a href="admin.php?act=editors&orderType=<?php echo $norderType; ?>&orderBy=editor_username"><?php echo $lang['Editors_Username']; ?></a></td>
        <td width="14%" class="headlist"><?php echo $lang['Editors_Password']; ?></td>
        <td class="headlist"><?php echo $lang['Editors_Put_only_this_author']; ?></td>
        <td class="headlist" colspan="2">&nbsp;</td>
  	  </tr>
      
  	<?php 
	$sql   = "SELECT count(*) as total FROM ".$TABLE["Editors"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$row   = mysql_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/20);

	$sql = "SELECT * FROM ".$TABLE["Editors"]."   
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*20 . ",20";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	if (mysql_num_rows($sql_result)>0) {	
		while ($Editor = mysql_fetch_assoc($sql_result)) {			
	?>
  	  <tr>
        <td class="bodylist"><?php echo ReadDB($Editor["editor_name"]); ?></td>
        <td class="bodylist"><?php echo ReadDB($Editor["editor_email"]); ?></td>
        <td class="bodylist"><?php echo ReadDB($Editor["editor_username"]); ?></td>
        <td class="bodylist"><?php echo ReadDB($Editor["editor_password"]); ?></td>
        <td class="bodylist"><a href='admin.php?act=HTML_Ed&id=<?php echo $Editor["id"]; ?>'><?php echo $lang['Editors_Copy_the_code'];?></a></td>
        <td class="bodylistAct"><a href='admin.php?act=editEditor&id=<?php echo $Editor["id"]; ?>'><?php echo $lang['Editors_Edit']; ?></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delEditor&id=<?php echo $Editor["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');"><?php echo $lang['Editors_DELETE']; ?></a></td>
  	  </tr>
  	<?php 
			$i++;
		}
	} else {
	?>
      <tr>
      	<td colspan="8" style="border-bottom:1px solid #CCCCCC"><?php echo $lang['Editors_No_Editors']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>0) {
    ?>
  	  <tr>
      	<td colspan="8" class="bottomlist"><div class='paging'><?php echo $lang['Editors_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=editors&p=".$i."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
      </tr>
	<?php
    }
    ?>
	</table>


<?php 
} elseif ($_REQUEST["act"]=='newEditor') { 
?>
	<form action="admin.php" method="post" name="form">
  	<input type="hidden" name="act" value="addEditor" />
  	<div class="pageDescr"><?php echo $lang['Create_Editor_please_fill']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Create_Editor']; ?></td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Editor_name']; ?></td>
        <td><input type="text" name="editor_name" size="40" maxlength="250" /></td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Editor_email']; ?></td>
        <td><input type="text" name="editor_email" size="40" maxlength="250" /></td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Editor_Username']; ?></td>
        <td><input type="text" name="editor_username" size="40" maxlength="250" /></td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Editor_Password']; ?></td>
        <td><input type="text" name="editor_password" size="40" maxlength="250" /></td>
      </tr>     
            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="<?php echo $lang['Create_Editor_button']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>
    
<?php 
} elseif ($_REQUEST["act"]=='editEditor') {
	$sql = "SELECT * FROM ".$TABLE["Editors"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Editor = mysql_fetch_assoc($sql_result);	
?>
	<form action="admin.php" method="post" name="form">
  	<input type="hidden" name="act" value="updateEditor" />
  	<input type="hidden" name="id" value="<?php echo $Editor["id"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['Update_Editor_change_details']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Update_Editor']; ?></td>
      </tr>
       
      <tr>
        <td class="formLeft"><?php echo $lang['Update_Editor_name']; ?></td>
        <td><input type="text" name="editor_name" size="40" maxlength="250" value="<?php echo ReadHTML($Editor["editor_name"]); ?>" /></td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Update_Editor_email']; ?></td>
        <td><input type="text" name="editor_email" size="40" maxlength="250" value="<?php echo ReadHTML($Editor["editor_email"]); ?>" /></td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Update_Editor_Username']; ?></td>
        <td><input type="text" name="editor_username" size="40" maxlength="250" value="<?php echo ReadHTML($Editor["editor_username"]); ?>" /></td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Update_Editor_Password']; ?></td>
        <td><input type="text" name="editor_password" size="40" maxlength="250" value="<?php echo ReadHTML($Editor["editor_password"]); ?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>
        	<input name="submit" type="submit" value="<?php echo $lang['Update_Editor_button'] ?>" class="submitButton" />
        </td>
      </tr>
  	</table>
	</form>
    
<?php 
} elseif ($_REQUEST["act"]=='HTML_Ed') { 
	$sql = "SELECT * FROM ".$TABLE["Editors"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Editor = mysql_fetch_assoc($sql_result);	
?>
	
    <div style="clear:both; padding-top: 20px;">
    
    <div class="pageDescr">There is one easy way to put <strong>'<?php echo $Editor['editor_name']; ?>'</strong> author on your webpage.</div> 
        
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode"><strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the news from this author to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php $_REQUEST['editor_id']=<?php echo $_REQUEST["id"]; ?>; include(&quot;<?php echo $CONFIG["server_path"]; ?>news.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	At the top of the php page (first line) you should put this line of code too so captcha image verification can work on the comment form.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php session_start(); ?&gt;</div>     
        </td>
      </tr>
            
    </table>
    
    </div>

    
<?php 
} elseif ($_REQUEST["act"]=='news_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsNews" />
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">News options</td>
      </tr>
      
      <tr>
        <td valign="left" width="33%">Number of news per page: </td>
        <td valign="left"><input name="per_page" type="text" size="3" value="<?php echo ReadDB($Options["per_page"]); ?>" /></td>
      </tr>
      
      <tr>
        <td valign="left">Show news:<br />
          <span style="font-size:11px"><em>Choose how to display in the news listing</em></span></td>
        <td valign="left">
          <select name="shownews"> 
          <option value="OnlyTitles"<?php if ($Options["shownews"]=='OnlyTitles') echo ' selected="selected"'; ?>>Only Titles</option>       
          <option value="TitleAndSummary"<?php if ($Options["shownews"]=='TitleAndSummary') echo ' selected="selected"'; ?>>Title and Summary</option>
          <option value="FullNews"<?php if ($Options["shownews"]=='FullNews') echo ' selected="selected"'; ?>>Full News</option>
        </select></td>
      </tr>
      <tr>
        <td valign="left" width="33%">Number of top news: </td>
        <td valign="left"><input name="news_top_num" type="text" size="3" value="<?php echo ReadDB($Options["news_top_num"]); ?>" /></td>
      </tr>
      
      <tr>
        <td valign="left">Show Top news:<br />
          <span style="font-size:11px"><em>Choose how to display in the top news section</em></span></td>
        <td valign="left">
          <select name="shownews_top"> 
          <option value="OnlyTitles"<?php if ($Options["shownews_top"]=='OnlyTitles') echo ' selected="selected"'; ?>>Only Titles</option>       
          <option value="TitleAndSummary"<?php if ($Options["shownews_top"]=='TitleAndSummary') echo ' selected="selected"'; ?>>Title and Summary</option>
          <option value="FullNews"<?php if ($Options["shownews_top"]=='FullNews') echo ' selected="selected"'; ?>>Full News</option>
        </select></td>
      </tr>
      <tr>
        <td valign="left" width="33%">Number of news in the slider: </td>
        <td valign="left"><input name="news_slid_num" type="text" size="3" value="<?php echo ReadDB($Options["news_slid_num"]); ?>" /></td>
      </tr>
      <tr>
        <td valign="left" width="33%">URL of your Main News page:<br />
          <span style="font-size:11px"><em>Put the url of the page where news listing is located. Top news and Slider news will be linked to this URL<br /><br />
          Please note that if you leave this field blank the top article will be open in same page</em></span></td>
        <td valign="left">
        	<input name="news_link" type="text" size="60" value="<?php echo ReadDB($Options["news_link"]); ?>" />
            <div style="padding-top:6px;font-size:11px;">for example http://www.yoursite.com/main_news_page.php</div>
        </td>
      </tr>
      <tr>
        <td valign="left">Show search box:</td>
        <td valign="left">
          <select name="showsearch"> 
           <option value="yes"<?php if ($Options["showsearch"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           <option value="no"<?php if ($Options["showsearch"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
       </td>
      </tr>
      <tr>
        <td valign="left">Show the news on the date published:<br />
          <span style="font-size:11px"><em>If you choose "yes", the news will be hidden until the datetime of publishing</em></span></td>
        <td valign="left">
          <select name="publishon">      
           <option value="no"<?php if ($Options["publishon"]=='no') echo ' selected="selected"'; ?>>no</option>
           <option value="yes"<?php if ($Options["publishon"]=='yes') echo ' selected="selected"'; ?>>yes</option>  
          </select>
       </td>
      </tr>
      <tr>
        <td valign="left">Set the correct time zone:<br />
          <span style="font-size:11px"><em>If the hosting server of your website is located in different time zone, you can correct the time offset here</em></span></td>
        <td valign="left">
          <select name="time_offset"> 
            <option value="-11 hours"<?php if($Options['time_offset']=='-11 hours') echo ' selected="selected"'; ?>>-11 hours</option>
            <option value="-10 hours"<?php if($Options['time_offset']=='-10') echo ' selected="selected"'; ?>>-10 hours</option>
            <option value="-9 hours"<?php if($Options['time_offset']=='-9 hours') echo ' selected="selected"'; ?>>-9 hours</option>
            <option value="-8 hours"<?php if($Options['time_offset']=='-8 hours') echo ' selected="selected"'; ?>>-8 hours</option>
            <option value="-7 hours"<?php if($Options['time_offset']=='-7 hours') echo ' selected="selected"'; ?>>-7 hours</option>
            <option value="-6 hours"<?php if($Options['time_offset']=='-6 hours') echo ' selected="selected"'; ?>>-6 hours</option>
            <option value="-5 hours"<?php if($Options['time_offset']=='-5 hours') echo ' selected="selected"'; ?>>-5 hours</option>
            <option value="-4 hours"<?php if($Options['time_offset']=='-4 hours') echo ' selected="selected"'; ?>>-4 hours</option>
            <option value="-3 hours"<?php if($Options['time_offset']=='-3 hours') echo ' selected="selected"'; ?>>-3 hours</option>
            <option value="-2 hours"<?php if($Options['time_offset']=='-2 hours') echo ' selected="selected"'; ?>>-2 hours</option>
            <option value="-1 hour"<?php if($Options['time_offset']=='-1 hour') echo ' selected="selected"'; ?>>-1 hour</option>
            <option value="0 hour"<?php if($Options['time_offset']=='0 hour') echo ' selected="selected"'; ?>>no offset</option>
            <option value="+1 hour"<?php if($Options['time_offset']=='+1 hour') echo ' selected="selected"'; ?>>+1 hour</option>
            <option value="+2 hours"<?php if($Options['time_offset']=='+2 hours') echo ' selected="selected"'; ?>>+2 hours</option>
            <option value="+3 hours"<?php if($Options['time_offset']=='+3 hours') echo ' selected="selected"'; ?>>+3 hours</option>
            <option value="+4 hours"<?php if($Options['time_offset']=='+4 hours') echo ' selected="selected"'; ?>>+4 hours</option>
            <option value="+5 hours"<?php if($Options['time_offset']=='+5 hours') echo ' selected="selected"'; ?>>+5 hours</option>
            <option value="+6 hours"<?php if($Options['time_offset']=='+6 hours') echo ' selected="selected"'; ?>>+6 hours</option>
            <option value="+7 hours"<?php if($Options['time_offset']=='+7 hours') echo ' selected="selected"'; ?>>+7 hours</option>
            <option value="+8 hours"<?php if($Options['time_offset']=='+8 hours') echo ' selected="selected"'; ?>>+8 hours</option>
            <option value="+9 hours"<?php if($Options['time_offset']=='+9 hours') echo ' selected="selected"'; ?>>+9 hours</option>
            <option value="+10 hours"<?php if($Options['time_offset']=='+10 hours') echo ' selected="selected"'; ?>>+10 hours</option>
            <option value="+11 hours"<?php if($Options['time_offset']=='+11 hours') echo ' selected="selected"'; ?>>+11 hours</option>
          </select>
       </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>    
	</form>


<?php
} elseif ($_REQUEST["act"]=='comments_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="frm">
	<input type="hidden" name="act" value="updateOptionsComments" />
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Comments options</td>
      </tr>
      <tr>
        <td width="45%" valign="top">Administrator email:<br />
          <em>all new comments notifications will be sent to this email address</em></td>
        <td valign="top">
          <input name="email" type="text" size="50" value="<?php echo ReadDB($Options["email"]); ?>" />
        </td>
      </tr>
      <tr>
        <td width="45%" valign="top">Approval:<br />
          <span style="font-size:11px"><em>check if you want to approve comments before having them posted on the article</em></span></td>
        <td valign="top"><input name="approval" type="checkbox" value="true"<?php if ($Options["approval"]=='true') echo ' checked="checked"'; ?> /></td>
      </tr>
      <tr>
        <td valign="top">Comments order:<br />
          <span style="font-size:11px"><em>If you set 'New at the bottom', new comment will appear at the bottom of all comments.<br /> 
          If you set 'New on top', new comment will appear on top of all comments.</em></span></td>
        <td valign="top">
          <select name="comments_order">          
          <option value="AtBottom"<?php if ($Options["comments_order"]=='AtBottom') echo ' selected="selected"'; ?>>New at the bottom</option>
          <option value="OnTop"<?php if ($Options["comments_order"]=='OnTop') echo ' selected="selected"'; ?>>New on top</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top">Type of the Captcha Verification Code:</td>
        <td valign="top">
          <select name="captcha">          
          <option value="recap"<?php if ($Options["captcha"]=='recap') echo ' selected="selected"'; ?>>reCaptcha (highly secured)</option>
          <option value="capmath"<?php if ($Options["captcha"]=='capmath') echo ' selected="selected"'; ?>>Mathematical Captcha</option>
          <option value="cap"<?php if ($Options["captcha"]=='cap') echo ' selected="selected"'; ?>>Simple Captcha</option>
          <option value="vsc"<?php if ($Options["captcha"]=='vsc') echo ' selected="selected"'; ?>>Very Simple Captcha</option>
            <option value="nocap"<?php if ($Options["captcha"]=='nocap') echo ' selected="selected"'; ?>>--- No Captcha ---</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top">If you use reCaptcha Verification, please choose the theme:</td>
        <td valign="top">
          <select name="captcha_theme">
          	  <option value="clean"<?php if ($Options["captcha_theme"]=='clean') echo ' selected="selected"'; ?>>Clean theme</option>         
              <option value="red"<?php if ($Options["captcha_theme"]=='red') echo ' selected="selected"'; ?>>Red theme</option>
              <option value="white"<?php if ($Options["captcha_theme"]=='white') echo ' selected="selected"'; ?>>White theme</option>
              <option value="blackglass"<?php if ($Options["captcha_theme"]=='blackglass') echo ' selected="selected"'; ?>>Blackglass theme</option>
          </select>
        </td>
      </tr>
      
      <tr>
        <td valign="top">Verification question:</td>
        <td valign="top">
          <input name="verify_question" type="text" size="85" value="<?php echo ReadHTML($Options["verify_question"]); ?>" />
        </td>
      </tr>
      
      <tr>
        <td valign="top">Verification answer:<br />
          <em>leave empty if you don't want to use verification question and answer</em></td>
        <td valign="top">
          <input name="verify_answer" type="text" size="20" value="<?php echo ReadHTML($Options["verify_answer"]); ?>" /> - <span style="padding-top:6px;font-size:11px;">case insensitive</span>
        </td>
      </tr>
      
      <tr>
        <td valign="left">Turn off comments by default when create news:</td>
        <td valign="left">
          <select name="commentsoff">      
           <option value="no"<?php if ($Options["commentsoff"]=='no') echo ' selected="selected"'; ?>>no</option>
           <option value="yes"<?php if ($Options["commentsoff"]=='yes') echo ' selected="selected"'; ?>>yes</option>  
          </select>
       </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Create a list with banned IP addresses</td>
      </tr>
      <tr>
        <td width="45%" valign="top">Make a list of IP addresses and comments posted from any of these IP addresses could not be submitted.<br />
          <br />
          For example: 192.168.0.201, 185.168.539.71, 83.91.459.71<br /><br />
          You can block a group of IP addresses. For example if you want to block all IP addresses from 185.168.539.1 to 185.168.539.255, you should enter 185.168.539.
          <br /><br />
          <span style="font-size:11px"><em>Note that you can copy IP address from Comments List.</em></span>
          </td>
        <td valign="top"><textarea name="ban_ips" id="ban_ips" cols="60" rows="5"><?php echo ReadDB($Options["ban_ips"]); ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Create a list with banned words</td>
      </tr>
      <tr>
        <td width="45%" valign="top">Make a list of words and comments containing any of these words can not be posted.<br />
          <br />
          For example: word1,word2, word3<br />
          <br />
          <span style="font-size:11px"><em>Note that the words are not case sensitive. Does not matter if you type 'Word' or 'word'.</em></span></td>
        <td valign="top"><textarea name="ban_words" cols="60" rows="5"><?php echo ReadDB($Options["ban_words"]); ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
	</form>
 

<?php
} elseif ($_REQUEST["act"]=='visual_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize(ReadDB($Options['visual']));
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsVisual" />

    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Set news front-end visual style.</td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">General style: </td>
      </tr>
      <tr>
        <td class="langLeft">General font-family:</td>
        <td valign="top">
        	<select name="gen_font_family">
            	<option value="Arial"<?php if($OptionsVis['gen_font_family']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['gen_font_family']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['gen_font_family']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['gen_font_family']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['gen_font_family']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['gen_font_family']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['gen_font_family']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['gen_font_family']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['gen_font_family']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['gen_font_family']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['gen_font_family']=='Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['gen_font_family']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['gen_font_family']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['gen_font_family']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">General font-size:</td>
        <td valign="top">
        	<select name="gen_font_size">
            	<option value="inherit"<?php if($OptionsVis['gen_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="10px"<?php if($OptionsVis['gen_font_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['gen_font_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['gen_font_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['gen_font_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['gen_font_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['gen_font_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
            </select>
        </td>
      </tr> 
      
      <tr>
        <td class="langLeft">General font-color:</td>
        <td valign="top"><input name="gen_font_color" type="text" size="7" value="<?php echo $OptionsVis["gen_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["gen_font_color"]); ?>;background-color:<?php echo $OptionsVis["gen_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.gen_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>   
      <tr>
        <td class="langLeft">General background-color:</td>
        <td valign="top"><input name="gen_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["gen_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["gen_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["gen_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.gen_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td class="langLeft">General line-height:</td>
        <td valign="top">
        	<select name="gen_line_height">
            	<option value="inherit"<?php if($OptionsVis['gen_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="12px"<?php if($OptionsVis['gen_line_height']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['gen_line_height']=='13px') echo ' selected="selected"'; ?>>13px</option>
            	<option value="14px"<?php if($OptionsVis['gen_line_height']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['gen_line_height']=='15px') echo ' selected="selected"'; ?>>15px</option>
                <option value="16px"<?php if($OptionsVis['gen_line_height']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['gen_line_height']=='18px') echo ' selected="selected"'; ?>>18px</option>
            	<option value="20px"<?php if($OptionsVis['gen_line_height']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['gen_line_height']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['gen_line_height']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['gen_line_height']=='26px') echo ' selected="selected"'; ?>>26px</option>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">General news width:</td>
        <td valign="top"><input name="gen_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["gen_width"]); ?>" />px &nbsp; <sub> - leave blank if you don't want fixed width</sub></td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      <tr>
        <td colspan="3" class="subinfo">News title style: </td>
      </tr>
      <tr>
        <td class="langLeft">Title color:</td>
        <td valign="top"><input name="title_color" type="text" size="7" value="<?php echo $OptionsVis["title_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["title_color"]); ?>;background-color:<?php echo $OptionsVis["title_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.title_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Title font-family:</td>
        <td valign="top">
        	<select name="title_font">
            	<option value="Arial"<?php if($OptionsVis['title_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['title_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['title_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['title_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['title_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['title_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['title_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['title_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['title_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['title_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['title_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['title_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['title_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['title_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-size:</td>
        <td valign="top">
        	<select name="title_size">
            	<option value="inherit"<?php if($OptionsVis['title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['title_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['title_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['title_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['title_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['title_size']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['title_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['title_size']=='15px') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16px"<?php if($OptionsVis['title_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="17px"<?php if($OptionsVis['title_size']=='17px') echo ' selected="selected"'; ?>>17px</option>
                <option value="18px"<?php if($OptionsVis['title_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['title_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['title_size']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['title_size']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['title_size']=='26px') echo ' selected="selected"'; ?>>26px</option>
                <option value="28px"<?php if($OptionsVis['title_size']=='28px') echo ' selected="selected"'; ?>>28px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-weight:</td>
        <td valign="top">
        	<select name="title_font_weight">
            	<option value="normal"<?php if($OptionsVis['title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-style:</td>
        <td valign="top">
        	<select name="title_font_style">
            	<option value="normal"<?php if($OptionsVis['title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title text-align:</td>
        <td valign="top">
        	<select name="title_text_align">
            	<option value="center"<?php if($OptionsVis['title_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['title_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['title_text_align']=='left') echo ' selected="selected"'; ?>>left</option>right
                <option value="right"<?php if($OptionsVis['title_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['title_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      <tr>
        <td colspan="3" class="subinfo">News summary title style: </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title color:</td>
        <td valign="top"><input name="summ_title_color" type="text" size="7" value="<?php echo $OptionsVis["summ_title_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["summ_title_color"]); ?>;background-color:<?php echo $OptionsVis["summ_title_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.summ_title_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">News summary title font-family:</td>
        <td valign="top">
        	<select name="summ_title_font">
            	<option value="Arial"<?php if($OptionsVis['summ_title_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['summ_title_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['summ_title_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['summ_title_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['summ_title_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['summ_title_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['summ_title_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['summ_title_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['summ_title_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['summ_title_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['summ_title_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['summ_title_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['summ_title_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title font-size:</td>
        <td valign="top">
        	<select name="summ_title_size">
            	<option value="inherit"<?php if($OptionsVis['summ_title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>            	
                <option value="9px"<?php if($OptionsVis['summ_title_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['summ_title_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['summ_title_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['summ_title_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['summ_title_size']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['summ_title_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['summ_title_size']=='15px') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16px"<?php if($OptionsVis['summ_title_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="17px"<?php if($OptionsVis['summ_title_size']=='17px') echo ' selected="selected"'; ?>>17px</option>
                <option value="18px"<?php if($OptionsVis['summ_title_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['summ_title_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['summ_title_size']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['summ_title_size']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['summ_title_size']=='26px') echo ' selected="selected"'; ?>>26px</option>
                <option value="28px"<?php if($OptionsVis['summ_title_size']=='28px') echo ' selected="selected"'; ?>>28px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title font-weight:</td>
        <td valign="top">
        	<select name="summ_title_font_weight">
            	<option value="normal"<?php if($OptionsVis['summ_title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['summ_title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title font-style:</td>
        <td valign="top">
        	<select name="summ_title_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title text-align:</td>
        <td valign="top">
        	<select name="summ_title_text_align">
            	<option value="center"<?php if($OptionsVis['summ_title_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['summ_title_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['summ_title_text_align']=='left') echo ' selected="selected"'; ?>>left</option>right
                <option value="right"<?php if($OptionsVis['summ_title_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      <tr>
        <td colspan="3" class="subinfo">News date style: </td>
      </tr>
      <tr>
        <td class="langLeft">Show date on news listing:</td>
        <td valign="top">
        	<select name="show_date">
            	<option value="yes"<?php if($OptionsVis['show_date']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_date']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date color:</td>
        <td valign="top"><input name="date_color" type="text" size="7" value="<?php echo $OptionsVis["date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["date_color"]); ?>;background-color:<?php echo $OptionsVis["date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.date_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Date font-family:</td>
        <td valign="top">
        	<select name="date_font">
            	<option value="Arial"<?php if($OptionsVis['date_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['date_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['date_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['date_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['date_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['date_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['date_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['date_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['date_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['date_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['date_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['date_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['date_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['date_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-size:</td>
        <td valign="top">
        	<select name="date_size">
            	<option value="inherit"<?php if($OptionsVis['date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['date_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['date_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['date_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['date_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['date_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['date_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['date_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['date_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-style:</td>
        <td valign="top">
        	<select name="date_font_style">
            	<option value="normal"<?php if($OptionsVis['date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date text-align:</td>
        <td valign="top">
        	<select name="date_text_align">
            	<option value="center"<?php if($OptionsVis['date_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['date_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['date_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['date_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['date_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date format:</td>
        <td valign="top">
        	<select name="date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['date_format']=='l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2012</option>
                <option value="l - F j Y"<?php if($OptionsVis['date_format']=='l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2012</option>
                <option value="l, F j Y"<?php if($OptionsVis['date_format']=='l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2012</option>
            	<option value="l, F j, Y"<?php if($OptionsVis['date_format']=='l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2012</option>
                <option value="l F j Y"<?php if($OptionsVis['date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2012</option>
                <option value="l F j, Y"<?php if($OptionsVis['date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2012</option>
                <option value="F j Y"<?php if($OptionsVis['date_format']=='F j Y') echo ' selected="selected"'; ?>>January 18 2012</option>
                <option value="F j, Y"<?php if($OptionsVis['date_format']=='F j, Y') echo ' selected="selected"'; ?>>January 18, 2012</option>
                <option value="F jS, Y"<?php if($OptionsVis['date_format']=='F jS, Y') echo ' selected="selected"'; ?>>January 4th, 2012</option>
                <option value="F Y"<?php if($OptionsVis['date_format']=='F Y') echo ' selected="selected"'; ?>>January 2012</option>
                <option value="m-d-Y"<?php if($OptionsVis['date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['date_format']=='l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2012</option>
                <option value="l - j F Y"<?php if($OptionsVis['date_format']=='l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2012</option>
                <option value="l, j F Y"<?php if($OptionsVis['date_format']=='l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2012</option>
                <option value="l, j F, Y"<?php if($OptionsVis['date_format']=='l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2012</option>
                <option value="l j F Y"<?php if($OptionsVis['date_format']=='l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2012</option>
                <option value="l j F, Y"<?php if($OptionsVis['date_format']=='l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2012</option>
                <option value="d F Y"<?php if($OptionsVis['date_format']=='d F Y') echo ' selected="selected"'; ?>>18 January 2012</option>
                <option value="d F, Y"<?php if($OptionsVis['date_format']=='d F, Y') echo ' selected="selected"'; ?>>18 January, 2012</option>
                <option value="d-m-Y"<?php if($OptionsVis['date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="langLeft">Showing the time:</td>
        <td valign="top">
        	<select name="showing_time">
            	<option value=""<?php if($OptionsVis['showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="langLeft">Show Author(Editor):</td>
        <td valign="top">
        	<select name="show_author">
            	<option value="yes"<?php if($OptionsVis['show_author']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_author']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">News summary date style: </td>
      </tr>
      <tr>
        <td class="langLeft">Show date on news summary:</td>
        <td valign="top">
        	<select name="summ_show_date">
            	<option value="yes"<?php if($OptionsVis['summ_show_date']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['summ_show_date']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date color:</td>
        <td valign="top"><input name="summ_date_color" type="text" size="7" value="<?php echo $OptionsVis["summ_date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["summ_date_color"]); ?>;background-color:<?php echo $OptionsVis["summ_date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.summ_date_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">News summary date font-family:</td>
        <td valign="top">
        	<select name="summ_date_font">
            	<option value="Arial"<?php if($OptionsVis['summ_date_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['summ_date_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['summ_date_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['summ_date_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['summ_date_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['summ_date_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['summ_date_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['summ_date_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['summ_date_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['summ_date_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['summ_date_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['summ_date_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['summ_date_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['summ_date_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date font-size:</td>
        <td valign="top">
        	<select name="summ_date_size">
            	<option value="inherit"<?php if($OptionsVis['summ_date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['summ_date_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['summ_date_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['summ_date_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['summ_date_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['summ_date_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['summ_date_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['summ_date_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['summ_date_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date font-style:</td>
        <td valign="top">
        	<select name="summ_date_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date text-align:</td>
        <td valign="top">
        	<select name="summ_date_text_align">
            	<option value="center"<?php if($OptionsVis['summ_date_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['summ_date_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['summ_date_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['summ_date_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['summ_date_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date format:</td>
        <td valign="top">
        	<select name="summ_date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['summ_date_format']=='l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2012</option>
                <option value="l - F j Y"<?php if($OptionsVis['summ_date_format']=='l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2012</option>
                <option value="l, F j Y"<?php if($OptionsVis['summ_date_format']=='l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2012</option>
            	<option value="l, F j, Y"<?php if($OptionsVis['summ_date_format']=='l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2012</option>
                <option value="l F j Y"<?php if($OptionsVis['summ_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2012</option>
                <option value="l F j, Y"<?php if($OptionsVis['summ_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2012</option>
                <option value="F j Y"<?php if($OptionsVis['summ_date_format']=='F j Y') echo ' selected="selected"'; ?>>January 18 2012</option>
                <option value="F j, Y"<?php if($OptionsVis['summ_date_format']=='F j, Y') echo ' selected="selected"'; ?>>January 18, 2012</option>
                <option value="F jS, Y"<?php if($OptionsVis['summ_date_format']=='F jS, Y') echo ' selected="selected"'; ?>>January 4th, 2012</option>
                <option value="F Y"<?php if($OptionsVis['summ_date_format']=='F Y') echo ' selected="selected"'; ?>>January 2012</option>
                <option value="m-d-Y"<?php if($OptionsVis['summ_date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['summ_date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['summ_date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['summ_date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['summ_date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['summ_date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['summ_date_format']=='l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2012</option>
                <option value="l - j F Y"<?php if($OptionsVis['summ_date_format']=='l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2012</option>
                <option value="l, j F Y"<?php if($OptionsVis['summ_date_format']=='l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2012</option>
                <option value="l, j F, Y"<?php if($OptionsVis['summ_date_format']=='l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2012</option>
                <option value="l j F Y"<?php if($OptionsVis['summ_date_format']=='l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2012</option>
                <option value="l j F, Y"<?php if($OptionsVis['summ_date_format']=='l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2012</option>
                <option value="d F Y"<?php if($OptionsVis['summ_date_format']=='d F Y') echo ' selected="selected"'; ?>>18 January 2012</option>
                <option value="d F, Y"<?php if($OptionsVis['summ_date_format']=='d F, Y') echo ' selected="selected"'; ?>>18 January, 2012</option>
                <option value="d-m-Y"<?php if($OptionsVis['summ_date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['summ_date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['summ_date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['summ_date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['summ_date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['summ_date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="langLeft">News summary showing the time:</td>
        <td valign="top">
        	<select name="summ_showing_time">
            	<option value=""<?php if($OptionsVis['summ_showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['summ_showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['summ_showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      
           
      <tr>
        <td colspan="3" class="subinfo">News content style: </td>
      </tr>
      <tr>
        <td class="langLeft">News content color:</td>
        <td valign="top"><input name="cont_color" type="text" size="7" value="<?php echo $OptionsVis["cont_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["cont_color"]); ?>;background-color:<?php echo $OptionsVis["cont_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.cont_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">News content font-family:</td>
        <td valign="top">
        	<select name="cont_font">
            	<option value="Arial"<?php if($OptionsVis['cont_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['cont_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['cont_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['cont_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['cont_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['cont_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['cont_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['cont_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['cont_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['cont_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['cont_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['cont_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['cont_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['cont_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content font-size:</td>
        <td valign="top">
        	<select name="cont_size">
            	<option value="inherit"<?php if($OptionsVis['cont_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['cont_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['cont_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['cont_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['cont_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['cont_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['cont_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['cont_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['cont_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content font-style:</td>
        <td valign="top">
        	<select name="cont_font_style">
            	<option value="normal"<?php if($OptionsVis['cont_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['cont_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['cont_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['cont_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content text-align:</td>
        <td valign="top">
        	<select name="cont_text_align">
            	<option value="center"<?php if($OptionsVis['cont_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['cont_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['cont_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['cont_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['cont_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content line-height:</td>
        <td valign="top">
        	<select name="cont_line_height">
            	<option value="inherit"<?php if($OptionsVis['cont_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="12px"<?php if($OptionsVis['cont_line_height']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['cont_line_height']=='13px') echo ' selected="selected"'; ?>>13px</option>
            	<option value="14px"<?php if($OptionsVis['cont_line_height']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['cont_line_height']=='15px') echo ' selected="selected"'; ?>>15px</option>
                <option value="16px"<?php if($OptionsVis['cont_line_height']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['cont_line_height']=='18px') echo ' selected="selected"'; ?>>18px</option>
            	<option value="20px"<?php if($OptionsVis['cont_line_height']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['cont_line_height']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['cont_line_height']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['cont_line_height']=='26px') echo ' selected="selected"'; ?>>26px</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
       
      
      <tr>
        <td colspan="3" class="subinfo">News summary style: </td>
      </tr>
      <tr>
        <td class="langLeft">News summary color:</td>
        <td valign="top"><input name="summ_color" type="text" size="7" value="<?php echo $OptionsVis["summ_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["summ_color"]); ?>;background-color:<?php echo $OptionsVis["summ_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.summ_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">News summary font-family:</td>
        <td valign="top">
        	<select name="summ_font">
            	<option value="Arial"<?php if($OptionsVis['summ_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['summ_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['summ_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['summ_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['summ_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['summ_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['summ_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['summ_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['summ_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['summ_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['summ_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['summ_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['summ_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['summ_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary font-size:</td>
        <td valign="top">
        	<select name="summ_size">
            	<option value="inherit"<?php if($OptionsVis['summ_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['summ_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['summ_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['summ_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['summ_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['summ_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['summ_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['summ_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['summ_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary font-style:</td>
        <td valign="top">
        	<select name="summ_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary text-align:</td>
        <td valign="top">
        	<select name="summ_text_align">
            	<option value="center"<?php if($OptionsVis['summ_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['summ_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['summ_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['summ_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['summ_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary line-height:</td>
        <td valign="top">
        	<select name="summ_line_height">
            	<option value="inherit"<?php if($OptionsVis['summ_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="12px"<?php if($OptionsVis['summ_line_height']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['summ_line_height']=='13px') echo ' selected="selected"'; ?>>13px</option>
            	<option value="14px"<?php if($OptionsVis['summ_line_height']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['summ_line_height']=='15px') echo ' selected="selected"'; ?>>15px</option>
                <option value="16px"<?php if($OptionsVis['summ_line_height']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['summ_line_height']=='18px') echo ' selected="selected"'; ?>>18px</option>
            	<option value="20px"<?php if($OptionsVis['summ_line_height']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['summ_line_height']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['summ_line_height']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['summ_line_height']=='26px') echo ' selected="selected"'; ?>>26px</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">Image style in News summary: </td>
      </tr>
      <tr>
        <td class="langLeft">Show image in the news listing(summary):</td>
        <td valign="top">
        	<select name="summ_show_image">
            	<option value="yes"<?php if($OptionsVis['summ_show_image']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['summ_show_image']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Summary image width:</td>
        <td valign="top"><input name="summ_img_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["summ_img_width"]); ?>" />px</td>
      </tr>  
      <tr>
        <td class="langLeft">Summary image height:</td>
        <td valign="top"><input name="summ_img_height" type="text" size="4" value="<?php echo ReadDB($OptionsVis["summ_img_height"]); ?>" />px - leave empty if you don't want fixed height</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">Highlighted News style: </td>
      </tr>
      <tr>
        <td class="langLeft">HighLight background-color:</td>
        <td valign="top"><input name="hl_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["hl_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["hl_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["hl_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.hl_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Highlight Padding:</td>
        <td valign="top">
        	<select name="hl_padding">
            	<option value="0px"<?php if($OptionsVis['hl_padding']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['hl_padding']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['hl_padding']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['hl_padding']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['hl_padding']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['hl_padding']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['hl_padding']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['hl_padding']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['hl_padding']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['hl_padding']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['hl_padding']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['hl_padding']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['hl_padding']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['hl_padding']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['hl_padding']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="17px"<?php if($OptionsVis['hl_padding']=='17px') echo ' selected="selected"'; ?>>17px</option>
                <option value="18px"<?php if($OptionsVis['hl_padding']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="19px"<?php if($OptionsVis['hl_padding']=='19px') echo ' selected="selected"'; ?>>19px</option>
                <option value="20px"<?php if($OptionsVis['hl_padding']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
        
      <tr>
        <td colspan="3" class="subinfo">Pagination style: </td>
      </tr>
      <tr>
        <td class="langLeft">Align to:</td>
        <td valign="top">
        	<select name="pag_align_to">
            	<option value="left"<?php if($OptionsVis['pag_align_to']=='left') echo ' selected="selected"'; ?>>left</option>
            	<option value="center"<?php if($OptionsVis['pag_align_to']=='center') echo ' selected="selected"'; ?>>center</option>
                <option value="right"<?php if($OptionsVis['pag_align_to']=='right') echo ' selected="selected"'; ?>>right</option>
            </select>
        </td>
      </tr>  
         
      <tr>
        <td class="langLeft">Pages font color:</td>
        <td valign="top"><input name="pag_font_color" type="text" size="7" value="<?php echo $OptionsVis["pag_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_font_color"]); ?>;background-color:<?php echo $OptionsVis["pag_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>    
      <tr>
        <td class="langLeft">Pages border color:</td>
        <td valign="top"><input name="pag_bord_color" type="text" size="7" value="<?php echo $OptionsVis["pag_bord_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bord_color"]); ?>;background-color:<?php echo $OptionsVis["pag_bord_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bord_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td class="langLeft">Pages background color:</td>
        <td valign="top"><input name="pag_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>   
      
      <tr>
        <td class="langLeft">Font color on hover (on mouse over):</td>
        <td valign="top"><input name="pag_font_color_hover" type="text" size="7" value="<?php echo $OptionsVis["pag_font_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_font_color_hover"]); ?>;background-color:<?php echo $OptionsVis["pag_font_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_font_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>    
      <tr>
        <td class="langLeft">Border color on hover (on mouse over):</td>
        <td valign="top"><input name="pag_bord_color_hover" type="text" size="7" value="<?php echo $OptionsVis["pag_bord_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bord_color_hover"]); ?>;background-color:<?php echo $OptionsVis["pag_bord_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bord_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td class="langLeft">Background color on hover (on mouse over):</td>
        <td valign="top"><input name="pag_bgr_color_hover" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color_hover"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      
      <tr>
        <td class="langLeft">Selected page font color:</td>
        <td valign="top"><input name="pag_font_color_sel" type="text" size="7" value="<?php echo $OptionsVis["pag_font_color_sel"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_font_color_sel"]); ?>;background-color:<?php echo $OptionsVis["pag_font_color_sel"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_font_color_sel,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>    
      <tr>
        <td class="langLeft">Selected page border color:</td>
        <td valign="top"><input name="pag_bord_color_sel" type="text" size="7" value="<?php echo $OptionsVis["pag_bord_color_sel"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bord_color_sel"]); ?>;background-color:<?php echo $OptionsVis["pag_bord_color_sel"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bord_color_sel,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Selected page background color:</td>
        <td valign="top"><input name="pag_bgr_color_sel" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color_sel"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color_sel"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color_sel"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color_sel,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      
      <tr>
        <td class="langLeft">Active Previous/Next button font color:</td>
        <td valign="top"><input name="pag_font_color_prn" type="text" size="7" value="<?php echo $OptionsVis["pag_font_color_prn"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_font_color_prn"]); ?>;background-color:<?php echo $OptionsVis["pag_font_color_prn"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_font_color_prn,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>    
      <tr>
        <td class="langLeft">Active Previous/Next button border color:</td>
        <td valign="top"><input name="pag_bord_color_prn" type="text" size="7" value="<?php echo $OptionsVis["pag_bord_color_prn"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bord_color_prn"]); ?>;background-color:<?php echo $OptionsVis["pag_bord_color_prn"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bord_color_prn,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Active Previous/Next button background color:</td>
        <td valign="top"><input name="pag_bgr_color_prn" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color_prn"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color_prn"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color_prn"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color_prn,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Active Previous/Next button background color on hover (on mouse over):</td>
        <td valign="top"><input name="pag_bgr_color_prn_hover" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color_prn_hover"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color_prn_hover"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color_prn_hover"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color_prn_hover,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>    
      
      <tr>
        <td class="langLeft">Inactive Previous/Next button font color:</td>
        <td valign="top"><input name="pag_font_color_ina" type="text" size="7" value="<?php echo $OptionsVis["pag_font_color_ina"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_font_color_ina"]); ?>;background-color:<?php echo $OptionsVis["pag_font_color_ina"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_font_color_ina,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>    
      <tr>
        <td class="langLeft">Inactive Previous/Next button border color:</td>
        <td valign="top"><input name="pag_bord_color_ina" type="text" size="7" value="<?php echo $OptionsVis["pag_bord_color_ina"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bord_color_ina"]); ?>;background-color:<?php echo $OptionsVis["pag_bord_color_ina"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bord_color_ina,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Inactive Previous/Next button background color:</td>
        <td valign="top"><input name="pag_bgr_color_ina" type="text" size="7" value="<?php echo $OptionsVis["pag_bgr_color_ina"]; ?>" style="color:<?php echo invert_colour($OptionsVis["pag_bgr_color_ina"]); ?>;background-color:<?php echo $OptionsVis["pag_bgr_color_ina"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.pag_bgr_color_ina,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      
      <tr>
        <td class="langLeft">Pagination Font-family:</td>
        <td valign="top">
        	<select name="pag_font_family">
            	<option value="Arial"<?php if($OptionsVis['pag_font_family']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['pag_font_family']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['pag_font_family']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['pag_font_family']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['pag_font_family']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['pag_font_family']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['pag_font_family']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['pag_font_family']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['pag_font_family']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['pag_font_family']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['pag_font_family']=='Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['pag_font_family']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['pag_font_family']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_family']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Pagination font-size:</td>
        <td valign="top">
        	<select name="pag_font_size">
            	<option value="inherit"<?php if($OptionsVis['pag_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <option value="9px"<?php if($OptionsVis['pag_font_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['pag_font_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['pag_font_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['pag_font_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['pag_font_size']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['pag_font_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['pag_font_size']=='15px') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16px"<?php if($OptionsVis['pag_font_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['pag_font_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['pag_font_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Pagination font-style:</td>
        <td valign="top">
        	<select name="pag_font_style">
            	<option value="normal"<?php if($OptionsVis['pag_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['pag_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Pagination font-weight:</td>
        <td valign="top">
        	<select name="pag_font_weight">
            	<option value="normal"<?php if($OptionsVis['pag_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['pag_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>         
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8" style="border-bottom:solid 1px #e4e4e4"></td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">News 'Back' link: </td>
      </tr>
      
      <tr>
        <td class="langLeft">Back link font-size:</td>
        <td valign="top">
        	<select name="link_font_size">
            	<option value="inherit"<?php if($OptionsVis['link_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <option value="10px"<?php if($OptionsVis['link_font_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['link_font_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['link_font_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['link_font_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['link_font_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['link_font_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Back link font color:</td>
        <td valign="top"><input name="link_color" type="text" size="7" value="<?php echo $OptionsVis["link_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["link_color"]); ?>;background-color:<?php echo $OptionsVis["link_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.link_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Back link font-weight:</td>
        <td valign="top">
        	<select name="link_font_weight">
            	<option value="normal"<?php if($OptionsVis['link_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['link_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['link_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Back link alignment:</td>
        <td valign="top">
        	<select name="link_align">
            	<option value="left"<?php if($OptionsVis['link_align']=='left') echo ' selected="selected"'; ?>>left</option>
            	<option value="center"<?php if($OptionsVis['link_align']=='center') echo ' selected="selected"'; ?>>center</option>
                <option value="right"<?php if($OptionsVis['link_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['link_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit8" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">'Share This' button below the articles: </td>
      </tr>
      <tr>
        <td class="langLeft">Show 'Share This' button below the articles:</td>
        <td valign="top">
        	<select name="show_share_this">
            	<option value="yes"<?php if($OptionsVis['show_share_this']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_share_this']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">'Share This' button alignment:</td>
        <td valign="top">
        	<select name="share_this_align">
            	<option value="left"<?php if($OptionsVis['share_this_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['share_this_align']=='right') echo ' selected="selected"'; ?>>right</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit9" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">Distances: </td>
      </tr>
      
      <tr>
        <td class="langLeft">Distance between title and date:</td>
        <td valign="top">
        	<select name="dist_title_date">
            	<option value="0px"<?php if($OptionsVis['dist_title_date']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['dist_title_date']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['dist_title_date']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['dist_title_date']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['dist_title_date']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['dist_title_date']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['dist_title_date']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['dist_title_date']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['dist_title_date']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['dist_title_date']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['dist_title_date']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['dist_title_date']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['dist_title_date']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['dist_title_date']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['dist_title_date']=='16px') echo ' selected="selected"'; ?>>16px</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between title and date in the summary:</td>
        <td valign="top">
        	<select name="summ_dist_title_date">
            	<option value="0px"<?php if($OptionsVis['summ_dist_title_date']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['summ_dist_title_date']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['summ_dist_title_date']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['summ_dist_title_date']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['summ_dist_title_date']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['summ_dist_title_date']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['summ_dist_title_date']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['summ_dist_title_date']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['summ_dist_title_date']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['summ_dist_title_date']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['summ_dist_title_date']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['summ_dist_title_date']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['summ_dist_title_date']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['summ_dist_title_date']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['summ_dist_title_date']=='16px') echo ' selected="selected"'; ?>>16px</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between date and news content:</td>
        <td valign="top">
        	<select name="dist_date_text">
            	<option value="0px"<?php if($OptionsVis['dist_date_text']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['dist_date_text']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['dist_date_text']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['dist_date_text']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['dist_date_text']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['dist_date_text']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['dist_date_text']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['dist_date_text']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['dist_date_text']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['dist_date_text']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['dist_date_text']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['dist_date_text']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['dist_date_text']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['dist_date_text']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['dist_date_text']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['dist_date_text']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['dist_date_text']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between date and news summary:</td>
        <td valign="top">
        	<select name="summ_dist_date_text">
            	<option value="0px"<?php if($OptionsVis['summ_dist_date_text']=='0px') echo ' selected="selected"'; ?>>0px</option>
                <option value="1px"<?php if($OptionsVis['summ_dist_date_text']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['summ_dist_date_text']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['summ_dist_date_text']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['summ_dist_date_text']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['summ_dist_date_text']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['summ_dist_date_text']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['summ_dist_date_text']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['summ_dist_date_text']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['summ_dist_date_text']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['summ_dist_date_text']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['summ_dist_date_text']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['summ_dist_date_text']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['summ_dist_date_text']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['summ_dist_date_text']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['summ_dist_date_text']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['summ_dist_date_text']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between news in the news listing(summaries):</td>
        <td valign="top">
        	<select name="dist_btw_news">
            	<option value="2px"<?php if($OptionsVis['dist_btw_news']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['dist_btw_news']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['dist_btw_news']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['dist_btw_news']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['dist_btw_news']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['dist_btw_news']=='7px') echo ' selected="selected"'; ?>>7px</option>
                <option value="8px"<?php if($OptionsVis['dist_btw_news']=='8px') echo ' selected="selected"'; ?>>8px</option>
                <option value="9px"<?php if($OptionsVis['dist_btw_news']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['dist_btw_news']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="12px"<?php if($OptionsVis['dist_btw_news']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['dist_btw_news']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['dist_btw_news']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['dist_btw_news']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['dist_btw_news']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['dist_btw_news']=='22px') echo ' selected="selected"'; ?>>22px</option>
            	<option value="24px"<?php if($OptionsVis['dist_btw_news']=='24px') echo ' selected="selected"'; ?>>24px</option>
            	<option value="26px"<?php if($OptionsVis['dist_btw_news']=='26px') echo ' selected="selected"'; ?>>26px</option>
                <option value="28px"<?php if($OptionsVis['dist_btw_news']=='28px') echo ' selected="selected"'; ?>>28px</option>
                <option value="30px"<?php if($OptionsVis['dist_btw_news']=='30px') echo ' selected="selected"'; ?>>30px</option>
            	<option value="32px"<?php if($OptionsVis['dist_btw_news']=='32px') echo ' selected="selected"'; ?>>32px</option>
                <option value="36px"<?php if($OptionsVis['dist_btw_news']=='36px') echo ' selected="selected"'; ?>>36px</option>
                <option value="40px"<?php if($OptionsVis['dist_btw_news']=='40px') echo ' selected="selected"'; ?>>40px</option>
                <option value="44px"<?php if($OptionsVis['dist_btw_news']=='44px') echo ' selected="selected"'; ?>>44px</option>
                <option value="48px"<?php if($OptionsVis['dist_btw_news']=='48px') echo ' selected="selected"'; ?>>48px</option>
                <option value="50px"<?php if($OptionsVis['dist_btw_news']=='50px') echo ' selected="selected"'; ?>>50px</option>
                <option value="55px"<?php if($OptionsVis['dist_btw_news']=='55px') echo ' selected="selected"'; ?>>55px</option>
                <option value="60px"<?php if($OptionsVis['dist_btw_news']=='60px') echo ' selected="selected"'; ?>>60px</option>
                <option value="65px"<?php if($OptionsVis['dist_btw_news']=='65px') echo ' selected="selected"'; ?>>65px</option>
                <option value="70px"<?php if($OptionsVis['dist_btw_news']=='70px') echo ' selected="selected"'; ?>>70px</option>
                <option value="80px"<?php if($OptionsVis['dist_btw_news']=='80px') echo ' selected="selected"'; ?>>80px</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Distance between 'Back' link and news title:</td>
        <td valign="top">
        	<select name="dist_link_title">
            	<option value="1px"<?php if($OptionsVis['dist_link_title']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['dist_link_title']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['dist_link_title']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['dist_link_title']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['dist_link_title']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['dist_link_title']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['dist_link_title']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['dist_link_title']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['dist_link_title']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['dist_link_title']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['dist_link_title']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['dist_link_title']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['dist_link_title']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['dist_link_title']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['dist_link_title']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['dist_link_title']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit10" type="submit" value="Save" class="submitButton" /></td>
      </tr>
       
    </table>
	</form> 
    


<?php
} elseif ($_REQUEST["act"]=='visual_options_top') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual_top']);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsVisualTop" />

    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Set news front-end visual style on Top News Section.</td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">General style: </td>
      </tr>
      <tr>
        <td class="langLeft">General font-family:</td>
        <td valign="top">
        	<select name="top_gen_font_family">
            	<option value="Arial"<?php if($OptionsVis['top_gen_font_family']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['top_gen_font_family']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['top_gen_font_family']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['top_gen_font_family']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['top_gen_font_family']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['top_gen_font_family']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['top_gen_font_family']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['top_gen_font_family']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['top_gen_font_family']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['top_gen_font_family']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['top_gen_font_family']=='Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['top_gen_font_family']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['top_gen_font_family']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['top_gen_font_family']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">General font-size:</td>
        <td valign="top">
        	<select name="top_gen_font_size">
            	<option value="inherit"<?php if($OptionsVis['top_gen_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="10px"<?php if($OptionsVis['top_gen_font_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['top_gen_font_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['top_gen_font_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_gen_font_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['top_gen_font_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_gen_font_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
            </select>
        </td>
      </tr> 
      
      <tr>
        <td class="langLeft">General font-color:</td>
        <td valign="top"><input name="top_gen_font_color" type="text" size="7" value="<?php echo $OptionsVis["top_gen_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_gen_font_color"]); ?>;background-color:<?php echo $OptionsVis["top_gen_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_gen_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">General background-color:</td>
        <td valign="top"><input name="top_gen_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["top_gen_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_gen_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["top_gen_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_gen_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">General line-height:</td>
        <td valign="top">
        	<select name="top_gen_line_height">
            	<option value="inherit"<?php if($OptionsVis['top_gen_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="12px"<?php if($OptionsVis['top_gen_line_height']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['top_gen_line_height']=='13px') echo ' selected="selected"'; ?>>13px</option>
            	<option value="14px"<?php if($OptionsVis['top_gen_line_height']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['top_gen_line_height']=='15px') echo ' selected="selected"'; ?>>15px</option>
                <option value="16px"<?php if($OptionsVis['top_gen_line_height']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_gen_line_height']=='18px') echo ' selected="selected"'; ?>>18px</option>
            	<option value="20px"<?php if($OptionsVis['top_gen_line_height']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['top_gen_line_height']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['top_gen_line_height']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['top_gen_line_height']=='26px') echo ' selected="selected"'; ?>>26px</option>
            </select>
        </td>
      </tr>       
      <tr>
        <td class="langLeft">General news width:</td>
        <td valign="top"><input name="top_gen_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["top_gen_width"]); ?>" />px &nbsp; <sub> - leave blank if you don't want fixed width</sub></td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      <tr>
        <td colspan="3" class="subinfo">News title style: </td>
      </tr>
      <tr>
        <td class="langLeft">Title color:</td>
        <td valign="top"><input name="top_title_color" type="text" size="7" value="<?php echo $OptionsVis["top_title_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_title_color"]); ?>;background-color:<?php echo $OptionsVis["top_title_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_title_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Title font-family:</td>
        <td valign="top">
        	<select name="top_title_font">
            	<option value="Arial"<?php if($OptionsVis['top_title_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['top_title_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['top_title_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['top_title_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['top_title_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['top_title_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['top_title_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['top_title_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['top_title_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['top_title_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['top_title_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['top_title_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['top_title_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['top_title_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-size:</td>
        <td valign="top">
        	<select name="top_title_size">
            	<option value="inherit"<?php if($OptionsVis['top_title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['top_title_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_title_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['top_title_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['top_title_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['top_title_size']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['top_title_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['top_title_size']=='15px') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16px"<?php if($OptionsVis['top_title_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="17px"<?php if($OptionsVis['top_title_size']=='17px') echo ' selected="selected"'; ?>>17px</option>
                <option value="18px"<?php if($OptionsVis['top_title_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_title_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['top_title_size']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['top_title_size']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['top_title_size']=='26px') echo ' selected="selected"'; ?>>26px</option>
                <option value="28px"<?php if($OptionsVis['top_title_size']=='28px') echo ' selected="selected"'; ?>>28px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-weight:</td>
        <td valign="top">
        	<select name="top_title_font_weight">
            	<option value="normal"<?php if($OptionsVis['top_title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['top_title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['top_title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-style:</td>
        <td valign="top">
        	<select name="top_title_font_style">
            	<option value="normal"<?php if($OptionsVis['top_title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['top_title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['top_title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['top_title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title text-align:</td>
        <td valign="top">
        	<select name="top_title_text_align">
            	<option value="center"<?php if($OptionsVis['top_title_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['top_title_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['top_title_text_align']=='left') echo ' selected="selected"'; ?>>left</option>right
                <option value="right"<?php if($OptionsVis['top_title_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['top_title_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      
      <tr>
        <td colspan="3" class="subinfo">News summary title style: </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title color:</td>
        <td valign="top"><input name="top_summ_title_color" type="text" size="7" value="<?php echo $OptionsVis["top_summ_title_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_summ_title_color"]); ?>;background-color:<?php echo $OptionsVis["top_summ_title_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_summ_title_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">News summary title font-family:</td>
        <td valign="top">
        	<select name="top_summ_title_font">
            	<option value="Arial"<?php if($OptionsVis['top_summ_title_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['top_summ_title_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['top_summ_title_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['top_summ_title_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['top_summ_title_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['top_summ_title_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['top_summ_title_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['top_summ_title_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['top_summ_title_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['top_summ_title_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['top_summ_title_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['top_summ_title_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['top_summ_title_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_title_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title font-size:</td>
        <td valign="top">
        	<select name="top_summ_title_size">
            	<option value="inherit"<?php if($OptionsVis['top_summ_title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>            	
                <option value="9px"<?php if($OptionsVis['top_summ_title_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_summ_title_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['top_summ_title_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['top_summ_title_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['top_summ_title_size']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['top_summ_title_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['top_summ_title_size']=='15px') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16px"<?php if($OptionsVis['top_summ_title_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="17px"<?php if($OptionsVis['top_summ_title_size']=='17px') echo ' selected="selected"'; ?>>17px</option>
                <option value="18px"<?php if($OptionsVis['top_summ_title_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_summ_title_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['top_summ_title_size']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['top_summ_title_size']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['top_summ_title_size']=='26px') echo ' selected="selected"'; ?>>26px</option>
                <option value="28px"<?php if($OptionsVis['top_summ_title_size']=='28px') echo ' selected="selected"'; ?>>28px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title font-weight:</td>
        <td valign="top">
        	<select name="top_summ_title_font_weight">
            	<option value="normal"<?php if($OptionsVis['top_summ_title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['top_summ_title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title font-style:</td>
        <td valign="top">
        	<select name="top_summ_title_font_style">
            	<option value="normal"<?php if($OptionsVis['top_summ_title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['top_summ_title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['top_summ_title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary title text-align:</td>
        <td valign="top">
        	<select name="top_summ_title_text_align">
            	<option value="center"<?php if($OptionsVis['top_summ_title_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['top_summ_title_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['top_summ_title_text_align']=='left') echo ' selected="selected"'; ?>>left</option>right
                <option value="right"<?php if($OptionsVis['top_summ_title_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_title_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      
      <tr>
        <td colspan="3" class="subinfo">News date style: </td>
      </tr>
      <tr>
        <td class="langLeft">Show date on news listing:</td>
        <td valign="top">
        	<select name="top_show_date">
            	<option value="yes"<?php if($OptionsVis['top_show_date']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['top_show_date']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date color:</td>
        <td valign="top"><input name="top_date_color" type="text" size="7" value="<?php echo $OptionsVis["top_date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_date_color"]); ?>;background-color:<?php echo $OptionsVis["top_date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_date_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Date font-family:</td>
        <td valign="top">
        	<select name="top_date_font">
            	<option value="Arial"<?php if($OptionsVis['top_date_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['top_date_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['top_date_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['top_date_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['top_date_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['top_date_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['top_date_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['top_date_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['top_date_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['top_date_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['top_date_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['top_date_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['top_date_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['top_date_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-size:</td>
        <td valign="top">
        	<select name="top_date_size">
            	<option value="inherit"<?php if($OptionsVis['top_date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['top_date_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_date_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['top_date_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['top_date_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_date_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['top_date_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_date_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_date_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-style:</td>
        <td valign="top">
        	<select name="top_date_font_style">
            	<option value="normal"<?php if($OptionsVis['top_date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['top_date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['top_date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['top_date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date text-align:</td>
        <td valign="top">
        	<select name="top_date_text_align">
            	<option value="center"<?php if($OptionsVis['top_date_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['top_date_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['top_date_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['top_date_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['top_date_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date format:</td>
        <td valign="top">
        	<select name="top_date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['top_date_format']=='l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2012</option>
                <option value="l - F j Y"<?php if($OptionsVis['top_date_format']=='l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2012</option>
                <option value="l, F j Y"<?php if($OptionsVis['top_date_format']=='l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2012</option>
            	<option value="l, F j, Y"<?php if($OptionsVis['top_date_format']=='l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2012</option>
                <option value="l F j Y"<?php if($OptionsVis['top_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2012</option>
                <option value="l F j, Y"<?php if($OptionsVis['top_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2012</option>
                <option value="F j Y"<?php if($OptionsVis['top_date_format']=='F j Y') echo ' selected="selected"'; ?>>January 18 2012</option>
                <option value="F j, Y"<?php if($OptionsVis['top_date_format']=='F j, Y') echo ' selected="selected"'; ?>>January 18, 2012</option>
                <option value="F jS, Y"<?php if($OptionsVis['top_date_format']=='F jS, Y') echo ' selected="selected"'; ?>>January 4th, 2012</option>
                <option value="F Y"<?php if($OptionsVis['top_date_format']=='F Y') echo ' selected="selected"'; ?>>January 2012</option>
                <option value="m-d-Y"<?php if($OptionsVis['top_date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['top_date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['top_date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['top_date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['top_date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['top_date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['top_date_format']=='l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2012</option>
                <option value="l - j F Y"<?php if($OptionsVis['top_date_format']=='l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2012</option>
                <option value="l, j F Y"<?php if($OptionsVis['top_date_format']=='l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2012</option>
                <option value="l, j F, Y"<?php if($OptionsVis['top_date_format']=='l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2012</option>
                <option value="l j F Y"<?php if($OptionsVis['top_date_format']=='l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2012</option>
                <option value="l j F, Y"<?php if($OptionsVis['top_date_format']=='l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2012</option>
                <option value="d F Y"<?php if($OptionsVis['top_date_format']=='d F Y') echo ' selected="selected"'; ?>>18 January 2012</option>
                <option value="d F, Y"<?php if($OptionsVis['top_date_format']=='d F, Y') echo ' selected="selected"'; ?>>18 January, 2012</option>
                <option value="d-m-Y"<?php if($OptionsVis['top_date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['top_date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['top_date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['top_date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['top_date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['top_date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="langLeft">Showing the time:</td>
        <td valign="top">
        	<select name="top_showing_time">
            	<option value=""<?php if($OptionsVis['top_showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['top_showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['top_showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="langLeft">Show Author(Editor):</td>
        <td valign="top">
        	<select name="top_show_author">
            	<option value="yes"<?php if($OptionsVis['top_show_author']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['top_show_author']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      
      <tr>
        <td colspan="3" class="subinfo">News summary date style: </td>
      </tr>
      <tr>
        <td class="langLeft">Show date on news summary:</td>
        <td valign="top">
        	<select name="top_summ_show_date">
            	<option value="yes"<?php if($OptionsVis['top_summ_show_date']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['top_summ_show_date']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date color:</td>
        <td valign="top"><input name="top_summ_date_color" type="text" size="7" value="<?php echo $OptionsVis["top_summ_date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_summ_date_color"]); ?>;background-color:<?php echo $OptionsVis["top_summ_date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_summ_date_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">News summary date font-family:</td>
        <td valign="top">
        	<select name="top_summ_date_font">
            	<option value="Arial"<?php if($OptionsVis['top_summ_date_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['top_summ_date_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['top_summ_date_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['top_summ_date_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['top_summ_date_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['top_summ_date_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['top_summ_date_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['top_summ_date_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['top_summ_date_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['top_summ_date_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['top_summ_date_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['top_summ_date_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['top_summ_date_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_date_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date font-size:</td>
        <td valign="top">
        	<select name="top_summ_date_size">
            	<option value="inherit"<?php if($OptionsVis['top_summ_date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['top_summ_date_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_summ_date_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['top_summ_date_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['top_summ_date_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_summ_date_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['top_summ_date_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_summ_date_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_summ_date_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date font-style:</td>
        <td valign="top">
        	<select name="top_summ_date_font_style">
            	<option value="normal"<?php if($OptionsVis['top_summ_date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['top_summ_date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['top_summ_date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date text-align:</td>
        <td valign="top">
        	<select name="top_summ_date_text_align">
            	<option value="center"<?php if($OptionsVis['top_summ_date_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['top_summ_date_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['top_summ_date_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['top_summ_date_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_date_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary date format:</td>
        <td valign="top">
        	<select name="top_summ_date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['top_summ_date_format']=='l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2012</option>
                <option value="l - F j Y"<?php if($OptionsVis['top_summ_date_format']=='l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2012</option>
                <option value="l, F j Y"<?php if($OptionsVis['top_summ_date_format']=='l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2012</option>
            	<option value="l, F j, Y"<?php if($OptionsVis['top_summ_date_format']=='l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2012</option>
                <option value="l F j Y"<?php if($OptionsVis['top_summ_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2012</option>
                <option value="l F j, Y"<?php if($OptionsVis['top_summ_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2012</option>
                <option value="F j Y"<?php if($OptionsVis['top_summ_date_format']=='F j Y') echo ' selected="selected"'; ?>>January 18 2012</option>
                <option value="F j, Y"<?php if($OptionsVis['top_summ_date_format']=='F j, Y') echo ' selected="selected"'; ?>>January 18, 2012</option>
                <option value="F jS, Y"<?php if($OptionsVis['top_summ_date_format']=='F jS, Y') echo ' selected="selected"'; ?>>January 4th, 2012</option>
                <option value="F Y"<?php if($OptionsVis['top_summ_date_format']=='F Y') echo ' selected="selected"'; ?>>January 2012</option>
                <option value="m-d-Y"<?php if($OptionsVis['top_summ_date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['top_summ_date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['top_summ_date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['top_summ_date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['top_summ_date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['top_summ_date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['top_summ_date_format']=='l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2012</option>
                <option value="l - j F Y"<?php if($OptionsVis['top_summ_date_format']=='l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2012</option>
                <option value="l, j F Y"<?php if($OptionsVis['top_summ_date_format']=='l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2012</option>
                <option value="l, j F, Y"<?php if($OptionsVis['top_summ_date_format']=='l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2012</option>
                <option value="l j F Y"<?php if($OptionsVis['top_summ_date_format']=='l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2012</option>
                <option value="l j F, Y"<?php if($OptionsVis['top_summ_date_format']=='l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2012</option>
                <option value="d F Y"<?php if($OptionsVis['top_summ_date_format']=='d F Y') echo ' selected="selected"'; ?>>18 January 2012</option>
                <option value="d F, Y"<?php if($OptionsVis['top_summ_date_format']=='d F, Y') echo ' selected="selected"'; ?>>18 January, 2012</option>
                <option value="d-m-Y"<?php if($OptionsVis['top_summ_date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['top_summ_date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['top_summ_date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['top_summ_date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['top_summ_date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['top_summ_date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td class="langLeft">News summary showing the time:</td>
        <td valign="top">
        	<select name="top_summ_showing_time">
            	<option value=""<?php if($OptionsVis['top_summ_showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['top_summ_showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['top_summ_showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">News content style: </td>
      </tr>
      <tr>
        <td class="langLeft">News content color:</td>
        <td valign="top"><input name="top_cont_color" type="text" size="7" value="<?php echo $OptionsVis["top_cont_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_cont_color"]); ?>;background-color:<?php echo $OptionsVis["top_cont_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_cont_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">News content font-family:</td>
        <td valign="top">
        	<select name="top_cont_font">
            	<option value="Arial"<?php if($OptionsVis['top_cont_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['top_cont_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['top_cont_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['top_cont_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['top_cont_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['top_cont_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['top_cont_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['top_cont_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['top_cont_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['top_cont_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['top_cont_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['top_cont_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['top_cont_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['top_cont_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content font-size:</td>
        <td valign="top">
        	<select name="top_cont_size">
            	<option value="inherit"<?php if($OptionsVis['top_cont_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['top_cont_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_cont_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['top_cont_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['top_cont_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_cont_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['top_cont_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_cont_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_cont_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content font-style:</td>
        <td valign="top">
        	<select name="top_cont_font_style">
            	<option value="normal"<?php if($OptionsVis['top_cont_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['top_cont_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['top_cont_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['top_cont_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content text-align:</td>
        <td valign="top">
        	<select name="top_cont_text_align">
            	<option value="center"<?php if($OptionsVis['top_cont_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['top_cont_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['top_cont_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['top_cont_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['top_cont_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News content line-height:</td>
        <td valign="top">
        	<select name="top_cont_line_height">
            	<option value="inherit"<?php if($OptionsVis['top_cont_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="12px"<?php if($OptionsVis['top_cont_line_height']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['top_cont_line_height']=='13px') echo ' selected="selected"'; ?>>13px</option>
            	<option value="14px"<?php if($OptionsVis['top_cont_line_height']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['top_cont_line_height']=='15px') echo ' selected="selected"'; ?>>15px</option>
                <option value="16px"<?php if($OptionsVis['top_cont_line_height']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_cont_line_height']=='18px') echo ' selected="selected"'; ?>>18px</option>
            	<option value="20px"<?php if($OptionsVis['top_cont_line_height']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['top_cont_line_height']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['top_cont_line_height']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['top_cont_line_height']=='26px') echo ' selected="selected"'; ?>>26px</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">News summary style: </td>
      </tr>
      <tr>
        <td class="langLeft">News summary color:</td>
        <td valign="top"><input name="top_summ_color" type="text" size="7" value="<?php echo $OptionsVis["top_summ_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_summ_color"]); ?>;background-color:<?php echo $OptionsVis["top_summ_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_summ_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">News summary font-family:</td>
        <td valign="top">
        	<select name="top_summ_font">
            	<option value="Arial"<?php if($OptionsVis['top_summ_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['top_summ_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['top_summ_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['top_summ_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['top_summ_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['top_summ_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['top_summ_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['top_summ_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['top_summ_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['top_summ_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['top_summ_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['top_summ_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['top_summ_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary font-size:</td>
        <td valign="top">
        	<select name="top_summ_size">
            	<option value="inherit"<?php if($OptionsVis['top_summ_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['top_summ_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_summ_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['top_summ_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['top_summ_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_summ_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['top_summ_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_summ_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_summ_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary font-style:</td>
        <td valign="top">
        	<select name="top_summ_font_style">
            	<option value="normal"<?php if($OptionsVis['top_summ_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['top_summ_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['top_summ_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary text-align:</td>
        <td valign="top">
        	<select name="top_summ_text_align">
            	<option value="center"<?php if($OptionsVis['top_summ_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['top_summ_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['top_summ_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['top_summ_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['top_summ_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">News summary line-height:</td>
        <td valign="top">
        	<select name="top_summ_line_height">
            	<option value="inherit"<?php if($OptionsVis['top_summ_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="12px"<?php if($OptionsVis['top_summ_line_height']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['top_summ_line_height']=='13px') echo ' selected="selected"'; ?>>13px</option>
            	<option value="14px"<?php if($OptionsVis['top_summ_line_height']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['top_summ_line_height']=='15px') echo ' selected="selected"'; ?>>15px</option>
                <option value="16px"<?php if($OptionsVis['top_summ_line_height']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_summ_line_height']=='18px') echo ' selected="selected"'; ?>>18px</option>
            	<option value="20px"<?php if($OptionsVis['top_summ_line_height']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['top_summ_line_height']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['top_summ_line_height']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="26px"<?php if($OptionsVis['top_summ_line_height']=='26px') echo ' selected="selected"'; ?>>26px</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Show image in the news listing:</td>
        <td valign="top">
        	<select name="top_summ_show_image">
            	<option value="yes"<?php if($OptionsVis['top_summ_show_image']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['top_summ_show_image']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Summary image width:</td>
        <td valign="top"><input name="top_summ_img_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["top_summ_img_width"]); ?>" />px</td>
      </tr>  
      <tr>
        <td class="langLeft">Summary image height:</td>
        <td valign="top"><input name="top_summ_img_height" type="text" size="4" value="<?php echo ReadDB($OptionsVis["top_summ_img_height"]); ?>" />px - leave empty if you don't want fixed height</td>
      </tr>   
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">Highlighted Top News style: </td>
      </tr>
      <tr>
        <td class="langLeft">HighLight background-color:</td>
        <td valign="top"><input name="top_hl_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["top_hl_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_hl_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["top_hl_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_hl_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Highlight Padding:</td>
        <td valign="top">
        	<select name="top_hl_padding">
            	<option value="0px"<?php if($OptionsVis['top_hl_padding']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['top_hl_padding']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['top_hl_padding']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['top_hl_padding']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['top_hl_padding']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['top_hl_padding']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['top_hl_padding']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['top_hl_padding']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['top_hl_padding']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['top_hl_padding']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_hl_padding']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['top_hl_padding']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['top_hl_padding']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_hl_padding']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['top_hl_padding']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="17px"<?php if($OptionsVis['top_hl_padding']=='17px') echo ' selected="selected"'; ?>>17px</option>
                <option value="18px"<?php if($OptionsVis['top_hl_padding']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="19px"<?php if($OptionsVis['top_hl_padding']=='19px') echo ' selected="selected"'; ?>>19px</option>
                <option value="20px"<?php if($OptionsVis['top_hl_padding']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
                  
      <tr>
        <td colspan="3" class="subinfo">News 'Back' link: </td>
      </tr>
      
      <tr>
        <td class="langLeft">Back link font-size:</td>
        <td valign="top">
        	<select name="top_link_font_size">
            	<option value="inherit"<?php if($OptionsVis['top_link_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <option value="10px"<?php if($OptionsVis['top_link_font_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['top_link_font_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['top_link_font_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_link_font_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
            	<option value="16px"<?php if($OptionsVis['top_link_font_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_link_font_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Back link font color:</td>
        <td valign="top"><input name="top_link_color" type="text" size="7" value="<?php echo $OptionsVis["top_link_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["top_link_color"]); ?>;background-color:<?php echo $OptionsVis["top_link_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.top_link_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Back link font-weight:</td>
        <td valign="top">
        	<select name="top_link_font_weight">
            	<option value="normal"<?php if($OptionsVis['top_link_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['top_link_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['top_link_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Back link alignment:</td>
        <td valign="top">
        	<select name="top_link_align">
            	<option value="left"<?php if($OptionsVis['top_link_align']=='left') echo ' selected="selected"'; ?>>left</option>
            	<option value="center"<?php if($OptionsVis['top_link_align']=='center') echo ' selected="selected"'; ?>>center</option>
                <option value="right"<?php if($OptionsVis['top_link_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['top_link_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">'Share This' button below the articles: </td>
      </tr>
      <tr>
        <td class="langLeft">Show 'Share This' button below the articles:</td>
        <td valign="top">
        	<select name="top_show_share_this">
            	<option value="yes"<?php if($OptionsVis['top_show_share_this']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['top_show_share_this']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">'Share This' button alignment:</td>
        <td valign="top">
        	<select name="top_share_this_align">
            	<option value="left"<?php if($OptionsVis['top_share_this_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['top_share_this_align']=='right') echo ' selected="selected"'; ?>>right</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">Distances: </td>
      </tr>
      
      <tr>
        <td class="langLeft">Distance between title and date:</td>
        <td valign="top">
        	<select name="top_dist_title_date">
            	<option value="0px"<?php if($OptionsVis['top_dist_title_date']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['top_dist_title_date']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['top_dist_title_date']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['top_dist_title_date']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['top_dist_title_date']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['top_dist_title_date']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['top_dist_title_date']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['top_dist_title_date']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['top_dist_title_date']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['top_dist_title_date']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_dist_title_date']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['top_dist_title_date']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['top_dist_title_date']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_dist_title_date']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['top_dist_title_date']=='16px') echo ' selected="selected"'; ?>>16px</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between title and date in the summary:</td>
        <td valign="top">
        	<select name="top_summ_dist_title_date">
            	<option value="0px"<?php if($OptionsVis['top_summ_dist_title_date']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['top_summ_dist_title_date']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['top_summ_dist_title_date']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['top_summ_dist_title_date']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['top_summ_dist_title_date']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['top_summ_dist_title_date']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['top_summ_dist_title_date']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['top_summ_dist_title_date']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['top_summ_dist_title_date']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['top_summ_dist_title_date']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_summ_dist_title_date']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['top_summ_dist_title_date']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['top_summ_dist_title_date']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_summ_dist_title_date']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['top_summ_dist_title_date']=='16px') echo ' selected="selected"'; ?>>16px</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between date and news content:</td>
        <td valign="top">
        	<select name="top_dist_date_text">
            	<option value="0px"<?php if($OptionsVis['top_dist_date_text']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['top_dist_date_text']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['top_dist_date_text']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['top_dist_date_text']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['top_dist_date_text']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['top_dist_date_text']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['top_dist_date_text']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['top_dist_date_text']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['top_dist_date_text']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['top_dist_date_text']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_dist_date_text']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['top_dist_date_text']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['top_dist_date_text']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_dist_date_text']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['top_dist_date_text']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_dist_date_text']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_dist_date_text']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between date and news summary:</td>
        <td valign="top">
        	<select name="top_summ_dist_date_text">
            	<option value="0px"<?php if($OptionsVis['top_summ_dist_date_text']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['top_summ_dist_date_text']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['top_summ_dist_date_text']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['top_summ_dist_date_text']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['top_summ_dist_date_text']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['top_summ_dist_date_text']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['top_summ_dist_date_text']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['top_summ_dist_date_text']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['top_summ_dist_date_text']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['top_summ_dist_date_text']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_summ_dist_date_text']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['top_summ_dist_date_text']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['top_summ_dist_date_text']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_summ_dist_date_text']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['top_summ_dist_date_text']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_summ_dist_date_text']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_summ_dist_date_text']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance between news in the news listing(summaries):</td>
        <td valign="top">
        	<select name="top_dist_btw_news">
            	<option value="2px"<?php if($OptionsVis['top_dist_btw_news']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['top_dist_btw_news']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['top_dist_btw_news']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['top_dist_btw_news']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['top_dist_btw_news']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['top_dist_btw_news']=='7px') echo ' selected="selected"'; ?>>7px</option>
                <option value="8px"<?php if($OptionsVis['top_dist_btw_news']=='8px') echo ' selected="selected"'; ?>>8px</option>
                <option value="9px"<?php if($OptionsVis['top_dist_btw_news']=='9px') echo ' selected="selected"'; ?>>9px</option>
            	<option value="10px"<?php if($OptionsVis['top_dist_btw_news']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="12px"<?php if($OptionsVis['top_dist_btw_news']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_dist_btw_news']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['top_dist_btw_news']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_dist_btw_news']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_dist_btw_news']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['top_dist_btw_news']=='22px') echo ' selected="selected"'; ?>>22px</option>
            	<option value="24px"<?php if($OptionsVis['top_dist_btw_news']=='24px') echo ' selected="selected"'; ?>>24px</option>
            	<option value="26px"<?php if($OptionsVis['top_dist_btw_news']=='26px') echo ' selected="selected"'; ?>>26px</option>
                <option value="28px"<?php if($OptionsVis['top_dist_btw_news']=='28px') echo ' selected="selected"'; ?>>28px</option>
                <option value="30px"<?php if($OptionsVis['top_dist_btw_news']=='30px') echo ' selected="selected"'; ?>>30px</option>
            	<option value="32px"<?php if($OptionsVis['top_dist_btw_news']=='32px') echo ' selected="selected"'; ?>>32px</option>
                <option value="36px"<?php if($OptionsVis['top_dist_btw_news']=='36px') echo ' selected="selected"'; ?>>36px</option>
                <option value="40px"<?php if($OptionsVis['top_dist_btw_news']=='40px') echo ' selected="selected"'; ?>>40px</option>
                <option value="44px"<?php if($OptionsVis['top_dist_btw_news']=='44px') echo ' selected="selected"'; ?>>44px</option>
                <option value="48px"<?php if($OptionsVis['top_dist_btw_news']=='48px') echo ' selected="selected"'; ?>>48px</option>
                <option value="50px"<?php if($OptionsVis['top_dist_btw_news']=='50px') echo ' selected="selected"'; ?>>50px</option>
                <option value="55px"<?php if($OptionsVis['top_dist_btw_news']=='55px') echo ' selected="selected"'; ?>>55px</option>
                <option value="60px"<?php if($OptionsVis['top_dist_btw_news']=='60px') echo ' selected="selected"'; ?>>60px</option>
                <option value="65px"<?php if($OptionsVis['top_dist_btw_news']=='65px') echo ' selected="selected"'; ?>>65px</option>
                <option value="70px"<?php if($OptionsVis['top_dist_btw_news']=='70px') echo ' selected="selected"'; ?>>70px</option>
                <option value="80px"<?php if($OptionsVis['top_dist_btw_news']=='80px') echo ' selected="selected"'; ?>>80px</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Distance between 'Back' link and news title:</td>
        <td valign="top">
        	<select name="top_dist_link_title">
            	<option value="1px"<?php if($OptionsVis['top_dist_link_title']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['top_dist_link_title']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['top_dist_link_title']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['top_dist_link_title']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['top_dist_link_title']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['top_dist_link_title']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['top_dist_link_title']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['top_dist_link_title']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['top_dist_link_title']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['top_dist_link_title']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['top_dist_link_title']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['top_dist_link_title']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['top_dist_link_title']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['top_dist_link_title']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['top_dist_link_title']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['top_dist_link_title']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit8" type="submit" value="Save" class="submitButton" /></td>
      </tr>
       
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Set news front-end visual style for Slider News Section.</td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">General style: </td>
      </tr>
      <tr>
        <td class="langLeft">General slider width:</td>
        <td valign="top"><input name="sl_gen_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["sl_gen_width"]); ?>" />px</td>
      </tr>  
      <tr>
        <td class="langLeft">Border Color:</td>
        <td valign="top"><input name="sl_gen_bordercolor" type="text" size="7" value="<?php echo $OptionsVis["sl_gen_bordercolor"]; ?>" style="color:<?php echo invert_colour($OptionsVis["sl_gen_bordercolor"]); ?>;background-color:<?php echo $OptionsVis["sl_gen_bordercolor"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.sl_gen_bordercolor,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Number of slides per page:</td>
        <td valign="top"><input name="sl_gen_number" type="text" size="4" value="<?php echo ReadDB($OptionsVis["sl_gen_number"]); ?>" /> <sub> - recommended number 3, 4 or 5</sub></td>
      </tr>
      <tr>
        <td class="langLeft">SlideShow interval:</td>
        <td valign="top"><input name="sl_gen_interval" type="text" size="4" value="<?php echo ReadDB($OptionsVis["sl_gen_interval"]); ?>" /> seconds</td>
      </tr>
      <tr>
        <td class="langLeft">Background Color:</td>
        <td valign="top"><input name="sl_gen_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["sl_gen_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["sl_gen_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["sl_gen_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.sl_gen_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      <tr>
        <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">Image style: </td>
      </tr>
      <tr>
        <td class="langLeft">Width:</td>
        <td valign="top"><input name="sl_img_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["sl_img_width"]); ?>" />px</td>
      </tr>  
      <tr>
        <td class="langLeft">Height:</td>
        <td valign="top"><input name="sl_img_height" type="text" size="4" value="<?php echo ReadDB($OptionsVis["sl_img_height"]); ?>" />px</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      <tr>
        <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">Title style: </td>
      </tr>
      <tr>
        <td class="langLeft">Font-family:</td>
        <td valign="top">
        	<select name="sl_title_font_family">
            	<option value="Arial"<?php if($OptionsVis['sl_title_font_family']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['sl_title_font_family']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['sl_title_font_family']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['sl_title_font_family']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['sl_title_font_family']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['sl_title_font_family']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['sl_title_font_family']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['sl_title_font_family']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['sl_title_font_family']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['sl_title_font_family']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['sl_title_font_family']=='Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['sl_title_font_family']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['sl_title_font_family']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['sl_title_font_family']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td valign="top">
        	<select name="sl_title_font_size">
            	<option value="inherit"<?php if($OptionsVis['sl_title_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="10"<?php if($OptionsVis['sl_title_font_size']=='10') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11"<?php if($OptionsVis['sl_title_font_size']=='11') echo ' selected="selected"'; ?>>11px</option>
                <option value="12"<?php if($OptionsVis['sl_title_font_size']=='12') echo ' selected="selected"'; ?>>12px</option>
                <option value="13"<?php if($OptionsVis['sl_title_font_size']=='13') echo ' selected="selected"'; ?>>13px</option>
                <option value="14"<?php if($OptionsVis['sl_title_font_size']=='14') echo ' selected="selected"'; ?>>14px</option>
                <option value="15"<?php if($OptionsVis['sl_title_font_size']=='15') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16"<?php if($OptionsVis['sl_title_font_size']=='16') echo ' selected="selected"'; ?>>16px</option>
                <option value="17"<?php if($OptionsVis['sl_title_font_size']=='17') echo ' selected="selected"'; ?>>17px</option>
                <option value="18"<?php if($OptionsVis['sl_title_font_size']=='18') echo ' selected="selected"'; ?>>18px</option>
                <option value="19"<?php if($OptionsVis['sl_title_font_size']=='19') echo ' selected="selected"'; ?>>19px</option>
                <option value="20"<?php if($OptionsVis['sl_title_font_size']=='20') echo ' selected="selected"'; ?>>20px</option>
                <option value="21"<?php if($OptionsVis['sl_title_font_size']=='21') echo ' selected="selected"'; ?>>21px</option>
                <option value="22"<?php if($OptionsVis['sl_title_font_size']=='22') echo ' selected="selected"'; ?>>22px</option>
                <option value="23"<?php if($OptionsVis['sl_title_font_size']=='23') echo ' selected="selected"'; ?>>23px</option>
                <option value="24"<?php if($OptionsVis['sl_title_font_size']=='24') echo ' selected="selected"'; ?>>24px</option>
            </select>
        </td>
      </tr> 
      
      <tr>
        <td class="langLeft">Color:</td>
        <td valign="top"><input name="sl_title_color" type="text" size="7" value="<?php echo $OptionsVis["sl_title_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["sl_title_color"]); ?>;background-color:<?php echo $OptionsVis["sl_title_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.sl_title_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      <tr>
        <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">Summary text style: </td>
      </tr>
      <tr>
        <td class="langLeft">Show summary text:</td>
        <td valign="top">
        	<select name="sl_show_summ_text">
            	<option value="yes"<?php if($OptionsVis['sl_show_summ_text']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['sl_show_summ_text']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td valign="top">
        	<select name="sl_summ_font_family">
            	<option value="Arial"<?php if($OptionsVis['sl_summ_font_family']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['sl_summ_font_family']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['sl_summ_font_family']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['sl_summ_font_family']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['sl_summ_font_family']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['sl_summ_font_family']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['sl_summ_font_family']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['sl_summ_font_family']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['sl_summ_font_family']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['sl_summ_font_family']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['sl_summ_font_family']=='Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['sl_summ_font_family']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['sl_summ_font_family']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['sl_summ_font_family']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td valign="top">
        	<select name="sl_summ_font_size">
            	<option value="inherit"<?php if($OptionsVis['sl_summ_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="10"<?php if($OptionsVis['sl_summ_font_size']=='10') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11"<?php if($OptionsVis['sl_summ_font_size']=='11') echo ' selected="selected"'; ?>>11px</option>
                <option value="12"<?php if($OptionsVis['sl_summ_font_size']=='12') echo ' selected="selected"'; ?>>12px</option>
                <option value="13"<?php if($OptionsVis['sl_summ_font_size']=='13') echo ' selected="selected"'; ?>>13px</option>
                <option value="14"<?php if($OptionsVis['sl_summ_font_size']=='14') echo ' selected="selected"'; ?>>14px</option>
                <option value="15"<?php if($OptionsVis['sl_summ_font_size']=='15') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16"<?php if($OptionsVis['sl_summ_font_size']=='16') echo ' selected="selected"'; ?>>16px</option>
                <option value="17"<?php if($OptionsVis['sl_summ_font_size']=='17') echo ' selected="selected"'; ?>>17px</option>
                <option value="18"<?php if($OptionsVis['sl_summ_font_size']=='18') echo ' selected="selected"'; ?>>18px</option>
            </select>
        </td>
      </tr> 
      
      <tr>
        <td class="langLeft">Color:</td>
        <td valign="top"><input name="sl_summ_color" type="text" size="7" value="<?php echo $OptionsVis["sl_summ_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["sl_summ_color"]); ?>;background-color:<?php echo $OptionsVis["sl_summ_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.sl_summ_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td class="langLeft">Number of characters in the summary:</td>
        <td valign="top"><input name="sl_summ_num_char" type="text" size="4" value="<?php echo ReadDB($OptionsVis["sl_summ_num_char"]); ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      <tr>
        <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">Sliding images at the bottom: </td>
      </tr>
      <tr>
        <td class="langLeft">Background Color:</td>
        <td valign="top"><input name="sl_bottom_bgrcolor" type="text" size="7" value="<?php echo $OptionsVis["sl_bottom_bgrcolor"]; ?>" style="color:<?php echo invert_colour($OptionsVis["sl_bottom_bgrcolor"]); ?>;background-color:<?php echo $OptionsVis["sl_bottom_bgrcolor"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.sl_bottom_bgrcolor,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td class="langLeft">Background Color when selected:</td>
        <td valign="top"><input name="sl_bottom_bgrcolsel" type="text" size="7" value="<?php echo $OptionsVis["sl_bottom_bgrcolsel"]; ?>" style="color:<?php echo invert_colour($OptionsVis["sl_bottom_bgrcolsel"]); ?>;background-color:<?php echo $OptionsVis["sl_bottom_bgrcolsel"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.sl_bottom_bgrcolsel,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td class="langLeft">Height of the selected slide:</td>
        <td valign="top"><input name="sl_bottom_height" type="text" size="4" value="<?php echo ReadDB($OptionsVis["sl_bottom_height"]); ?>" />px &nbsp; <sub> - leave blanc if you don't want fixed height of the selected slides</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Keep the original proportion of the image slides:</td>
        <td valign="top">
        	<select name="sl_keep_proportion">
            	<option value="yes"<?php if($OptionsVis['sl_keep_proportion']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['sl_keep_proportion']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      
      
      <tr>
        <td colspan="3" class="subinfo" style="font-family: "Times New Roman", Times, serif">Titles under sliding images: </td>
      </tr>
      <tr>
        <td class="langLeft">Font-family:</td>
        <td valign="top">
        	<select name="title_im_font_family">
            	<option value="Arial"<?php if($OptionsVis['title_im_font_family']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['title_im_font_family']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['title_im_font_family']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['title_im_font_family']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['title_im_font_family']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['title_im_font_family']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['title_im_font_family']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['title_im_font_family']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['title_im_font_family']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['title_im_font_family']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['title_im_font_family']=='Times New Roman') echo ' selected="selected"'; ?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['title_im_font_family']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['title_im_font_family']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['title_im_font_family']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td valign="top">
        	<select name="title_im_font_size">
            	<option value="inherit"<?php if($OptionsVis['title_im_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="10"<?php if($OptionsVis['title_im_font_size']=='10') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11"<?php if($OptionsVis['title_im_font_size']=='11') echo ' selected="selected"'; ?>>11px</option>
                <option value="12"<?php if($OptionsVis['title_im_font_size']=='12') echo ' selected="selected"'; ?>>12px</option>
                <option value="13"<?php if($OptionsVis['title_im_font_size']=='13') echo ' selected="selected"'; ?>>13px</option>
                <option value="14"<?php if($OptionsVis['title_im_font_size']=='14') echo ' selected="selected"'; ?>>14px</option>
                <option value="15"<?php if($OptionsVis['title_im_font_size']=='15') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16"<?php if($OptionsVis['title_im_font_size']=='16') echo ' selected="selected"'; ?>>16px</option>
                <option value="17"<?php if($OptionsVis['title_im_font_size']=='17') echo ' selected="selected"'; ?>>17px</option>
                <option value="18"<?php if($OptionsVis['title_im_font_size']=='18') echo ' selected="selected"'; ?>>18px</option>
            </select>
        </td>
      </tr> 
      
      <tr>
        <td class="langLeft">Color:</td>
        <td valign="top"><input name="title_im_color" type="text" size="7" value="<?php echo $OptionsVis["title_im_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["title_im_color"]); ?>;background-color:<?php echo $OptionsVis["title_im_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.title_im_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="pick color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
    </table>  
	</form> 

<?php
} elseif ($_REQUEST["act"]=='visual_options_comm') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual_comm']);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsComm" />

    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Set comments front-end visual style.</td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">Comments listing visual style: </td>
      </tr>
      <tr>
        <td class="langLeft">Comments listing Borders:</td>
        <td valign="top">
        	<select name="comm_bord_sides">
            	<option value="all"<?php if($OptionsVis['comm_bord_sides']=='all') echo ' selected="selected"'; ?>>all sides</option>            	
            	<option value="top"<?php if($OptionsVis['comm_bord_sides']=='top') echo ' selected="selected"'; ?>>top</option>
                <option value="bottom"<?php if($OptionsVis['comm_bord_sides']=='bottom') echo ' selected="selected"'; ?>>bottom</option>
                <option value="top_bottom"<?php if($OptionsVis['comm_bord_sides']=='top_bottom') echo ' selected="selected"'; ?>>top and bottom</option>
                <option value="right"<?php if($OptionsVis['comm_bord_sides']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="left"<?php if($OptionsVis['comm_bord_sides']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right_left"<?php if($OptionsVis['comm_bord_sides']=='right_left') echo ' selected="selected"'; ?>>right and left</option>                <option value="none"<?php if($OptionsVis['comm_bord_sides']=='none') echo ' selected="selected"'; ?>>none</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments listing Border-style:</td>
        <td valign="top">
        	<select name="comm_bord_style">
            	<option value="solid"<?php if($OptionsVis['comm_bord_style']=='solid') echo ' selected="selected"'; ?>>solid</option>
            	<option value="double"<?php if($OptionsVis['comm_bord_style']=='double') echo ' selected="selected"'; ?>>double</option>
                <option value="dashed"<?php if($OptionsVis['comm_bord_style']=='dashed') echo ' selected="selected"'; ?>>dashed</option>
                <option value="dotted"<?php if($OptionsVis['comm_bord_style']=='dotted') echo ' selected="selected"'; ?>>dotted</option>
                <option value="outset"<?php if($OptionsVis['comm_bord_style']=='outset') echo ' selected="selected"'; ?>>outset</option>
                <option value="inset"<?php if($OptionsVis['comm_bord_style']=='inset') echo ' selected="selected"'; ?>>inset</option>
                <option value="groove"<?php if($OptionsVis['comm_bord_style']=='groove') echo ' selected="selected"'; ?>>groove</option>
                <option value="ridge"<?php if($OptionsVis['comm_bord_style']=='ridge') echo ' selected="selected"'; ?>>ridge</option>
                <option value="none"<?php if($OptionsVis['comm_bord_style']=='none') echo ' selected="selected"'; ?>>none</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments listing Border-width:</td>
        <td valign="top">
        	<select name="comm_bord_width">
            	<option value="0px"<?php if($OptionsVis['comm_bord_width']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['comm_bord_width']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['comm_bord_width']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['comm_bord_width']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['comm_bord_width']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['comm_bord_width']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['comm_bord_width']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['comm_bord_width']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['comm_bord_width']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['comm_bord_width']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['comm_bord_width']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['comm_bord_width']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['comm_bord_width']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['comm_bord_width']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['comm_bord_width']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['comm_bord_width']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['comm_bord_width']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments listing Border-color:</td>
        <td valign="top"><input name="comm_bord_color" type="text" size="7" value="<?php echo $OptionsVis["comm_bord_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["comm_bord_color"]); ?>;background-color:<?php echo $OptionsVis["comm_bord_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.comm_bord_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy.</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Comments listing padding:</td>
        <td valign="top">
        	<select name="comm_padding">
            	<option value="0px"<?php if($OptionsVis['comm_padding']=='0px') echo ' selected="selected"'; ?>>0px</option>
            	<option value="1px"<?php if($OptionsVis['comm_padding']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['comm_padding']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['comm_padding']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['comm_padding']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['comm_padding']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['comm_padding']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['comm_padding']=='7px') echo ' selected="selected"'; ?>>7px</option>
            	<option value="8px"<?php if($OptionsVis['comm_padding']=='8px') echo ' selected="selected"'; ?>>8px</option>
            	<option value="9px"<?php if($OptionsVis['comm_padding']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['comm_padding']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['comm_padding']=='11px') echo ' selected="selected"'; ?>>11px</option>
            	<option value="12px"<?php if($OptionsVis['comm_padding']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="14px"<?php if($OptionsVis['comm_padding']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="16px"<?php if($OptionsVis['comm_padding']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['comm_padding']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['comm_padding']=='20px') echo ' selected="selected"'; ?>>20px</option>
                <option value="22px"<?php if($OptionsVis['comm_padding']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="24px"<?php if($OptionsVis['comm_padding']=='24px') echo ' selected="selected"'; ?>>24px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments listing background color:</td>
        <td valign="top"><input name="comm_bgr_color" type="text" size="7" value="<?php echo $OptionsVis["comm_bgr_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["comm_bgr_color"]); ?>;background-color:<?php echo $OptionsVis["comm_bgr_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.comm_bgr_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy. Leave blank if you don't want this option</sub></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      
      <tr>
        <td colspan="3" class="subinfo">Comment name style: </td>
      </tr>
      <tr>
        <td class="langLeft">Comment name font color:</td>
        <td valign="top"><input name="name_font_color" type="text" size="7" value="<?php echo $OptionsVis["name_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["name_font_color"]); ?>;background-color:<?php echo $OptionsVis["name_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.name_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Comment name font-size:</td>
        <td valign="top">
        	<select name="name_font_size">
            	<option value="inherit"<?php if($OptionsVis['name_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <option value="9px"<?php if($OptionsVis['name_font_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['name_font_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['name_font_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['name_font_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['name_font_size']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['name_font_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['name_font_size']=='15px') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16px"<?php if($OptionsVis['name_font_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['name_font_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['name_font_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Comment name font-style:</td>
        <td valign="top">
        	<select name="name_font_style">
            	<option value="normal"<?php if($OptionsVis['name_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['name_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['name_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comment name font-weight:</td>
        <td valign="top">
        	<select name="name_font_weight">
            	<option value="normal"<?php if($OptionsVis['name_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['name_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['name_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit10" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      
      <tr>
        <td colspan="3" class="subinfo">Comments date style: </td>
      </tr>
      <tr>
        <td class="langLeft">Comments date color:</td>
        <td valign="top"><input name="comm_date_color" type="text" size="7" value="<?php echo $OptionsVis["comm_date_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["comm_date_color"]); ?>;background-color:<?php echo $OptionsVis["comm_date_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.comm_date_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>
      <tr>
        <td class="langLeft">Comments date font-family:</td>
        <td valign="top">
        	<select name="comm_date_font">
            	<option value="Arial"<?php if($OptionsVis['comm_date_font']=='Arial') echo ' selected="selected"'; ?>>Arial</option>
                <option value="Arial Black"<?php if($OptionsVis['comm_date_font']=='Arial Black') echo ' selected="selected"'; ?>>Arial Black</option>
                <option value="Book Antiqua"<?php if($OptionsVis['comm_date_font']=='Book Antiqua') echo ' selected="selected"'; ?>>Book Antiqua</option>
                <option value="Courier New"<?php if($OptionsVis['comm_date_font']=='Courier New') echo ' selected="selected"'; ?>>Courier New</option>
                <option value="Gadget"<?php if($OptionsVis['comm_date_font']=='Gadget') echo ' selected="selected"'; ?>>Gadget</option>
            	<option value="Georgia"<?php if($OptionsVis['comm_date_font']=='Georgia') echo ' selected="selected"'; ?>>Georgia</option>
                <option value="Helvetica"<?php if($OptionsVis['comm_date_font']=='Helvetica') echo ' selected="selected"'; ?>>Helvetica</option>
                <option value="Lucida Sans Unicode"<?php if($OptionsVis['comm_date_font']=='Lucida Sans Unicode') echo ' selected="selected"'; ?>>Lucida Sans Unicode</option>
                <option value="Palatino Linotype"<?php if($OptionsVis['comm_date_font']=='Palatino Linotype') echo ' selected="selected"'; ?>>Palatino Linotype</option>
                <option value="Tahoma"<?php if($OptionsVis['comm_date_font']=='Tahoma') echo ' selected="selected"'; ?>>Tahoma</option>
                <option value="Times New Roman"<?php if($OptionsVis['comm_date_font']=='Times New Roman') echo ' selected="selected"';?>>Times New Roman</option>
                <option value="Trebuchet MS"<?php if($OptionsVis['comm_date_font']=='Trebuchet MS') echo ' selected="selected"'; ?>>Trebuchet MS</option>
                <option value="Verdana"<?php if($OptionsVis['comm_date_font']=='Verdana') echo ' selected="selected"'; ?>>Verdana</option>
                <option value="inherit"<?php if($OptionsVis['comm_date_font']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments date font-size:</td>
        <td valign="top">
        	<select name="comm_date_size">
            	<option value="inherit"<?php if($OptionsVis['comm_date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<option value="9px"<?php if($OptionsVis['comm_date_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['comm_date_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['comm_date_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['comm_date_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['comm_date_size']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['comm_date_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['comm_date_size']=='15px') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16px"<?php if($OptionsVis['comm_date_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['comm_date_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['comm_date_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comments date font-style:</td>
        <td valign="top">
        	<select name="comm_date_font_style">
            	<option value="normal"<?php if($OptionsVis['comm_date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['comm_date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['comm_date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['comm_date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Comments date format:</td>
        <td valign="top">
        	<select name="comm_date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['comm_date_format']=='l - F j, Y') echo ' selected="selected"'; ?>>Monday - January 18, 2012</option>
                <option value="l - F j Y"<?php if($OptionsVis['comm_date_format']=='l - F j Y') echo ' selected="selected"'; ?>>Monday - January 18 2012</option>
                <option value="l, F j Y"<?php if($OptionsVis['comm_date_format']=='l, F j Y') echo ' selected="selected"'; ?>>Monday, January 18 2012</option>
            	<option value="l, F j, Y"<?php if($OptionsVis['comm_date_format']=='l, F j, Y') echo ' selected="selected"'; ?>>Monday, January 18, 2012</option>
                <option value="l F j Y"<?php if($OptionsVis['comm_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18 2012</option>
                <option value="l F j, Y"<?php if($OptionsVis['comm_date_format']=='l F j Y') echo ' selected="selected"'; ?>>Monday January 18, 2012</option>
                <option value="F j Y"<?php if($OptionsVis['comm_date_format']=='F j Y') echo ' selected="selected"'; ?>>January 18 2012</option>
                <option value="F j, Y"<?php if($OptionsVis['comm_date_format']=='F j, Y') echo ' selected="selected"'; ?>>January 18, 2012</option>
                <option value="F jS, Y"<?php if($OptionsVis['comm_date_format']=='F jS, Y') echo ' selected="selected"'; ?>>January 4th, 2012</option>
                <option value="F Y"<?php if($OptionsVis['comm_date_format']=='F Y') echo ' selected="selected"'; ?>>January 2012</option>
                <option value="m-d-Y"<?php if($OptionsVis['comm_date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['comm_date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['comm_date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['comm_date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['comm_date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['comm_date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['comm_date_format']=='l - j F, Y') echo ' selected="selected"'; ?>>Monday - 18 January, 2012</option>
                <option value="l - j F Y"<?php if($OptionsVis['comm_date_format']=='l - j F Y') echo ' selected="selected"'; ?>>Monday - 18 January 2012</option>
                <option value="l, j F Y"<?php if($OptionsVis['comm_date_format']=='l, j F Y') echo ' selected="selected"'; ?>>Monday, 18 January 2012</option>
                <option value="l, j F, Y"<?php if($OptionsVis['comm_date_format']=='l, j F, Y') echo ' selected="selected"'; ?>>Monday, 18 January, 2012</option>
                <option value="l j F Y"<?php if($OptionsVis['comm_date_format']=='l j F Y') echo ' selected="selected"'; ?>>Monday 18 January 2012</option>
                <option value="l j F, Y"<?php if($OptionsVis['comm_date_format']=='l j F, Y') echo ' selected="selected"'; ?>>Monday 18 January, 2012</option>
                <option value="d F Y"<?php if($OptionsVis['comm_date_format']=='d F Y') echo ' selected="selected"'; ?>>18 January 2012</option>
                <option value="d F, Y"<?php if($OptionsVis['comm_date_format']=='d F, Y') echo ' selected="selected"'; ?>>18 January, 2012</option>
                <option value="d-m-Y"<?php if($OptionsVis['comm_date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['comm_date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['comm_date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['comm_date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['comm_date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['comm_date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Showing comment time:</td>
        <td valign="top">
        	<select name="comm_showing_time">
            	<option value=""<?php if($OptionsVis['comm_showing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['comm_showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['comm_showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      
      <tr>
        <td colspan="3" class="subinfo">Comment text style: </td>
      </tr>
      <tr>
        <td class="langLeft">Comment name font color:</td>
        <td valign="top"><input name="comm_font_color" type="text" size="7" value="<?php echo $OptionsVis["comm_font_color"]; ?>" style="color:<?php echo invert_colour($OptionsVis["comm_font_color"]); ?>;background-color:<?php echo $OptionsVis["comm_font_color"]; ?>" /><a href="javascript:void(0)" onClick="cp.select(form.comm_font_color,'pickcolor');return false;" id="pickcolor"><img src="images/color_picker.jpg" alt="select color" width="20" height="20" border="0" align="absmiddle" /></a> &nbsp; <sub> - you can pick the color from pallette or you can put it manualy</sub></td>
      </tr>      
      <tr>
        <td class="langLeft">Comment text font-size:</td>
        <td valign="top">
        	<select name="comm_font_size">
            	<option value="inherit"<?php if($OptionsVis['comm_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <option value="9px"<?php if($OptionsVis['comm_font_size']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['comm_font_size']=='10px') echo ' selected="selected"'; ?>>10px</option>
            	<option value="11px"<?php if($OptionsVis['comm_font_size']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['comm_font_size']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['comm_font_size']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['comm_font_size']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['comm_font_size']=='15px') echo ' selected="selected"'; ?>>15px</option>
            	<option value="16px"<?php if($OptionsVis['comm_font_size']=='16px') echo ' selected="selected"'; ?>>16px</option>
                <option value="18px"<?php if($OptionsVis['comm_font_size']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="20px"<?php if($OptionsVis['comm_font_size']=='20px') echo ' selected="selected"'; ?>>20px</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Comment text font-style:</td>
        <td valign="top">
        	<select name="comm_font_style">
            	<option value="normal"<?php if($OptionsVis['comm_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['comm_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['comm_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Comment text font-weight:</td>
        <td valign="top">
        	<select name="comm_font_weight">
            	<option value="normal"<?php if($OptionsVis['comm_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['comm_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['comm_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit10" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      
      
      <tr>
        <td colspan="3" class="subinfo">Distances: </td>
      </tr>
      <tr>
        <td class="langLeft">Distance between comments:</td>
        <td valign="top">
        	<select name="dist_btw_comm">
            	<option value="0px"<?php if($OptionsVis['dist_btw_comm']=='0px') echo ' selected="selected"'; ?>>0px</option>
                <option value="1px"<?php if($OptionsVis['dist_btw_comm']=='1px') echo ' selected="selected"'; ?>>1px</option>
                <option value="2px"<?php if($OptionsVis['dist_btw_comm']=='2px') echo ' selected="selected"'; ?>>2px</option>
                <option value="3px"<?php if($OptionsVis['dist_btw_comm']=='3px') echo ' selected="selected"'; ?>>3px</option>
                <option value="4px"<?php if($OptionsVis['dist_btw_comm']=='4px') echo ' selected="selected"'; ?>>4px</option>
                <option value="5px"<?php if($OptionsVis['dist_btw_comm']=='5px') echo ' selected="selected"'; ?>>5px</option>
                <option value="6px"<?php if($OptionsVis['dist_btw_comm']=='6px') echo ' selected="selected"'; ?>>6px</option>
                <option value="7px"<?php if($OptionsVis['dist_btw_comm']=='7px') echo ' selected="selected"'; ?>>7px</option>
                <option value="8px"<?php if($OptionsVis['dist_btw_comm']=='8px') echo ' selected="selected"'; ?>>8px</option>
                <option value="9px"<?php if($OptionsVis['dist_btw_comm']=='9px') echo ' selected="selected"'; ?>>9px</option>
                <option value="10px"<?php if($OptionsVis['dist_btw_comm']=='10px') echo ' selected="selected"'; ?>>10px</option>
                <option value="11px"<?php if($OptionsVis['dist_btw_comm']=='11px') echo ' selected="selected"'; ?>>11px</option>
                <option value="12px"<?php if($OptionsVis['dist_btw_comm']=='12px') echo ' selected="selected"'; ?>>12px</option>
                <option value="13px"<?php if($OptionsVis['dist_btw_comm']=='13px') echo ' selected="selected"'; ?>>13px</option>
                <option value="14px"<?php if($OptionsVis['dist_btw_comm']=='14px') echo ' selected="selected"'; ?>>14px</option>
                <option value="15px"<?php if($OptionsVis['dist_btw_comm']=='15px') echo ' selected="selected"'; ?>>15px</option>
                <option value="16px"<?php if($OptionsVis['dist_btw_comm']=='16px') echo ' selected="selected"'; ?>>16px</option>
            	<option value="17px"<?php if($OptionsVis['dist_btw_comm']=='17px') echo ' selected="selected"'; ?>>17px</option>
            	<option value="18px"<?php if($OptionsVis['dist_btw_comm']=='18px') echo ' selected="selected"'; ?>>18px</option>
                <option value="19px"<?php if($OptionsVis['dist_btw_comm']=='19px') echo ' selected="selected"'; ?>>19px</option>
                <option value="20px"<?php if($OptionsVis['dist_btw_comm']=='20px') echo ' selected="selected"'; ?>>20px</option>
            	<option value="21px"<?php if($OptionsVis['dist_btw_comm']=='21px') echo ' selected="selected"'; ?>>21px</option>
                <option value="22px"<?php if($OptionsVis['dist_btw_comm']=='22px') echo ' selected="selected"'; ?>>22px</option>
                <option value="23px"<?php if($OptionsVis['dist_btw_comm']=='23px') echo ' selected="selected"'; ?>>23px</option>
                <option value="24px"<?php if($OptionsVis['dist_btw_comm']=='24px') echo ' selected="selected"'; ?>>24px</option>
                <option value="25px"<?php if($OptionsVis['dist_btw_comm']=='25px') echo ' selected="selected"'; ?>>25px</option>
                <option value="26px"<?php if($OptionsVis['dist_btw_comm']=='26px') echo ' selected="selected"'; ?>>26px</option>
                <option value="27px"<?php if($OptionsVis['dist_btw_comm']=='27px') echo ' selected="selected"'; ?>>27px</option>
                <option value="28px"<?php if($OptionsVis['dist_btw_comm']=='28px') echo ' selected="selected"'; ?>>28px</option>
                <option value="29px"<?php if($OptionsVis['dist_btw_comm']=='29px') echo ' selected="selected"'; ?>>29px</option>
                <option value="30px"<?php if($OptionsVis['dist_btw_comm']=='30px') echo ' selected="selected"'; ?>>30px</option>
                <option value="31px"<?php if($OptionsVis['dist_btw_comm']=='31px') echo ' selected="selected"'; ?>>31px</option>
                <option value="32px"<?php if($OptionsVis['dist_btw_comm']=='32px') echo ' selected="selected"'; ?>>32px</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
    </table>
	</form> 
  
    
<?php
} elseif ($_REQUEST["act"]=='language_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsLang = unserialize($Options['language']);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="frm">
	<input type="hidden" name="act" value="updateOptionsLanguage" />

    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">Translate front-end in your own language</td>
      </tr>
      <tr>
        <td colspan="3" class="subinfo">News navigation and paging: </td>
      </tr>
      
      <tr>
        <td class="langLeft">'Back' link:</td>
        <td valign="top"><input name="Back_to_home" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Back_to_home"]); ?>" />  &nbsp; <sub> - leave blank if you do not want 'Back' link </sub></td>
      </tr>  
      <tr>
        <td class="langLeft">'Read more' link:</td>
        <td valign="top"><input name="Read_more" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Read_more"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">'Search' button:</td>
        <td valign="top"><input name="Search_button" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Search_button"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Pagination "Previous":</td>
        <td valign="top"><input name="Previous" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Previous"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Pagination "Next":</td>
        <td valign="top"><input name="Next" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Next"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">No news published:</td>
        <td valign="top"><input name="No_news_published" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["No_news_published"]); ?>" /></td>
      </tr> 
      
      <tr>
        <td class="langLeft">Author:</td>
        <td valign="top"><input name="Author" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Author"]); ?>" /></td>
      </tr>   
            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">Days of the week in the date: </td>
      </tr>      
      <tr>
        <td class="langLeft">Monday:</td>
        <td valign="top"><input name="Monday" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["Monday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Tuesday:</td>
        <td valign="top"><input name="Tuesday" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["Tuesday"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Wednesday:</td>
        <td valign="top"><input name="Wednesday" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["Wednesday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Thursday:</td>
        <td valign="top"><input name="Thursday" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["Thursday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Friday:</td>
        <td valign="top"><input name="Friday" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["Friday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Saturday:</td>
        <td valign="top"><input name="Saturday" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["Saturday"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Sunday:</td>
        <td valign="top"><input name="Sunday" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["Sunday"]); ?>" /></td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      <tr>
        <td colspan="3" height="8" style="border-bottom:solid 1px #e4e4e4"></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">Months in the date: </td>
      </tr>      
      <tr>
        <td class="langLeft">January:</td>
        <td valign="top"><input name="January" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["January"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">February:</td>
        <td valign="top"><input name="February" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["February"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">March:</td>
        <td valign="top"><input name="March" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["March"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">April:</td>
        <td valign="top"><input name="April" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["April"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">May:</td>
        <td valign="top"><input name="May" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["May"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">June:</td>
        <td valign="top"><input name="June" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["June"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">July:</td>
        <td valign="top"><input name="July" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["July"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">August:</td>
        <td valign="top"><input name="August" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["August"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">September:</td>
        <td valign="top"><input name="September" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["September"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">October:</td>
        <td valign="top"><input name="October" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["October"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">November:</td>
        <td valign="top"><input name="November" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["November"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">December:</td>
        <td valign="top"><input name="December" type="text" size="30" value="<?php echo ReadHTML($OptionsLang["December"]); ?>" /></td>
      </tr>       
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8" style="border-bottom:solid 1px #e4e4e4"></td>
      </tr>
      
      
      <tr>
        <td colspan="3" class="subinfo">Post with comments page: </td>
      </tr>
      <tr>
        <td class="langLeft">Word 'Comments' under each article:</td>
        <td valign="top">
          <input name="Word_Comments" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Word_Comments"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">No comments posted:</td>
        <td valign="top">
          <input name="No_comments_posted" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["No_comments_posted"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Leave a Comment:</td>
        <td valign="top">
          <input name="Leave_Comment" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Leave_Comment"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Name:</td>
        <td valign="top"><input name="Comment_Name" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Comment_Name"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Email:</td>
        <td valign="top"><input name="Comment_Email" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Comment_Email"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Enter verification code:</td>
        <td valign="top"> <input name="Enter_verification_code" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Enter_verification_code"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Reqiured fields:</td>
        <td valign="top"><input name="Reqiured_fields" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Reqiured_fields"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Button 'Submit Comment':</td>
        <td valign="top"><input name="Submit_Comment" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Submit_Comment"]); ?>" /> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">System messages: </td>
      </tr>
      <tr>
        <td class="langLeft">Incorrect verification code:</td>
        <td valign="top">
          <input name="Incorrect_verification_code" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Incorrect_verification_code"]); ?>" />        </td>
      </tr>
            
      <tr>
        <td class="langLeft">Banned IP address used:</td>
        <td valign="top">
          <input name="Banned_ip_used" type="text" size="50" value="<?php echo ReadDB($OptionsLang["Banned_ip_used"]); ?>" />        </td>
      </tr> 
      <tr>
        <td class="langLeft">Banned word used:</td>
        <td valign="top">
          <input name="Banned_word_used" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Banned_word_used"]); ?>" />        </td>
      </tr>          
      <tr>
        <td class="langLeft">Your comment has been submitted:</td>
        <td valign="top"><input name="Comment_Submitted" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["Comment_Submitted"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">After approval of the administrator will be published:<br />
        <sub>/this message will appear if the option of approving post/comment is checked/</sub></td>
        <td valign="top"><input name="After_Approval_Admin" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["After_Approval_Admin"]); ?>" /></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">Popup messages when check the required fields: </td>
      </tr>
      <tr>
        <td class="langLeft">Please, fill all required fields:</td>
        <td valign="top"><input name="required_fields" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["required_fields"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Please, fill correct email address:</td>
        <td valign="top"><input name="correct_email" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["correct_email"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Please, enter verification code:</td>
        <td valign="top"><input name="field_code" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["field_code"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Please, enter verification answer:</td>
        <td valign="top"><input name="wrong_answer" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["wrong_answer"]); ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
      
      <tr>
        <td colspan="3" class="subinfo">Admin email subjects: </td>
      </tr>      
       <tr>
        <td class="langLeft">Email subject when new comment posted:</td>
        <td valign="top"><input name="New_comment_posted" type="text" size="50" value="<?php echo ReadHTML($OptionsLang["New_comment_posted"]); ?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
	</form>

<?php
} elseif ($_REQUEST["act"]=='html') {
?>
	<div class="pageDescr">There are two easy ways to put the news script on your website.</div>

	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the news to appear.</td>
      </tr>
      <tr>
      	<td class="putonwebpage">        	
        	<div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview.php&quot; width=&quot;100%&quot; height=&quot;700px&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot;&gt;&lt;/iframe&gt;   </div>     
        </td>
      </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">2) <strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the news to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>news.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	At the top of the php page (first line) you should put this line of code too so captcha image verification can work on the comment form.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php session_start(); ?&gt;</div>     
        </td>
      </tr>
            
    </table>
    
    
    <hr />
    
    <div class="pageDescr">There are two easy ways to put Top News section on your website.</div>

	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the Top News section to appear.</td>
      </tr>
      <tr>
      	<td class="putonwebpage">        	
        	<div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview_top.php&quot; width=&quot;100%&quot; height=&quot;700px&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot;&gt;&lt;/iframe&gt;   </div>     
        </td>
      </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">2) <strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the Top News section to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>newstop.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	At the top of the php page (first line) you should put this line of code too so captcha image verification can work on the comment form.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php session_start(); ?&gt;</div>     
        </td>
      </tr>
                  
    </table>
    
    <hr />
    
    <div class="pageDescr">There are two easy ways to put Archive News on your website.</div>

	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the archived news to appear.</td>
      </tr>
      <tr>
      	<td class="putonwebpage">        	
        	<div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview_archive.php&quot; width=&quot;100%&quot; height=&quot;700px&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot;&gt;&lt;/iframe&gt;   </div>     
        </td>
      </tr>
    </table>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">2) <strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the archived news to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>archive.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	At the top of the php page (first line) you should put this line of code too so captcha image verification can work on the comment form.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php session_start(); ?&gt;</div>     
        </td>
      </tr>
            
    </table>
    
    
    <hr />
    
    <div class="pageDescr">There is one easy way to put News Slyder on your website.</div>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode"><strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the News Slyder to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>slider.php&quot;); ?&gt; </div>     
        </td>
      </tr>
            
      <tr>
        <td class="putonwebpage">        	
        	<div>If you have any problems, please do not hesitate to contact us at info@newsscriptphp.com</div>     
        </td>
      </tr>
            
    </table>
    

<?php
} elseif ($_REQUEST["act"]=='rss') {
?>
    
    <div class="pageDescr">The RSS feed allows other people to keep track of your news using rss readers and to use your news on their websites. <br />
Every time you publish a new article it will appear on your RSS feed and every one using it will be informed about it.</div>
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode">You can view the RSS feed <a href="rss.php" target="_blank">here(in php)</a>, <a href="rss.xml" target="_blank">here(in xml)</a> or use one of the codes below to place it on your website as RSS link.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;a href=&quot;<?php echo $CONFIG["full_url"]; ?>rss.php&quot; target=&quot;_blank&quot;&gt;RSS feed&lt;/a&gt;</div>     
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;a href=&quot;<?php echo $CONFIG["full_url"]; ?>rss.xml&quot; target=&quot;_blank&quot;&gt;RSS feed&lt;/a&gt;</div>     
        </td>
      </tr>
            
    </table>
    
<?php
}
?>
</div>

<div class="clearfooter"></div>
<div class="blue_line"></div>
<div class="divProfiAnts"> <a class="footerlink" href="http://newsscriptphp.com" target="_blank">Product of ProfiAnts</a> </div>


<?php 
} else { ////// Login Form //////
?>
	<div class="loginDiv">
	<div class="message"><?php echo $message; ?></div>
    <form action="admin.php" method="post">
    <input type="hidden" name="act" value="login">
    <table border="0" cellspacing="0" cellpadding="0" class="loginTable">
      <tr>
        <td class="loginhead" height="57" valign="middle"><?php echo $lang['ADMIN_LOGIN']; ?></td>
      </tr>
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="8">
          <tr>
            <td class="userpass"><?php echo $lang['Username']; ?> </td>
            <td class="userpassfield"><input name="user" type="text" class="loginfield" /></td>
          </tr>
          <tr>
            <td class="userpass"><?php echo $lang['Password']; ?> </td>
            <td class="userpassfield"><input name="pass" type="password" class="loginfield" /></td>
          </tr>
          <tr>
            <td class="userpass">&nbsp;</td>
            <td class="userpassfield"><input type="submit" name="button" value="<?php echo $lang['Login']; ?>" class="loginButon" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="63" valign="bottom">&nbsp;</td>
      </tr>
    </table>
    </form>
    </div>
<?php 
}
?>
</center>
</body>
</html>