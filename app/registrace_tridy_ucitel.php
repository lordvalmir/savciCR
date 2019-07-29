<?php 
$title = "Registrace třídy - učitel";
include('sculpture/head.php');
?>

<?php include 'db/db_connect.php';?>
<?php
    session_start();
    if(!isset($_SESSION['login']) or $_SESSION['ucitel'] != 1){
        header( "Location: ../" );
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        /**************************************************************/
        $sql = "SELECT id_ucitel FROM ucitel WHERE login = '".$_SESSION['login']."'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result);
        //Load inputs
        $nazev = mysqli_real_escape_string($db,$_POST['nazev']);
        $sql = "INSERT INTO trida (nazev, fk_ucitel) VALUES ('".$nazev."', '".$row['id_ucitel']."')";
        mysqli_query($db,$sql);
        header( "Location: registrace_tridy_ucitel.php" );
        //Load inputs
        /**************************************************************/
   }
?>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h3> Registrace tříd </h3>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

                <div class="deska_2">
                    <div class="prihlasovaci_menu">
                        <form  method="post">
                            <div class="kolonky_3">
                                <div class="kolonka_3">
                                    <label>Název třídy:</label>
                                    <input type="text" name="nazev" placeholder="EPA4">
                                </div>
                            </div>

                            <div class="prihlaseni">
                                <button  type="submit"><p>Registrace</p></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="nav_menu">
                    <div class="zpet"><a href="prehled_trid_ucitel.php"><p>Zpět</p></a></div>
                </div>
            </div>
        </div>
    </body>
</html>
