<?php
// Встановлюємо час початку виконання
$start_time = microtime(true);

// Отримуємо значення MD5 із параметра GET
$md5 = isset($_GET['md5']) ? $_GET['md5'] : '';

$found = false; // Флаг, чи знайшли PIN
$pin = ''; // Знайдений PIN
$max_length = 4; // Довжина PIN (4 цифри)

// HTML-заголовок
echo "<!DOCTYPE html>
<html>
<head>
    <title>MD5 PIN Cracker</title>
</head>
<body>
<h1>MD5 PIN Cracker</h1>
<form method='GET'>
    <label for='md5'>Enter MD5 Hash:</label>
    <input type='text' id='md5' name='md5' size='32'>
    <button type='submit'>Crack MD5</button>
</form>";

// Логіка брутфорсу
if ($md5) {
    echo "<p>Looking for MD5: $md5</p>\n";

    // Перебір усіх комбінацій PIN (від 0000 до 9999)
    for ($i = 0; $i <= 9999; $i++) {
        // Формуємо PIN у форматі "0000"
        $test_pin = str_pad($i, $max_length, '0', STR_PAD_LEFT);
        
        // Обчислюємо MD5 хеш для тестового PIN
        $test_hash = hash('md5', $test_pin);
        
        // Перевіряємо, чи збігається хеш
        if ($test_hash === $md5) {
            $found = true;
            $pin = $test_pin;
            break;
        }
    }

    // Результат
    if ($found) {
        echo "<p>PIN found: <b>$pin</b></p>\n";
    } else {
        echo "<p>PIN not found</p>\n";
    }
} else {
    echo "<p>No MD5 parameter provided</p>\n";
}

// Вимірюємо час виконання
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "<p>Elapsed time: $elapsed_time seconds</p>\n";

// Закриваємо HTML
echo "</body>
</html>";
?>
