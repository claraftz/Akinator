<?php
declare(strict_types=1);
session_start();
require_once 'connectToDb.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']['id'])){
    $db = connectToDb();
    $userId = $_SESSION['user']['id'];
    
    
    
    try {
        $db->beginTransaction();
        
        //supprr infos user
        $deleteGame = $db->prepare('DELETE FROM Game WHERE id_user = ?');
        $deleteGame->execute([$userId]);
        
        //suppr user 
        $deletePlayer = $db->prepare('DELETE FROM Player WHERE id = ?');
        $deletePlayer->execute([$userId]);
        
        
        $db->commit();
        
        
        session_destroy();
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $db->rollBack(); 
        
        $_SESSION['error'] = "Impossible de supprimer tes empreintes Jedi : contactez le conseil des Jedi ! ";
        header('Location: profil.php');
        exit;
    }
    
    
}