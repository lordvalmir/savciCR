<?php
$title = "Přehled žáků";
include('sculpture/head.php');
?>
<?php include 'db/db_connect.php';?>
<?php 
    session_start();
    if(!isset($_SESSION['login']) or $_SESSION['ucitel'] != 1){
        header( "Location: ../" );
    }
    $sql = "SELECT nazev FROM trida WHERE id_trida = '".$_GET['trida']."'";
    $result = mysqli_query($db,$sql);
    $trida = mysqli_fetch_array($result);

    $sql = "SELECT zak.id_zak AS id from zak LEFT JOIN trida on trida.id_trida = zak.fk_trida WHERE trida.id_trida = ".$_GET['trida'];
    $result = mysqli_query($db,$sql);
    $count = mysqli_num_rows($result);

    /*****paging*****/
    //number of teas per page
    $per_page = 9;
    //number of pages
    $number_of_pages = ceil($count/$per_page);
    //which page is on
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $page_back = intval($page)-1;
    $page_next = intval($page)+1;
    $sql = "SELECT zak.id_zak AS id, zak.jmeno AS jmeno, zak.prijmeni as prijmeni, zak.login as login from zak LEFT JOIN trida on trida.id_trida = zak.fk_trida WHERE trida.id_trida = ".$_GET['trida']." LIMIT ".$page_back*$per_page.','.$per_page;
    $result = mysqli_query($db,$sql);
    $zak = '';
    while ($row = mysqli_fetch_array($result)) {
        $zak.='<a class="column" href="zak_prosel.php?id='.$row['id'].'&trida='.$_GET['trida'].'"><p>'.$row['jmeno'].' '.$row['prijmeni'].' </p><p> '.$row['login'].'</p></a>';      
    }

?>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h3> <?php if(isset($_GET['trida'])) echo $trida['nazev']; else echo'Třída nenalezena';?> </h3>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

                <div class="deska_2">
                    <div class="posun"></div>
                    <div class="row">
                        <?php echo $zak;?>
                    </div>
                    <div class="posun">
                        <?php 
                            if($page>1) echo '<div class="back" onclick="window.location.href = '."'prehled_tridy_ucitel.php?trida=".$_GET['trida']."&page=".$page_back."'".'"></div>';
                            if($page<$number_of_pages) echo '<div class="next" onclick="window.location.href = '."'prehled_tridy_ucitel.php?trida=".$_GET['trida']."&page=".$page_next."'".'"></div>';
                        ?>
                    </div>
                </div>

                <div class="nav_menu">
                    <div class="zpet"><a href="prehled_trid_ucitel.php"><p>Zpět</p></a></div>
                    <div class="dalsi_2"><a href=<?php echo '"registrace_zaka.php?trida='.$_GET['trida'].'"'?>><p>Registrace</p></a></div>
                </div>
            </div>
        </div>
    </body>
</html>
