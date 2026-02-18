<?php
session_start();
require_once 'connectToDb.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])){
    $db = connectToDb();
    
    $deletePlayer = $db->prepare('DELETE FROM Player WHERE id = ?');
    $deletePlayer->execute([$_SESSION['user']['id']]);
    
    session_destroy();
    header('Location: index.php');
    exit;
}