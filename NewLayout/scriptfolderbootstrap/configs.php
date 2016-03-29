<?php 
error_reporting(0);

$CONFIG["hostname"]='localhost';
$CONFIG["mysql_user"]='skibbdcc_usernam';
$CONFIG["mysql_password"]='fastnetrally85';
$CONFIG["mysql_database"]='skibbdcc_example';
$CONFIG["server_path"]='/home/skibbdcc/public_html/scriptfolder/';
$CONFIG["full_url"]='http://www.skibbdcc.com/scriptfolder/';
$CONFIG["folder_name"]='/scriptfolder/';
$CONFIG["admin_user"]='Alan';
$CONFIG["admin_pass"]='0000';
$CONFIG["hostname"]='localhost';
$CONFIG["mysql_user"]='skibbdcc_usernam';
$CONFIG["mysql_password"]='fastnetrally85';
$CONFIG["mysql_database"]='skibbdcc_news';
$CONFIG["server_path"]='/home/skibbdcc/public_html/scriptfolder/';
$CONFIG["full_url"]='http://www.skibbdcc.com/scriptfolder/';
$CONFIG["folder_name"]='/scriptfolder/';
$CONFIG["admin_user"]='Alan Mulligan';
$CONFIG["admin_pass"]='05c18815';


//////////////////////////////////////////
////////// DO NOT CHANGE BELOW ///////////
//////////////////////////////////////////

$CONFIG["upload_folder"]='upload/';
$CONFIG["upload_thumbs"]='upload/thumbs/';

$TABLE["News"] 		= 'pa_npro_news';
$TABLE["Archives"] 	= 'pa_npro_archives';
$TABLE["Categories"]= 'pa_npro_categories';
$TABLE["Comments"] 	= 'pa_npro_comments';
$TABLE["Editors"] 	= 'pa_npro_editors';
$TABLE["Options"] 	= 'pa_npro_options';

$Version = 1.4;

if ($installed != 'yes') {
	$conn = mysql_connect($CONFIG["hostname"], $CONFIG["mysql_user"], $CONFIG["mysql_password"]) or die ('Unable to connect to MySQL server.'.mysql_error());
	mysql_query('set names utf8', $conn);
	$db = mysql_select_db($CONFIG["mysql_database"], $conn) or die ('Unable to select database.'.mysql_error());
}

require_once('include/functions.php');
require_once('recaptchalib.php');


//// front-end functions
function cutText($strMy, $maxLength)
{
	$ret = substr($strMy, 0, $maxLength);
	if (substr($ret, strlen($ret)-1,1) != " " && strlen($strMy) > $maxLength) {
		$ret1 = substr($ret, 0, strrpos($ret," "))." ...";
	} elseif(substr($ret, strlen($ret)-1,1) == " " && strlen($strMy) > $maxLength) {
		$ret1 = $ret." ...";
	} else {
		$ret1 = $ret;
	}
	return $ret1;
}

$configs_are_set = 1;
?>