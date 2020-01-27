<?php

$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){
        $stmt = $conn->query("SELECT * from zanrai");
        $zanras = $stmt->fetchall();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} ?>
<?php if (isset($_POST['submit'])){
    try {
        if ($conn){
            $sql = "INSERT INTO zanrai (pavadinimas)
            VALUES (:pavadinimas)";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(':pavadinimas', $_POST['pavadinimas'], PDO::PARAM_STR);
            $stmt->execute();
            header('Location:/sfilmai/?page=zanru-valdymas');


        }
    } catch (PDOException $e){
        echo $e->getMessage();
    }
}

?>
<br>
<ul class="list-group list-group-horizontal">
<?php foreach ($zanras as $zanrai):?>
<li class="list-group-item list-group-item-warning"><?=$zanrai['pavadinimas'];?>&nbsp;<a href="?page=trinti-zanra&id=<?=$zanrai['id'];?>" class="badge badge-danger">Istrinti</a></li>
<?php endforeach;?>
</ul>
<form method="post">
    <div class="form-group">
        <label for="formGroupExampleInput">Filmo pavadinimas</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="pavadinimas"  placeholder="Iveskite zanro pavadinima">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Prideti zanra</button>
</form>