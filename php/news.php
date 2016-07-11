<?php
class News {
    public $publish_date;
    public $content;
    public $title;

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
}
