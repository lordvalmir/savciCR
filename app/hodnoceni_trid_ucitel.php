<?php 
$title = "Hodnocení tříd - učitel";
include('sculpture/head.php');?>
<?php 
    session_start();
    if(!isset($_SESSION['login']) or $_SESSION['ucitel'] != 1){
        header( "Location: ../" );
    }
?>
    <body>
        <div class="background">
            <div class="main">
                <?php if(isset($_SESSION['login'])) echo'
                <div class="logout">
                    <div class="logoutpom">
                         <a href=logout.php>Odhlásit se</a>
                    </div>
                </div>
                '?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h1> Hodnocení </h1>
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
