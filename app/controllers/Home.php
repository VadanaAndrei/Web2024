<?php

class Home extends Controller{
    public function index(){
        $this -> view('home');
    }

    public function latestReports()
    {
        $mysqli = require __DIR__ . "/../db/connect.php";

        $sql = "SELECT r.report_id, r.species, r.area, r.country, r.city, r.address, r.description, r.submitted_at,
               GROUP_CONCAT(DISTINCT t.tag_name SEPARATOR ', ') as tags,
               GROUP_CONCAT(DISTINCT p.photo_url SEPARATOR ', ') as photos
        FROM reports r
        LEFT JOIN tags t ON r.report_id = t.report_id
        LEFT JOIN photos p ON r.report_id = p.report_id
        GROUP BY r.report_id
        ORDER BY r.submitted_at DESC
        LIMIT 5";

        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='latest-report-item'>";
                echo "<div class='text-content'>";
                echo "<h3>Species: " . $row['species'] . "</h3><br>";
                echo "<p>Area: " . $row['area'] . "</p>";
                echo "<p>Country: " . $row['country'] . "</p>";
                echo "<p>City: " . $row['city'] . "</p>";
                echo "<p>Address: " . $row['address'] . "</p>";
                echo "<p>Description: " . $row['description'] . "</p>";
                echo "<p>Submitted at: " . $row['submitted_at'] . "</p>";
                if (!empty($row['tags'])) {
                    echo "<p>Tag: " . $row['tags'] . "</p>";
                }
                echo "</div>";
                if (!empty($row['photos'])) {
                    $photos = explode(', ', $row['photos']);
                    echo "<div class='photos'>";
                    foreach ($photos as $photo) {
                        echo "<img src='.." . $photo . "' alt='Report photo' />";
                    }
                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No reports found.</p>";
        }

        $mysqli->close();
    }

}