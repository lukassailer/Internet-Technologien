<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>Fragen anzeigen</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Fragen anzeigen</h1>


    <?php

    require_once(__DIR__ . "/Database.php");

    $db = new Database();

    $questions = $db->getQuestions();

    echo "<table>";
    echo "<tr>";

    echo "<th>Frage</th>";
    echo "<th>Antwort 0</th>";
    echo "<th>Antwort 1</th>";
    echo "<th>Antwort 2</th>";
    echo "<th></th>";
    echo "<th></th>";

    echo "</tr>";

    foreach ($questions as $q) {

        $id = $q['id'];
        $question = $q['question'];
        $answer0 = $q['answer0'];
        $answer1 = $q['answer1'];
        $answer2 = $q['answer2'];
        $solution = $q['solution'];

        echo "<tr>";

        echo "<td>$question</td>";

        $color0 = "red";
        $color1 = "red";
        $color2 = "red";

        switch ($solution) {
            case 0:
                $color0 = "green";
                break;
            case 1:
                $color1 = "green";
                break;
            case 2:
                $color2 = "green";
                break;
            default:
                break;
        }

        echo "<td style='background-color:$color0'>$answer0</td>";
        echo "<td style='background-color:$color1'>$answer1</td>";
        echo "<td style='background-color:$color2'>$answer2</td>";

        echo "<td> <form action='questions-edit.php' method='get' class='inline-form'><button name='id' value='$id'>Bearbeiten</button></form> </td>";
        echo "<td> <form action='questions-delete.php' method='post' class='inline-form'><button name='id' value='$id'>Löschen</button></form> </td>";

        echo "</tr>";
    }

    echo "</table>";


    ?>
    <hr>
    <p><a href="questions-create.php">Frage hinzufügen</a></p>


</body>

</html>