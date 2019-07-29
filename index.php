<?php 
$title = "Přihlašování";   
$index=1; 
include('app/sculpture/head.php');
?>
<?php include('app/db/db_connect.php');?>
<?php
    session_start();
    if(isset($_SESSION['login']) and $_SESSION['ucitel'] == 1){
        header( "Location: app/menu_ucitel.php" );
    }else if(isset($_SESSION['login'])){
        header( "Location: app/menu_zak.php" );
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        /**************************************************************/
        //Load inputs
        $login = mysqli_real_escape_string($db,$_POST['login']);
        $heslo = md5(mysqli_real_escape_string($db,$_POST['heslo']));
        //Load inputs
        /**************************************************************/
        //look for in ucitel
        $sql = "SELECT id_ucitel FROM ucitel WHERE login = '$login' and heslo = '$heslo'";
        $res_odb = mysqli_query($db,$sql);
        $count = mysqli_num_rows($res_odb);
        echo "<script> alert('".$login."'); </script>";
        //look for in zak
        $sql = "SELECT id_zak FROM zak WHERE login = '$login' and heslo = '$heslo'";
        $res_adm = mysqli_query($db,$sql);
        $count1 = mysqli_num_rows($res_adm);

        if($count == 1) {
            $_SESSION['login'] = $login;
            $_SESSION['ucitel'] = 1;
            header("location: app/menu_ucitel.php");
        }else if ($count1 == 1){
            $_SESSION['login'] = $login;
            $_SESSION['ucitel'] = 0;
            header("location: app/menu_zak.php");
        }else{
            echo "<script> alert('Email nebo heslo byly zadány špatně'); </script>";
        }
   }
?>
    <body>
        <div class="background">
            <div class="main">

                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h1> Vítejte </h1>
                    </div>
                </div>

                <div class="odsazeni"></div>

                <div class="deska">
                    <div class="prihlasovaci_menu">
                        <form action="" method="POST" accept-charset="utf-8">
                            <div class="kolonky">
                                <div class="kolonka">
                                    <label>Login :</label>
                                    <input type="text" name="login" placeholder="login">
                                </div>
                                <div class="kolonka">
                                    <label>Heslo :</label>
                                    <input type="password" name="heslo" placeholder="heslo">
                                </div>
                            </div>

                            <div class="prihlaseni">
                                <button  type="submit"><p>Přihlásit</p></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
