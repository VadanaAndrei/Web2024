<?php

class AdminProfile extends Controller{
    public function index(){
        $this -> view('admin-profile');
    }

    public function removeUser()
    {
        global $mysqli;
        header('Content-Type: application/json');

        require __DIR__ . "/../db/connect.php";

        if (isset($_GET['user_id'])) {
            $user_id = intval($_GET['user_id']);

            $sql = "DELETE FROM users WHERE user_id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $user_id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'No user ID provided']);
        }

        $mysqli->close();
    }

    public function removeReport()
    {
        global $mysqli;
        header('Content-Type: application/json');

        try {
            require __DIR__ . "/../db/connect.php";

            if (isset($_GET['report_id'])) {
                $report_id = intval($_GET['report_id']);

                $mysqli->begin_transaction();

                $sql_photos = "DELETE FROM photos WHERE report_id = ?";
                $stmt_photos = $mysqli->prepare($sql_photos);
                $stmt_photos->bind_param("i", $report_id);
                $stmt_photos->execute();
                $stmt_photos->close();

                $sql_tags = "DELETE FROM tags WHERE report_id = ?";
                $stmt_tags = $mysqli->prepare($sql_tags);
                $stmt_tags->bind_param("i", $report_id);
                $stmt_tags->execute();
                $stmt_tags->close();

                $sql_reports = "DELETE FROM reports WHERE report_id = ?";
                $stmt_reports = $mysqli->prepare($sql_reports);
                $stmt_reports->bind_param("i", $report_id);

                if ($stmt_reports->execute()) {
                    $mysqli->commit();
                    echo json_encode(['success' => true]);
                } else {
                    $mysqli->rollback();
                    echo json_encode(['success' => false, 'error' => $stmt_reports->error]);
                }

                $stmt_reports->close();
            } else {
                echo json_encode(['success' => false, 'error' => 'No report ID provided']);
            }

            $mysqli->close();
        } catch (Exception $e) {
            $mysqli->rollback();
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}