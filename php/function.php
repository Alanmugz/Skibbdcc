<?php

	class Common 
	{
		public static function NewsTemplate(
			$title,
			$date) 
		{
			?><span class="newstitle"><b><?php echo $title; ?></span></b><br /><i><span class=""><?php echo $date; ?></span></i><?php
		}
	}