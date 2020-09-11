<?php
 
$erreurs = "";
$db = new PDO('mysql:host=localhost;dbname=tuto;charset=utf8', 'root', '');
 
if (isset($_POST['creer_tache'])) { 
    if (empty($_POST['creer_tache'])) {  
        $erreurs = 'Vous devez indiquer la valeure de la tâche';
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
 
<link rel="stylesheet" href=".css"/>
 
<div class="header">
    <p class="header_titre"> My_Todo_List </p>
</div>
 
 
<form class="taches_input" method="post" action="index.php">
 
 
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
            <td><a class="suppr" href=".php?supprimer_tache=<?php echo $taches['id'] ?>"> X</a></td>
        </tr>
        <?php
    }
 
 
    ?>
 
 
</table>