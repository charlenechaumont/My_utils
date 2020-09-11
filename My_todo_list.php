<!DOCTYPE html>
<?php
 
$erreurs = "";
if (isset($_POST['creer_tache'])) { 
    if (empty($_POST['creer_tache'])) {  
        $erreurs = ('indiquer la valeure de la tâche');
    } else {
        $tache = $_POST['creer_tache'];
        $db->exec("INSERT INTO tache(tache) VALUES('$tache')"); 
    }
}
 
if(isset($_GET['supprimer_tache'])) {
    $id = $_GET['supprimer_tache'];
    $db->exec("DELETE FROM tache WHERE id=$id");
}
 
?>
 
<link rel="stylesheet" href="mytodolist.css"/>
 
<html>
<head>
<title>My_Todo_List.</title>
</head>
 
<form class="taches_input" method="post" action="My_todo_list.php">
 
 
    <input id="inserer" type="text" name="creer_tache"/>
    <button id="envoyer">Créer</button>
</form>
<?php
if (isset($erreurs)) {
    ?>
    <p><?php echo $erreurs ?></p>
    <?php
}
?>
 
 
<table class="taches">
    <tr>
        <th>
            A faire
        </th>
        <th>
            finie
        </th>
    </tr>
    <?php
    $reponse = $db->query('Select * from tache'); 
    while ($taches = $reponse->fetch()) { 
        ?>
        <tr>
            <td><?php echo $taches['id'] ?></td>
            <td><?php echo $taches['tache'] ?></td>
            <td><a class="suppr" href="My_todo_list.php?supprimer_tache=<?php echo $taches['id'] ?>"> X</a></td>
        </tr>
        <?php
    }
 
 
    ?>
 
 
</table>
</html>
