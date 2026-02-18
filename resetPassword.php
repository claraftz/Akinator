<?php 
declare(strict_types=1);
session_start();
require_once 'connectToDb.php';

if(!isset($_SESSION['user']['id'])) {
    header('Location: connection.php');
    exit;
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']['id'])) {
    $db = connectToDb();
    $newPassword = $_POST['new_password'];
    $userId = $_SESSION['user']['id'];
    
    //regex
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,16}$/';
    
    if(preg_match($regex, $newPassword)){
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = $db->prepare('UPDATE Player SET password = ? WHERE id = ?');
        $requestSucess = $update->execute([$hash, $userId]);
        
        if($requestSucess) {
            $_SESSION['success'] = 'Code crypté avec succès';
        } else {
            $_SESSION['error'] = 'Erreur lors de la MAJ';
        }
        
        
        
    } else {
        $_SESSION['error'] = "Le nouveau code secret ne respecte pas les règles Jedi !";
    }
    
    header('Location: profil.php');
    exit;
}