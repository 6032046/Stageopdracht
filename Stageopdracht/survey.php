<?php
    require "./db/db_connection.php";
    header('Content-Type: application/json');

    $response = [];

    try {
        $input = json_decode(file_get_contents("php://input"), true);
        if (!empty($input)) {
            $name = htmlspecialchars(trim($input["name"]));
            $age = (int)$input["age"];
            $gender = htmlspecialchars(trim($input["gender"]));
            $lang = htmlspecialchars(trim($input["lang"]));
            $comments = htmlspecialchars(trim($input["comments"]));

            if ($age < 0) {
                throw new Exception("Age cannot be negative.");
            }

            $query = "INSERT INTO form (username, age, gender, lang, comment) VALUES (:username, :age, :gender, :lang, :comment)";
            $stmt = $conn->prepare($query);
            $stmt->execute([
                ":username" => $name,
                ":age" => $age,
                ":gender" => $gender,
                ":lang" => $lang,
                ":comment" => $comments
            ]);

            $response["status"] = "success";
            $response["message"] = "Data ingevoerd.";
        } else {
            throw new Exception("Geen data gegeven");
        }
    } catch (PDOException $e) {
        $response["status"] = "error";
        $response["message"] = "Database error: " . $e->getMessage();
        error_log($e->getMessage());
    } catch (Exception $e) {
        $response["status"] = "error";
        $response["message"] = $e->getMessage();
    }

    echo json_encode($response);
?>
