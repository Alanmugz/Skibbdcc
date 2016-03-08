<?php 
if(!isset($configs_are_set)) {
	include("configs.php");
}
$thisPage = $_SERVER['PHP_SELF'];

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
$Options = mysql_fetch_assoc($sql_result);
mysql_free_result($sql_result);
$OptionsVis = unserialize($Options['visual']);
$OptionsVisC = unserialize($Options['visual_comm']);
$OptionsLang = unserialize($Options['language']);

if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]!='') {
	$_REQUEST["cat_id"] = (int) mysql_real_escape_string($_REQUEST["cat_id"]);
}

if(!function_exists('lang_date')){ 
	function lang_date($subject) {	
		$search  = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
		
		$replace = array(
						ReadDB($GLOBALS['OptionsLang']['January']), 
						ReadDB($GLOBALS['OptionsLang']['February']), 
						ReadDB($GLOBALS['OptionsLang']['March']), 
						ReadDB($GLOBALS['OptionsLang']['April']), 
						ReadDB($GLOBALS['OptionsLang']['May']), 
						ReadDB($GLOBALS['OptionsLang']['June']), 
						ReadDB($GLOBALS['OptionsLang']['July']), 
						ReadDB($GLOBALS['OptionsLang']['August']), 
						ReadDB($GLOBALS['OptionsLang']['September']), 
						ReadDB($GLOBALS['OptionsLang']['October']), 
						ReadDB($GLOBALS['OptionsLang']['November']), 
						ReadDB($GLOBALS['OptionsLang']['December']), 
						ReadDB($GLOBALS['OptionsLang']['Monday']), 
						ReadDB($GLOBALS['OptionsLang']['Tuesday']), 
						ReadDB($GLOBALS['OptionsLang']['Wednesday']), 
						ReadDB($GLOBALS['OptionsLang']['Thursday']), 
						ReadDB($GLOBALS['OptionsLang']['Friday']), 
						ReadDB($GLOBALS['OptionsLang']['Saturday']), 
						ReadDB($GLOBALS['OptionsLang']['Sunday'])
						);
	
		$lang_date = str_replace($search, $replace, $subject);
		return $lang_date;
	}
}


/////////////////////////////////////////////////
////// checking for correct captcha starts //////
if (isset($_POST["act"]) and $_POST["act"]=='post_comment') {
	
	/////////////////////////////////////////////////
	////// checking for correct captcha starts //////
	if($Options['captcha']=='nocap') { // if the option is set to no Captcha
		$testvariable = true;	// test variable is set to true
	} else {
		$testvariable = false;	// test variable is set to false
	}
	
	if(trim($Options['verify_answer']=='')) { // if the option verify answer is active
		$testanswer = true;	// test answer is set to true (passed)
	} else {
		if(isset($_REQUEST['verify_answer']) and trim($_REQUEST['verify_answer'])) {
			if(preg_match('/^'.$Options['verify_answer'].'$/i', $_REQUEST['verify_answer'])) {
				$testanswer = true;	// test answer is set to true (passed)
			} else {
				$testanswer = false;	// test answer is set to false (not passed)	
			}
		}
	}
		
	if($Options['captcha']=='recap') { // if the option is set to reCaptcha
	
		$privatekey = "6Lfk9L0SAAAAAMccSmLp8kxaMQ53yJyVE0kuOSrh";
		if ($_POST["recaptcha_response_field"]) {
			$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
	
			if ($resp->is_valid) { // test variable is set to true				
					$testvariable = true;				
				} else {
				# set the error code so that we can display it
				$error = $resp->error;
				$SysMessage =  ReadDB($OptionsLang["Incorrect_verification_code"]); 
				unset($_REQUEST["act"]);
			}
		} else {		
			$SysMessage =  ReadDB($OptionsLang["Incorrect_verification_code"]); 
			unset($_REQUEST["act"]);
		}
		
	} elseif($Options['captcha']!='recap' and $Options['captcha']!='nocap') { // if is set to math, simple or very simple captcha option
	
		if (preg_match('/^'.$_SESSION['key'].'$/i', $_REQUEST['string'])) { // test variable is set			
				$testvariable = true;			
			} else {		
			$SysMessage =  ReadDB($OptionsLang["Incorrect_verification_code"]); 
			unset($_REQUEST["act"]);
		}
	}
}
////// checking for correct captcha ends //////
///////////////////////////////////////////////


