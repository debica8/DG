<?php include 'kod.php'; ?>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prva zadaća</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    <body>
        <?php
        include_once 'navigacija.php';
        if(isset($_GET['id'])){
            $sql = "SELECT * from vijesti WHERE id=".$_GET['id'];
            $vij = $c->query($sql);
            $vijest = $vij->fetch_assoc();
            
            $sql = "SELECT * from slike WHERE vijest=".$_GET['id'];
            $sli = $c->query($sql);
        ?>
        <div>
            <?php
            while ($slika = mysqli_fetch_array($sli)){
                echo '<div class="galerija">';
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $slika['slika'] ).'"/>';
                echo '</div>';
            }
            ?>
        </div>
        <hr>
        <div class="sadrzaj">
            <h2><?php echo $vijest['naslov'] ?></h2>
            <small>Datum objave: <?php echo $vijest['datum'] ?></small>
            <p><?php echo $vijest['tekst'] ?></p>
            <a href="navigacija.php?x=2"><--Povratak</a>
        </div>
        <?php
        }
        else{
        ?>
        <div class="sadrzaj">
            <h1>Vijesti</h1>
            <?php
            $sql = "SELECT * from vijesti WHERE arhiva = 0 AND odobren = 1";
            $r = $c->query($sql);
            
            while ($row = $r->fetch_assoc()){
                    $sql = "SELECT * from slike WHERE vijest=".$row['id'];
                    $sli = $c->query($sql);
                    $slika = mysqli_fetch_array($sli);
                    
                    echo '<div><img src="data:image/jpeg;base64,'.base64_encode( $slika['slika'] ).'" style="height: 100px; float: left; padding-right: 20px;"/>';
                    echo '<h2>'.$row['naslov'].'</h2>';
                    $isjecak = substr($row['tekst'], 0, 300);
                    echo  $isjecak.'<a href="vijesti.php?x=2&id='.$row['id'].'">...Više</a><br><br></div>';
            }
            echo '</div>';
        }
        ?>
        </div>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
<?php $c->close(); ?>