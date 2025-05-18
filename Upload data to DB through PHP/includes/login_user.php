<?php
require_once("db.php");

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["email"], $data["password"])) {
  http_response_code(400);
  echo json_encode(["status" => "ERROR", "message" => "Липсващи данни!"]);
  exit;
}

$email = $data["email"];
$password = $data["password"];

try {
  $pdo = getDB();
  $stmt = $pdo->prepare("SELECT id, pwd FROM users WHERE email = :email");
  $stmt->execute(["email" => $email]);

  if ($stmt->rowCount() === 0) {
    http_response_code(400);
    echo json_encode(["status" => "ERROR", "message" => "Невалиден имейл!"]);
    exit;
  }

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!password_verify($password, $user["pwd"])) {
    http_response_code(400);
    echo json_encode(["status" => "ERROR", "message" => "Грешна парола!"]);
    exit;
  }

  session_start();
  $_SESSION["user_id"] = $user["id"];

  echo json_encode(["status" => "SUCCESS", "message" => "Успешен вход!"]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(["status" => "ERROR", "message" => "Грешка в сървъра!"]);
}
?>
