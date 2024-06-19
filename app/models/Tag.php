<?php
class Tag {
    private $tag_id;
    private $report_id;
    private $tag_name;

    public function getTagId() {
        return $this->tag_id;
    }

    public function getReportId() {
        return $this->report_id;
    }

    public function getTagName() {
        return $this->tag_name;
    }

    public function setTagId($tag_id) {
        $this->tag_id = $tag_id;
    }

    public function setReportId($report_id) {
        $this->report_id = $report_id;
    }

    public function setTagName($tag_name) {
        $this->tag_name = $tag_name;
    }
}
