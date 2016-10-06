<?php
if(!isset($configs_are_set)) {
	include("configs.php");
}
$thisPage = $_SERVER['PHP_SELF'];

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
$Options = mysql_fetch_assoc($sql_result);
$OptionsVis = unserialize($Options['visual_top']);
$OptionsLang = unserialize($Options['language']);
?>
<script src="<?php echo $CONFIG["full_url"]; ?>include/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>include/jquery.accessible-news-slider.js"></script>
<script type="text/javascript">
// when the DOM is ready, convert the feed anchors into feed content
jQuery(document).ready(function() {

	jQuery('#newsslider').accessNews({
		title : "",
		subtitle:"",
		slideBy: <?php echo $OptionsVis["sl_gen_number"];?>,
		speed: "slow",
		slideShowInterval: <?php echo $OptionsVis["sl_gen_interval"];?>000,
		slideShowDelay: <?php echo $OptionsVis["sl_gen_interval"];?>000
	});
});
</script>

<style type="text/css">
/* Accessible News Slider: Base styles */

div.jqans-wrapper {
	-x-system-font:none;
	font-family:arial,helvetica,clean,sans-serif;
	font-size:13px;
	font-size-adjust:none;
	font-stretch:normal;
	font-style:normal;
	font-variant:normal;
	font-weight:normal;
	color:#666666;
}

div.jqans-wrapper img {
	border: 0;
}

div.jqans-wrapper ul,
div.jqans-wrapper li,
div.jqans-wrapper h1,
div.jqans-wrapper p {
	margin: 0;
	padding: 0;
}

div.jqans-wrapper {
	position: relative;
	overflow: hidden;
}

div.jqans-wrapper ul {
	position: relative;
	left: 0;
	width: auto;
	list-style-type: none;
	overflow: hidden;
	z-index: 1;
}

div.jqans-wrapper li {
	float: left;
	display: inline;
}


.slider_bigimg {
	width: <?php echo $OptionsVis["sl_img_width"];?>px;
	height: <?php echo $OptionsVis["sl_img_height"];?>px;	
}
/*************************************
	Height and Width values
	these are extremely important!!!
*************************************/

/* the stories ul and li's must have the same height */
div.jqans-wrapper.default .jqans-stories ul,
div.jqans-wrapper.default .jqans-stories li {
	height: <?php echo $OptionsVis["sl_bottom_height"];?>px;
}

div.jqans-wrapper.default .jqans-stories-selector ul,
div.jqans-wrapper.default .jqans-stories-selector li {
	height: 6px;
}

/* 
	wrapper and the container must have the same width
	in order to get this value take the width value of
	of story ".jqans-stories li" and times it by the 
	number of stories you want to initially display.
	
	107px * 4 = 428px
	
 */
div.jqans-wrapper.default,
div.jqans-wrapper.default .jqans-container {
	width: <?php echo $OptionsVis["sl_gen_width"];?>px;
	background-color: <?php echo $OptionsVis["sl_gen_bgr_color"];?>;
}

/* width value for each story li */
div.jqans-wrapper.default li {
	width: <?php echo ($OptionsVis["sl_gen_width"]/$OptionsVis["sl_gen_number"]);?>px;
}

/* default styles */
div.jqans-wrapper.default a {
	text-decoration: none;
	font-weight: normal;
	color: #363636;
	outline: none;
}

div.jqans-wrapper.default strong {
	color: #000;
}

/* wrapper */
div.jqans-wrapper.default {
	border-left: 1px solid <?php echo $OptionsVis["sl_gen_bordercolor"];?>;
	border-right: 1px solid <?php echo $OptionsVis["sl_gen_bordercolor"];?>;
	border-top: 1px solid <?php echo $OptionsVis["sl_gen_bordercolor"];?>;
	margin: 0 0 32px 0;
}

/* container */
div.jqans-wrapper.default .jqans-container { 
	min-height: 280px; 
	text-align: center;
	padding-top: 4px;
}

div.jqans-wrapper.default .jqans-container a {
	font-weight: bold;
}

/* headline */
div.jqans-wrapper.default .jqans-headline {
	text-align: left;
	margin-left: 4px;
	margin-bottom: 4px;
}

div.jqans-wrapper.default .jqans-content h1 {
	text-align: left;
	color: <?php echo $OptionsVis["sl_title_color"];?>;
	margin: 0;
	padding-left: 4px;
	padding-top: 2px;
	height: <?php echo (($OptionsVis["sl_title_font_size"])*2 + 3);?>px;
	font-size: <?php echo $OptionsVis["sl_title_font_size"];?>px;
	line-height: <?php echo ($OptionsVis["sl_title_font_size"] + 2);?>px;
	font-family: <?php echo $OptionsVis["sl_title_font_family"];?>;
}

div.jqans-wrapper.default .jqans-content h1 a {
	color: <?php echo $OptionsVis["sl_title_color"];?>;
}

div.jqans-wrapper.default .jqans-content p {
	text-align: left;
	margin:0;
	padding:0;
}

/* stories */
div.jqans-wrapper.default .jqans-stories {
	background: <?php echo $OptionsVis["sl_bottom_bgrcolor"];?>;
}

div.jqans-wrapper.default .jqans-stories li {
	overflow: hidden;
	text-align: center;
	font-size: 12px;
	color: #666;
}

div.jqans-wrapper.default .jqans-stories li.selected {
	background: <?php echo $OptionsVis["sl_bottom_bgrcolsel"];?>;
}

div.jqans-wrapper.default .jqans-stories li img {
	margin-top: 4px;
	border: 1px solid #FFFFFF;
	background-color: #FFFFFF;
}

