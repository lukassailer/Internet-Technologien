<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>Frage bearbeiten</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php

    require_once(__DIR__ . "/Database.php");

    $db = new Database();

    $id = $_GET['id'];
    $q = $db->getQuestion($id);

    $question = $q['question'];
    $answer0 = $q['answer0'];
    $answer1 = $q['answer1'];
    $answer2 = $q['answer2'];
    $solution = $q['solution'];

    ?>

    <h1>Frage bearbeiten</h1>
    <hr>

    <form action="questions-update.php" method="post">

        <label for="question">Frage:</label><br>
        <textarea name="question" id="question" required><?php echo $question; ?></textarea>
        <br><br>

        <label for="answer0">Antwort 0:</label><br>
        <input name="solution" type="radio" id="solution" value="0" <?php if ($solution === 0) echo "checked"; ?>>
        <input name="answer0" type="text" id="answer0" value="<?php echo $answer0 ?>" required><br>

        <label for="answer1">Antwort 1:</label><br>
        <input name="solution" type="radio" id="solution" value="1" <?php if ($solution === 1) echo "checked"; ?>>
        <input name="answer1" type="text" id="answer1" value="<?php echo $answer1 ?>" required><br>

        <label for="answer2">Antwort 2:</label><br>
        <input name="solution" type="radio" id="solution" value="2" <?php if ($solution === 2) echo "checked"; ?>>
        <input name="answer2" type="text" id="answer2" value="<?php echo $answer2 ?>" required><br><br>

        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

        <button type="submit">Änderung speichern</button>

    </form>

</body>

</html>