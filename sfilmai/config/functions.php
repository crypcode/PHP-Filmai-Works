<?php
//Visi filmai
function connect()
{
    global $host, $db, $username, $password, $options;
    $dns = "mysql:host=$host;dbname=$db";
    try {
        $conn = new PDO($dns, $username, $password, $options);

    } catch (PDOException $e) {
        echo $e->getMessage();

    }
    return $conn;
}
//visi filmai
function allmovies(){
    $conn = connect();
    try {
        if ($conn) {
            $stmt = $conn->query("SELECT filmaitable.pavadinimas, filmaitable.aprasymas, filmaitable.rezisierius, filmaitable.metai, filmaitable.genre_id, zanrai.pavadinimas AS zanroPavadinimas
                                      FROM filmaitable
                                       INNER JOIN zanrai ON filmaitable.genre_id=zanrai.id");
            $filmai = $stmt->fetchAll();
            return $filmai;
            $conn = null;
        }
    }catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    return $filmai;
}
//pagal zanra
function bygenre(){
    $conn = connect();
    try {
        if($conn){
            $stmt = $conn->query("SELECT * FROM zanrai");
            $filmuZanrai = $stmt->fetchAll();
            }
            $conn = null;
        } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    return $filmuZanrai;
}
//by id
function bygenreid()
{
    $conn = connect();
    try {
        if ($conn) {
            if (isset($_GET['id'])) {
                $zid = $_GET['id'];
                $stmt = $conn->query("SELECT filmaitable.pavadinimas, filmaitable.aprasymas, 
                              filmaitable.metai, filmaitable.rezisierius, zanrai.pavadinimas AS zanroPavadinimas
                              FROM filmaitable 
                              INNER JOIN zanrai ON filmaitable.genre_id=zanrai.id
                              WHERE $zid=zanrai.id");
                $pagalzanra = $stmt->fetchAll();
                return $pagalzanra;
            }
            $conn = null;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
//searchas
function searchas(){
    $rezultatai=[];
    $conn = connect();
    try {
        if ($conn) {
            $stmt = $conn->query("SELECT pavadinimas FROM filmaitable ");
            $sarasas = $stmt->fetchAll();
                return $sarasas;
            }
            $conn = null;
        } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
function searchas2(){
    $conn = connect();
    try {
        if ($conn) {
            if (isset($_POST['search'])){
           $uzklausa = $conn->prepare('SELECT zanrai.pavadinimas AS kategorija, filmaitable.pavadinimas, 
                filmaitable.rezisierius, filmaitable.metai, filmaitable.imdb, filmaitable.aprasymas FROM filmaitable
                INNER JOIN zanrai
                ON filmaitable.genre_id = zanrai.id
                WHERE filmaitable.pavadinimas LIKE ?');
            $input = $_POST['pavadinimas'];
            $uzklausa->bindValue(1,"%$input%", PDO::PARAM_STR);
            $uzklausa->execute();
            $rezultatai = $uzklausa->fetchAll();
            return $rezultatai;
        }
        }
        $conn = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
?>