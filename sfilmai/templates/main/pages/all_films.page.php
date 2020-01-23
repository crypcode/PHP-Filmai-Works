<h2>visi filmai</h2>
<?php
$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){
        $stmt = $conn->query("SELECT filmaitable.pavadinimas, filmaitable.aprasymas, filmaitable.rezisierius, filmaitable.metai, filmaitable.genre_id, zanrai.pavadinimas AS zanroPavadinimas
                                        FROM filmaitable
                                        INNER JOIN zanrai ON filmaitable.genre_id=zanrai.id");
        $filmai = $stmt->fetchAll();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} ?>
<table class="table table-bordered">
    <thead>
    <tr>
        <td>Pavadinimas</td>
        <td>Aprasymas</td>
        <td>Rezisierius</td>
        <td>Metai</td>
        <td>Zanrai</td>
    </tr>
    </thead>
    <tr>
        <?php
        foreach ($filmai as $filmas): ?>

    <tr>
    <td><?=$filmas['pavadinimas']; ?></td>
    <td><?=$filmas['aprasymas']; ?></td>
    <td><?=$filmas['rezisierius']; ?></td>
    <td><?=$filmas['metai']; ?></td>
    <td><?=$filmas['zanroPavadinimas']; ?></td>

    </tr>
    <?php endforeach; ?>
    </tr>
</table>
