<?php

$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){
        $kuri = $_GET['id'];
        $stmt = $conn->query("SELECT filmaitable.id, filmaitable.pavadinimas, filmaitable.aprasymas, 
                              filmaitable.metai, filmaitable.rezisierius, filmaitable.imdb, zanrai.id AS rekimasId, zanrai.pavadinimas AS zanroPavadinimas
                              FROM filmaitable 
                              INNER JOIN zanrai ON filmaitable.genre_id=zanrai.id 
                              WHERE filmaitable.id = $kuri");
        $filmas = $stmt->fetch();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} ?>

<?php if (isset($_POST['submit'])){
    try {
        if ($conn){
            $sql = "UPDATE filmaitable SET pavadinimas = :pavadinimas, 
                                          aprasymas = :aprasymas, 
                                          metai = :metai, 
                                          rezisierius =:rezisierius, 
                                          imdb = :imdb, 
                                          genre_id = :genre_id
               
                    WHERE id = :id";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
            $stmt->bindParam(':pavadinimas', $_POST['pavadinimas'], PDO::PARAM_STR);
            $stmt->bindParam(':aprasymas', $_POST['aprasymas'], PDO::PARAM_STR);
            $stmt->bindParam(':metai', $_POST['metai'], PDO::PARAM_STR);
            $stmt->bindParam(':rezisierius', $_POST['rezisierius'], PDO::PARAM_STR);
            $stmt->bindParam(':imdb', $_POST['ivertinimai'], PDO::PARAM_STR);
            $stmt->bindParam(':genre_id', $_POST['zanroId'], PDO::PARAM_STR);
            $stmt->execute();
            header('Location:?page=filmu-valdymas');


        }
    } catch (PDOException $e){
        echo $e->getMessage();
    }
}

?>

<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="id">Filmo id</label>
            <input type="text" class="form-control" id="id" name="id"  value="<?=$filmas['id']; ?>">
        </div>
        <div class="form-group">
            <label for="pavadinimas">Filmo pavadinimas</label>
            <input type="text" class="form-control" id="pavadinimas" name="pavadinimas"  value="<?=$filmas['pavadinimas']; ?>">
        </div>
        <div class="form-group">
            <label for="aprasymas">Aprasymas</label>
            <input type="text" class="form-control" id="aprasymas" name="aprasymas" value="<?=$filmas['aprasymas']; ?>">
        </div>
        <div class="form-group">
            <label for="metai">Filmo metai</label>
            <input type="text" class="form-control" id="metai" name="metai"  value="<?=$filmas['metai']; ?>">
        </div>
        <div class="form-group">
            <label for="rezisierius">Rezisierius</label>
            <input type="text" class="form-control" id="rezisierius" name="rezisierius" value="<?=$filmas['rezisierius']; ?>">
        </div>
        <div class="form-group">
            <label for="ivertinimai">Ivertinimai</label>
            <input type="text" class="form-control" id="ivertinimai" name="ivertinimai" value="<?=$filmas['imdb']; ?>">
        </div>

        <div class="form-group">
            <label for="zanras">Filmo zanras</label>
            <input type="text" class="form-control" id="zanras" name="zanras"  value="<?=$filmas['zanroPavadinimas']; ?>">
        </div>
        <div class="form-group">
            <label for="zanroId">Filmo id</label>
            <input type="text" class="form-control" id="zanroId"  name="zanroId" value="<?=$filmas['rekimasId'];?>" >
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>