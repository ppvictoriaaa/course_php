<?php
session_start(); // Початок сесії на самому початку файлу

// Перевірка, чи є ім'я в сесії
if (!isset($_SESSION['name'])) {
    die("Name parameter missing");
}

// Логіка для гри
$choices = ["Rock", "Paper", "Scissors"];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_choice = $_POST['choice'];
    $computer_choice = $choices[rand(0, 2)];

    // Перевірка результату гри
    function check($computer, $human) {
        if ($computer == $human) {
            return "Tie";
        }
        if (($computer == "Rock" && $human == "Scissors") ||
            ($computer == "Scissors" && $human == "Paper") ||
            ($computer == "Paper" && $human == "Rock")) {
            return "You Lose";
        }
        return "You Win";
    }

    $result = check($computer_choice, $user_choice);

    // Зберігаємо результат гри в сесії
    if (!isset($_SESSION['history'])) {
        $_SESSION['history'] = [];
    }

    // Додаємо новий результат до історії
    $_SESSION['history'][] = [
        'user_choice' => $user_choice,
        'computer_choice' => $computer_choice,
        'result' => $result
    ];
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>
    
    <form method="POST">
        <label for="choice">Choose your move:</label>
        <select name="choice" id="choice">
            <option value="Rock">Rock</option>
            <option value="Paper">Paper</option>
            <option value="Scissors">Scissors</option>
        </select>
        <button type="submit">Play</button>
    </form>
    
    <?php if (isset($result)) { ?>
        <p>Your play: <?php echo $user_choice; ?> | Computer play: <?php echo $computer_choice; ?></p>
        <p>Result: <?php echo $result; ?></p>
    <?php } ?>

    <h2>Game History</h2>
    <table>
        <thead>
            <tr>
                <th>Your Play</th>
                <th>Computer Play</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Виводимо історію ігор, якщо вона є
            if (isset($_SESSION['history']) && count($_SESSION['history']) > 0) {
                foreach ($_SESSION['history'] as $game) {
                    echo "<tr>
                            <td>{$game['user_choice']}</td>
                            <td>{$game['computer_choice']}</td>
                            <td>{$game['result']}</td>
                          </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <a href="index.php">Logout</a>
</body>
</html>

