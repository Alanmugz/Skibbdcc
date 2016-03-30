<?php
class News {
    public $publish_date;
    public $content;
    public $summary;

    public function getPublishDate() {
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

    public function getSummary() {
        return $this->summary;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }
}
