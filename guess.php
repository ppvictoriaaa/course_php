<?php
// Встановлюємо правильне число для вгадування
$correct_number = 42;

// Отримуємо значення параметра 'guess' з URL
$guess = isset($_GET['guess']) ? $_GET['guess'] : '';

// Додаємо ім'я до тегу <title>
echo "<!DOCTYPE html>
<html>
<head>
    <title>Вікторія</title>
</head>
<body>";

if ($guess === '') {
    echo "Missing guess parameter";
} elseif (strlen($guess) < 1) {
    echo "Your guess is too short";
} elseif (!is_numeric($guess)) {
    echo "Your guess is not a number";
} elseif ($guess < $correct_number) {
    echo "Your guess is too low";
} elseif ($guess > $correct_number) {
    echo "Your guess is too high";
} else {
    echo "Congratulations - You are right";
}

echo "</body>
</html>";
?>
