<h2>Visi filmai</h2>
<?php
$dsn= "mysql:host=$host; dbname=$db";
try{
    $conn = new PDO($dsn, $username, $password);
    if($conn){
        $stmt = $conn->query("SELECT * FROM filmai");
        $filmai = $stmt->fetchAll();
    }
}catch (PDOException $e){

    echo $e->getMessage();
}?>
<table class="table table-bordered">
    <tr>
        <?php
        foreach ($filmai as $filmas):?>
    </tr>
    <tr>
        <td><?=$filmas['id'];?></td>
    <td><?=$filmas['pavadinimas'];?></td>
    <td><?=$filmas['metai'];?></td>
    <td><?=$filmas['rezisierius'];?></td>
    <td><?=$filmas['imdb'];?></td>
    <td><?=$filmas['genre_id'];?></td>
    <td><?=$filmas['aprasymas'];?></td>
    </tr>
    <?php endforeach;?>
</table>
