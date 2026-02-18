<?php
declare(strict_types=1);
function connectToDb() : PDO {
    $dsn = 'mysql:host=db.3wa.io;port=3306;dbname=clarafritz_sprint_akinator;charset=utf8';
    $user = 'clarafritz';
    $password = '7aecfc5cd604a4900c524a7a25615655';
    $db = new PDO($dsn, $user, $password);
    return $db;
}
