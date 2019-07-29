<?php 
$title ="Hodnocení - žák";
include('sculpture/head.php');
?>
<?php include 'db/db_connect.php';?>
<?php 
    session_start();
    if(!isset($_SESSION['login'])){
        header( "Location: ../" );
    }
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h1> <?php echo $_SESSION['login']; ?> </h1>
                    </div>
                </div>

                <div class="odsazeni_2"></div>

                <div class="deska_2">

                    <?php
                    $sql = 'SELECT id_zak FROM zak WHERE login = "'.$_SESSION['login'].'"';
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_array($result);
                    $id_zak = $row['id_zak'];

                    $sql = 'SELECT MAX(id_test) AS max FROM test WHERE fk_zak = "'.$id_zak.'"';
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_array($result);
                    $testId = $row['max'];

                    $sql = 'SELECT COUNT(*) AS correct FROM testovane_zvirata WHERE fk_test = "'.$testId.'" AND spravne = "1"';
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_array($result);
                    $correct = $row['correct'];
                    
                    $sql = 'SELECT COUNT(*) AS wrong FROM testovane_zvirata WHERE fk_test = "'.$testId.'" AND spravne = "0"';
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_array($result);
                    $wrong = $row['wrong'];
                    ?>

                    <div id="piechart"></div>
                    <script type="text/javascript">
                        // Load google charts
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        // Draw the chart and set the chart values
                        function drawChart() {
                            var x = <?php echo $correct?>;
                            var y = <?php echo $wrong?>;
                            var data = google.visualization.arrayToDataTable([
                            ['Task', 'Answers'],
                            ['Správně zodpovězené', x],
                            ['Špatně zodpovězené', y],
                        ]);
                            // Optional; add a title and set the width and height of the chart
                            var options = {
                                fontSize:14,
                                legendTextStyle: { color: '#FFF' },
                                width:550,
                                height:400,
                                backgroundColor: 'transparent'
                            };

                            // Display the chart inside the <div> element with id="piechart"
                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                            chart.draw(data, options);
                        }
                    </script>
                </div>
                <div class="nav_menu">
                    <div class="zpet"><a href="menu_zak.php"><p>Zpět</p></a></div>
                </div>
            </div>
        </div>
    </body>
</html>
