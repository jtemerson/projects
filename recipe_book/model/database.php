<?php
$dsn = 'mysql:host=localhost;dbname=jtemerso_recipes';
    $username = 'jtemerso_iClient';
    $password = 'tjpjtpp7';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('errors/database_error.php');
        exit();
    }
