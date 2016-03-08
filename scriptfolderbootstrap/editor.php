<?php
error_reporting(0);
session_start();
include("configs.php");
include("language_editor.php");

if(isset($_REQUEST["act"])) {
  if ($_REQUEST["act"]=='logout') {
			$_SESSION["ProFiAnTsEdiTorNeWsPRoLoGin"] = "";
			unset($_SESSION["ProFiAnTsEdiTorNeWsPRoLoGin"]);
			$_SESSION["EditorId"] = "";
			unset($_SESSION["EditorId"]);
 } elseif ($_REQUEST["act"]=='login') {
 	$sql = "SELECT * FROM ".$TABLE["Editors"]." WHERE editor_username='".mysql_escape_string($_REQUEST["user"])."' AND editor_password='".mysql_escape_string($_REQUEST["pass"])."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
  	if (mysql_num_rows($sql_result)==1) {
		$EditorId = mysql_fetch_assoc($sql_result);
		$_SESSION["ProFiAnTsEdiTorNeWsPRoLoGin"] = "LoggedIn";	
		$_SESSION["EditorId"] = $EditorId['id'];		
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
<title><?php echo $lang['News_Script_PHP_Pro_Editors']; ?></title>

<script language="javascript" src="include/functions.js"></script>
<script language="javascript" src="include/color_pick.js"></script>
<script type="text/javascript" src="include/datetimepicker_css.js"></script>
<link href="styles/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>

<body>
<center>
<div class="logo"><?php echo $lang['News_Script_PHP_Pro_Editors']; ?></div>
<div style="clear:both"></div>

<?php  
$Logged = false;
if ((isset($_SESSION["ProFiAnTsEdiTorNeWsPRoLoGin"])) and ($_SESSION["ProFiAnTsEdiTorNeWsPRoLoGin"]=="LoggedIn")) {
	$Logged = true;
	$EditorId = $_SESSION['EditorId'];
}
if ( $Logged ){

if ($_REQUEST["act"] == "addNews"){
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql);
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	if (!isset($_REQUEST["topnews"]) or $_REQUEST["topnews"]=='') $_REQUEST["topnews"] = 'false';
	if (!isset($_REQUEST["highlight"]) or $_REQUEST["highlight"]=='') $_REQUEST["highlight"] = 'false';
	if (!isset($_REQUEST["news_comments"]) or $_REQUEST["news_comments"]=='') $_REQUEST["news_comments"] = 'false';
	
	$sql = "INSERT INTO ".$TABLE["News"]." 
			SET publish_date 	= '".SaveDB($_REQUEST["publish_date"])."',
				status 			= '".SaveDB($_REQUEST["status"])."',	
				cat_id 			= '".SaveDB($_REQUEST["cat_id"])."',		
				editor_id 		= '".$EditorId."',				
				topnews 		= '".SaveDB($_REQUEST["topnews"])."',
				highlight 		= '".SaveDB($_REQUEST["highlight"])."',
				slider 			= '".SaveDB($_REQUEST["slider"])."',
				title 			= '".SaveDB($_REQUEST["title"])."',
				summary 		= '".SaveDB($_REQUEST["summary"])."',
				content 		= '".SaveDB($_REQUEST["content"])."',
				imgpos 			= '".SaveDB($_REQUEST["imgpos"])."',
				imgwidth 		= '".SaveDB($_REQUEST["imgwidth"])."',
				imgheight		= '".SaveDB($_REQUEST["imgheight"])."',  
				news_comments 	= '".SaveDB($_REQUEST["news_comments"])."',  
				reviews 		= '0'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());	
	
	$index_id = mysql_insert_id();
	
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) {
		
		$format = end(explode(".", $_FILES["image"]['name']));
		$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");
			
		if(in_array($format, $formats)) {	
		
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
						SET image = '".$name."'  
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
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql);
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	if (!isset($_REQUEST["topnews"]) or $_REQUEST["topnews"]=='') $_REQUEST["topnews"] = 'false';
	if (!isset($_REQUEST["highlight"]) or $_REQUEST["highlight"]=='') $_REQUEST["highlight"] = 'false';
	if (!isset($_REQUEST["news_comments"]) or $_REQUEST["news_comments"]=='') $_REQUEST["news_comments"] = 'false';

	$sql = "UPDATE ".$TABLE["News"]." 
			SET publish_date 	= '".SaveDB($_REQUEST["publish_date"])."',
				status 			= '".SaveDB($_REQUEST["status"])."',	
				cat_id 			= '".SaveDB($_REQUEST["cat_id"])."',		
				editor_id 		= '".$EditorId."',					
				topnews 		= '".SaveDB($_REQUEST["topnews"])."',
				highlight 		= '".SaveDB($_REQUEST["highlight"])."',
				slider 			= '".SaveDB($_REQUEST["slider"])."',
                title 			= '".SaveDB($_REQUEST["title"])."',
				summary 		= '".SaveDB($_REQUEST["summary"])."',
				content 		= '".SaveDB($_REQUEST["content"])."',
				imgpos 			= '".SaveDB($_REQUEST["imgpos"])."', 
				imgwidth 		= '".SaveDB($_REQUEST["imgwidth"])."',
				imgwidth 		= '".SaveDB($_REQUEST["imgwidth"])."',
				news_comments 	= '".SaveDB($_REQUEST["news_comments"])."'  
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
			
		if(in_array($format, $formats)) {	
		
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
	
} elseif ($_REQUEST["act"]=='delNews') {
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id = '".$_REQUEST["id"]."' AND editor_id = '".$EditorId."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
	$imageArr = mysql_fetch_assoc($sql_result);
	$image = stripslashes($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);
	if($image != "") unlink($CONFIG["upload_thumbs"].$image);

	$sql = "DELETE FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."' AND editor_id = '".$EditorId."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
 	$_REQUEST["act"]='news'; 
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
	
} elseif ($_REQUEST["act2"]=="change_status") { 
	
	$sql = "UPDATE ".$TABLE["News"]." 
			SET status = '".SaveDB($_REQUEST["status"])."' 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	$message = $lang['Message_Status_Updated'];
	$_REQUEST["act"] = "news";

	
} elseif ($_REQUEST["act2"]=="change_status_comm") { 
	
	$sql = "UPDATE ".$TABLE["Comments"]." 
			SET status = '".SaveDB($_REQUEST["status"])."' 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	$message = $lang['Message_Comment_Status_Updated'];
	$_REQUEST["act"] = "comments";

} elseif ($_REQUEST["act"]=='updateComment') {

	$sql = "UPDATE ".$TABLE["Comments"]." 
			SET status		='".$_REQUEST["status"]."', 
				name	='".SaveDB($_REQUEST["name"])."', 
				email	='".SaveDB($_REQUEST["email"])."', 
				comment	='".SaveDB($_REQUEST["comment"])."' 
			WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql);
	$_REQUEST["act"]='comments'; 
	$message = $lang['Message_Comment_updated'];
	
} elseif ($_REQUEST["act"]=='delComment') {
	
	$sql = "DELETE FROM ".$TABLE["Comments"]." WHERE id='".$_REQUEST["id"]."'";
   	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql." ".mysql_error());
 	$_REQUEST["act"]='comments'; 
	$message = $lang['Message_Comment_deleted'];

}
if ($_REQUEST["act"]=='' or !isset($_REQUEST["act"])) $_REQUEST["act"]='news';
?> 

	<div class="blue_line"></div>
    
	<div class="divMenu">	
      <div class="menuButtons">
   	  	<div class="menuButton"><a<?php if($_REQUEST['act']=='news' or $_REQUEST['act']=='newNews' or $_REQUEST['act']=='viewNews' or $_REQUEST['act']=='editNews' or $_REQUEST['act']=='rss') echo ' class="selected"'; ?> href="editor.php?act=news"><?php echo $lang['menu_News']; ?></a></div>
        <div class="menuButton"><a<?php if($_REQUEST['act']=='comments' or $_REQUEST['act']=='editComment') echo ' class="selected"'; ?> href="editor.php?act=comments"><?php echo $lang['menu_Comments'] ?></a></div>
        <div class="menuButtonLogout"><a href="editor.php?act=logout"><?php echo $lang['menu_Logout']; ?></a></div>
        <div class="clear"></div>        
      </div>
	</div>
	
    <div class="blue_line"></div>


<?php
if ($_REQUEST["act"]=='news' or $_REQUEST["act"]=='newNews' or $_REQUEST["act"]=='editNews' or $_REQUEST["act"]=='viewNews' or $_REQUEST["act"]=='rss') {
?>
<div class="divSubMenu">	
    <div class="menuSubButtons">
   	  <div class="menuSubButton"><a<?php if($_REQUEST['act']=='news') echo ' class="selected"'; ?> href="editor.php?act=news"><?php echo $lang['menu_News_List']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newNews') echo ' class="selected"'; ?> href="editor.php?act=newNews"><?php echo $lang['menu_Create_News']; ?></a></div>
      <div class="menuSubButton"><a href="preview.php" target="_blank"><?php echo $lang['menu_News_Preview']; ?></a></div>
      <div class="menuSubButton"><a href="preview_top.php" target="_blank"><?php echo $lang['menu_TopNews_Preview']; ?></a></div>
      <div class="menuSubButton"><a href="preview_slider.php" target="_blank"><?php echo $lang['menu_Slider_Preview']; ?></a></div>
      <div class="clear"></div>        
    </div>
</div>
<?php
}
?>

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
	
	$sqlPublished   = "SELECT id FROM ".$TABLE["News"]." WHERE status='Published' AND editor_id=".$EditorId;
	$sql_resultPublished = mysql_query ($sqlPublished, $conn ) or die ('MySQL query error: '.$sqlPublished.'. Error: '.mysql_error());
	$NewsPublished = mysql_num_rows($sql_resultPublished);
	
	$sqlCount   = "SELECT id FROM ".$TABLE["News"]." WHERE editor_id=".$EditorId;
	$sql_resultCount = mysql_query ($sqlCount, $conn ) or die ('MySQL query error: '.$sqlCount.'. Error: '.mysql_error());
	$NewsCount = mysql_num_rows($sql_resultCount);
?>
	<div class="pageDescr"><?php echo $lang['List_Below_is_a_list']; ?> <strong style="font-size:16px"><?php echo $NewsPublished; ?></strong> <?php echo $lang['List_news_published']; ?> <strong style="font-size:16px"><?php echo $NewsCount; ?></strong>.</div>
    
    <div class="searchForm">
    <form action="editor.php?act=news" method="post" name="form" class="formStyle">
      <input type="text" name="search" onfocus="searchdescr(this.value);" value="<?php if(isset($_REQUEST["search"])) echo $_REQUEST["search"]; else echo 'enter part of news title'; ?>" class="searchfield" />
      <input type="submit" value="<?php echo $lang['List_Search_for_news']; ?>" class="submitButton" />
    </form>
    </div>
    
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td class="headlist"><a href="editor.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=title"><?php echo $lang['List_Title']; ?></a></td>
        <td width="16%" class="headlist"><a href="editor.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['List_Date_published']; ?></a></td>
        <td width="11%" class="headlist"><a href="editor.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['List_Status']; ?></a></td>
        <td width="10%" class="headlist"><a href="editor.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=cat_id"><?php echo $lang['List_Category']; ?></a></td>
        <td width="9%" class="headlist"><?php echo $lang['List_Comments']; ?></td>
        <td width="8%" class="headlist"><a href="editor.php?act=news&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=reviews"><?php echo $lang['List_Reviews']; ?></a></td>
        <td class="headlist" colspan="3">&nbsp;</td>
  	  </tr>
      
  	<?php 
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
	  $findMe = mysql_escape_string($_REQUEST["search"]);
	  $search = " AND title LIKE '%".$findMe."%'";
	} else {
	  $search = '';
	}

	$sql   = "SELECT count(*) as total FROM ".$TABLE["News"]." WHERE editor_id=".$EditorId." ".$search;
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$row   = mysql_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/20);

	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE editor_id=".$EditorId." ".$search." 
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
        <td class="bodylist">
        	<form action="editor.php?act=news" method="post" name="form<?php echo $i; ?>" class="formStyle">
            <input type="hidden" name="act2" value="change_status" />
            <input type="hidden" name="id" value="<?php echo $News["id"]; ?>" />
            <select name="status" onChange="document.form<?php echo $i; ?>.submit()">
				<option value="Published" <?php if($News['status']=='Published') echo "selected='selected'"; ?>><?php echo $lang['List_Published']; ?></option>
				<option value="Hidden" <?php if($News['status']=='Hidden') echo "selected='selected'"; ?>><?php echo $lang['List_Hidden']; ?></option>
            </select>
            </form>
        </td>        
        <td class="bodylist">
        	<?php 
			$sqlCat = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$News["cat_id"]."'";
			$sql_resultCat = mysql_query ($sqlCat, $conn ) or die ('MySQL query error: '.$sqlCat.'. Error: '.mysql_error());
			$Cat = mysql_fetch_assoc($sql_resultCat);	
			if($Cat["id"]>0) echo ReadDB($Cat["cat_name"]); else echo "------"; ?>
        </td>
        <td class="bodylist"><a style="text-decoration:none" href="editor.php?act=comments&news_id=<?php echo $News["id"]; ?>"><?php echo $countComm["total"]; ?></a> <?php if($News["news_comments"]=='false') echo "<sub>(not allowed)</sub>"; ?></td>
        <td class="bodylist"><?php if($News["reviews"]=='') echo "0"; else echo $News["reviews"]; ?></td>
        <td class="bodylistAct"><a class="view" href='editor.php?act=viewNews&id=<?php echo $News["id"]; ?>'><?php echo $lang['List_Preview']; ?></a></td>
        <td class="bodylistAct"><a href='editor.php?act=editNews&id=<?php echo $News["id"]; ?>'><?php echo $lang['List_Edit']; ?></a></td>
        <td class="bodylistAct"><a class="delete" href="editor.php?act=delNews&id=<?php echo $News["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');"><?php echo $lang['List_DELETE']; ?></a></td>
  	  </tr>
  	<?php 
			$i++;
		}
	} else {
	?>
      <tr>
      	<td colspan="9" style="border-bottom:1px solid #CCCCCC"><?php echo $lang['List_No_News']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>0) {
    ?>
  	  <tr>
      	<td colspan="9" class="bottomlist"><div class='paging'><?php echo $lang['List_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='editor.php?act=news&p=".$i."&search=".$_REQUEST["search"]."' class='paging'>".$i."</a>"; 
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
} elseif ($_REQUEST["act"]=='newNews') { 
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql);
	$Options = mysql_fetch_assoc($sql_result);
	mysql_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
?>
	<form action="editor.php" method="post" name="form" enctype="multipart/form-data">
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
            	<option value="320px" selected="selected">320px</option>
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
                <option value="70px">70px</option>
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
                <option value="240px" selected="selected">240px</option>
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
                <option value="70px">70px</option>
                <option value="70px">70px</option>
                <option value="60px">60px</option>
                <option value="50px">50px</option>
                <option value="40px">40px</option>
            </select>
        </td>
      </tr>
      
      
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_News_Publish date']; ?></td>
        <td>
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." " .$OptionsVis["time_offset"])); ?>" readonly="readonly" /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','dropdown',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a>
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
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."' AND editor_id=".$EditorId;
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$IsEditorsNews = mysql_num_rows($sql_result);
	$News = mysql_fetch_assoc($sql_result);
	
	$sqlC   = "SELECT count(*) FROM ".$TABLE["Comments"]." WHERE news_id='".$News["id"]."'";
	$sql_resultC = mysql_query ($sqlC, $conn ) or die ('MySQL query error: '.$sqlC.'. Error: '.mysql_error());
	$count = mysql_fetch_array($sql_resultC);
	
	if($IsEditorsNews==1) {
?>
	<form action="editor.php" method="post" name="form" enctype="multipart/form-data">
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
			<img src="<?php echo $CONFIG["upload_folder"].ReadDB($News["image"]); ?>" border="0" width="160" /> 			&nbsp;&nbsp;<a href="<?php $_SERVER["PHP_SELF"]; ?>?act=delImage&id=<?php echo $News["id"]; ?>">delete</a><br /> 
            If you upload new image the old one will be deleted <br />
            <?php } ?>
          	<input type="file" name="image" size="70" /> <sub><?php echo $lang['edit_News_Limit_Mb']; ?></sub>
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
      	<td><?php echo $count["count(*)"]; ?> (<a href="editor.php?act=comments&news_id=<?php echo $News["id"]; ?>"><?php echo $lang['edit_News_view']; ?></a>)</td>
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
	} else {
	?>
    <div style="color:#FF0000;font-weight:bold;clear:both; padding:20px">You don't have access to this article. If you have more questions just call to administrator.</div>
    <?php 
	}
	?>
    
