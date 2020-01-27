<?php
//$dns= "mysql:host=$host;dbname=$db";
//$rezultatai=[];
//try{
//    $conn = new PDO($dns, $username, $password, $options);
//    if($conn){
//        $stmt = $conn->query("SELECT pavadinimas FROM filmaitable ");
//        $sarasas = $stmt->fetchAll();
//        if (isset($_POST['search'])){
//            $uzklausa = $conn->prepare('SELECT zanrai.pavadinimas AS kategorija, filmaitable.pavadinimas,
//                filmaitable.rezisierius, filmaitable.metai, filmaitable.imdb, filmaitable.aprasymas FROM filmaitable
//                INNER JOIN zanrai
//                ON filmaitable.genre_id = zanrai.id
//                WHERE filmaitable.pavadinimas LIKE ?');
//            $input = $_POST['pavadinimas'];
//
//            $uzklausa->bindValue(1,"%$input%", PDO::PARAM_STR);
//            $uzklausa->execute();
//            $rezultatai = $uzklausa->fetchAll();
//
//        }
//
//    }
//} catch (PDOException $e) {
//    echo $e->getMessage();
//}
$sarasas = searchas();

?>
<div class="container m-5">
    <form method="post">
        <div class="form-group">
            <label for="pavadinimas">Iveskite, kokio filmo ieskote</label>
            <input type="text" class="form-control" id="paieskai" name="pavadinimas" list="pavadinimas" aria-describedby="emailHelp">
            <datalist id="pavadinimas">
                <?php foreach ($sarasas as $irasas):?>
                    <option value="<?=$irasas['pavadinimas'];?>"></option>
                <?php endforeach;?>
            </datalist>
        </div>
        <button name="search" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="container m-5">
    <?php if (isset($_POST['pavadinimas'])): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>Filmo pavadinimas</td>
                <td>Filmo aprasymas</td>
                <td>Filmo rezisierius</td>
                <td>Filmo sukurimo metai</td>
                <td>Filmo kategirija</td>
            </tr>
            </thead>
            <tr>
                <?php $rezultatai = searchas2();?>
                <?php
                foreach ($rezultatai as $irasas): ?>
                <td><?=$irasas['pavadinimas']; ?></td>
                <td><?=$irasas['aprasymas']; ?></td>
                <td><?=$irasas['rezisierius']; ?></td>
                <td><?=$irasas['metai']; ?></td>
                <td><?=$irasas['kategorija']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>