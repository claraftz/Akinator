<?php
declare(strict_types=1);
session_start();
require_once 'connectToDb.php';

/**
 * 1. Verif connexion user
 * 2. Recupération l'ID du perso final 
 *  3. Enregistrement sécurisé (verif character existe en Sql)
 * 4. Recupérer les données pour affichage 
**/

//1
if(!isset($_SESSION['user']['id'])){
    header('Location: connection.php');
    exit;
}



// 2.
if(!isset($_GET['id_character'])){
    header('Location: quiz.php');
    exit;
}

$characterId = (int)$_GET['id_character'];
$userId = (int)$_SESSION['user']['id'];
$db = connectToDb();



// 3. 
try {
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
    die("Erreur historique : " . $e->getMessage());
}



// 4. 
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