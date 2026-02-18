<?php 
session_start();
require_once 'connectToDb.php';


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    $db = connectToDb();
    $newPassword = $_POST['new_password'];
    
    //regex
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,16}$/';
    
    if(preg_match($regex, $newPassword)){
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = $db->prepare('UPDATE Player SET password = ? WHERE id = ?');
        $update->execute([$hash, $_SESSION['user']['id']]);
        
        header('Location: profil.php?success=Code secret crypté avec succès');
    } else {
        header('Location: profil.php?error=Le nouveau code secret ne respecte pas les règles de sécurité !');
    }
    
    exit;
}