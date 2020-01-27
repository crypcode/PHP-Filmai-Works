<?php

$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){
        $genreid = $_GET['id'];
        $stmt = $conn->query("SELECT * FROM zanrai
                                        WHERE id = $genreid
             ");
        $genre = $stmt->fetch();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} ?>
<?php if (isset($_POST['submit'])){
    try {
        if ($conn){
            $sql = "DELETE FROM zanrai                
                    WHERE id = :id";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
            $stmt->execute();
            header('Location:?page=zanru-valdymas');
        }
    } catch (PDOException $e){
        echo $e->getMessage();
    }
}

?>
<form method="post">
    <label class="text-danger display-4" for="klausimas">Ar tikrai norite istrinti si zanra?</label>
    <div class="form-group">
        <label for="id">Zanro id</label>
        <input type="text" class="form-control" id="id" name="id"  value="<?=$genre['id']; ?>">
    </div>
    <div class="form-group">
        <label for="id">Zanro id</label>
        <input type="text" class="form-control" id="pavadinimas" name="pavadinimas"  value="<?=$genre['pavadinimas']; ?>">
    </div>
    <div class="form-group">
        <a href="?page=zanru-valdymas" class="btn btn-success">Cancel</a>
        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
    </div>
</form>