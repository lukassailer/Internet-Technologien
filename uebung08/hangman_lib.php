<?php

function initGame()
{
    $_SESSION["toGuess"] = transformWord(getRandomWord());
    $_SESSION["mask"] = maskWord($_SESSION["toGuess"]);
    $_SESSION["guessedLetters"] = [];
    $_SESSION["errorCount"] = 0;
    $_SESSION["state"] = 0;
}

function transformWord($word)
{
    $replace = array("ä", "ö", "ü", "ß");
    $replaceWith = array("ae", "oe", "ue", "ss");

    $word = str_replace($replace, $replaceWith, $word);
    return strtoupper($word);
}

function maskWord($word)
{
    $n = strlen($word) - 1;

    return array_fill(0, $n, "_");
}

function getAllWords()
{
    $wordsString = file_get_contents('words-array.php');
    $replace = array("[", "]", "\"");
    $wordsString = str_replace($replace, "", $wordsString);

    return explode(",", $wordsString);
}

function getRandomWord()
{
    $words = getAllWords();
    $i = array_rand($words);

    return $words[$i];
}

function guessLetter($letter)
{
    $letter = strtoupper($letter);
    if (in_array($letter, $_SESSION["guessedLetters"])) {
        return;
    }

    array_push($_SESSION["guessedLetters"], $letter);

    $letterPos = strpos($_SESSION["toGuess"], $letter);

    if ($letterPos === false) {
        $_SESSION["errorCount"]++;
    } else {
        while ($letterPos !== false) {
            $_SESSION["mask"][$letterPos - 1] = $letter;
            $letterPos = strpos($_SESSION["toGuess"], $letter, $letterPos + 1);
        }
    }

    if ($_SESSION["errorCount"] > 8)
        $_SESSION["state"] = 2;
    elseif (!in_array("_", $_SESSION["mask"]))
        $_SESSION["state"] = 1;
}
