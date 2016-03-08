<?php
header("Content-Type: application/rss+xml");
include("configs.php");

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
$Options = mysql_fetch_assoc($sql_result);

echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
<channel>
	<title>News RSS</title>
	<link><?php echo $CONFIG["full_url"]; ?></link>
    <description>latest 10 news</description>
<?php
	$sql = "SELECT * FROM ".$TABLE["News"]." WHERE status='Published' ORDER BY publish_date DESC LIMIT 0,10";
	$sql_result = mysql_query ($sql, $conn ) or die ('MySQL Query '.$sql.' have error: '.mysql_error());
	while ($News = mysql_fetch_assoc($sql_result)) {
		$isPermaLink = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFG1234567890'), 0, 20);
?>
	<item>
    	
        <title><?php echo ReadDB($News["title"]); ?></title>
		<link><?php if(trim($Options["news_link"])!=''){ echo ReadDB($Options["news_link"])."?id=".$News['id']; } else { echo $CONFIG["full_url"]."preview.php?id=".$News["id"]; } ?></link>
		<description><?php echo ReadDB($News["summary"]); ?></description>
		<guid isPermaLink="false"><?php echo $CONFIG["full_url"]; ?></guid>
        <pubDate><?php echo date("D, d M Y H:i:s O",strtotime($News["publish_date"])); ?></pubDate>
        
        
        <media:content url="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].$News["image"]; ?>" fileSize="<?php echo filesize($CONFIG["upload_folder"].$News["image"]); ?>" type="image/jpeg" width="<?php echo $News["imgwidth"];?>">

			<media:title><?php echo ReadDB($News["title"]); ?></media:title>

			<media:description><?php echo ReadDB($News["summary"]); ?></media:description>

			<media:thumbnail url="<?php echo $CONFIG["full_url"].$CONFIG["upload_thumbs"].ReadDB($News["image"]); ?>" width="<?php echo $OptionsVis["summ_img_width"];?>"/>
            
		</media:content>
        
	</item>
<?php } ?>
</channel>
</rss>