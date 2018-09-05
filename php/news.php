<?php
class News {
	public $publish_date;
	public $content;
	public $title;
	public $image;
	public $imgwidth;
	public $imgheight;

	public function getPublishDate() {
		return date('d-m-Y H:i',strtotime($this->publish_date));
	}

	public function setPublishDate($publishDate) {
		$this->publish_date = $publishDate;
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getImage() {
		return $this->image;
	}

	public function setImage($image) {
		$this->image = $image;
	}

	public function getImgwidth() {
		return $this->imgwidth;
	}

	public function setImgwidth($imgwidth) {
		$this->imgwidth = $imgwidth;
	}

	public function getImgheight() {
		return $this->imgheight;
	}

	public function setImgheight($imgheight) {
		$this->imgheight = $imgheight;
	}
}
