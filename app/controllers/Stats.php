<?php

class Stats extends Controller {
    public function index() {
        $cities = $this->getCities();
        $species= $this->getSpecies();
        $this->view('stats', ['cities' => $cities  , 'species' => $species]);
    }

    public function getCities() {
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

    public function getSpecies() {
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

    public function generateStats()
    {

        $mysqli = require __DIR__ . "/../db/connect.php";

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate']) && $_POST['generate'] == 'csv') {
            $city = $_POST['city'] ?? '';
            $start_date = $_POST['start_date'] ?? '';
            $end_date = $_POST['end_date'] ?? '';
            $species = $_POST['animal'] ?? '';

            $areas = [
                'Park', 'Kindergarten', 'School', 'Hospital', 'Other'
            ];

            $query = "SELECT 
                    r.city, 
                    r.species, 
                    COUNT(r.report_id) AS count,
                    tr.total_reports";

            foreach ($areas as $area) {
                $areaAlias = strtolower($area) . '_count';
                $query .= ", SUM(CASE WHEN r.area = '$area' THEN 1 ELSE 0 END) AS $areaAlias";
            }

            $query .= " FROM reports r
                    LEFT JOIN (
                        SELECT species, COUNT(*) AS total_reports 
                        FROM reports 
                        GROUP BY species
                    ) tr ON r.species = tr.species
                    WHERE 1=1";

            if ($city !== '') {
                $query .= " AND r.city = '" . $mysqli->real_escape_string($city) . "'";
            }

            if ($species !== '') {
                $query .= " AND r.species = '" . $mysqli->real_escape_string($species) . "'";
            }

            if ($start_date !== '') {
                $query .= " AND r.submitted_at >= '" . $mysqli->real_escape_string($start_date) . " 00:00:00'";
            }

            if ($end_date !== '') {
                $query .= " AND r.submitted_at <= '" . $mysqli->real_escape_string($end_date) . " 23:59:59'";
            }

            $query .= " GROUP BY r.city, r.species, tr.total_reports
                    ORDER BY r.city, r.species";

            $result = $mysqli->query($query);

            if (!$result) {
                die("Query error: " . $mysqli->error);
            }

            $filename = "statistics_" . date('Ymd') . ".csv";

            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="' . $filename . '"');

            $output = fopen('php://output', 'w');

            $headers = ['City', 'Species', 'In this City', 'In any City'];
            foreach ($areas as $area) {
                $headers[] = $area . ' Reports Number';
            }

            fputcsv($output, $headers);

            while ($row = $result->fetch_assoc()) {
                $data = [
                    $row['city'],
                    $row['species'],
                    $row['count'],
                    $row['total_reports']
                ];
                foreach ($areas as $area) {
                    $data[] = $row[strtolower($area) . '_count'];
                }
                fputcsv($output, $data);
            }

            fclose($output);
            exit();
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate']) && $_POST['generate'] == 'html-pie-chart') {
            $city = $_POST['city'] ?? '';
            $start_date = $_POST['start_date'] ?? '';
            $end_date = $_POST['end_date'] ?? '';
            $species = $_POST['animal'] ?? '';

            $areas = [
                'Park', 'Kindergarten', 'School', 'Hospital', 'Other'
            ];

            $query = "SELECT 
            r.species, 
            COUNT(r.report_id) AS count
            FROM reports r
            WHERE 1=1";

            if ($city !== '') {
                $query .= " AND r.city = '" . $mysqli->real_escape_string($city) . "'";
            }

            if ($species !== '') {
                $query .= " AND r.species = '" . $mysqli->real_escape_string($species) . "'";
            }

            if ($start_date !== '') {
                $query .= " AND r.submitted_at >= '" . $mysqli->real_escape_string($start_date) . " 00:00:00'";
            }

            if ($end_date !== '') {
                $query .= " AND r.submitted_at <= '" . $mysqli->real_escape_string($end_date) . " 23:59:59'";
            }

            $query .= " GROUP BY r.species
            ORDER BY r.species";

            $result = $mysqli->query($query);

            if (!$result) {
                die("Query error: " . $mysqli->error);
            }

            $speciesData = [];
            while ($row = $result->fetch_assoc()) {
                $speciesData[$row['species']] = $row['count'];
            }

            $totalReports = array_sum($speciesData);

            $htmlContent = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Species by Percentage Statistic</title>";
            $htmlContent .= "<style>
                    body { font-family: Arial, sans-serif; }
                    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    .pie-chart {
                        width: 200px;
                        height: 200px;
                        border-radius: 50%;
                        background: conic-gradient(
    ";

            $colors = [];
            $currentAngle = 0;
            foreach ($speciesData as $species => $count) {
                $percentage = ($count / $totalReports) * 100;
                $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                $colors[$species] = $color;
                $htmlContent .= "$color $currentAngle%,";
                $currentAngle += $percentage;
                $htmlContent .= "$color $currentAngle%,";
            }

            $htmlContent = rtrim($htmlContent, ',');
            $htmlContent .= ");
                    }
                    .legend { display: flex; flex-direction: column; }
                    .legend-item { display: flex; align-items: center; margin-bottom: 5px; }
                    .legend-color { width: 20px; height: 20px; margin-right: 10px; }
                    </style>";
            $htmlContent .= "</head><body>";
            $htmlContent .= "<h1>Statistics Report</h1>";
            $htmlContent .= "<div class='pie-chart'></div>";
            $htmlContent .= "<div class='legend'>";

            foreach ($colors as $species => $color) {
                $htmlContent .= "<div class='legend-item'><div class='legend-color' style='background-color: $color;'></div>" . htmlspecialchars($species) . "</div>";
            }

            $htmlContent .= "</div>";
            $htmlContent .= "<table>";
            $htmlContent .= "<tr><th>Species</th><th>Total Reports</th><th>Percentage</th></tr>";

            foreach ($speciesData as $species => $count) {
                $percentage = ($count / $totalReports) * 100;
                $htmlContent .= "<tr>";
                $htmlContent .= "<td>" . htmlspecialchars($species) . "</td>";
                $htmlContent .= "<td>" . htmlspecialchars($count) . "</td>";
                $htmlContent .= "<td>" . htmlspecialchars(number_format($percentage, 2)) . "%</td>";
                $htmlContent .= "</tr>";
            }

            $htmlContent .= "</table>";
            $htmlContent .= "</body></html>";

            $filename = "species_by_percentage_" . date('Ymd') . ".html";
            file_put_contents($filename, $htmlContent);

            header('Content-Type: text/html');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            readfile($filename);

            unlink($filename);
            exit();
        }

        else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate']) && $_POST['generate'] == 'html-stacked-bar'){
            $city = $_POST['city'] ?? '';
            $start_date = $_POST['start_date'] ?? '';
            $end_date = $_POST['end_date'] ?? '';
            $species = $_POST['animal'] ?? '';

            $query = "SELECT 
            r.city, 
            r.species, 
            COUNT(r.report_id) AS count
            FROM reports r
            WHERE 1=1";

            if ($city !== '') {
                $query .= " AND r.city = '" . $mysqli->real_escape_string($city) . "'";
            }

            if ($species !== '') {
                $query .= " AND r.species = '" . $mysqli->real_escape_string($species) . "'";
            }

            if ($start_date !== '') {
                $query .= " AND r.submitted_at >= '" . $mysqli->real_escape_string($start_date) . " 00:00:00'";
            }

            if ($end_date !== '') {
                $query .= " AND r.submitted_at <= '" . $mysqli->real_escape_string($end_date) . " 23:59:59'";
            }

            $query .= " GROUP BY r.city, r.species
                ORDER BY r.city, r.species";

            $result = $mysqli->query($query);

            if (!$result) {
                die("Query error: " . $mysqli->error);
            }

            $cityData = [];
            $speciesData = [];

            while ($row = $result->fetch_assoc()) {
                $city = $row['city'];
                $species = $row['species'];
                $count = $row['count'];

                if (!isset($cityData[$city])) {
                    $cityData[$city] = [];
                }

                $cityData[$city][$species] = $count;

                if (!isset($speciesData[$species])) {
                    $speciesData[$species] = 0;
                }
                $speciesData[$species] += $count;
            }

            $totalReports = array_sum($speciesData);

            $htmlContent = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Species Statistic</title>";
            $htmlContent .= "<style>
        body { font-family: Arial, sans-serif; }
        .chart-container { display: flex; flex-direction: column; align-items: flex-start; width: 100%; }
        .bar { display: flex; align-items: center; margin-bottom: 10px; width: 100%; }
        .bar-label { flex-shrink: 0; width: 17%; padding-right: 10px; overflow: hidden; text-overflow: ellipsis; white-space: normal; word-break: break-word; }
        .bar-stack { display: flex; width: 85%; }
        .bar-segment { height: 30px; }
        .legend { display: flex; margin-top: 20px; flex-wrap: wrap; }
        .legend-item { display: flex; align-items: center; margin-right: 20px; }
        .legend-color { width: 20px; height: 20px; margin-right: 5px; }
        </style>";
            $htmlContent .= "</head><body>";
            $htmlContent .= "<h1>City Species Report</h1>";
            $htmlContent .= "<div class='chart-container'>";

            $colors = [];
            foreach ($cityData as $city => $speciesCounts) {
                $htmlContent .= "<div class='bar'>";
                $htmlContent .= "<div class='bar-label'>" . htmlspecialchars($city) . "</div>";
                $htmlContent .= "<div class='bar-stack'>";
                $totalCityReports = array_sum($speciesCounts);
                foreach ($speciesCounts as $species => $count) {
                    if (!isset($colors[$species])) {
                        $colors[$species] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    }
                    $percentage = ($count / $totalCityReports) * 100;
                    $htmlContent .= "<div class='bar-segment' style='width: {$percentage}%; background-color: {$colors[$species]};' title='{$species}: {$count} ({$percentage}%)'></div>";
                }
                $htmlContent .= "</div>";
                $htmlContent .= "</div>";
            }

            $htmlContent .= "</div>";
            $htmlContent .= "<div class='legend'>";
            foreach ($colors as $species => $color) {
                $htmlContent .= "<div class='legend-item'><div class='legend-color' style='background-color: $color;'></div>" . htmlspecialchars($species) . "</div>";
            }
            $htmlContent .= "</div>";

            $htmlContent .= "</body></html>";

            $filename = "species_report_" . date('Ymd') . ".html";
            file_put_contents($filename, $htmlContent);

            header('Content-Type: text/html');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            readfile($filename);

            unlink($filename);
            exit();
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate']) && $_POST['generate'] == 'html-bar-chart'){
            $city = $_POST['city'] ?? '';
            $start_date = $_POST['start_date'] ?? '';
            $end_date = $_POST['end_date'] ?? '';
            $species = $_POST['animal'] ?? '';

            $query = "SELECT 
                area, 
                COUNT(report_id) AS count 
              FROM 
                reports 
              WHERE 1=1";

            if ($city !== '') {
                $query .= " AND city = '" . $mysqli->real_escape_string($city) . "'";
            }

            if ($species !== '') {
                $query .= " AND species = '" . $mysqli->real_escape_string($species) . "'";
            }

            if ($start_date !== '') {
                $query .= " AND submitted_at >= '" . $mysqli->real_escape_string($start_date) . " 00:00:00'";
            }

            if ($end_date !== '') {
                $query .= " AND submitted_at <= '" . $mysqli->real_escape_string($end_date) . " 23:59:59'";
            }

            $query .= " GROUP BY area 
                ORDER BY count DESC";

            $result = $mysqli->query($query);

            if (!$result) {
                die("Query error: " . $mysqli->error);
            }

            $areaData = [];
            while ($row = $result->fetch_assoc()) {
                $areaData[$row['area']] = $row['count'];
            }

            $htmlContent = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Reports by Area Statistic</title>";
            $htmlContent .= "<style>
            body { font-family: Arial, sans-serif; }
            .bar-chart-container { display: flex; align-items: flex-end; justify-content: center; height: 400px; margin-top: 20px; }
            .bar { display: flex; flex-direction: column; align-items: center; margin: 0 10px; }
            .bar-label { margin-top: 10px; text-align: center; }
            .bar-segment { width: 40px; background-color: #4CAF50; }
            .bar-count { margin-top: 5px; }
            </style>";
            $htmlContent .= "</head><body>";
            $htmlContent .= "<h1>Reports by Area</h1>";
            $htmlContent .= "<div class='bar-chart-container'>";

            foreach ($areaData as $area => $count) {
                $barHeight = $count * 10;
                $htmlContent .= "<div class='bar'>
                            <div class='bar-segment' style='height: {$barHeight}px;' title='{$area}: {$count}'></div>
                            <div class='bar-count'>{$count}</div>
                            <div class='bar-label'>" . htmlspecialchars($area) . "</div>
                         </div>";
            }
            $htmlContent .= "</div>";

            $htmlContent .= "</body></html>";

            $filename = "reports_by_area_" . date('Ymd') . ".html";
            file_put_contents($filename, $htmlContent);

            header('Content-Type: text/html');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            readfile($filename);

            unlink($filename);
            exit();
        }
    }
}
