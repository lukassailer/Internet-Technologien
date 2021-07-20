<?php require_once(__DIR__ . "/hangman_lib.php");
initGame();
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>Alle Wörter</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    $words = getAllWords();
    $numberOfWords = sizeof($words);

    echo <<<END
    <div class="page-header">
        <h1>Alle Wörter</h1>
    </div>
END;

    if ($numberOfWords > 0) {
        echo "<table>";

        echo "<tr>
        <th>Wort</th>
        <th>Zu raten</th>
        <th>Maske</th>
    </tr>";

        foreach ($words as $w) {
            $t = transformWord($w);
            $m = implode(" ", maskWord($t));
            echo "<tr>
                <td>$w</td>
                <td>$t</td>
                <td>$m</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "keine Wörter da";
    }

    ?>

</body>

</html>