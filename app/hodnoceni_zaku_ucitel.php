<?php
$title = "Hodnocení žáků - učitel";
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
                        <h1> Hodnocení žáků </h1>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

                <div class="deska_2">
                    <div class="next"></div>
                </div>
                <div class="nav_menu">
                    <div class="zpet"><a href="menu_ucitel.php"><p>Zpět</p></a></div>
                </div>
            </div>
        </div>
    </body>
</html>
