<?php
$id = $_GET['id'];
require 'database.php';
$statment = $pdo->prepare('SELECT * FROM etudient where id = :id');
$statment->execute([
    ':id' => $id
]);
$etudients = $statment->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] && isset($_POST['modifier'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filier = $_POST['filiere'];
    $photo = 'image/img5.jpeg';
    $id = $_POST['id'];

    if(!empty($nom) && !empty($prenom) && !empty($filier) && !empty($photo)){
        $statment = $pdo->prepare('UPDATE etudient SET nom = :nom,prenom = :prenom,filier = :filier,photo = :photo where idStagiaire = :id');
        $statment->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':filier' => $filier,
            ':photo' => $photo,
            ':id' => $id
        ]);
        header('location:affichage.php');
    }else{
        echo 'les information sont correcte';
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
            <input type="hidden" id="id_hotel" name="id_hotel" >
            
            <label for="nom">nom</label>
            <input type="text" id="nom" name="nom" >

            <label for="prenom">prenom</label>
            <input type="text" id="prenom" name="prenom" value="">

            <label for="filiere">Filière</label>
            <select id="filiere" name="filiere">
                <?php foreach ($filieres as $filiere): ?>
                <option value="<?php echo $filiere['id']; ?>"><?php echo $filiere['initiale']; ?>developpent</option>
                <?php endforeach; ?>
            </select>

            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">

            <button type="submit" name="modifie">Modifier</button>
        </form>
    </div>
</body>
</html>