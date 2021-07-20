<?php


class Database
{

    private $connection;

    /**
     * Database constructor.
     *
     * Baut die Verbindung zur Datenbank auf
     */
    public function __construct()
    {
        // MySQL-Zugangsdaten
        // Hier: Automatisch auslesen aus .my.cnf. Sonst einfach von Hand eintragen
        $user = get_current_user(); // Benutzer, dem diese Datei gehört!
        $myCnf = parse_ini_file("/home/$user/.my.cnf");

        $host = $myCnf['host'];
        $user = $myCnf['user'];
        $password = $myCnf['password'];
        $database = $myCnf['database'];

        $this->connection = new mysqli($host, $user, $password, $database);
    }

    /**
     * Schließt die Verbindung zru Datenbank
     */
    public function __destruct()
    {
        $this->connection->close();
    }

    public function addQuestion($question, $answer0, $answer1, $answer2, $solution)
    {
        $statement = $this->connection->prepare("INSERT INTO questions(question,answer0,answer1,answer2,solution) VALUES(?,?,?,?,?)");
        $statement->bind_param("ssssi", $question, $answer0, $answer1, $answer2, $solution);
        return $statement->execute();
    }

    public function deleteQuestions($id)
    {
        $statement = $this->connection->prepare("DELETE FROM questions WHERE id = ?");
        $statement->bind_param("i", $id);
        return $statement->execute();
    }

    public function editQuestions($id, $question, $answer0, $answer1, $answer2, $solution)
    {
        $statement = $this->connection->prepare("UPDATE questions SET question = ?, answer0 = ?, answer1 = ?, answer2 = ?, solution = ? WHERE id = ?");
        $statement->bind_param("ssssii", $question, $answer0, $answer1, $answer2, $solution, $id);
        return $statement->execute();
    }

    public function getQuestions()
    {
        $result = $this->connection->query("SELECT * FROM questions");

        $resultArray = [];

        while ($line = $result->fetch_assoc()) {
            array_push($resultArray, $line);
        }

        $result->free();

        return $resultArray;
    }

    public function getQuestion($id)
    {
        $statement = $this->connection->prepare("SELECT * FROM questions WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

        return $statement->get_result()->fetch_assoc();
    }
}
