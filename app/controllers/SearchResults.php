<?php

class SearchResults extends Controller {
    public function index() {
        $query = $_GET['query'] ?? '';
        $results = $this->searchReports($query);
        require __DIR__ . '/../../html-pages/search-results.php';
    }

    public function searchReports($query) {
        $mysqli = require __DIR__ . "/../db/connect.php";

        $sql = "
        SELECT r.report_id, r.species, r.area, r.country, r.city, r.address, r.description,r.submitted_at,
               GROUP_CONCAT(DISTINCT t.tag_name SEPARATOR ', ') as tags,
               GROUP_CONCAT(DISTINCT p.photo_url SEPARATOR ', ') as photos
        FROM reports r
        LEFT JOIN tags t ON r.report_id = t.report_id
        LEFT JOIN photos p ON r.report_id = p.report_id
        WHERE r.species RLIKE ?
        GROUP BY r.report_id
        ORDER BY r.submitted_at DESC
    ";

        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("SQL error: " . $mysqli->error);
        }

        $searchTerm = '\\b' . $query . '\\b';
        $stmt->bind_param('s', $searchTerm);

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("SQL error: " . $stmt->error);
        }

        $reports = [];
        while ($row = $result->fetch_assoc()) {
            $reports[] = $row;
        }

        return $reports;
    }

}