<?php 
session_start();
require_once 'connectToDb.php';


/**
 * 1. User pas co -> redirection page login 
 * 2. On verif si user clique sur validé 
 * 3. On recup l'ID dans URL (ou question1)
 * 4. Recup les réponses : table Answer
**/

//1.
if (!isset($_SESSION['user'])) {
    header('Location: connection.php');
    exit;
}

$db = connectToDb();



//2. res_ = id d'un perso : resultat
if(isset($_POST['next'])) {
    $nextValue = $_POST['next'];
    if(strpos($nextValue, 'res_') === 0) {
        $characterId = str_replace('res_', '', $nextValue);
        header('Location: result.php?id_character=' . $characterId);
        exit;
    } else {
        header('Location: quiz.php?id=' . (int)$nextValue);
        exit;
    }
}



//3.
if (isset($_GET['id'])) {
    $questionId = (int)$_GET['id'];
} else {
    $questionId = 1;
}

//prend données de la quest - Table Question
$request = $db->prepare('SELECT * FROM Question WHERE id = ?');
$request->execute([$questionId]);
$currentQuestion = $request->fetch();
//question n'existe pas -> home
if(!$currentQuestion) {
    header('Location: index.php');
    exit;
}



//4.
$typeAnswer = $db->prepare('SELECT * FROM Answer WHERE id_question = ?');
$typeAnswer->execute([$questionId]);
$answers = $typeAnswer->fetchAll(); 

$answerYes = null;
$answerNo = null; 

foreach($answers as $answer) {
    if ($answer['type_answer'] === 'OUI') {
        $answerYes = $answer;
    } elseif ($answer['type_answer'] === 'NON') {
        $answerNo = $answer; 
    }
}



$title = 'Akinator - Quiz';
$template = 'template/quiz.phtml';
include 'template/layout.phtml';
