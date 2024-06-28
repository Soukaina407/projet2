<?php
require 'database.php';
$statement = $pdo->prepare('SELECT idStagiaire, nom, prenom, initiale, filiere.id FROM etudient, filiere WHERE etudient.id = filiere.id ');
$statement->execute();
$etudiants = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Stagiaires</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        h1, h2 {
            text-align: center;
        }

        .table-container {
            width: 85%;
            margin: 20px auto;
        }

        .table-container table {
            width: 100%;
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            padding: 8px;
            text-align: center;
        }

        .table-container th {
            background-color: #4DC3FA;
            color: white;
        }

        .table-container tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-container tbody tr:hover {
            background-color: #ddd;
        }

        .action-icons {
            display: flex;
            justify-content: space-around;
        }

        .action-icons a {
            margin: 0 5px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Table Stagiaires</h1>
        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Filière</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($etudiants as $etudiant): ?>
                        <tr>
                            <td><?= $etudiant['idStagiaire'] ?></td>
                            <td><?= $etudiant['nom'] ?></td>
                            <td><?= $etudiant['prenom'] ?></td>
                            <td><?= $etudiant['initiale'] ?></td>
                            <td class="action-icons">
                                <a href="modifier.php?id=<?= $etudiant['idStagiaire'] ?>" class="btn btn-sm btn-info">
                                    Modifier
                                </a>
                                <a href="supprimer.php?id=<?= $etudiant['idStagiaire'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stagiaire ?');">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
