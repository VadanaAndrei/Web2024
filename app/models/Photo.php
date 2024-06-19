<?php
class Photo {
    private $photo_id;
    private $report_id;
    private $photo_url;

    public function getPhotoId() {
        return $this->photo_id;
    }

    public function getReportId() {
        return $this->report_id;
    }

    public function getPhotoUrl() {
        return $this->photo_url;
    }

    public function setPhotoId($photo_id) {
        $this->photo_id = $photo_id;
    }

    public function setReportId($report_id) {
        $this->report_id = $report_id;
    }

    public function setPhotoUrl($photo_url) {
        $this->photo_url = $photo_url;
    }
}
