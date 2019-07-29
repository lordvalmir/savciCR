<?php 
$title = "Přehled tříd - učitel";
include('sculpture/head.php');
?>
<?php include 'db/db_connect.php';?>
<?php 
    $trida='';
    session_start();
    if(!isset($_SESSION['login']) or $_SESSION['ucitel'] != 1){
        header( "Location: ../" );
    }
    $sql = "SELECT id_ucitel FROM ucitel WHERE login = '".$_SESSION['login']."'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);

    $sql = "SELECT id_trida, nazev FROM trida WHERE fk_ucitel = ".$row['id_ucitel'];
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

    //use limit for showing reults
    $sql = "SELECT id_trida, nazev FROM trida WHERE fk_ucitel = ".$row['id_ucitel']." LIMIT ".$page_back*$per_page.','.$per_page;
    $result = mysqli_query($db,$sql);
    while ($row = mysqli_fetch_array($result)) {
        $trida.='<a class="column_2" href="prehled_tridy_ucitel.php?trida='.$row['id_trida'].'"><p>'.$row['nazev'].'</p></a>';       
    }

?>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h1> Třídy </h1>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

                <div class="deska_2">
                    <div class="posun"></div>
                    <div class="row">
                        <?php echo $trida;?>
                    </div>
                    <div class="posun">
                        <?php 
                            if($page>1) echo '<div class="back" onclick="window.location.href = '."'prehled_trid_ucitel.php?page=".$page_back."'".'"></div>';
                            if($page<$number_of_pages) echo '<div class="next" onclick="window.location.href = '."'prehled_trid_ucitel.php?page=".$page_next."'".'"></div>';
                        ?>
                    </div>
                </div>

                <div class="nav_menu">
                    <div class="zpet"><a href="menu_ucitel.php"><p>Zpět</p></a></div>
                    <div class="dalsi_2"><a href="registrace_tridy_ucitel.php"><p>Registrace</p></a></div>
                </div>
            </div>
        </div>
    </body>
</html>
