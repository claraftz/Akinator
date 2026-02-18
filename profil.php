<?php 
session_start();
require_once 'connectToDb.php';

/**
 * 1. Verif user connecté 
 * 2. Message verif erreur . succes**/
// 1.
if(!isset($_SESSION['user']['id'])){
    header('Location: connection.php');
    exit;
}

$db = connectToDb();
$idPlayer = (int)$_SESSION['user']['id'];

// 2.
$success = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);

try {
    $query = $db->prepare('
        SELECT G.date_game, C.name_character, C.picture
        FROM Game G
        JOIN `Character` C ON G.id_character = C.id
        WHERE G.id_user = ?
        ORDER BY G.date_game DESC
    ');
    $query->execute([$idPlayer]);
    
    
    $gamesLogs = $query->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    $error = "Erreur lors de la lecture des archives Jedi.";
    $gamesLogs = [];
}

$title = 'Akinator - Profil';
$template = 'template/profil.phtml';
include 'template/layout.phtml';