<?php 
$title = "Registrace žáku - učitel";
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
        //Load inputs
        if(isset($_POST['jmeno'])&&$_POST['prijmeni']){
            $jmeno = mysqli_real_escape_string($db,$_POST['jmeno']);
            $prijmeni = mysqli_real_escape_string($db,$_POST['prijmeni']);
            $trida = mysqli_real_escape_string($db,$_GET['trida']);
            //Load inputs
            /**************************************************************/
            //Create login
            $num = 1;
            $prijmeni_pom = strtolower(preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $prijmeni));
            $login = 'x'.substr($prijmeni_pom, 0, 6).$num;
            //echo "<script> alert('".$login."'); </script>";
            $sql = 'SELECT zak.id_zak FROM zak WHERE login = "'.$login.'"';
            $result = mysqli_query($db,$sql);
            while($row = mysqli_fetch_array($result)){
                $num++;
                //echo "<script> alert('".$num."'); </script>";
                $login = 'x'.substr($prijmeni_pom, 0, 6).$num;
                $sql = 'SELECT zak.id_zak FROM zak WHERE login = "'.$login.'"';
                $result = mysqli_query($db,$sql);
            }
            $login = strtolower('x'.substr($prijmeni_pom, 0, 6).$num);
            //Create login
            /**************************************************************/
            //Create password
            $heslo = rand(1, 9);
            for ($x = 0; $x <= 8; $x++){
                $heslo.=chr(rand(97, 122));
            }
            $heslo1=md5($heslo);
           // echo "<script> alert('".$heslo."'); </script>";
            $sql = "INSERT INTO zak (jmeno, prijmeni, fk_trida, login, heslo) VALUES ('".$jmeno."', '".$prijmeni."', '".$trida."', '".$login."', '".$heslo1."')";
            mysqli_query($db,$sql);
            header( "Location: registrace_zaka.php?login=".$login."&heslo=".$heslo."&trida=".$trida);
        }else{
            echo "<script> alert('Zadejte všechny pole'); </script>";
        }
   }
?>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h3> Registrace žáků </h3>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

                <div class="deska_2">
                    <div class="prihlasovaci_menu">
                        <form  method="post">

                            <div class="kolonky_2">
                                <div class="kolonka_2">
                                    <label>Jméno žáka :</label>
                                    <input type="text" name="jmeno" placeholder="Jméno" required>
                                </div>
                                <div class="kolonka_2">
                                    <label>Příjmení žáka :</label>
                                    <input type="text" name="prijmeni" placeholder="Příjmení" required>
                                </div>
                            </div>

                            <div class="registrace">
                                <button  type="submit"><p>Vložit</p></button>
                            </div>

                            <div class="ex3">
                               <?php if(isset($_GET['login'])){
                                    echo 'Login: '.$_GET['login'].' Heslo: '.$_GET['heslo'];
                               }  ?>
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