if ($_POST["act"]=='post_comment') { // if comment is submitted
	
	if ($testvariable==true and $testanswer==true) { // if test variable is set to true, then go to update database and send emails
	
		if ($Options["approval"]=='true') {			
			$status = 'Not approved';
		} else {
			$status = 'Approved';
		}
		
		$WordAllowed = true;
		$BannedWords = explode(",", ReadDB($Options["ban_words"]));
		if (count($BannedWords)>0) {
		  $checkComment = strtolower($_REQUEST["comment"]);
		  for($i=0;$i<count($BannedWords);$i++){
			  $banWord = trim($BannedWords[$i]);
			  if (trim($BannedWords[$i])<>'') {
				  if(preg_match("/".$banWord."/i", $checkComment)){ 
					  $WordAllowed = false;
					  break;
				  }
			  }
		  }
		}
		
		$IPAllowed = true;
		$BannedIPs = explode(",", ReadDB($Options["ban_ips"]));
		if (count($BannedIPs)>0) {
		  $checkIP = strtolower($_SERVER["REMOTE_ADDR"]);
		  for($i=0;$i<count($BannedIPs);$i++){
			  $banIP = trim($BannedIPs[$i]);
			  if (trim($BannedIPs[$i])<>'') {
				  if(preg_match("/".$banIP."/i", $checkIP)){
					  $IPAllowed = false;
					  break;
				  }
			  }
		  }
		}
		
		if($WordAllowed==false) {
			 $SysMessage =  $OptionsLang["Banned_word_used"]; 
		} elseif($IPAllowed==false) {
			 $SysMessage = ReadDB($OptionsLang["Banned_ip_used"]); 
		} else {
			
			$publish_date = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." " .$Options["time_offset"]));
			
			$sql = "INSERT INTO ".$TABLE["Comments"]."
					SET `publish_date` 	= '".$publish_date."',
						`ipaddress` 	= '".SaveDB($_SERVER["REMOTE_ADDR"])."',
					  	`status` 		= '".$status."',
					  	`news_id` 		= '".SaveDB($_REQUEST["id"])."',
					  	`name` 			= '".SaveDB($_REQUEST["name"])."',
					  	`email` 		= '".SaveDB($_REQUEST["email"])."',
					  	`comment` 		= '".SaveDB($_REQUEST["comment"])."'";
			$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
			$SysMessage = $OptionsLang["Comment_Submitted"];
			if($Options['approval']=='true') {
				$SysMessage .= $OptionsLang["After_Approval_Admin"];
			}
										
			$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".mysql_real_escape_string($_REQUEST["id"])."'";
			$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
			$News = mysql_fetch_assoc($sql_result);
			mysql_free_result($sql_result);

			$mailheader = "From: ".ReadDB($Options["email"])."\r\n";
			$mailheader .= "Reply-To: ".ReadDB($Options["email"])."\r\n";
			$mailheader .= "Content-type: text/html; charset=UTF-8\r\n";
			$Message_body = "News: <strong>".ReadDB($News["title"])."</strong><br /><br />";
			$Message_body .= "Comment: <br />".$_REQUEST["comment"]."<br /><br />";
			$Message_body .= "Name: ".$_REQUEST["name"]."<br />";
			$Message_body .= "Email: ".$_REQUEST["email"]."<br />";
			mail(ReadDB($Options["email"]), $OptionsLang["New_comment_posted"], $Message_body, $mailheader);
						
			$sql = "SELECT * FROM ".$TABLE["Editors"]." WHERE id='".$News["editor_id"]."'";
			$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
			$Editor = mysql_fetch_assoc($sql_result);
			mysql_free_result($sql_result);	
			
			mail(ReadDB($Editor["editor_email"]), $OptionsLang["New_comment_posted"], $Message_body, $mailheader);
			
			unset($_REQUEST["name"]);
			unset($_REQUEST["email"]);
			unset($_REQUEST["comment"]);
		}

	} else {		
		$SysMessage =  $OptionsLang["Incorrect_verification_code"]; 
		unset($_REQUEST["act"]);
	}
}
?>
<style type="text/css">

html {-webkit-text-size-adjust:none} 

div.post_text a {	
	color: <?php echo $OptionsVis["links_font_color"];?>;
	text-decoration: <?php echo $OptionsVis["links_text_decoration"];?>;
	font-size: <?php echo $OptionsVis["links_font_size"];?>;
	font-style: <?php echo $OptionsVis["links_font_style"];?>;
	font-weight: <?php echo $OptionsVis["links_font_weight"];?>;
}
div.post_text a:hover {	
	color: <?php echo $OptionsVis["links_font_color_hover"];?>;
	text-decoration: <?php echo $OptionsVis["links_text_decoration_hover"];?>;
	font-size: <?php echo $OptionsVis["links_font_size"];?>;
	font-style: <?php echo $OptionsVis["links_font_style"];?>;
	font-weight: <?php echo $OptionsVis["links_font_weight"];?>;
}

/* pagination style */
div.pagination {
	text-align: <?php echo $OptionsVis["pag_align_to"];?>;
	padding-bottom:8px;
	font-size:<?php echo $OptionsVis["pag_font_size"];?>;
	font-style:<?php echo $OptionsVis["pag_font_style"];?>;
	font-weight:<?php echo $OptionsVis["pag_font_weight"]; ?>;
	font-family: <?php echo $OptionsVis["pag_font_family"]; ?>;
}
div.pagination a {
	padding: 4px 10px;
	margin: 1px;
	border: 1px solid <?php echo $OptionsVis["pag_bord_color"];?>;	
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	text-decoration: none; 
	color: <?php echo $OptionsVis["pag_font_color"];?>;
	background-color: <?php echo $OptionsVis["pag_bgr_color"];?>;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid <?php echo $OptionsVis["pag_bord_color_hover"];?>;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	color: <?php echo $OptionsVis["pag_font_color_hover"];?>;
	background-color: <?php echo $OptionsVis["pag_bgr_color_hover"];?>;
}

div.pagination a.next_prev {
	border: 1px solid <?php echo $OptionsVis["pag_bord_color_prn"];?>;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	background-color: <?php echo $OptionsVis["pag_bgr_color_prn"];?>;
	color: <?php echo $OptionsVis["pag_font_color_prn"];?>;
}

div.pagination a.next_prev:hover {
	border: 1px solid <?php echo $OptionsVis["pag_bord_color_prn"];?>;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	background-color: <?php echo $OptionsVis["pag_bgr_color_prn_hover"];?>;
	color: <?php echo $OptionsVis["pag_font_color_prn"];?>;
}

div.pagination span.current {
	padding: 4px 10px;
	margin: 1px;
	border: 1px solid <?php echo $OptionsVis["pag_bord_color_sel"];?>;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;		
	font-weight:<?php echo $OptionsVis["pag_font_weight"]; ?>;
	background-color: <?php echo $OptionsVis["pag_bgr_color_sel"];?>;
	color: <?php echo $OptionsVis["pag_font_color_sel"];?>;
}
div.pagination span.disabled {
	padding: 4px 10px;
	margin: 1px;
	border: 1px solid <?php echo $OptionsVis["pag_bord_color_ina"];?>;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	font-weight:<?php echo $OptionsVis["pag_font_weight"]; ?>;
	background-color: <?php echo $OptionsVis["pag_bgr_color_ina"];?>;
	color: <?php echo $OptionsVis["pag_font_color_ina"];?>;
}
</style>

<div style="background-color:<?php echo $OptionsVis["gen_bgr_color"];?>;">
<div style="font-family:<?php echo $OptionsVis["gen_font_family"];?>; font-size:<?php echo $OptionsVis["gen_font_size"];?>;margin:0 auto;width:<?php echo $OptionsVis["gen_width"];?>px; color:<?php echo $OptionsVis["gen_font_color"];?>;line-height:<?php echo $OptionsVis["gen_line_height"];?>;word-wrap:break-word;">


