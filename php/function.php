<?php
class Common 
{
	/**
	* Formats a news title and publish date.
	*
	* @param string $title News title.
	* @param string $date Date news iten was published.
	*/
	public static function NewsTemplate(
		$title,
		$date) 
	{
		?><span class="newstitle"><b><?php echo $title; ?></span></b><br /><i><span class=""><?php echo $date; ?></span></i><?php
	}


	/**
	* Formats a news title and publish date.
	*
	* @param string $title News title.
	* @param string $date Date news iten was published.
	*/
	public static function Href(
		$location,
		$title) 
	{
		?><a href="<?php echo $location; ?>" style="color: red; text-decoration: underline;"><?php echo $title; ?></a><?php
	}
}
?>