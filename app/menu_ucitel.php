<?php
$title = "Savci ČR - učitel";
include('sculpture/head.php');
?>
<?php 
    session_start();
    if(!isset($_SESSION['login']) or $_SESSION['ucitel'] != 1){
        header( "Location: ../" );
    }
?>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h1> Savci ČR </h1>
                    </div>
                </div>

                <div class="odsazeni"></div>

                <div class="vedle">
                    <div class="tlacitka_vedle_sebe"><h2><a href="vyuka.php?id=1">VÝUKA</a></h2></div> 
                    <div class="tlacitka_vedle_sebe"><h2><a href="test_ucitel.php">TEST</a></h2></div>
                </div>

                <div class="tlacitko_pod"><h2><a href="prehled_trid_ucitel.php">TŘÍDY</a></h2></div>

            </div>
        </div>
    </body>
</html>
