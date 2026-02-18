<?php 
session_start();
require_once 'connectToDb.php';


/**
 * 1. Jedi pas authentifié --> bloque acces
 * 2. gestion des deux messages de retour (succès + echec)
 * 3. Récupération de l'historique des missions 
**/

//1.
if(!isset($_SESSION['user'])){
    header('Location: connection.php');
    exit;
}


$db = connectToDb();
$idPlayer = $_SESSION['user']['id'];


//2.
$success = isset($_POST['success']) ? $_POST['success'] : null;
$error = isset($_POST['error']) ? $_POST['error'] : null;


try {
    //3.
    $query = $db->prepare('
        SELECT G;date_game, C.name_character, C.picture
        FROM Game G
        JOIN Character C ON G.id_character = C.id
        WHERE G.id_user = ?
        ORDER BY G.date_game DESC
    ');
    $query->execute([$idPlayer]);
    $gameslogs = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Erreur lors de la lecture des archives";
}




$title = 'Akinator - Profil';
$template = 'template/profil.phtml';
include 'template/layout.phtml';
