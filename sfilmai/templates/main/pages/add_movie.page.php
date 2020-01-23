<?php
$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){
        $stmt = $conn->query("SELECT * FROM zanrai");
        $zanrai = $stmt->fetchAll();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} ?>

<?php
$validation_errors=[];
if (isset($_POST['submit'])){
    if (!preg_match('/\w{1,30}$/',
        trim(htmlspecialchars($_POST['pavadinimas']))) ){
        $validation_errors[] = "pavadinimas negali virsyti 30 simboliu ir trumpesnis uz 1";
    } else {
        $_POST['pavadinimas'] = trim(htmlspecialchars( $_POST['pavadinimas']));
    }
    if (!preg_match('/[\w\s{50,1000}]/i',
        trim(htmlspecialchars($_POST['aprasymas'])))) {
        $validation_errors[] = "netinkamas aprasymo formatas";
    } else {
        $_POST['aprasymas'] = trim(htmlspecialchars($_POST['aprasymas']));
    }

    if (!preg_match('/\w{1,30}$/',
        trim(htmlspecialchars($_POST['rezisierius']))) ){
        $validation_errors[] = "pavadinimas negali virsyti 30 simboliu ir trumpesnis uz 1";
    } else {
        $_POST['rezisierius'] = trim(htmlspecialchars( $_POST['rezisierius']));
    }
    if (!preg_match('/\d\.\d/',
        trim(htmlspecialchars($_POST['ivertinimai'])))){
        $validation_errors[] = "ivertinimai - netinkamas formatas";
    } else {
        $_POST['ivertinimai'] = trim(htmlspecialchars($_POST['ivertinimai']));
    }
}

?>
<?php
if($validation_errors) :?>
    <div class="errors">
        <ul>
            <?php foreach($validation_errors as $error) :?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

<?php if (isset($_POST['submit'])){
    try {
        if ($conn){
            $sql = "INSERT INTO filmaitable (pavadinimas, aprasymas, metai, rezisierius, imdb, genre_id)
            VALUES (:pavadinimas, :aprasymas, :metai, :rezisierius, :imdb, :genre_id)";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(':pavadinimas', $_POST['pavadinimas'], PDO::PARAM_STR);
            $stmt->bindParam(':aprasymas', $_POST['aprasymas'], PDO::PARAM_STR);
            $stmt->bindParam(':metai', $_POST['metai'], PDO::PARAM_STR);
            $stmt->bindParam(':rezisierius', $_POST['rezisierius'], PDO::PARAM_STR);
            $stmt->bindParam(':imdb', $_POST['ivertinimai'], PDO::PARAM_STR);
            $stmt->bindParam(':genre_id', $_POST['zanras'], PDO::PARAM_STR);
            $stmt->execute();
            header('Location:/sfilmai/?page=visi');


        }
    } catch (PDOException $e){
        echo $e->getMessage();
    }
}

?>
        <div class="container">
<form method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">Filmo pavadinimas</label>
    <input type="text" class="form-control" id="formGroupExampleInput" name="pavadinimas"  placeholder="Iveskite filmo pavadinima">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Aprasymas</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="aprasymas" placeholder="Iveskite filmo Aprasymas">
  </div>
    <div class="form-group ">
        <label for="metai">Metai</label>
        <select id="metai" class="form-control" name="metai">
            <option selected>pasirinkite...</option>

            <?php $metai=1996; ?>
            <?php for($i=0; $i<25; $i++) : ?>
                <option value="<?= $metai; ?>"><?= $metai; ?></option>
                <?php $metai++; ?>
            <?php endfor; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Rezisierius</label>
        <input type="text" class="form-control" id="formGroupExampleInput2" name="rezisierius" placeholder="iverskite filmo rezisieriu">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Ivertinimai</label>
        <input type="text" class="form-control" id="formGroupExampleInput2" name="ivertinimai" placeholder="iveskite filmo ivertinima">
    </div>

    <div class="form-group ">
        <label for="inputState">Zanras</label>
        <select id="inputState" class="form-control" name="zanras">
            <option selected>pasirinkite...</option>
            <?php
            foreach ($zanrai as $zanras): ?>
            <option  value="<?=$zanras['id']; ?>"><?= $zanras['pavadinimas']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>

