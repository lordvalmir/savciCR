<?php 
$title = "Test";
include('sculpture/head.php');
?>
<?php include 'db/db_connect.php';?>
<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header( "Location: ../" );
    }
    $id=$_GET['id'];
?>
<?php include('sculpture/header.php')?>

                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h1> Otázka č. <?php echo $id?></h1>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

<?php    
    $id_next=$id+1;

    $type=$_GET['type'];

    $len = $_GET['len'];

    if ($type == '1') { // 'poznej obrázek'
        $testType = 1;
    } elseif ($type == '2') { // 'přiřaď obrázek'
        $testType = 2;
    } elseif ($type == '3') { // 'poznej popis'
        $testType = 3;
    } elseif ($type == '12') { // 'poznej obrázek' + 'přiřaď obrázek'
        $testType = rand(1,2);
    } elseif ($type == '13') { // 'poznej obrázek' + 'poznej popis'
        $testType = rand(0,1) ? 1 : 3;
    } elseif ($type == '23') { // 'přiřaď obrázek' + 'poznej popis'
        $testType = rand(2,3);
    } elseif ($type == '123') { // 'poznej obrázek' + 'přiřaď obrázek' + 'poznej popis'
        $testType = rand(1,3);
    }

    // check if there is next test
    if ($id == $len) {
        $next = 'hodnoceni_zak.php';
    } else {
        $next = 'test_c_1.php?id='.$id_next.'&len='.$len.'&type='.$type.'';
    }

    // id for test
    $sql="SELECT MAX(id_test) AS max FROM test";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);

    $testId = $row['max'];

    // tested animal
    $testAnimalId = rand(1,9);

    $sql="SELECT nazev, popis, obrazek FROM zvire WHERE id_zvire = ".$testAnimalId."";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);

    $testAnimalName = $row['nazev'];
    $testAnimalDesc = $row['popis'];
    $testAnimalImg = $row['obrazek'];

    // id for non-tested animal
    $firstAnimalId = rand(1,9);
    while ($firstAnimalId == $testAnimalId) {
        $firstAnimalId = rand(1,9);
    }
    $secondAnimalId = rand(1,9);
    while ($secondAnimalId == $testAnimalId || $secondAnimalId == $firstAnimalId) {
        $secondAnimalId = rand(1,9);
    }
    $thirdAnimalId = rand(1,9);
    while ($thirdAnimalId == $testAnimalId || $thirdAnimalId == $firstAnimalId || $thirdAnimalId == $secondAnimalId) {
        $thirdAnimalId = rand(1,9);
    }
    
    // items of test
    $sql="SELECT nazev, obrazek FROM zvire WHERE id_zvire = ".$firstAnimalId."";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);

    $firstAnimalName = $row['nazev'];
    $firstAnimalImg = $row['obrazek'];
    
    $sql = "SELECT nazev, obrazek FROM zvire WHERE id_zvire = ".$secondAnimalId."";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);

    $secondAnimalName = $row['nazev'];
    $secondAnimalImg = $row['obrazek'];

    $sql = "SELECT nazev, obrazek FROM zvire WHERE id_zvire = ".$thirdAnimalId."";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);

    $thirdAnimalName = $row['nazev'];
    $thirdAnimalImg = $row['obrazek'];

    if ($testType == 1) { // 'poznej obrázek'

        // position of testAnimal in test question
        $position = rand(1,3);

        echo '<div class="obrazek_2"><img src='.$testAnimalImg.' height="100%" width="auto"></div>';
        echo '<div class="vedle">';

            echo '<form action="uloz_odpoved.php" method="POST">';
                echo '<input type="hidden" name="next" value="'.$next.'">';
                echo '<input type="hidden" name="testAnimalId" value="'.$testAnimalId.'">';
                echo '<input type="hidden" name="testId" value="'.$testId.'">';
                echo '<input type="hidden" name="testType" value="'.$testType.'">';
                if ($position == 1) {
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="correct" value="'.$testAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$firstAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$secondAnimalName.'"></input>';
                } elseif ($position == 2) {
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$firstAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="correct" value="'.$testAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$secondAnimalName.'"></input>';
                } elseif ($position == 3) {
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$firstAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$secondAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="correct" value="'.$testAnimalName.'"></input>';
                }
            echo '</form>';

        echo '</div>';

    } elseif ($testType == 3) {  // 'poznej popis'

        // position of testAnimal in test question
        $position = rand(1,3);

        echo '<div class="odsazeni_2"></div>';
        echo '<div class="informace_2">';

            echo '<p>'.$testAnimalDesc.'</p>';

        echo '</div>';
        echo '<div class="odsazeni_2"></div>';
        echo '<div class="vedle">';

            echo '<form action="uloz_odpoved.php" method="POST">';
                echo '<input type="hidden" name="next" value="'.$next.'">';
                echo '<input type="hidden" name="testAnimalId" value="'.$testAnimalId.'">';
                echo '<input type="hidden" name="testId" value="'.$testId.'">';
                echo '<input type="hidden" name="testType" value="'.$testType.'">';
                if ($position == 1) {
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="correct" value="'.$testAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$firstAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$secondAnimalName.'"></input>';
                } elseif ($position == 2) {
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$firstAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="correct" value="'.$testAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$secondAnimalName.'"></input>';
                } elseif ($position == 3) {
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$firstAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="wrong" value="'.$secondAnimalName.'"></input>';
                    echo '<input type="submit" class="tlacitka_vedle_sebe_2" name="correct" value="'.$testAnimalName.'"></input>';
                }
            echo '</form>';

        echo '</div>';

    } elseif ($testType == 2) { // 'přiřaď obrázek'

        // position of testAnimal in test question
        $position = rand(1,4);

        echo '<div class="nazev_zvirete"><h2>'.$testAnimalName.'</h2></div>';
        echo '<div class="row_obr">';

            echo '<form action="uloz_odpoved.php" method="POST">';
                echo '<input type="hidden" name="next" value="'.$next.'">';
                echo '<input type="hidden" name="testAnimalId" value="'.$testAnimalId.'">';
                echo '<input type="hidden" name="testId" value="'.$testId.'">';
                echo '<input type="hidden" name="testType" value="'.$testType.'">';
                if ($position == 1) {
                        echo '<button type="submit" class="obrazek_3" name="correct"><img src="'.$testAnimalImg.'" height="100%" width="auto"></button>';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$firstAnimalImg.'" height="100%" width="auto"></button>';
                    echo '</div>';
                    echo '<div class="row_obr">';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$secondAnimalImg.'" height="100%" width="auto"></button>';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$thirdAnimalImg.'" height="100%" width="auto"></button>';
                } elseif ($position == 2) {
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$firstAnimalImg.'" height="100%" width="auto"></button>';
                        echo '<button type="submit" class="obrazek_3" name="correct"><img src="'.$testAnimalImg.'" height="100%" width="auto"></button>';
                    echo '</div>';
                    echo '<div class="row_obr">';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$secondAnimalImg.'" height="100%" width="auto"></button>';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$thirdAnimalImg.'" height="100%" width="auto"></button>';
                } elseif ($position == 3) {
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$firstAnimalImg.'" height="100%" width="auto"></button>';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$secondAnimalImg.'" height="100%" width="auto"></button>';
                    echo '</div>';
                    echo '<div class="row_obr">';
                        echo '<button type="submit" class="obrazek_3" name="correct"><img src="'.$testAnimalImg.'" height="100%" width="auto"></button>';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$thirdAnimalImg.'" height="100%" width="auto"></button>';
                } elseif ($position == 4) {
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$firstAnimalImg.'" height="100%" width="auto"></button>';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$secondAnimalImg.'" height="100%" width="auto"></button>';
                    echo '</div>';
                    echo '<div class="row_obr">';
                        echo '<button type="submit" class="obrazek_3" name="wrong"><img src="'.$thirdAnimalImg.'" height="100%" width="auto"></button>';
                        echo '<button type="submit" class="obrazek_3" name="correct"><img src="'.$testAnimalImg.'" height="100%" width="auto"></button>';
                }
            echo '</form>';
        
        echo '</div>';
    }
?>
            </div>
        </div>
    </body>
</html>
