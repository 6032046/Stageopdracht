<?php
require "../db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $name = htmlspecialchars($_POST["name"]);
    $age = (int)$_POST["age"];
    $gender = $_POST["gender"];
    $lang = $_POST["lang"];
    $comments = htmlspecialchars($_POST["comments"]);

    try {
        $query = "INSERT INTO form (username, age, gender, lang, comment) VALUES (:username, :age, :gender, :lang, :comment)";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            "username" => $name, 
            "age" => $age, 
            "gender" => $gender, 
            "lang" => $lang, 
            "comment" => $comments
        ]);

        // Redirect to the form with a success message
        header("Location: survey.html?success=1");
        exit;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo "An error occurred while processing your request: " . $e->getMessage();
    }
}
?>
