<?php 
declare(strict_types=1);
session_start();
require_once 'connectToDb.php';

$error = '';

/**
 * 1. Connexion base donnée via fonction 
 * 2. Verif champs vides d'inscription
 * 3. Verif du format email
 * 4. Verif du mdp + respecte le <p> (regex)
 * 5. Verif si email existe deja dans Player 
 * 6. Hachage mdp 
 * 7. Insertion dans DB
 * 8. succès -> redirection vers connexion 
**/
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    try{
        //1.
        $db = connectToDb();
        
        
        //2.
        if(empty($_POST['nickname']) || empty($_POST['email']) || empty($_POST['password'])) {
            throw new Exception("Tous les champs sont obligatoires pour rejoindre l'Alliance !");
        }
        
        
        //3.
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Format d'email invalide !");
        }
        
        
        //4.
        $password = $_POST['password'];
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/';
        if(!preg_match($regex, $password)) {
            throw new Exception("Le mot de passe ne respecte pas les critères de sécurité. Attention Jedi !");
        }
        
        
        //5.
        $checkEmail = $db->prepare('SELECT id FROM Player WHERE email = ?');
        $checkEmail->execute([$_POST['email']]);
        if ($checkEmail->fetch()){
            throw new Exception('Cet email est déjà utilisé par un autre Jedi !');
        }
        
        
        //6.
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        
        //7.
        $insertIntoDb = $db->prepare('INSERT INTO Player (nickname, email, password) VALUES (?, ?, ?)');
        $insertIntoDb->execute([
            htmlspecialchars($_POST['nickname']),
            $_POST['email'],
            $passwordHash
        ]);
        
        
        //8.
        header('Location: connection.php');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}


$title = 'Akinator - Inscription';
$template = 'template/registration.phtml';
include 'template/layout.phtml';
