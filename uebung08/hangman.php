<?php require_once(__DIR__ . "/hangman_lib.php");

session_name(get_current_user() . "u08");
session_start();

if (!isset($_SESSION["toGuess"]))
    header("Location: hangman-init.php");
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>Wörter raten</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $mask = implode(" ", $_SESSION["mask"]);
    $errorCount = $_SESSION["errorCount"];
    $toGuess = $_SESSION["toGuess"];

    echo <<<END
        <div class="page-header">
            <h1>Wörter raten</h1>
            <h2>$mask</h2>
        </div>
    END;

    $unguessed = array_diff(range('A', 'Z'), $_SESSION["guessedLetters"]);

    if ($_SESSION["state"] == 0)
        foreach ($unguessed as $u) {
            echo "<form action='hangman-guess.php' method='post' class='inline-form'><button name='letter' value='$u'>$u</button></form>";
        }
    echo "<h3>Fehlversuche: $errorCount / 8</h3>";

    if ($_SESSION["state"] == 1) {
        echo "<h2>Juhu Gewonnen!</h2>";
        echo '<a href="hangman-init.php">Neuer Versuch</a>';
    } elseif ($_SESSION["state"] == 2) {
        echo "<h2>Viel Glück beim nächsten Mal!</h2>";
        echo "<h2>Das Wort war $toGuess</h2>";
        echo '<a href="hangman-init.php">Neuer Versuch</a>';
    }

    $src = "img/fish-$errorCount.svg";
    echo '<br><img src="' . $src . '"/>';
    ?>
</body>

</html>