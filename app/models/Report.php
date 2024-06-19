<?php
class Report {
    private $report_id;
    private $user_id;
    private $species;
    private $area;
    private $country;
    private $city;
    private $address;
    private $description;
    private $additional_information;
    private $submitted_at;

    public function getReportId() {
        return $this->report_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getSpecies() {
        return $this->species;
    }

    public function getArea() {
        return $this->area;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getCity() {
        return $this->city;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAdditionalInformation() {
        return $this->additional_information;
    }

    public function getSubmittedAt() {
        return $this->submitted_at;
    }

    public function setReportId($report_id) {
        $this->report_id = $report_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setSpecies($species) {
        $this->species = $species;
    }

    public function setArea($area) {
        $this->area = $area;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setAdditionalInformation($additional_information) {
        $this->additional_information = $additional_information;
    }

    public function setSubmittedAt($submitted_at) {
        $this->submitted_at = $submitted_at;
    }
}