<?php
if ($_REQUEST["id"]>0) {	
	$_REQUEST["id"]= (int) mysql_real_escape_string($_REQUEST["id"]);
?>
	<div style="clear: both; height:0px;"></div>
    <a name="ontitle" id="ontitle"></a>
	<?php if(trim($OptionsLang["Back_to_home"])!='') { ?>
    <div style="text-align:<?php echo $OptionsVis["link_align"]; ?>"><a href="<?php echo $thisPage; ?>?cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;p=<?php echo $_REQUEST["p"]; ?>#ontitle" style='font-weight:<?php echo $OptionsVis["link_font_weight"]; ?>;color:<?php echo $OptionsVis["link_color"]; ?>;font-size:<?php echo $OptionsVis["link_font_size"]; ?>;text-decoration:underline'><?php echo $OptionsLang["Back_to_home"]; ?></a></div>    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_link_title"];?>;"></div>    
    <?php } ?>

	<?php 
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE status='Published' AND id='".mysql_real_escape_string($_REQUEST["id"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	if(mysql_num_rows($sql_result)>0) {	
	  $News = mysql_fetch_assoc($sql_result);
	?>
	
	<div style="color:<?php echo $OptionsVis["title_color"];?>;font-family:<?php echo $OptionsVis["title_font"];?>;font-size:<?php echo $OptionsVis["title_size"];?>;font-weight:<?php echo $OptionsVis["title_font_weight"];?>;font-style:<?php echo $OptionsVis["title_font_style"];?>;text-align:<?php echo $OptionsVis["title_text_align"];?>;">	  
            <?php echo ReadDB($News["title"]); ?>     
    </div>
    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_title_date"];?>;"></div>
    
    <?php 
	if($OptionsVis["show_author"]=='yes') {
		$sqlE = "SELECT * FROM ".$TABLE["Editors"]." WHERE id='".$News["editor_id"]."'";
		$sql_resultE = mysql_query ($sqlE, $conn ) or die ('MySQL query error: '.$sqlE.'. Error: '.mysql_error());	
		if(mysql_num_rows($sql_resultE)>0) {
			$Editor = mysql_fetch_assoc($sql_resultE);
	?>    
    	<div style="float:left;padding-left:10px; padding-right:10px;color:<?php echo $OptionsVis["date_color"];?>; font-family:<?php echo $OptionsVis["date_font"];?>; font-size:<?php echo $OptionsVis["date_size"];?>;font-style: <?php echo $OptionsVis["date_font_style"];?>;text-align:<?php echo $OptionsVis["date_text_align"];?>;"><?php echo $OptionsLang["Author"]; ?> <?php echo ReadDB($Editor["editor_name"]); ?> </div>
    <?php 
		}
	}
	?>
    
    <?php if($OptionsVis["show_date"]=='yes') { ?>
    <div style="color:<?php echo $OptionsVis["date_color"];?>; font-family:<?php echo $OptionsVis["date_font"];?>; font-size:<?php echo $OptionsVis["date_size"];?>;font-style: <?php echo $OptionsVis["date_font_style"];?>;text-align:<?php echo $OptionsVis["date_text_align"];?>;">
		<?php echo lang_date(date($OptionsVis["date_format"],strtotime($News["publish_date"]))); ?> 
		<?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($News["publish_date"])); ?></div>
    <?php } ?>
    
    <div style="clear:both; height:<?php echo $OptionsVis["dist_date_text"];?>;"></div>
    
    <div style="color:<?php echo $OptionsVis["cont_color"];?>; font-family:<?php echo $OptionsVis["cont_font"];?>; font-size:<?php echo $OptionsVis["cont_size"];?>;font-style: <?php echo $OptionsVis["cont_font_style"];?>;text-align:<?php echo $OptionsVis["cont_text_align"];?>;line-height:<?php echo $OptionsVis["cont_line_height"];?>;">
      <?php if(ReadDB($News["image"])!='') { ?>
		<?php if(ReadDB($News["imgpos"])=='left') { ?><div style="float:left"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-right:14px; padding-bottom:6px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>"<?php if($News["imgheight"]!="") {?> height="<?php echo $News["imgheight"] ?>"<?php }?> /></div><?php } ?>
        <?php if(ReadDB($News["imgpos"])=='right') { ?><div style="float:right"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-left:14px; padding-bottom:6px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>"<?php if($News["imgheight"]!="") {?> height="<?php echo $News["imgheight"] ?>"<?php }?> /></div><?php } ?>
        <?php if(ReadDB($News["imgpos"])=='top') { ?><div style="clear:both; text-align:center"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>"<?php if($News["imgheight"]!="") {?> height="<?php echo $News["imgheight"] ?>"<?php }?> alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
      <?php } ?>
        <?php echo ReadDB($News["content"]); ?> 
      <?php if(ReadDB($News["image"])!='') { ?>
        <?php if(ReadDB($News["imgpos"])=='bottom') { ?><div style="clear:both; text-align:center"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>"<?php if($News["imgheight"]!="") {?> height="<?php echo $News["imgheight"] ?>"<?php }?> alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:10px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
      <?php } ?>
    </div>
    
    <div style="clear:both"></div>
    
    <?php 
	$sql = "UPDATE ".$TABLE["News"]." 
			SET reviews = reviews + 1 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
	?>
    
    <?php if($OptionsVis["show_share_this"]=='yes') { ?>
    <div style="padding-top:6px; float:<?php echo $OptionsVis["share_this_align"];?>;">
	<!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style">    
    <a class="addthis_button_preferred_1"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_4"></a>
    <a class="addthis_button_email" style="cursor:pointer"></a>
    <a class="addthis_button_more"></a>
    <div style="clear:both"></div>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4d1b600761d3017d"></script>
    <!-- AddThis Button END -->
	</div>
    <?php } ?>
    <div style="clear:both"></div>
    	
        <!-- start comments code -->
    	<?php if($News['news_comments']=='true') { ?>
        
        <a name="comments" id="comments"></a>
		<?php if(isset($SysMessage)) { ?>
        <div style="padding:10px;color:red;font-weight:bold;"><?php echo $SysMessage; ?></div>
        <?php } ?>
        
        <?php
        if ($Options["comments_order"]=='OnTop') {
            $commentOrder = 'DESC';
        } else {
            $commentOrder = 'ASC';
        }
        
        $sql = "SELECT * FROM ".$TABLE["Comments"]." WHERE news_id='".$News["id"]."' AND status='Approved' ORDER BY id ".$commentOrder;
        $sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql);
        $numComments = mysql_num_rows($sql_result);
        if ($numComments>0) { 
            if ($Options["comments_order"]=='OnTop') {
                $commentNum = $numComments;
            } else {
                $commentNum = 1;
            }
        ?>
        <div style="padding-bottom:6px;padding-top:8px;font-weight:bold;"><?php echo $OptionsLang["Word_Comments"];?></div>
        <?php
            while ($Comments = mysql_fetch_assoc($sql_result)) {
        ?>
        <!-- comments wrap div -->
        <div style="background-color:<?php echo $OptionsVisC["comm_bgr_color"];?>;padding:<?php echo $OptionsVisC["comm_padding"];?>; <?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='top_bottom' or $OptionsVisC["comm_bord_sides"]=='top') {?>border-top:<?php echo $OptionsVisC["comm_bord_style"];?> <?php echo $OptionsVisC["comm_bord_width"];?> <?php echo $OptionsVisC["comm_bord_color"];?>;<?php } ?> <?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='top_bottom' or $OptionsVisC["comm_bord_sides"]=='bottom') {?>border-bottom:<?php echo $OptionsVisC["comm_bord_style"];?> <?php echo $OptionsVisC["comm_bord_width"];?> <?php echo $OptionsVisC["comm_bord_color"];?>;<?php } ?> <?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='right_left' or $OptionsVisC["comm_bord_sides"]=='left') {?>border-left:<?php echo $OptionsVisC["comm_bord_style"];?> <?php echo $OptionsVisC["comm_bord_width"];?> <?php echo $OptionsVisC["comm_bord_color"];?>;<?php } ?> <?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='right_left' or $OptionsVisC["comm_bord_sides"]=='right') {?>border-right:<?php echo $OptionsVisC["comm_bord_style"];?> <?php echo $OptionsVisC["comm_bord_width"];?> <?php echo $OptionsVisC["comm_bord_color"];?>;<?php } ?>">
            
            <!-- comments name -->
            <div style="float:left;padding-bottom:8px;color:<?php echo $OptionsVisC["name_font_color"];?>;font-size:<?php echo $OptionsVisC["name_font_size"];?>;font-style:<?php echo $OptionsVisC["name_font_style"];?>;font-weight:<?php echo $OptionsVisC["name_font_weight"];?>;"><?php echo ReadHTML($Comments["name"]); ?></div>
            
            <div style="float:right; padding-left:10px;"><span style="font-weight:bold;padding-right:2px;">#</span><?php echo $commentNum; ?></div>
            
            <!-- comments date -->
            <div style="color:<?php echo $OptionsVisC["comm_date_color"];?>; font-family:<?php echo $OptionsVisC["comm_date_font"];?>; font-size:<?php echo $OptionsVisC["comm_date_size"];?>;font-style: <?php echo $OptionsVisC["comm_date_font_style"];?>;text-align:<?php echo $OptionsVisC["comm_date_text_align"];?>; float:right;">
				<?php echo lang_date(date($OptionsVisC["comm_date_format"],strtotime($Comments["publish_date"]))); ?> 
				<?php if($OptionsVisC["comm_showing_time"]!='') echo date($OptionsVisC["comm_showing_time"],strtotime($Comments["publish_date"])); ?></div>
                
            <div style="clear:both"></div>
            
            <!-- comments text -->
            <div style="color:<?php echo $OptionsVisC["comm_font_color"];?>;font-size:<?php echo $OptionsVisC["comm_font_size"];?>;font-style:<?php echo $OptionsVisC["comm_font_style"];?>;font-weight:<?php echo $OptionsVisC["comm_font_weight"];?>;"><?php echo nl2br(ReadHTML($Comments["comment"])); ?></div>
        
        </div>
        
        <div style="clear:both;height:<?php echo $OptionsVisC["dist_btw_comm"];?>;"></div>
        
        <?php
                if ($Options["comments_order"]=='OnTop') {
                    $commentNum --;
                } else {
                    $commentNum ++;
                }
            }
        } else {
        ?>
        <div  style="padding-bottom:10px;padding-top:10px;font-weight:bold;"><?php echo $OptionsLang["No_comments_posted"]; ?></div>
        <?php 
        }
        ?>   
        
        
        <script type="text/javascript">
        function checkComment(form){
            var chekmail = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
        
            var name, email, comment, isOk = true;
			<?php if($Options['captcha']!='recap' and $Options['captcha']!='nocap') { // if the option is set to reCaptcha or no captcha ?>
			var string;
			<?php } ?>
			<?php if($Options['verify_answer']!='') { // if the verification answer is empry ?>
			var verify_answer;
			<?php } ?>
            var message = "";
            
            message = "<?php echo $OptionsLang["required_fields"]; ?>";
            
            name	= form.name.value;	
            email	= form.email.value;
            comment	= form.comment.value;
			<?php if($Options['captcha']!='recap' and $Options['captcha']!='nocap') { // if the option is set to reCaptcha or no captcha ?>
            string	= form.string.value;
			<?php } ?>
			<?php if($Options['verify_answer']!='') { // if the verification answer is empry ?>
			verify_answer	= form.verify_answer.value;
			<?php } ?>
        
            if (name.length==0){
                form.name.focus();
                isOk=false;
            }
            else if (email.length<5){
                form.email.focus();
                isOk=false;
            }	
            else if (email.length>=5 && email.match(chekmail)==null){
                message ="<?php echo $OptionsLang["correct_email"]; ?>";
                form.email.focus();
                isOk=false;
            }
            else if (comment.length==0){
                form.comment.focus();
                isOk=false;
            }
			
			<?php if($Options['captcha']!='recap' and $Options['captcha']!='nocap') { // if the option is set to reCaptcha or no captcha ?>
            else if (string.length==0){
                message ="<?php echo $OptionsLang["field_code"]; ?>";
                form.string.focus();
                isOk=false;
            }
        	<?php } ?>
			<?php if($Options['verify_answer']!='') { // if the verification answer is empry ?>
			else if (verify_answer.length==0){
                message ="<?php echo $OptionsLang["wrong_answer"]; ?>";
                form.verify_answer.focus();
                isOk=false;
            }
			<?php } ?>
            if (!isOk){			   
                alert(message);
                return isOk;
            } else {
                return isOk;
            }
        }
        </script>
        <script type="text/javascript">
		 var RecaptchaOptions = {
			theme : '<?php echo $Options['captcha_theme']; ?>'
		 };
		</script>
        <!-- comments form -->
        <form action="<?php echo $thisPage; ?>?p=<?php echo $_REQUEST['p']; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>#comments" name="formComment" method="post" style="margin:0;padding:0;">
        <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>" />
        <input type="hidden" name="act" value="post_comment" />
        <table width="100%" border="0" cellpadding="6" cellspacing="0" bgcolor="<?php echo $OptionsVisC["tbl_bgr"];?>" style="padding:6px;background-color:<?php echo $OptionsVisC["comm_bgr_color"];?>; <?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='top_bottom' or $OptionsVisC["comm_bord_sides"]=='top') {?>border-top:<?php echo $OptionsVisC["comm_bord_style"];?> <?php echo $OptionsVisC["comm_bord_width"];?> <?php echo $OptionsVisC["comm_bord_color"];?>;<?php } ?> <?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='top_bottom' or $OptionsVisC["comm_bord_sides"]=='bottom') {?>border-bottom:<?php echo $OptionsVisC["comm_bord_style"];?> <?php echo $OptionsVisC["comm_bord_width"];?> <?php echo $OptionsVisC["comm_bord_color"];?>;<?php } ?> <?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='right_left' or $OptionsVisC["comm_bord_sides"]=='left') {?>border-left:<?php echo $OptionsVisC["comm_bord_style"];?> <?php echo $OptionsVisC["comm_bord_width"];?> <?php echo $OptionsVisC["comm_bord_color"];?>;<?php } ?> <?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='right_left' or $OptionsVisC["comm_bord_sides"]=='right') {?>border-right:<?php echo $OptionsVisC["comm_bord_style"];?> <?php echo $OptionsVisC["comm_bord_width"];?> <?php echo $OptionsVisC["comm_bord_color"];?>;<?php } ?>">
          <tr>
            <td colspan="2" style="padding:6px;font-size:<?php echo $OptionsVis["gen_font_size"];?>;font-weight:bold;color:#000000;"><?php echo $OptionsLang["Leave_Comment"]; ?></td>
            </tr>
          <tr>    
            <td align="right" style="padding:6px;padding-left:<?php echo $OptionsVisC["comm_padding"];?>;"><input type="text" name="name" style="width:100%" value="<?php echo $_REQUEST["name"]; ?>" /></td>
            <td align="left" width="55%" style="padding:6px;font-size:<?php echo $OptionsVis["gen_font_size"];?>;"><?php echo $OptionsLang["Comment_Name"]; ?></td>
          </tr>
          <tr>    
            <td align="right" style="padding:6px;padding-left:<?php echo $OptionsVisC["comm_padding"];?>;"><input type="text" name="email" style="width:100%" value="<?php echo $_REQUEST["email"]; ?>" /></td>
            <td align="left" style="padding:6px;font-size:<?php echo $OptionsVis["gen_font_size"];?>;"><?php echo $OptionsLang["Comment_Email"]; ?></td>
          </tr>
          <tr>    
            <td colspan="2" valign="top" style="padding:6px;padding-left:<?php echo $OptionsVisC["comm_padding"];?>;"><textarea name="comment" style="width:95%;display:block; float:left;" rows="5"><?php echo $_REQUEST["comment"]; ?></textarea> <div style="float:left; padding-left:5px;">*</div></td>
          </tr>
          
          <?php 
		  if($Options['captcha']!='nocap') { // if the option is set to no Captcha
		  ?>
          <tr>    
            <td valign="top" align="right" style="padding:6px;padding-left:<?php echo $OptionsVisC["comm_padding"];?>;"> 
            <?php if($Options['captcha']=='recap') { // if the option is set to reCaptcha
					$publickey = "6Lfk9L0SAAAAACp13Wlzz6WTanYxrcLBXyn7XNSJ";
					echo recaptcha_get_html($publickey, $error);
				  } elseif($Options['captcha']=='capmath') { ?>            
            <input type="text" name="string" style="width:40px;display:block;float:right;margin-top:4px;height:28px;font-size:17px; text-align:center;" maxlength="6" />  
          	<div style="float:right;padding-top:9px;padding-left:3px;padding-right:3px;font-size:20px;color:#666;font-weight:bold;"> = </div>
			<img src="<?php echo $CONFIG["folder_name"]; ?>captchamath.php" id="captcha" style="display:block;float:right;" />
			<?php } elseif($Options['captcha']=='cap') {  ?>
                	<input type="text" name="string" style="width:66px;display:block;float:right;margin-top:6px;" /> <img src="<?php echo $CONFIG["folder_name"]; ?>captcha.php" style="display:block;float:right;padding-right:10px;" />
            <?php } else {  ?>
                	<input type="text" name="string" style="width:66px;display:block;float:right;margin-top:6px;" /> <img src="<?php echo $CONFIG["folder_name"]; ?>captchasimple.php" style="display:block;float:right;padding-right:10px;" />
            <?php } ?>
            </td>
            <td align="left" style="padding:6px;color:<?php echo $OptionsVisC["label_font_color"];?>;font-size:<?php echo $OptionsVisC["label_font_size"];?>;font-style:<?php echo $OptionsVisC["label_font_style"];?>;font-weight:<?php echo $OptionsVisC["label_font_weight"];?>;"><?php echo $OptionsLang["Enter_verification_code"]; ?></td>
          </tr>
          <?php 
		  }
		  ?>
          
          <?php if($Options['verify_answer']!='') { // if the verification answer is empry ?>			
          <tr>    
            <td align="left" colspan="2" valign="top" style="padding:6px;color:<?php echo $OptionsVisC["label_font_color"];?>;font-size:<?php echo $OptionsVisC["label_font_size"];?>;font-style:<?php echo $OptionsVisC["label_font_style"];?>;font-weight:<?php echo $OptionsVisC["label_font_weight"];?>;"><?php echo ReadDB($Options["verify_question"]); ?></td>
          </tr>
          <tr>    
            <td align="left" colspan="2" valign="top" style="padding:6px;color:<?php echo $OptionsVisC["label_font_color"];?>;font-size:<?php echo $OptionsVisC["label_font_size"];?>;font-style:<?php echo $OptionsVisC["label_font_style"];?>;font-weight:<?php echo $OptionsVisC["label_font_weight"];?>;"><input type="text" name="verify_answer" style="float:left;" size="10" autocomplete="off" /> <div style="float:left; padding-left:5px;">*</div></td>
          </tr>
          <?php } ?>
          
          <tr>
            <td colspan="2" style="padding:6px;padding-left:<?php echo $OptionsVisC["comm_padding"];?>;padding-top:0;padding-bottom:0;">* - <span style="font-size:10px;"><?php echo $OptionsLang["Reqiured_fields"]; ?></span></td>
          </tr>
          <tr>
            <td style="padding:6px;padding-left:<?php echo $OptionsVisC["comm_padding"];?>;">&nbsp;</td>
            <td align="left" style="padding:6px;"><input type="submit" name="button" value="<?php echo $OptionsLang["Submit_Comment"]; ?>" onclick="return checkComment(this.form)" /></td>
          </tr>
        </table>
        </form>
        
        <?php 
        } // end if news_comments true
        ?>

    
	<?php 
	} // end if mysql num rows 
	mysql_free_result($sql_result);
	?>
<?php
} else {
?>

	<?php $height = 0; $paddingright = 0; ?>
	<div style="clear:both;height:0;"></div>
	<?php if(!isset($_REQUEST['hide_cat'])) { 
		$sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
		$sql_result = mysql_query ($sql, $conn) or die ('Could not execute MySQL query: '.$sql.' . Error: '.mysql_error());
		if (mysql_num_rows($sql_result)>0) {
			$height = 10;	$paddingright = 12;
		?>
        <div style="float:right; padding-bottom:0px;padding-top:18px;">
		<select name="cat_id" onchange="window.location.href='<?php echo $thisPage; ?>?cat_id='+this.value">
			<option value="0">ALL</option>
			<?php
			$sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
			$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
			while ($Cat = mysql_fetch_assoc($sql_result)) { ?>
				<option value="<?php echo $Cat["id"]; ?>"<?php if ($Cat["id"]==$_REQUEST["cat_id"]) echo ' selected="selected"'?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
			<?php } ?>
		</select>
        </div>
		<?php } ?>    	
    <?php } mysql_free_result($sql_result); ?>
    
    <?php if($Options['showsearch']=='yes') {
			$height = 10;	
	?>
    <div style="float:right; padding-bottom:10px; padding-right: <?php echo $paddingright; ?>px;">
    <form action="<?php echo $thisPage; ?>?cat_id=<?php echo $_REQUEST["cat_id"]; ?>" method="post" name="form" style="margin:0; padding:0;">
      <input type="text" name="search" value="<?php if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') echo htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES); ?>" />
      <input name="SearchNews" type="submit" value="<?php echo $OptionsLang["Search_button"]; ?>" />
    </form>
    </div>    
    <?php } ?>
    
    <div style="clear:both;height:<?php echo $height; ?>px;"></div>
    

  	<div>  	
    	<?php 
		if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
			$pageNum = (int) mysql_real_escape_string(urldecode($_REQUEST["p"]));
			if($pageNum<=0) $pageNum = 1;
		} else { 
			$pageNum = 1;
		}
		
		$search = "";
		if ($_REQUEST["cat_id"]>0) $search .= " AND cat_id='".mysql_real_escape_string(htmlentities($_REQUEST["cat_id"]))."'";
		
		if ($_REQUEST["editor_id"]>0) $search .= " AND editor_id='".mysql_real_escape_string(htmlentities($_REQUEST["editor_id"]))."'";
		
		if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
			$find = mysql_real_escape_string(urldecode($_REQUEST["search"]));
			$search .= " AND (title LIKE '%".$find."%' OR summary LIKE '%".$find."%' OR content LIKE '%".$find."%')";
		}
		
		if ($Options["publishon"]=="yes") $search .= " AND publish_date <= NOW() ";
				
		$sql = "SELECT count(*) as total FROM ".$TABLE["News"]." WHERE status='Published' ".$search;
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
		$row  = mysql_fetch_array($sql_result);
		mysql_free_result($sql_result);
		$total_pages = $row["total"];
		$adjacents = 2; // the adjacents to the current page digid when some pages are hidden
		$limit = $Options["per_page"];  //how many items to show per page
		$page = (int) mysql_real_escape_string(urldecode($_GET["p"]));
		
		if($page) { 
			$start = ($page - 1) * $limit;  //first item to display on this page
		} else {
			$start = 0;	 //if no page var is given, set start to 0
		}
		
		/* Setup page vars for display. */
		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		// pagination query and variables ends
	
		$sql = "SELECT * FROM ".$TABLE["News"]."  
				WHERE status='Published' ".$search." 
				ORDER BY publish_date DESC 
				LIMIT " . ($pageNum-1)*$Options["per_page"] . "," . $Options["per_page"];	
		$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
		
		if (mysql_num_rows($sql_result)>0) {	
		  while ($News = mysql_fetch_assoc($sql_result)) {
		?>
        
        <div<?php if(ReadDB($News['highlight'])=='true') { ?> style="padding:<?php echo $OptionsVis["hl_padding"];?>; background-color:<?php echo $OptionsVis["hl_bgr_color"];?>;"<?php } ?>>
        
        
        <?php if($Options['shownews']=='TitleAndSummary') { ?>
        <!-- start table for TitleAndSummary image -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin:0;">
         <tr>
           <?php if(ReadDB($News["image"])!='' and $OptionsVis["summ_show_image"]=='yes') { ?>
           <td valign="top" align="left" width="<?php echo $OptionsVis["summ_img_width"];?>">
          	  		
            <div style="padding-right:10px; padding-top:3px;">
            	<a href="<?php echo $thisPage; ?>?id=<?php echo $News['id']; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;p=<?php echo $_REQUEST["p"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>#ontitle">
            		<img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_thumbs"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" width="<?php echo $OptionsVis["summ_img_width"];?>"<?php if($OptionsVis['summ_img_height']!="") {?>height="<?php echo $OptionsVis['summ_img_height']; ?>"<?php }?> border="0" style="border:0;" />
                </a>
            </div>
                    
           </td>
           <?php } ?>
           
           <td valign="top">  
        <?php } // end if shownews == TitleAndSummary - for image ?>    
        
  			<div <?php if($Options['shownews']=='FullNews') { ?>style="text-align:<?php echo $OptionsVis["title_text_align"];?>;"<?php } else { ?>style="text-align:<?php echo $OptionsVis["summ_title_text_align"];?>;"<?php } ?>>
             <a <?php if($Options['shownews']=='FullNews') { ?>style="color:<?php echo $OptionsVis["title_color"];?>;font-family:<?php echo $OptionsVis["title_font"];?>;font-size:<?php echo $OptionsVis["title_size"];?>;font-weight:<?php echo $OptionsVis["title_font_weight"];?>;font-style:<?php echo $OptionsVis["title_font_style"];?>;text-decoration:none"<?php } else { ?>style="color:<?php echo $OptionsVis["summ_title_color"];?>;font-family:<?php echo $OptionsVis["summ_title_font"];?>;font-size:<?php echo $OptionsVis["summ_title_size"];?>;font-weight:<?php echo $OptionsVis["summ_title_font_weight"];?>;font-style:<?php echo $OptionsVis["summ_title_font_style"];?>;text-decoration:none"<?php } ?> onmouseover="this.style.textDecoration = 'underline'" onmouseout="this.style.textDecoration = 'none'" href="<?php echo $thisPage; ?>?id=<?php echo $News['id']; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;p=<?php echo $_REQUEST["p"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>#ontitle">
				<?php echo ReadDB($News["title"]); ?>
             </a>
            </div>
        	
            <?php if($Options['shownews']=='FullNews') { ?>
            <div style="clear:both; height:<?php echo $OptionsVis["dist_title_date"];?>;padding:0;margin:0;line-height:0;"></div>
            <?php } else { ?>
            <div style="clear:both; height:<?php echo $OptionsVis["summ_dist_title_date"];?>;padding:0;margin:0;line-height:0;"></div>
        	<?php } ?>
            
            <?php if($OptionsVis["summ_show_date"]=='yes') { ?>
        	<div <?php if($Options['shownews']=='FullNews') { ?>style="color:<?php echo $OptionsVis["date_color"];?>;font-family:<?php echo $OptionsVis["date_font"];?>;font-size:<?php echo $OptionsVis["date_size"];?>;font-style:<?php echo $OptionsVis["date_font_style"];?>;text-align:<?php echo $OptionsVis["date_text_align"];?>;"<?php } else { ?>style="color:<?php echo $OptionsVis["summ_date_color"];?>;font-family:<?php echo $OptionsVis["summ_date_font"];?>;font-size:<?php echo $OptionsVis["summ_date_size"];?>;font-style:<?php echo $OptionsVis["summ_date_font_style"];?>;text-align:<?php echo $OptionsVis["summ_date_text_align"];?>;"<?php } ?>>
				<?php echo lang_date(date($OptionsVis["summ_date_format"],strtotime($News["publish_date"]))); ?> 
                <?php if($OptionsVis["summ_showing_time"]!='') echo date($OptionsVis["summ_showing_time"],strtotime($News["publish_date"])); ?>
            </div>
        	<?php } ?>
        	
            <?php if($Options['shownews']=='FullNews') { ?>
        	<div style="clear:both; height:<?php echo $OptionsVis["dist_date_text"];?>;padding:0;margin:0;line-height:0;"></div>
        	<?php } else { ?>
            <div style="clear:both; height:<?php echo $OptionsVis["summ_dist_date_text"];?>;padding:0;margin:0;line-height:0;"></div>
        	<?php } ?>
            
            
        	<?php if($Options['shownews']=='TitleAndSummary') { ?>
        
			<div style="color:<?php echo $OptionsVis["summ_color"];?>; font-family:<?php echo $OptionsVis["summ_font"];?>; font-size:<?php echo $OptionsVis["summ_size"];?>;font-style: <?php echo $OptionsVis["summ_font_style"];?>;text-align:<?php echo $OptionsVis["summ_text_align"];?>;line-height:<?php echo $OptionsVis["summ_line_height"];?>;">
        	
			 <?php echo nl2br(ReadDB($News["summary"])); ?> &nbsp; 
             <a style="color:<?php echo $OptionsVis["summ_title_color"];?>; text-decoration: underline" href="<?php echo $thisPage; ?>?id=<?php echo $News['id']; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;p=<?php echo $_REQUEST["p"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>#ontitle"><?php echo $OptionsLang['Read_more']; ?></a>
        	</div>
            
          </td>
         </tr>
        </table>
        <!-- end table for TitleAndSummary image -->
                
		<?php } elseif($Options['shownews']=='FullNews') { ?>
         
        <div style="color:<?php echo $OptionsVis["cont_color"];?>; font-family:<?php echo $OptionsVis["cont_font"];?>; font-size:<?php echo $OptionsVis["cont_size"];?>;font-style: <?php echo $OptionsVis["cont_font_style"];?>;text-align:<?php echo $OptionsVis["cont_text_align"];?>;line-height:<?php echo $OptionsVis["cont_line_height"];?>;">
          <?php if(ReadDB($News["image"])!='') { ?>
        	<?php if(ReadDB($News["imgpos"])=='left') { ?><div style="float:left"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>"<?php if($News["imgheight"]!="") {?> height="<?php echo $News["imgheight"] ?>"<?php }?> alt="<?php echo ReadDB($News["title"]); ?>" style="padding-right:14px; padding-bottom:6px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
            <?php if(ReadDB($News["imgpos"])=='right') { ?><div style="float:right"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" alt="<?php echo ReadDB($News["title"]); ?>" style="padding-left:14px; padding-bottom:6px; padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>"<?php if($News["imgheight"]!="") {?> height="<?php echo $News["imgheight"] ?>"<?php }?> /></div><?php } ?>
            <?php if(ReadDB($News["imgpos"])=='top') { ?><div style="clear:both; text-align:center"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>"<?php if($News["imgheight"]!="") {?> height="<?php echo $News["imgheight"] ?>"<?php }?> alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:6px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
          <?php } ?>
			<?php echo ReadDB($News["content"]); ?> 
          <?php if(ReadDB($News["image"])!='') { ?>
            <?php if(ReadDB($News["imgpos"])=='bottom') { ?><div style="clear:both; text-align:center"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>"<?php if($News["imgheight"]!="") {?> height="<?php echo $News["imgheight"] ?>"<?php }?> alt="<?php echo ReadDB($News["title"]); ?>" style="padding-bottom:10px;padding-top:10px;" width="<?php echo $News["imgwidth"]; ?>" /></div><?php } ?>
           <?php } ?>
        </div>
        	
            <?php 
			$sqlU = "UPDATE ".$TABLE["News"]." 
					SET reviews = reviews + 1 
					WHERE id='".$News["id"]."'";
			$sql_resultU = mysql_query ($sqlU, $conn ) or die ('MySQL query error: '.$sqlU.'. Error: '.mysql_error());	
			?>
        
		<?php } else { 
				// only titles
			  }
		?>
        <div style="clear:both; height:0;"></div>
        </div>
        
             
        <div style="clear:both; height:<?php echo $OptionsVis["dist_btw_news"];?>;"></div>
        
    	  <?php 
		  } 
        } else {
		?>
        <div style="line-height:20px; padding-bottom:20px;"><?php echo $OptionsLang['No_news_published'] ?></div>
        <?php	
		}
		mysql_free_result($sql_result);
		?>   
              
	</div>
    
    	<!-- Pagination start here --> 
        <div style="padding-top:8px;font-style:<?php echo $OptionsVis["pag_font_style"];?>;font-size:<?php echo $OptionsVis["pag_font_size"];?>">  
		<?php 
        // pagination starts. It can be shown wherever we need
        if($lastpage > 1) {	
        ?>
        <div class="pagination">
            <?php
            //previous button starts
            if ($page > 1) {
            ?>	 
            <a class="next_prev" href="<?php echo $thisPage."?p=".$prev;?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]);?>"><?php echo $OptionsLang["Previous"];?></a>
            <?php } else { ?>
            <span class="disabled"><?php echo $OptionsLang["Previous"]; ?></span>	
            <?php 
            }
            //previous button ends
            
            //pages	start
            if ($lastpage < 7 + ($adjacents * 2)) {	//not enough pages to bother breaking it up
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page) { ?>
                    <span class="current"><?php echo $counter; ?></span>
                    <?php } else { ?>
                    <a href="<?php echo $thisPage."?p=".$counter; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]);?>"><?php echo $counter; ?></a>
                    <?php } 				
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2)) {	//enough pages to hide some		
                //close to beginning; only hide later pages
                if($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page) { ?>
                        <span class="current"><?php echo $counter; ?></span>
                        <?php } else { ?>
                        <a href="<?php echo $thisPage."?p=".$counter;?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]);?>"><?php echo $counter;?></a>
                        <?php } 				
                    } ?>
                    ...<a href="<?php echo $thisPage."?p=".$lpm1; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]);?>"><?php echo $lpm1; ?></a>
                    <a href="<?php echo $thisPage."?p=".$lastpage; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]);?>"><?php echo $lastpage; ?></a>
                    
                <?php   
                } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) { //in middle; hide some front and some back ?>
                    <a href="<?php echo $thisPage; ?>?p=1&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>">1</a>
                    <a href="<?php echo $thisPage; ?>?p=2&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>">2</a>...
                    
                    <?php 
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page) { ?>
                            <span class="current"><?php echo $counter; ?></span>
                    <?php } else { ?>
                            <a href="<?php echo $thisPage."?p=".$counter; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>"><?php echo $counter; ?></a>	
                    <?php } 
                                            
                    } ?>
                    ...<a href="<?php echo $thisPage."?p=".$lpm1; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>"><?php echo $lpm1; ?></a>
                    <a href="<?php echo $thisPage."?p=".$lastpage; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>"><?php echo $lastpage; ?></a>
                <?php     		
                } else { //close to end; only hide early pages  ?>
    
                    <a href="<?php echo $thisPage; ?>?p=1&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>">1</a>
                    <a href="<?php echo $thisPage; ?>?p=2&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>">2</a>...
                    <?php 
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page) { ?>
                            <span class="current"><?php echo $counter; ?></span>
                        <?php } else { ?>
                            <a href="<?php echo $thisPage."?p=".$counter; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>"><?php echo $counter; ?></a>
                        <?php } 					
                    }
                }
            }
            
            //next button
            if ($page < $counter - 1) { ?>
                <a class="next_prev" href="<?php echo $thisPage."?p=".$next; ?>&amp;cat_id=<?php echo $_REQUEST["cat_id"]; ?>&amp;search=<?php echo urlencode($_REQUEST["search"]); ?>"><?php echo $OptionsLang["Next"]; ?></a>
            <?php } else { ?>
                <span class="disabled"><?php echo $OptionsLang["Next"]; ?></span>
        	<?php 
            }
			?>
        	</div>
        <?php 
        } // pagination ends	
        ?> 
    	</div>
    	<!-- Pagination end here --> 

<?php
}
?>
</div>
</div>
