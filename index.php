<?php
require 'database.php';
$statment = $pdo->prepare('SELECT * FROM filiere');
$statment->execute();
$filieres = $statment->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $photo = 'img5.jpeg';
    $filiere = $_POST['filiere'];

    if(!empty($nom) && !empty($prenom)){
        $statment = $pdo->prepare('INSERT INTO etudient(nom,prenom,photoProfile,id)VALUES(:nom,:prenom,:photo,:filiere)');
        $statment->execute([
            ':nom' => $nom,
            ':prenom' => $prenom, 
            ':photo' => $photo,
            ':filiere' => $filiere
        ]);
    header('Location: affichage.php');
    exit();
    }
}

?>









<!DOCTYPE html>
<html>
<head>
    <title>A Stagiaire</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
            line-height: 1.5;
            min-height: 100vh;
            background: #f3f3f3;
            flex-direction: column;
            margin: 0;
        }

        .main {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 500px;
            text-align: center;
        }

        h1 {
            color: #4CAF50;
        }

        label {
            display: block;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 5px;
            text-align: left;
            color: #555;
            font-weight: bold;
        }

        input, select {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
            border: none;
            color: white;
            cursor: pointer;
            background-color: #4CAF50;
            width: 100%;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1>Inserer un Nouveau Stagiaire</h1>
        <form action="" method="POST">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Entrer le nom">

            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrer le prénom">

            <label for="filiere">Filière</label>
            <select id="filiere" name="filiere">
                <?php foreach ($filieres as $filiere): ?>
                <option value="<?php echo $filiere['id']; ?>"><?php echo $filiere['initiale']; ?></option>
                <?php endforeach; ?>
            </select> 
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">

            <button type="submit" name="ajouter">Ajouter</button>
        </form>
    
  
       
      </div>
</body>
</html>
