<?php require_once(__DIR__ . "/hangman_lib.php");

session_name(get_current_user() . "u08");
session_start();

if (isset($_POST["letter"]))
    guessLetter($_POST["letter"]);

header("Location: hangman.php");
