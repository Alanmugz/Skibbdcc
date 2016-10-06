<?php
error_reporting(0);
$installed = 'yes';
include("configs.php");

if (isset($_POST["install"]) and $_POST["install"]==1) {
	$message = '';
	$conn = mysql_connect($_REQUEST["hostname"], $_REQUEST["mysql_user"], $_REQUEST["mysql_password"]);
	if (!$conn) {
		$message = "<span style='color:red;'>MySQL login details are incorrect. Please, check your login details and contact your hosting company to verify them. If you have troubles just send us login details for your hosting account control panel and we will do the installation of the script for you for free.
		<br /> Error message: " . mysql_error() . "</span>";
	} else {
		$db = mysql_select_db($_REQUEST["mysql_database"], $conn);
		if (!$db) {
			$message = "<span style='color:red;'>Unable to select database. Database name is incorrect or is not created. Please check database name or create it.</span>";
		} else {
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["News"]."`;";
			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			$sql = "CREATE TABLE `".$TABLE["News"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `publish_date` datetime default NULL,
					  `status` varchar(50) default NULL,
					  `cat_id` varchar(10) default NULL,
					  `editor_id` varchar(10) default NULL,
					  `topnews` varchar(50) default NULL,
					  `highlight` varchar(50) default NULL,
					  `slider` varchar(10) default NULL,
					  `title` varchar(250) default NULL,
					  `summary` text,
					  `content` text,
					  `image` varchar(250) default NULL,
					  `imgpos` varchar(10) default NULL,
					  `imgwidth` varchar(10) default NULL,
					  `imgheight` varchar(10) default NULL,
					  `news_comments` varchar(50) default NULL,
					  `reviews` int(11) default NULL, 
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Archives"]."`;";
			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			$sql = "CREATE TABLE `".$TABLE["Archives"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `publish_date` datetime default NULL,
					  `status` varchar(50) default NULL,
					  `cat_id` varchar(10) default NULL,
					  `editor_id` varchar(10) default NULL,
					  `topnews` varchar(50) default NULL,
					  `highlight` varchar(50) default NULL,
					  `slider` varchar(10) default NULL,
					  `title` varchar(250) default NULL,
					  `summary` text,
					  `content` text,
					  `image` varchar(250) default NULL,
					  `imgpos` varchar(10) default NULL,
					  `imgwidth` varchar(10) default NULL,
					  `imgheight` varchar(10) default NULL,
					  `news_comments` varchar(50) default NULL,
					  `reviews` int(11) default NULL, 
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Categories"]."`;";
			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			$sql = "CREATE TABLE `".$TABLE["Categories"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `cat_name` varchar(250) default NULL,
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Comments"]."`;";
			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			$sql = "CREATE TABLE `".$TABLE["Comments"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `ipaddress` varchar(50) default NULL,
					  `publish_date` datetime default NULL,
					  `status` varchar(50) default NULL,
					  `news_id` varchar(11) default NULL,
					  `archive_id` varchar(11) default NULL,
					  `name` varchar(250) default NULL,
					  `email` varchar(250) default NULL,
					  `comment` text,
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Editors"]."`;";
			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			$sql = "CREATE TABLE `".$TABLE["Editors"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `editor_name` varchar(250) default NULL,
					  `editor_email` varchar(250) default NULL,
					  `editor_username` varchar(250) default NULL,
					  `editor_password` varchar(250) default NULL,
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Options"]."`;";
			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			$sql = "CREATE TABLE `".$TABLE["Options"]."` (
					  `options_id` int(11) NOT NULL auto_increment,
					  `per_page` varchar(10),
					  `shownews` varchar(20),
					  `news_top_num` varchar(10),					  
					  `shownews_top` varchar(20),
					  `news_slid_num` varchar(10),
					  `news_link` varchar(250),
					  `showsearch` varchar(10),
					  `publishon` varchar(10),
					  `time_offset` varchar(20),
					  `email` varchar(250),
					  `approval` varchar(10),
					  `commentsoff` varchar(10),
					  `comments_order` varchar(10),
					  `captcha` varchar(10),
					  `captcha_theme` varchar(20),
					  `verify_question` varchar(250),
					  `verify_answer` varchar(250),
					  `ban_words` text,
					  `ban_ips` text,
					  `visual` text,
					  `visual_top` text,
					  `visual_comm` text,
					  `language` text,
					  `visual_arch` text,
					  `language_arch` text,
					  PRIMARY KEY  (`options_id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
			$sql = 'INSERT INTO `'.$TABLE["Options"].'` 
					SET `per_page`="10",
						`shownews`="TitleAndSummary", 
						`news_top_num`="3",
						`shownews_top`="TitleAndSummary",
						`news_slid_num`="6",
						`news_link`="http://www.yourwebsite.com/newspage.php", 
						`time_offset`="0 hour", 
						`email`="admin@email.com", 
						`approval`="true", 
						`comments_order`="AtBottom",
						`captcha`="recap", 
						`captcha_theme`="clean", 
						`verify_question`="Please, type the capital of United Kingdom below to prove you are not a spambot?", 
						`verify_answer`="london", 						 
						
						`visual`=\'a:85:{s:15:"gen_font_family";s:5:"Arial";s:13:"gen_font_size";s:4:"12px";s:14:"gen_font_color";s:7:"#000000";s:13:"gen_bgr_color";s:7:"#FFFFFF";s:15:"gen_line_height";s:7:"inherit";s:9:"gen_width";s:3:"650";s:11:"title_color";s:8:"#00476c ";s:10:"title_font";s:7:"Georgia";s:10:"title_size";s:4:"18px";s:17:"title_font_weight";s:6:"normal";s:16:"title_font_style";s:6:"italic";s:16:"title_text_align";s:7:"justify";s:16:"summ_title_color";s:8:"#00476c ";s:15:"summ_title_font";s:7:"Georgia";s:15:"summ_title_size";s:4:"12px";s:22:"summ_title_font_weight";s:4:"bold";s:21:"summ_title_font_style";s:6:"normal";s:21:"summ_title_text_align";s:7:"justify";s:14:"summ_show_date";s:3:"yes";s:15:"summ_date_color";s:7:"#666666";s:14:"summ_date_font";s:7:"inherit";s:14:"summ_date_size";s:4:"11px";s:20:"summ_date_font_style";s:6:"normal";s:20:"summ_date_text_align";s:5:"right";s:16:"summ_date_format";s:10:"l - F j, Y";s:17:"summ_showing_time";s:5:"g:i a";s:9:"show_date";s:3:"yes";s:10:"date_color";s:7:"#666666";s:9:"date_font";s:7:"inherit";s:9:"date_size";s:4:"11px";s:15:"date_font_style";s:6:"normal";s:15:"date_text_align";s:5:"right";s:11:"date_format";s:10:"l - F j, Y";s:12:"showing_time";s:5:"g:i a";s:11:"show_author";s:3:"yes";s:10:"cont_color";s:7:"#333333";s:9:"cont_font";s:7:"inherit";s:9:"cont_size";s:4:"12px";s:15:"cont_font_style";s:6:"normal";s:15:"cont_text_align";s:7:"justify";s:16:"cont_line_height";s:4:"18px";s:10:"summ_color";s:7:"#333333";s:9:"summ_font";s:7:"inherit";s:9:"summ_size";s:4:"11px";s:15:"summ_font_style";s:6:"normal";s:15:"summ_text_align";s:7:"justify";s:16:"summ_line_height";s:4:"15px";s:15:"summ_show_image";s:3:"yes";s:14:"summ_img_width";s:3:"110";s:15:"summ_img_height";s:2:"80";s:12:"hl_bgr_color";s:7:"#f4f2e5";s:10:"hl_padding";s:3:"8px";s:12:"pag_align_to";s:6:"center";s:14:"pag_font_color";s:7:"#0032B1";s:14:"pag_bord_color";s:7:"#FFFFFF";s:13:"pag_bgr_color";s:7:"#FFFFFF";s:20:"pag_font_color_hover";s:7:"#0032B1";s:20:"pag_bord_color_hover";s:7:"#C9DDE9";s:19:"pag_bgr_color_hover";s:7:"#C9DDE9";s:18:"pag_font_color_sel";s:7:"#555555";s:18:"pag_bord_color_sel";s:7:"#C9DDE9";s:17:"pag_bgr_color_sel";s:7:"#FFFFFF";s:18:"pag_font_color_prn";s:7:"#0032B1";s:18:"pag_bord_color_prn";s:7:"#C9DDE9";s:17:"pag_bgr_color_prn";s:7:"#FBFBFB";s:23:"pag_bgr_color_prn_hover";s:7:"#F5F5F5";s:18:"pag_font_color_ina";s:7:"#CCCCCC";s:18:"pag_bord_color_ina";s:7:"#CCCCCC";s:17:"pag_bgr_color_ina";s:7:"#FBFBFB";s:15:"pag_font_family";s:9:"Helvetica";s:13:"pag_font_size";s:4:"16px";s:14:"pag_font_style";s:6:"normal";s:15:"pag_font_weight";s:6:"normal";s:14:"link_font_size";s:7:"inherit";s:10:"link_color";s:7:"#00476c";s:16:"link_font_weight";s:4:"bold";s:10:"link_align";s:4:"left";s:15:"show_share_this";s:3:"yes";s:16:"share_this_align";s:5:"right";s:15:"dist_title_date";s:3:"0px";s:20:"summ_dist_title_date";s:3:"0px";s:14:"dist_date_text";s:3:"8px";s:19:"summ_dist_date_text";s:3:"0px";s:13:"dist_btw_news";s:4:"28px";s:15:"dist_link_title";s:4:"12px";}\',
						
						`visual_top`=\'a:86:{s:19:"top_gen_font_family";s:5:"Arial";s:17:"top_gen_font_size";s:4:"12px";s:18:"top_gen_font_color";s:7:"#000000";s:17:"top_gen_bgr_color";s:7:"#FFFFFF";s:19:"top_gen_line_height";s:7:"inherit";s:13:"top_gen_width";s:3:"650";s:15:"top_title_color";s:8:"#00476c ";s:14:"top_title_font";s:7:"Georgia";s:14:"top_title_size";s:4:"18px";s:21:"top_title_font_weight";s:6:"normal";s:20:"top_title_font_style";s:6:"italic";s:20:"top_title_text_align";s:7:"justify";s:20:"top_summ_title_color";s:8:"#00476c ";s:19:"top_summ_title_font";s:7:"Georgia";s:19:"top_summ_title_size";s:4:"12px";s:26:"top_summ_title_font_weight";s:4:"bold";s:25:"top_summ_title_font_style";s:6:"normal";s:25:"top_summ_title_text_align";s:7:"justify";s:13:"top_show_date";s:3:"yes";s:14:"top_date_color";s:7:"#666666";s:13:"top_date_font";s:7:"inherit";s:13:"top_date_size";s:4:"11px";s:19:"top_date_font_style";s:6:"normal";s:19:"top_date_text_align";s:5:"right";s:15:"top_date_format";s:10:"l - F j, Y";s:16:"top_showing_time";s:5:"g:i a";s:15:"top_show_author";s:3:"yes";s:18:"top_summ_show_date";s:3:"yes";s:19:"top_summ_date_color";s:7:"#666666";s:18:"top_summ_date_font";s:7:"inherit";s:18:"top_summ_date_size";s:4:"10px";s:24:"top_summ_date_font_style";s:6:"normal";s:24:"top_summ_date_text_align";s:5:"right";s:20:"top_summ_date_format";s:10:"l - F j, Y";s:21:"top_summ_showing_time";s:5:"g:i a";s:14:"top_cont_color";s:7:"#333333";s:13:"top_cont_font";s:7:"inherit";s:13:"top_cont_size";s:4:"12px";s:19:"top_cont_font_style";s:6:"normal";s:19:"top_cont_text_align";s:7:"justify";s:20:"top_cont_line_height";s:4:"18px";s:14:"top_summ_color";s:7:"#333333";s:13:"top_summ_font";s:7:"inherit";s:13:"top_summ_size";s:4:"11px";s:19:"top_summ_font_style";s:6:"normal";s:19:"top_summ_text_align";s:7:"justify";s:20:"top_summ_line_height";s:4:"15px";s:19:"top_summ_show_image";s:3:"yes";s:18:"top_summ_img_width";s:3:"110";s:19:"top_summ_img_height";s:2:"80";s:16:"top_hl_bgr_color";s:7:"#eeebd7";s:14:"top_hl_padding";s:3:"8px";s:18:"top_link_font_size";s:4:"12px";s:14:"top_link_color";s:7:"#00476c";s:20:"top_link_font_weight";s:4:"bold";s:14:"top_link_align";s:4:"left";s:19:"top_show_share_this";s:3:"yes";s:20:"top_share_this_align";s:5:"right";s:19:"top_dist_title_date";s:3:"0px";s:24:"top_summ_dist_title_date";s:3:"0px";s:18:"top_dist_date_text";s:3:"8px";s:23:"top_summ_dist_date_text";s:3:"0px";s:17:"top_dist_btw_news";s:4:"28px";s:19:"top_dist_link_title";s:4:"12px";s:12:"sl_gen_width";s:3:"300";s:18:"sl_gen_bordercolor";s:7:"#dddddd";s:13:"sl_gen_number";s:1:"3";s:15:"sl_gen_interval";s:1:"4";s:16:"sl_gen_bgr_color";s:0:"";s:12:"sl_img_width";s:3:"300";s:13:"sl_img_height";s:3:"200";s:20:"sl_title_font_family";s:5:"Arial";s:18:"sl_title_font_size";s:2:"14";s:14:"sl_title_color";s:7:"#000000";s:17:"sl_show_summ_text";s:3:"yes";s:19:"sl_summ_font_family";s:5:"Arial";s:17:"sl_summ_font_size";s:2:"12";s:13:"sl_summ_color";s:7:"#666666";s:16:"sl_summ_num_char";s:3:"180";s:18:"sl_bottom_bgrcolor";s:7:"#f3f3f3";s:19:"sl_bottom_bgrcolsel";s:7:"#ebebeb";s:16:"sl_bottom_height";s:0:"";s:18:"sl_keep_proportion";s:3:"yes";s:20:"title_im_font_family";s:5:"Arial";s:18:"title_im_font_size";s:2:"11";s:14:"title_im_color";s:7:"#000000";}\',
						
						`visual_comm`=\'a:21:{s:15:"comm_bord_sides";s:10:"top_bottom";s:15:"comm_bord_style";s:5:"solid";s:15:"comm_bord_width";s:3:"1px";s:15:"comm_bord_color";s:7:"#dddddd";s:12:"comm_padding";s:4:"10px";s:14:"comm_bgr_color";s:7:"#F8F8F8";s:15:"name_font_color";s:7:"#0066cc";s:14:"name_font_size";s:4:"14px";s:15:"name_font_style";s:6:"normal";s:16:"name_font_weight";s:4:"bold";s:14:"comm_date_font";s:12:"Trebuchet MS";s:15:"comm_date_color";s:7:"#0066cc";s:14:"comm_date_size";s:4:"11px";s:20:"comm_date_font_style";s:6:"normal";s:16:"comm_date_format";s:7:"F jS, Y";s:17:"comm_showing_time";s:5:"g:i a";s:15:"comm_font_color";s:7:"#000000";s:14:"comm_font_size";s:7:"inherit";s:15:"comm_font_style";s:6:"normal";s:16:"comm_font_weight";s:6:"normal";s:13:"dist_btw_comm";s:4:"14px";}\',
						 
						`language`=\'a:46:{s:12:"Back_to_home";s:4:"Back";s:9:"Read_more";s:12:"Read more...";s:13:"Search_button";s:6:"Search";s:8:"Previous";s:3:"<<<";s:4:"Next";s:3:">>>";s:17:"No_news_published";s:17:"No news published";s:6:"Author";s:6:"Author";s:6:"Monday";s:6:"Monday";s:7:"Tuesday";s:7:"Tuesday";s:9:"Wednesday";s:9:"Wednesday";s:8:"Thursday";s:8:"Thursday";s:6:"Friday";s:6:"Friday";s:8:"Saturday";s:8:"Saturday";s:6:"Sunday";s:6:"Sunday";s:7:"January";s:7:"January";s:8:"February";s:8:"February";s:5:"March";s:5:"March";s:5:"April";s:5:"April";s:3:"May";s:3:"May";s:4:"June";s:4:"June";s:4:"July";s:4:"July";s:6:"August";s:6:"August";s:9:"September";s:9:"September";s:7:"October";s:7:"October";s:8:"November";s:8:"November";s:8:"December";s:8:"December";s:13:"Word_Comments";s:9:"Comments:";s:18:"No_comments_posted";s:21:"No comments posted...";s:13:"Leave_Comment";s:15:"Leave a Comment";s:12:"Comment_Name";s:6:"* Name";s:13:"Comment_Email";s:31:"* Email (will not be published)";s:23:"Enter_verification_code";s:25:"* Enter verification code";s:15:"Reqiured_fields";s:15:"Reqiured fields";s:14:"Submit_Comment";s:14:"Submit Comment";s:14:"Banned_ip_used";s:24:"Banned IP address used! ";s:16:"Banned_word_used";s:19:"Banned word used!  ";s:27:"Incorrect_verification_code";s:45:"Incorrect verification code or wrong answer! ";s:14:"Post_Submitted";N;s:17:"Comment_Submitted";s:33:"Your comment has been submitted! ";s:20:"After_Approval_Admin";s:58:"After approval of the administrator it will be published! ";s:15:"required_fields";s:34:"Please, fill all required fields! ";s:13:"correct_email";s:36:"Please, fill correct email address! ";s:10:"field_code";s:33:"Please, enter verification code! ";s:12:"wrong_answer";s:35:"Please, enter verification answer! ";s:15:"New_post_posted";N;s:18:"New_comment_posted";s:18:"new comment posted";}\'';
			
			$sql_result = mysql_query ($sql, $conn ) or die ('Could not execute MySQL query: '.$sql." -> Error: ".mysql_error());
			
					
			
			
			
			$ConfigFile = "configs.php";
			$CONFIG='$CONFIG';
			
			$handle = @fopen($ConfigFile, "r");
			
			if ($handle) {
				$buffer = fgets($handle, 4096);
	  			$buffer .=fgets($handle, 4096);	
				$buffer .=fgets($handle, 4096);	
				
				$buffer .=$CONFIG."[\"hostname\"]='".$_REQUEST["hostname"]."';\n";
				
				$buffer .=$CONFIG."[\"mysql_user\"]='".$_REQUEST["mysql_user"]."';\n";
				
				$buffer .=$CONFIG."[\"mysql_password\"]='".$_REQUEST["mysql_password"]."';\n";
				
				$buffer .=$CONFIG."[\"mysql_database\"]='".addslashes($_REQUEST["mysql_database"])."';\n";
								
				$buffer .=$CONFIG."[\"server_path\"]='".$_REQUEST["server_path"]."';\n";
				
				$buffer .=$CONFIG."[\"full_url\"]='".addslashes($_REQUEST["full_url"])."';\n";
								
				$buffer .=$CONFIG."[\"folder_name\"]='".addslashes($_REQUEST["folder_name"])."';\n";
				
				$buffer .=$CONFIG."[\"admin_user\"]='".$_REQUEST["admin_user"]."';\n";
				
				$buffer .=$CONFIG."[\"admin_pass\"]='".$_REQUEST["admin_pass"]."';\n";
				
				while (!feof($handle)) {
					$buffer .= fgets($handle, 4096);
				}
				
				fclose($handle);
				
				$handle = @fopen($ConfigFile, "w");
				
				if (!$handle) {
					echo "Configuration file $ConfigFile is missing or the permissions does not allow to be changed. Please upload the file and/or set the right permissions (CHMOD 777).";
					exit();
				}
				
				if (!fwrite($handle,$buffer)) {
				  	echo "Configuration file $ConfigFile is missing or the permissions does not allow to be changed. Please upload the file and/or set the right permissions (CHMOD 777).";
					exit();
				}
				
				fclose($handle);
				
			} else {
				echo "Error opening ".$ConfigFile." file with fopen php function. Please make sure this file is fully uploaded on your webserver. Also make sure that you have rights to open and write on it. All the installation information will be written on this file!";
				exit();
			}
			
			$message = 'Script successfully installed';	
?>
		<script type="text/javascript">
			window.document.location.href='installation.php?install=2'
		</script>     		
<?php		
		}
	}
}


$check_version[0]="PHP,4.3.0,php_version";
$check_version[1]="MySQL,3.0,mysql_version";


function php_version($php_ver,&$cur_ver) {
	$cur_ver=phpversion();
	return	version_compare(phpversion(), $php_ver, ">=");
} 
function mysql_version($mysql_ver,&$cur_ver) {

	ob_start();
	phpinfo();
	$php_info=ob_get_contents();
	ob_end_clean();
	
	if (preg_match('/Client\ API\ version.*\>(\d+\.\d+\.\d+)/',substr($php_info,strpos($php_info,"module_mysql")),$matches)) {
	//Client API version
		$cur_ver=$matches[1];
		return	version_compare($matches[1],$mysql_ver, ">=");
	}
	return false;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Script installation</title>
<link href="styles/installation.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="install_wrap">

<?php if (isset($_GET["install"]) && $_GET["install"]==2) { ?>
	<table border="0" class="form_table" align="center" cellpadding="4">
	  <tr>
      	<td>
			Script successfully installed. <a href='admin.php'>Login here</a>.
        </td>
      </tr>
    </table>
<?php } else {?>

	<form action="installation.php" method="post" name="installform">
    <input name="install" type="hidden" value="1" />
	<table border="0" class="form_table" align="center" cellpadding="4">
      
      
      <tr>
      	<td colspan="3">
        	<?php 
			if (isset($message) and $message!='') { 
				echo $message;
			} else {
				echo 'These are the details that script will use to install and run: ';
			}
			?>
	  	</td>
      </tr>
      
      <tr>
        <td colspan="3" class="head_row">Minimum version required</td>
      </tr>
      
      	<?php
		$check_pass=true;
		for ($i=0;$i<count($check_version);$i++) {
			$cur_ver='';
			$element=split(",",$check_version[$i]);
			
			if (call_user_func_array($element[2],array($element[1],&$cur_ver))) {
				$element[3]="Server version of $element[0] is ok";
			} else {
				$element[3]="<strong style='color:red'>Server version of $element[0] is not ok!</strong>";
				$check_pass=false;
				if (version_compare($cur_ver,"0.0.1",">=")) {
					$error_msg.="$element[0] requirement checks failed and the script may not work properly. You have version $cur_ver but the required version is $element[1]. Please contact your hosting company or system administrator for assistance.";
				} else {
					$error_msg.="$element[0] requirement checks failed and the script may not work properly.. It seems that your hosting account does not support $element[0] Please contact your hosting company or system administrator for assistance.";
				}
			}	
		?>
      <tr>
        <td width="30%"><?php echo $element[0]; ?></td>
        <td><?php echo $element[3]; ?></td>
      </tr>
	  <?php } ?> 
      
      <?php if(isset($error_msg)) {?>
      <tr>
        <td colspan="2" style="color:#FF0000;"><?php echo $error_msg; ?></td>
      </tr>       
      <?php } ?>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="3" class="head_row">MySQL login details</td>
      </tr>
      
      <tr>
        <td align="left">MySQL Server:</td>
        <td align="left"><input type="text" name="hostname" value="<?php if(isset($_REQUEST['hostname'])) echo $_REQUEST['hostname']; else echo 'localhost'; ?>" size="30" /></td>
      </tr>
      <tr>
        <td align="left">MySQL Username: </td>
        <td align="left"><input name="mysql_user" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_user'])) echo $_REQUEST['mysql_user']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">MySQL Password: </td>
        <td align="left"><input name="mysql_password" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_password'])) echo $_REQUEST['mysql_password']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Database name:</td>
        <td align="left"><input name="mysql_database" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_database'])) echo $_REQUEST['mysql_database']; ?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="3" class="head_row">Installation paths to script directory</td>
      </tr>
      
      	<?php 
	  	$server_path=$_SERVER['SCRIPT_FILENAME'];
		if (preg_match("/(.*)\//",$server_path,$matches)) {
			$server_path=$matches[0];
		}
		
		$server_path = str_replace("\\","/",$server_path);
		$server_path = str_replace("installation.php","",$server_path);
			
	  	?>
      <tr>
        <td align="left" valign="top">Server path to script directory:</td>
        <td colspan="2" align="left">
        	<input name="server_path" type="text" value="<?php echo $server_path; ?>" style="width:95%" /><br />
        	<span style="font-size:11px;font-style:italic;">Example: /home/server/public_html/SCRIPTFOLDER/ -  for Linux host</span><br />
            <span style="font-size:11px;font-style:italic;">Example: D:/server/www/websitedir/SCRIPTFOLDER/ -  for Windows host</span>
        </td>
      </tr>
      
      <?php 
	  	$full_url = 'http';
		if ($_SERVER["HTTPS"] == "on") {$full_url .= "s";}
		$full_url .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$full_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$full_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		if (preg_match("/(.*)\//",$full_url,$matches)) {
			$full_url=$matches[0];
		}
		//$full_url = str_replace("installation.php","",$full_url);
		?>
      <tr>
        <td align="left" valign="top">Full URL to script directory:</td>
        <td colspan="2" align="left">
        	<input name="full_url" type="text" value="<?php echo $full_url; ?>" style="width:95%" /><br />
        	<span style="font-size:11px;font-style:italic;">Example: http://yourdomain.com/SCRIPTFOLDER/</span>
        </td>
      </tr>      
      
      	<?php 
	  	$url = $_SERVER['PHP_SELF']; 
		if (preg_match("/(.*)\//",$url,$matches)) {
			$folder_name=$matches[0];
		}
	  	?>
      <tr>
        <td align="left" valign="top">Script directory name:</td>
        <td colspan="2" align="left">
        	<input name="folder_name" type="text" value="<?php echo $folder_name; ?>" style="width:95%" /><br />
            <span style="font-size:11px;font-style:italic;">Example: /SCRIPTFOLDER/</span>
        </td>
      </tr>
      
      	
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" class="head_row">Administrator login details (<span style="font-weight:normal; font-size:11px; font-style:italic;">Choose Username and Password you should use later when log in admin area)</span></td>
      </tr>
      <tr>
        <td align="left">Admin Username:</td>
        <td align="left"><input name="admin_user" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['admin_user'])) echo $_REQUEST['admin_user']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Admin Password:</td>
        <td align="left"><input name="admin_pass" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['admin_pass'])) echo $_REQUEST['admin_pass']; ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="installScript" type="submit" value="Install Script"></td>
      </tr>
    </table>
	</form>
<?php } ?>    

</div>

</body>
</html>
