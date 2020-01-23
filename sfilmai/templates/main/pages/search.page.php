<?php
$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){

        if (isset($_POST['submit'])){
            $pavadinimas = $_POST['pavadinimas'];
            $stmt = $conn->query("SELECT * FROM filmaitable 
                              WHERE pavadinimas LIKE '%$pavadinimas%'");
            $sarasas = $stmt->fetchAll();
        }

    }
} catch (PDOException $e) {
    echo $e->getMessage();
} ?>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="paieskai">Iveskite, kokio filmo ieskote</label>
                <input type="text" class="form-control" id="paieskai" name="pavadinimas" aria-describedby="emailHelp">
            </div>
            <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <br>
<?php if (isset($_POST['pavadinimas'])): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <td>Filmo pavadinimas</td>
            <td>Filmo aprasymas</td>
            <td>Filmo rezisierius</td>
            <td>Filmo sukurimo metai</td>

        </tr>
        </thead>
        <tr>
            <?php
            foreach ($sarasas as $irasas): ?>

        <tr>
            <td><?=$irasas['pavadinimas']; ?></td>
            <td><?=$irasas['aprasymas']; ?></td>
            <td><?=$irasas['rezisierius']; ?></td>
            <td><?=$irasas['metai']; ?></td>


        </tr>
        <?php endforeach; ?>
        </tr>
    </table>
<?php endif;?>