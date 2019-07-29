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
    $sql = 'SELECT jmeno, prijmeni, login FROM zak WHERE id_zak ='.$_GET['id'];
    $result = mysqli_query($db,$sql);
    $zak_info = mysqli_fetch_array($result);

    /*****paging*****/
    $sql = 'SELECT COUNT(*) AS pageNum FROM test WHERE fk_zak = "'.$_GET['id'].'"';
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
    $number_of_pages = $row['pageNum'];

    //which page is on
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $page_back = intval($page)-1;
    $page_next = intval($page)+1;

    //use limit for showing reults
    $sql = "SELECT * FROM test WHERE fk_zak = ".$_GET['id']." LIMIT 1 OFFSET ".$page_back;
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
    $testId = $row['id_test'];

    $sql = 'SELECT COUNT(*) AS correct FROM testovane_zvirata WHERE fk_test = "'.$testId.'" AND spravne = "1"';
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
    $correct = $row['correct'];

    $sql = 'SELECT COUNT(*) AS wrong FROM testovane_zvirata WHERE fk_test = "'.$testId.'" AND spravne = "0"';
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
    $wrong = $row['wrong'];


?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h3><?php echo $zak_info['jmeno'].' '.$zak_info['prijmeni'] ?></h3>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

                <div class="deska_2">
                    <div class="new_row">Test č. <?php echo $page;?></div>
                    <div id="piechart"></div>
                    <script type="text/javascript">
                        // Load google charts
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        // Draw the chart and set the chart values
                        function drawChart() {
                            var x = <?php echo $correct;?>;
                            var y = <?php echo $wrong;?>;
                            var data = google.visualization.arrayToDataTable([
                            ['Task', 'Answers'],
                            ['Správně zodpovězené', x],
                            ['Špatně zodpovězené', y],
                        ]);
                            // Optional; add a title and set the width and height of the chart
                            var options = {
                                fontSize:14,
                                legendTextStyle: { color: '#FFF' },
                                width:600,
                                height:280,
                                backgroundColor: 'transparent'
                            };

                            // Display the chart inside the <div> element with id="piechart"
                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div class="posun_2">
                        <?php
                            if($page>1) echo '<div class="back" onclick="window.location.href = '."'zak_prosel.php?id=".$_GET['id']."&trida=".$_GET['trida']."&page=".$page_back."'".'"></div>';
                            if($page<$number_of_pages) echo '<div class="next" onclick="window.location.href = '."'zak_prosel.php?id=".$_GET['id']."&trida=".$_GET['trida']."&page=".$page_next."'".'"></div>';
                        ?>
                    </div>
                </div>
                <div class="nav_menu">
                    <div class="zpet"><a href=<?php echo '"prehled_tridy_ucitel.php?trida='.$_GET['trida'].'"'?>><p>Zpět</p></a></div>
                </div>
            </div>
        </div>
    </body>
</html>
