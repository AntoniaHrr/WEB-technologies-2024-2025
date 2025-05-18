    <?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    $username = $_POST["username"]; 
    $pwd = $_POST["pwd"]; 
    $email = $_POST["email"]; 
    try { require_once "db.php"; 
    $query = "INSERT INTO users (username, pwd, email) VALUES (:username,:pwd,:email);"; //not good to insert user data in the query directly. :wouldnt treat the string as sql code 
    $stmt = $pdo->prepare($query); 
    $stmt->bindParam(":username", $username); 
    $stmt->bindParam(":pwd", $pwd); 
    $stmt->bindParam(":email", $email);
    $stmt->execute([$username, $pwd, $email]); 
    $pdo = null;
    $stmt = null; //closing the connection 
    header("Location: ../index.php"); 
    die(); 
    } catch (PDOException $e) { 
    throw new PDOException($e->getMessage()); }
     } else { 
     header("Location: ../index.php"); 
     }
