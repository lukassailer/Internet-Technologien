<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <title>Frage hinzufügen</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Frage hinzufügen</h1>
    <hr>


    <form action="questions-store.php" method="post">

        <label for="question">Frage:</label><br>
        <textarea name="question" id="question" required></textarea><br><br>

        <label for="answer0">Antwort 0:</label><br>
        <input name="solution" type="radio" id="solution" value="0" checked>
        <input name="answer0" type="text" id="answer0" required><br>

        <label for="answer1">Antwort 1:</label><br>
        <input name="solution" type="radio" id="solution" value="1">
        <input name="answer1" type="text" id="answer1" required><br>

        <label for="answer2">Antwort 2:</label><br>
        <input name="solution" type="radio" id="solution" value="2">
        <input name="answer2" type="text" id="answer2" required><br><br>

        <button type="submit">Frage speichern</button>

    </form>

</body>

</html>