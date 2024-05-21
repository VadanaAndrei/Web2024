<?php
header('Content-Type: application/rss+xml; charset=UTF-8');

$mysqli = require __DIR__ . '/../app/db/connect.php';

echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>FePA - Latest Reports</title>';
echo '<link>http://localhost/Web2024/public/Home</link>';
echo '<description>Latest animal reports from FePA</description>';

$sql = "SELECT r.report_id, r.species, r.area, r.country, r.city, r.address, r.description, r.submitted_at
        FROM reports r
        ORDER BY r.submitted_at DESC
        LIMIT 10";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<item>';
        echo '<title>' . htmlspecialchars($row['species']) . '</title>';
        echo '<link>http://localhost/Web2024/public/Report?id=' . $row['report_id'] . '</link>';
        echo '<description><![CDATA[' . htmlspecialchars($row['description']) . ']]></description>';
        echo '<pubDate>' . date(DATE_RSS, strtotime($row['submitted_at'])) . '</pubDate>';
        echo '</item>';
    }
}

echo '</channel>';
echo '</rss>';

$mysqli->close();
?>
