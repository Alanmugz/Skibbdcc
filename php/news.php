<?php
class News {
    public $publish_date;
    public $content;
    public $title;

    public function getPublishDate() {
		$this->publish_date = date_format($publishDate, 'd-m-Y H:i:s');
        return $this->publish_date;
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
}
