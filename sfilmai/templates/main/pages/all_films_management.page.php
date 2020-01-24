<h2>Visi filmai</h2>
<?php
$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){
        $stmt = $conn->query("SELECT filmaitable.id, filmaitable.pavadinimas, filmaitable.aprasymas, filmaitable.rezisierius, filmaitable.metai, filmaitable.genre_id, zanrai.pavadinimas AS zanroPavadinimas
                                        FROM filmaitable
                                        INNER JOIN zanrai ON filmaitable.genre_id=zanrai.id");
        $filmai = $stmt->fetchAll();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} ?>
<a href="?page=prideti-filma" class="btn btn-primary">Naujas filmas</a>
<br>
<br>
<table class="table table-bordered">
    <tr>
        <?php
        foreach ($filmai as $filmas): ?>

    <tr>
        <td><?=$filmas['pavadinimas']; ?></td>
        <td><?=$filmas['aprasymas']; ?></td>
        <td><?=$filmas['rezisierius']; ?></td>
        <td><?=$filmas['metai']; ?></td>
        <td><?=$filmas['zanroPavadinimas']; ?></td>
        <td><a href="?page=redaguoti-filma&id=<?=$filmas['id']?>">Redaguoti</a></td>
        <td><a href="?page=trinti-filma&id=<?=$filmas['id']?>">Salinti</a></td>


    </tr>
    <?php endforeach; ?>
    </tr>
</table>