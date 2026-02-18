<?php 
declare(strict_types=1);
session_start(); 
require_once 'connectToDb.php';

$error = '';


/**
 * 1. Appelle fonction pr se connecter a la Db sql 
 * 2. Verif des champs si remplit ou non 
 * 3. Recherche de l'user / player par son mail
 * 4. Verif de l'user +  son mdp 
 * 5. Connexion reussi : on stocke les infos (session)
 * 6. Redirection page profil / home
**/
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        //1. 
        $db = connectToDb(); 
        //2.  
        if (empty($_POST['email']) || empty($_POST['password'])) {
            throw new Exception('Veuillez remplir tous les champs pour vous connecter Jedi !');
        }
        
        //3. 
        $research = $db->prepare('SELECT * FROM Player WHERE email = ?');
        $research->execute([$_POST['email']]);
        $user = $research->fetch(PDO::FETCH_ASSOC);
        
        
        //4.
        if(!$user || !password_verify($_POST['password'], $user['password'])) {
            throw new Exception("Identifiants incorrects, ressaisis toi Jedi !");
        }
        
        
        //5.
        $_SESSION['user'] = [
            'id' => $user['id'],
            'nickname' => $user['nickname'],
            'email' => $user['email']
        ];
        
        
        //6. 
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}




$title = 'Akinator - Connexion';
$template = 'template/connection.phtml';
include 'template/layout.phtml';