<?php 
} elseif ($_REQUEST["act"]=='viewNews') {
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$Options = mysql_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	$OptionsLang = unserialize($Options['language']);
	
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$News = mysql_fetch_assoc($sql_result);
?>
	<div style="clear:both;padding-left:40px;padding-top:10px;padding-bottom:10px;"><a href="editor.php?act=editNews&id=<?php echo ReadDB($News['id']); ?>"><?php echo $lang['Preview_News_Edit_Article']; ?></a></div>
    
	<div style="font-family:<?php echo $OptionsVis["gen_font_family"];?>; font-size:<?php echo $OptionsVis["gen_font_size"];?>;margin:0 auto;width:<?php echo $OptionsVis["gen_width"];?>px; color:<?php echo $OptionsVis["gen_font_color"];?>;line-height:<?php echo $OptionsVis["gen_line_height"];?>;">
    
    
	<?php if($OptionsLang["Back_to_home"]!='') { ?>
    <div style="text-align:<?php echo $OptionsVis["link_align"]; ?>">
    	<a href="editor.php?act=news" style='font-weight:<?php echo $OptionsVis["link_font_weight"]; ?>;color:<?php echo $OptionsVis["link_color"]; ?>;font-size:<?php echo $OptionsVis["link_font_size"]; ?>;text-decoration:underline'><?php echo $OptionsLang["Back_to_home"]; ?></a>
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
    
    <div style="color:<?php echo $OptionsVis["summ_color"];?>; font-family:<?php echo $OptionsVis["summ_font"];?>; font-size:<?php echo $OptionsVis["summ_size"];?>;font-style: <?php echo $OptionsVis["summ_font_style"];?>;text-align:<?php echo $OptionsVis["summ_text_align"];?>;line-height:<?php echo $OptionsVis["summ_line_height"];?>;">
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
    <form action="editor.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>" method="post" name="form" class="formStyle">
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
	<div class="pageDescr"><?php echo $lang['Comments_list_of_comments']; ?> "<?php echo ReadDB($News["title"]); ?>". <a href="editor.php?act=comments"><?php echo $lang['Comments_click_here_to']; ?></a>.</div>
	<?php	
    }
    ?>
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
      	<td width="20%" class="headlist"><a href="editor.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['Comments_Date_published']; ?></a></td>
      	<td width="18%" class="headlist"><a href="editor.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=name"><?php echo $lang['Comments_Name']; ?></a></td>
      	<td width="12%" class="headlist"><a href="editor.php?act=comments&news_id=<?php echo $_REQUEST["news_id"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['Comments_Status']; ?></a></td>
      	<td class="headlist"><?php echo $lang['Comments_Comment_on_article']; ?></td>
      	<td colspan="2" class="headlist">&nbsp;</td>
      </tr>
      
    <?php 
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
		$find = mysql_escape_string($_REQUEST["search"]);
		$search = " AND (c.name LIKE '%".$find."%' OR c.email LIKE '%".$find."%')";
		if ($_REQUEST["news_id"]>0) $search .= " AND news_id='".$_REQUEST["news_id"]."'";
	} else {
		if ($_REQUEST["news_id"]>0) {
			$search .= " AND c.news_id='".$_REQUEST["news_id"]."'";
		} else {
			$search = '';
		}
	}
	
	$sql = "SELECT count(*) as total 
			FROM ".$TABLE["Comments"]." c, ".$TABLE["News"]." n 
			WHERE c.news_id=n.id AND n.editor_id=".$EditorId." ".$search;
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	$row   = mysql_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/30);

	$sql = "SELECT c.* FROM ".$TABLE["Comments"]." c, ".$TABLE["News"]." n 
			WHERE c.news_id=n.id AND n.editor_id=".$EditorId." ".$search." 
			ORDER BY c." . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*30 . ",30";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
	
	if (mysql_num_rows($sql_result)>0) {
		$i=1;
		while ($Comments = mysql_fetch_assoc($sql_result)) {
			$sqlC = "SELECT * FROM ".$TABLE["News"]." WHERE id='".$Comments["news_id"]."'";
			$sql_resultC = mysql_query ($sqlC, $conn ) or die ('MySQL query error: '.$sqlC.'. Error: '.mysql_error());
			$News = mysql_fetch_assoc($sql_resultC);
	?>
      <tr>
        <td class="bodylist"><?php echo admin_date($Comments["publish_date"]); ?></td>
        <td class="bodylist"><?php echo ReadHTML($Comments["name"]); ?></td>
        <td class="bodylist">
        	<form action="editor.php?act=comments" method="post" name="form<?php echo $i; ?>" class="formStyle">
            <input type="hidden" name="act2" value="change_status_comm" />
            <input type="hidden" name="id" value="<?php echo $Comments["id"]; ?>" />
            <select name="status" onChange="document.form<?php echo $i; ?>.submit()">
				<option value="Approved" <?php if($Comments['status']=='Approved') echo "selected='selected'"; ?>><?php echo $lang['Comments_Approved']; ?></option>
				<option value="Not approved" <?php if($Comments['status']=='Not approved') echo "selected='selected'"; ?>><?php echo $lang['Comments_Not_approved']; ?></option>
            </select>
            </form>			
        </td>
        <td class="bodylist"><?php echo cutText(ReadDB($News["title"]),70); ?></td>
        <td class="bodylistAct"><a href='editor.php?act=editComment&id=<?php echo $Comments["id"]; ?>&search=<?php echo $_REQUEST["search"]; ?>&news_id=<?php echo $_REQUEST["news_id"]; ?>'><?php echo $lang['Comments_Edit']; ?></a></td>
        <td class="bodylistAct"><a class="delete" href="editor.php?act=delComment&id=<?php echo $Comments["id"]; ?>&search=<?php echo $_REQUEST["search"]; ?>&news_id=<?php echo $_REQUEST["news_id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');"><?php echo $lang['Comments_DELETE']; ?></a></td>
      </tr>
    <?php 
			$i++;
		}
	} else {
	?>
      <tr>
      	<td colspan="6" style="border-bottom:1px solid #CCCCCC"><?php echo $lang['Comments_No_comments']; ?></td>
      </tr>
    <?php	
	}
	?>

	<?php
    if ($pages>0) {
    ?>
      <tr>
    	<td colspan="6" class="bottomlist"><div class='paging'><?php echo $lang['Comments_Page']; ?> </div> 
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='editor.php?act=comments&p=".$i."&search=".$_REQUEST["search"]."&news_id=".$_REQUEST["news_id"]."' class='paging'>".$i."</a>"; 
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


    <form action="editor.php" method="post" style="margin:0px; padding:0px" name="form">
    <input type="hidden" name="act" value="updateComment" />
    <input type="hidden" name="id" value="<?php echo $Comments["id"]; ?>" />
    
    <div class="pageDescr"><a href="editor.php?act=comments&search=<?php echo $_REQUEST["search"]; ?>&news_id=<?php echo $_REQUEST["news_id"]; ?>"><?php echo $lang['Edit_comment_back_to_comments']; ?></a></div>    

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
    <form action="editor.php" method="post">
    <input type="hidden" name="act" value="login">
    <table border="0" cellspacing="0" cellpadding="0" class="loginTable">
      <tr>
        <td class="loginhead" height="57" valign="middle"><?php echo $lang['EDITOR_LOGIN']; ?></td>
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