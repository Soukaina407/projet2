<?php
require 'database.php';
$id = $_GET['id'];
$statment = $pdo->prepare('DELETE FROM etudient WHERE idStagiaire = :id');
$statment->execute([
    ':id' => $id
]);
header('location:affichage.php');