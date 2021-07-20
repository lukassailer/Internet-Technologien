<?php
require_once(__DIR__ . "/Database.php");

$id = $_POST['id'];

$db = new Database();
$db->deleteQuestions($id);

header("Location: questions-show.php");
