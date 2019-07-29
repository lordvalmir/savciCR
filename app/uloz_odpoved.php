<?php include 'db/db_connect.php';?>
<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header( "Location: ../" );
    }
?>
<?php
if (!empty($_POST)) {

    if (isset($_POST['correct'])) {

        $sql = "INSERT INTO testovane_zvirata (fk_zvire, fk_test, spravne, fk_typ_testu) VALUES ('".$_POST['testAnimalId']."', '".$_POST['testId']."', '1', '".$_POST['testType']."')";
        mysqli_query($db,$sql);

    } elseif (isset($_POST['wrong'])) {

        $sql = "INSERT INTO testovane_zvirata (fk_zvire, fk_test, spravne, fk_typ_testu) VALUES ('".$_POST['testAnimalId']."', '".$_POST['testId']."', '0', '".$_POST['testType']."')";
        mysqli_query($db,$sql);
        
    }
    header('Location: '.$_POST['next']);
}

?>