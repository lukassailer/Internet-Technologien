<?php
require_once(__DIR__ . "/Database.php");

$id = $_POST['id'];
$question = $_POST['question'];
$answer0 = $_POST['answer0'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$solution = $_POST['solution'];

$db = new Database();
$db->editQuestions($id, $question, $answer0, $answer1, $answer2, $solution);

header("Location: questions-show.php");
