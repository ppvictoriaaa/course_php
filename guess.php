<?php
// Встановлюємо правильне число для вгадування
$correct_number = 40;

// Отримуємо значення параметра 'guess' з URL
$guess = isset($_GET['guess']) ? $_GET['guess'] : null;

// Додаємо ім'я до тегу <title>
echo "<!DOCTYPE html>
<html>
<head>
    <title>Вікторія 2854ba61</title>
</head>
<body>";

if ($guess === null) {
    // Якщо параметр 'guess' відсутній
    echo "Missing guess parameter";
} elseif (strlen($guess) === 0) {
    // Якщо 'guess' присутній, але порожній (наприклад, ?guess=)
    echo "Your guess is too short";
} elseif (!is_numeric($guess)) {
    // Якщо 'guess' не є числом
    echo "Your guess is not a number";
} elseif ($guess < $correct_number) {
    // Якщо число занадто маленьке
    echo "Your guess is too low";
} elseif ($guess > $correct_number) {
    // Якщо число занадто велике
    echo "Your guess is too high";
} else {
    // Якщо число правильне
    echo "Congratulations - You are right";
}

echo "</body>
</html>";
?>
