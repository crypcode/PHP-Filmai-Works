<?php
$dns= "mysql:host=$host;dbname=$db";
try{
    $conn = new PDO($dns, $username, $password, $options);
    if($conn){
        if (isset($_GET['submit'])) {
            $kuri = $_GET['hidden'];
            $stmt = $conn->query("DELETE  FROM filmaitable
                                        WHERE id = '.$kuri.'
                            ");
            header('Location:/sfilmai/?page=filmu-valdymas');
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} ?>
<div>
    <p>Ar tikrai norite istrinti si filma?</p>
    <br>
    <form>
       <?php var_dump($_GET['id'])?>
      <input type="hidden" value="<?=$_GET['id']?>">
     <button class="btn btn-danger" type="submit" name="submit">Patvirtinti</button></form>
</div>
