<?php

$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){
        $kuri = $_GET['id'];
        $stmt = $conn->query("SELECT filmaitable.id, filmaitable.pavadinimas, filmaitable.aprasymas, 
                              filmaitable.metai, filmaitable.rezisierius, filmaitable.imdb, zanrai.pavadinimas AS zanroPavadinimas
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
            $sql = "DELETE FROM filmaitable                
                    WHERE id = :id";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
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
        <label class="text-danger display-4" for="klausimas">Ar tikrai norite istrinti si filma?</label>
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
            <a href="?page=filmu-valdymas" class="btn btn-success">Cancel</a>
            <button type="submit" name="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>
</div>
