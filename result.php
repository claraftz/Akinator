<?php
session_start();
require_once 'connectToDb.php';

// 1. Verif connexion
if(!isset($_SESSION['user']['id'])){
    header('Location: connection.php');
    exit;
}

// 2. Recup ID character
if(!isset($_GET['id_character'])){
    header('Location: quiz.php');
    exit;
}

$characterId = (int)$_GET['id_character'];
$userId = (int)$_SESSION['user']['id'];
$db = connectToDb();

// 3. Enregistrement sécurisé
try {
    // On vérifie si le perso existe vraiment dans la table Character
    $check = $db->prepare('SELECT id FROM `Character` WHERE id = ?');
    $check->execute([$characterId]);
    
    if($check->fetch()) {
        $insert = $db->prepare('
            INSERT INTO Game (date_game, id_user, id_character) 
            VALUES (NOW(), ?, ?)
        ');
        $insert->execute([$userId, $characterId]);
    }
} catch (Exception $e) {
    // Si ça plante, on veut voir l'erreur !
    die("Erreur historique : " . $e->getMessage());
}

// 4. Recup données pour l'affichage
$request = $db->prepare('SELECT name_character, description, picture FROM `Character` WHERE id = ?');
$request->execute([$characterId]);
$character = $request->fetch();

if (!$character){
    header('Location: index.php');
    exit;
}

$title = 'Akinator - Résultat ' . htmlspecialchars($character['name_character']);
$template = 'template/result.phtml';
include 'template/layout.phtml';