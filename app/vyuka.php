<?php 
$title = "Výuka - žák";
include('sculpture/head.php');
?>
<?php include 'db/db_connect.php';?>
<?php
    session_start();
    if(!isset($_SESSION['login']) or !isset($_GET['id'])){
        header( "Location: ../" );
    }
    $id=$_GET['id'];
    $id_next=$id+1;
    $id_prev=$id-1;
    $sql="SELECT id_zvire  from zvire where id_zvire ='".$id_next."'";
    $result = mysqli_query($db,$sql);
    $row_try = mysqli_fetch_array($result);
    $sql="SELECT nazev, popis, obrazek from zvire where id_zvire ='".$id."'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
    $sql="SELECT count(*) as count FROM zvire";
    $result = mysqli_query($db,$sql);
    $row_count = mysqli_fetch_array($result);
?>
<?php include('sculpture/header.php')?>
                <div class="pozadni_nadpis">
                    <div class="nadpis">
                        <h1> <?php echo $row['nazev']?></h1>
                    </div>
                </div>

                <div class="obrazek"><img src=<?php echo$row['obrazek']?> alt=<?php echo $row['nazev'];?> height="100%" width="auto"></div>

                <div class="informace">
                    <div class="page_count">
                        <div class="page_num">
                            <form action="javascript:void(0);">
                                <input type="text" id="zvire_id" value=<?php echo $id ?>>
                                <?php echo '<input type="submit" style="display:none;" id="btnHidden" name="'.$row_count['count'].'"">'?>
                            </form>
                        </div>
                        <div class="page_num">/<?php echo $row_count['count']?></div>
                    </div>
                    <p><?php echo $row['popis']?></p>
                </div>
                <div class="nav_menu">
                    <?php if ($id>1) echo '<div class="zpet"><a href="vyuka.php?id='.$id_prev.'"><p>Předchozí</p></a></div>' ?>
                    <?php if ($row_try) echo '<div class="dalsi"><a href="vyuka.php?id='.$id_next.'"><p>Další</p></a></div>'?>
                    <div class="zpet_menu">
                        <a href=<?php if($_SESSION['ucitel']==0) echo "menu_zak.php";else echo "menu_ucitel.php";?>>
                            <p>Menu</p></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script type="text/javascript">
    document.getElementById('zvire_id').addEventListener('keyup',function(e){
        var count = parseInt(document.getElementById('btnHidden').name)+1;
        var which_chosen = document.getElementById('zvire_id').value; 
        if(!isNaN(which_chosen) && which_chosen < count && which_chosen > 0){
            if (e.which == 13) window.location.href = 'vyuka.php?id='+ document.getElementById('zvire_id').value;   
        }
    });
</script>
</html>
