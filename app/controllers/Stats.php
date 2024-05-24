<?php

class Stats extends Controller {
    public function index() {
        $cities = $this->getCities();
        $species= $this->getSpecies();
        $this->view('stats', ['cities' => $cities  , 'species' => $species]);
    }

    private function getCities() {
        $mysqli = require __DIR__ . "/../db/connect.php";

        $sql = "SELECT DISTINCT city FROM reports ORDER BY city";
        $result = $mysqli->query($sql);

        $cities = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cities[] = $row['city'];
            }
        }

        $mysqli->close();
        return $cities;
    }

    private function getSpecies() {
        $mysqli = require __DIR__ . "/../db/connect.php";

        $sql = "SELECT DISTINCT species FROM reports ORDER BY species";
        $result = $mysqli->query($sql);

        $species = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $species[] = $row['species'];
            }
        }

        $mysqli->close();
        return $species;
    }
}
