<?php
/**
 * Formats a news title and publish date.
 *
 * @param string $title News title.
 * @param string $date Date news iten was published.
 */
class Common 
{
	public static function NewsTemplate(
		$title,
		$date) 
	{
?><span class="newstitle"><b><?php echo $title; ?></span></b><br /><i><span class=""><?php echo $date; ?></span></i><?php
	}
}
?>