div.jqans-wrapper.default .jqans-stories li p {
	display: none;
}

div.jqans-wrapper.default .jqans-stories li h3 {
	margin:0;
	font-size:11px;
	font-weight:normal;
}

div.jqans-wrapper.default .jqans-stories-selector li.selected div {
	margin:auto;
	height: 0px;
	width:0px;
	line-height:0px;
	font-size:0px;
	border-right: 10px solid <?php if(trim($OptionsVis["sl_gen_bgr_color"])) echo $OptionsVis["sl_gen_bgr_color"]; else echo "white";?>;
	border-bottom: 10px solid <?php echo $OptionsVis["sl_bottom_bgrcolsel"];?>;
	border-left: 10px solid <?php if(trim($OptionsVis["sl_gen_bgr_color"])) echo $OptionsVis["sl_gen_bgr_color"]; else echo "white";?>;
}

/* pagination */
div.jqans-wrapper.default .jqans-pagination {
	border-top: 1px solid <?php echo $OptionsVis["sl_gen_bordercolor"];?>;
	border-bottom: 1px solid <?php echo $OptionsVis["sl_gen_bordercolor"];?>;
	margin: 0;
	padding: 2px 2px 0 2px;
	background: <?php echo $OptionsVis["sl_bottom_bgrcolor"];?>;
	text-align: left;
	clear: both;
	width: 100%;
	overflow: hidden;
}

div.jqans-wrapper.default .jqans-pagination-count {
	float: left;
}

div.jqans-wrapper.default .jqans-pagination-controls {
	float: right;
}

div.jqans-wrapper.default .jqans-pagination-controls a {
	display: inline-block;
	width: 22px;
	height: 12px;
	text-indent: -9999px;
	background: no-repeat bottom center;
	*float:left;
}

div.jqans-wrapper.default .jqans-pagination-controls-back a {
	background-image: url(<?php echo $CONFIG["full_url"]; ?>images/slider_previous.jpg);
}

div.jqans-wrapper.default .jqans-pagination-controls-next a {
	background-image: url(<?php echo $CONFIG["full_url"]; ?>images/slider_next.jpg);
}
</style>  

<?php 
if ($Options["publishon"]=="yes") $search .= " AND publish_date <= NOW() ";

$sql = "SELECT * FROM ".$TABLE["News"]."  
		WHERE status='Published' AND slider='yes' ".$search."  
		ORDER BY publish_date DESC 
		LIMIT 0," . $Options["news_slid_num"];	
$sql_result = mysql_query ($sql, $conn ) or die ('MySQL query error: '.$sql.'. Error: '.mysql_error());
if (mysql_num_rows($sql_result)>0) {	
?>
<noscript><strong>Please Note:</strong> You may have disabled JavaScript and/or CSS. Although this news content will be accessible, certain functionality is unavailable.</noscript>

<ul id="newsslider">
	<?php 
	while ($News = mysql_fetch_assoc($sql_result)) {
	?>
    <li>
      	<a href="<?php if(trim($Options["news_link"])!=''){ echo ReadDB($Options["news_link"])."?id=".$News['id'];} else { echo $thisPage."?tid=".$News['id'];}?>&cat_id=<?php echo $News["cat_id"];?>#ontitle"><img src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($News["image"]); ?>" width="<?php echo (($OptionsVis["sl_gen_width"]/$OptionsVis["sl_gen_number"])-10);?>" <?php if($OptionsVis["sl_keep_proportion"]=="no"){?>height="<?php echo (($OptionsVis["sl_gen_width"]/$OptionsVis["sl_gen_number"])-10)*0.66;?>"<?php }?> alt="<?php echo ReadHTML($News["title"]); ?>" /></a>
        <h3 style="margin:0; padding:0; line-height:12px; padding-bottom: 6px;">
        	<a href="<?php if(trim($Options["news_link"])!=''){ echo ReadDB($Options["news_link"])."?id=".$News['id'];} else { echo $thisPage."?tid=".$News['id'];}?>&cat_id=<?php echo $News["cat_id"];?>#ontitle" style="color:<?php echo $OptionsVis["title_im_color"];?>;font-size: <?php echo $OptionsVis["title_im_font_size"];?>px; font-family: <?php echo $OptionsVis["title_im_font_family"];?>;">
            	<?php echo ReadHTML($News["title"]); ?>
        	</a>
        </h3>
        <p>
        	<?php if($OptionsVis["sl_show_summ_text"]=="yes") { ?>
			<span style="display:block; height:66px;padding-left:4px;padding-right:4px; font-size: <?php echo $OptionsVis["sl_summ_font_size"];?>px; line-height: <?php echo ($OptionsVis["sl_summ_font_size"] + 4);?>px; font-family: <?php echo $OptionsVis["sl_summ_font_family"];?>; color:<?php echo $OptionsVis["sl_summ_color"];?>;"><?php echo cutText(ReadDB($News["summary"]), $OptionsVis["sl_summ_num_char"]); ?></span>
            <a href="<?php if(trim($Options["news_link"])!=''){ echo ReadDB($Options["news_link"])."?id=".$News['id'];} else { echo $thisPage."?tid=".$News['id'];}?>&cat_id=<?php echo $News["cat_id"];?>#ontitle"> 
            <span style="display:block; padding-left:4px;padding-bottom:2px; font-size:11px;">&raquo; <?php echo $OptionsLang['Read_more']; ?></span>            
            </a>
            <?php } ?>
        </p>
    </li>
    <?php 
	}
	?>
</ul>

<?php 
} else {
?>
<div style="line-height:20px; padding-bottom:20px;"><?php echo $OptionsLang['No_news_published'] ?></div>
<?php	
}
?>   
