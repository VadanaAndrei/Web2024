<?php

class Report extends Controller {
    public function index() {
        $this->view('report');
    }

    public function submitReport() {
        session_start();
        $mysqli = require __DIR__ . "/../db/connect.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_SESSION['user_id'];
            $species = $_POST['species'];
            $description = $_POST['description'];
            $tag = $_POST['tag'];
            $area = $_POST['area'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $additional_information = $_POST['additional_info'];

            $stmt = $mysqli->prepare("INSERT INTO reports (user_id, species, area, country, city, address, description, additional_information) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssss", $user_id, $species, $area, $country, $city, $address, $description, $additional_information);

            if ($stmt->execute()) {
                $report_id = $stmt->insert_id;

                if (!empty($tag)) {
                    $stmt_tag = $mysqli->prepare("INSERT INTO tags (report_id, tag_name) VALUES (?, ?)");
                    $stmt_tag->bind_param("is", $report_id, $tag);
                    $stmt_tag->execute();
                    $stmt_tag->close();
                }

                if (isset($_FILES['photos']) && is_array($_FILES['photos']['name']) && !empty($_FILES['photos']['name'][0])) {
                    $total = count($_FILES['photos']['name']);
                    for ($i = 0; $i < $total; $i++) {
                        if ($_FILES['photos']['error'][$i] === UPLOAD_ERR_OK) {
                            $photo_name = basename($_FILES['photos']['name'][$i]);
                            $photo_tmp = $_FILES['photos']['tmp_name'][$i];
                            $photo_path = __DIR__ . "/../../uploads/" . $photo_name;


                            if (move_uploaded_file($photo_tmp, $photo_path)) {
                                $photo_url = "/uploads/" . $photo_name;
                                $stmt_photos = $mysqli->prepare("INSERT INTO photos (report_id, photo_url) VALUES (?, ?)");
                                $stmt_photos->bind_param("is", $report_id, $photo_url);
                                if (!$stmt_photos->execute()) {
                                    $_SESSION['error_message'] = "Failed to insert photo into database: " . $stmt_photos->error;
                                    header("Location: ../Report");
                                    exit;
                                }
                                $stmt_photos->close();
                            } else {
                                $_SESSION['error_message'] = "Failed to upload photo.";
                                header("Location: ../Report");
                                exit;
                            }
                        } else {
                            $_SESSION['error_message'] = "Error uploading photo: " . $_FILES['photos']['error'][$i];
                            header("Location: ../Report");
                            exit;
                        }
                    }
                }

                $_SESSION['success_message'] = "Raportul a fost trimis cu succes!";
                header("Location: ../Home");
                exit;
            } else {
                $_SESSION['error_message'] = "Eroare la trimiterea raportului: " . $stmt->error;
                header("Location: ../Report");
                exit;
            }

            $stmt->close();
        }

        $mysqli->close();
    }
}
