<?php 
$title = "Testové nastavení - učitel";
include('sculpture/head.php');
?>
<?php include 'db/db_connect.php';?>
<?php
    session_start();
    if(!isset($_SESSION['login']) or $_SESSION['ucitel'] != 1){
        header( "Location: ../" );
    }
?>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h1> TEST </h1>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

                <div class="deska_2">
                  <form method="POST">
                      <div class="column_3"><input type="checkbox" id="checkbox_1" checked="checked"><label for="checkbox_1">Chybné</label></div>
                      <div class="column_3"><input type="radio"    id="radio_1"    checked="checked" name="len" value="1"><label for="radio_1">Krátký</label></div>
                      <div class="column_3"><input type="checkbox" id="checkbox_2" checked="checked" name="type_1"><label for="checkbox_2">Poznej obrázek</label></div>

                      <div class="column_3"><input type="checkbox" id="checkbox_3" checked="checked" ><label for="checkbox_3">Zodpovězené</label></div>
                      <div class="column_3"><input type="radio" id="radio_2" name="len" value="2"><label for="radio_2">Střední</label></div>
                      <div class="column_3"><input type="checkbox" id="checkbox_4" checked="checked" name="type_2"><label for="checkbox_4">Přiřaď obrázek</label></div>

                      <div class="column_3"><input type="checkbox" id="checkbox_5" checked="checked" ><label for="checkbox_5">Nezodpovězené</label></div>
                      <div class="column_3"><input type="radio" id="radio_3" name="len" value="3"><label for="radio_3">Dlouhý</label></div>
                      <div class="column_3"><input type="checkbox" id="checkbox_6" checked="checked" name="type_3"><label for="checkbox_6">Poznej popis</label></div>
                      <div class="midle">
                        <div class="midle_2">
                          <input type="submit" value="Potvrdit" align="center">
                        </div>
                      </div>

                  </form>
                </div>

                <div class="nav_menu">
                    <div class="zpet"><a href="menu_ucitel.php"><p>Zpět</p></a></div>
                    <?php
                      if (!empty($_POST)) {

                        // type of the test
                        if (isset($_POST['type_1']) && isset($_POST['type_2']) && isset($_POST['type_3'])) {
                          // all of options
                          $type = 123;

                        } elseif (isset($_POST['type_1']) && !isset($_POST['type_2']) && !isset($_POST['type_3'])) {
                          // only type_1
                          $type = 1;

                        } elseif (!isset($_POST['type_1']) && isset($_POST['type_2']) && !isset($_POST['type_3'])) {
                          // only type_2
                          $type = 2;

                        } elseif (!isset($_POST['type_1']) && !isset($_POST['type_2']) && isset($_POST['type_3'])) {
                          // only type_3
                          $type = 3;

                        } elseif (isset($_POST['type_1']) && isset($_POST['type_2']) && !isset($_POST['type_3'])) {
                          // type_1 + type_2
                          $type = 12;
                          
                        } elseif (isset($_POST['type_1']) && !isset($_POST['type_2']) && isset($_POST['type_3'])) {
                          // type_1 + type_3
                          $type = 13;

                        } elseif (!isset($_POST['type_1']) && isset($_POST['type_2']) && isset($_POST['type_3'])) {
                          // type_2 + type_3
                          $type = 23;

                        } elseif (!isset($_POST['type_1']) && !isset($_POST['type_2']) && !isset($_POST['type_3'])) {
                          echo "<script> alert('Není zvolen typ testu'); </script>";
                          header('Location: test_ucitel.php');
                        }

                        // length of the test
                        if (isset($_POST['len'])) {
                          if ($_POST['len'] == 1) {
                            $len = 5;
                          } elseif ($_POST['len'] == 2) {
                            $len = 10;
                          } elseif ($_POST['len'] == 3) {
                            $len = 15;
                          }
                        }

                        echo '<div class="dalsi_2"><a href="test_c_1.php?id=1&len='.$len.'&type='.$type.'"><p>Spustit</p></a></div>';
                      }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

