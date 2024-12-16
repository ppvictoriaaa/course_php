<?php
session_start(); // Початок сесії на самому початку файлу

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Хеш паролю php123

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['who'];
    $pass = $_POST['pass'];
    
    // Перевірка на пусті поля
    if (empty($name) || empty($pass)) {
        $error = "User name and password are required";
    } else {
        // Перевірка паролю
        $check_hash = hash('md5', $salt . $pass);
        if ($check_hash == $stored_hash) {
            // Якщо пароль правильний, зберігаємо ім'я в сесії і переходимо на game.php
            $_SESSION['name'] = $name; // Збереження імені в сесії
            header("Location: game.php"); // Редірект без передачі параметра в URL
            exit();
        } else {
            $error = "Incorrect password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <label for="who">Username:</label>
        <input type="text" id="who" name="who" value=""><br><br>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" value=""><br><br>
        <button type="submit">Log In</button>
    </form>
</body>
</html>

