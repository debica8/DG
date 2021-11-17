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
        if(isset($_GET['id']) && !isset($_GET['z'])){
            if(isset($_GET['sid'])){
                $sql = "DELETE FROM slike WHERE id=".$_GET['sid'];
                $c->query($sql);
            }
            
            $sql = "SELECT * from vijesti WHERE id=".$_GET['id'];
            $vij = $c->query($sql);
            $vijest = $vij->fetch_assoc();
            ?>
            <div class="forma">
            <form method="POST" action="uredivanje.php?x=9" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $vijest['id'] ?>">
                Naslov:<br>
                <input type="text" name="nnaslov" value="<?php echo $vijest['naslov'] ?>"><br>
                Tekst:<br>
                <textarea id="tekst" name="ntekst" rows="10" cols="100"><?php echo $vijest['tekst'] ?></textarea><br>
                Datum:<br>
                <input type="date" name="ndatum" value="<?php echo $vijest['datum'] ?>"><br>
                Dodaj još jednu sliku u članak <input name="nslika" type="file" /><br>
                <input type="submit" name="submit" value="Spremi promjene">
            </form>
            </div>
            <?php
            $sql = "SELECT * from slike WHERE vijest=".$_GET['id'];
            $sli = $c->query($sql);
            
            while ($slika = mysqli_fetch_array($sli)){
                echo '<div class="galerija" style="padding: 30px;">';
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $slika['slika'] ).'"/>';
                echo '<a href="uredivanje.php?x=9&a=u&id='.$_GET['id'].'&sid='.$slika['id'].'">Obriši sliku</a>';
                echo '</div>';
            }
            echo '<br>';
        }
        else if (isset ($_GET['d'])){
                ?>
                <div class="forma">
                <form method="POST" action="uredivanje.php?x=9" enctype="multipart/form-data">
                    Naslov:<br>
                    <input type="text" name="naslov"><br>
                    Tekst:<br>
                    <textarea id="tekst" name="tekst" rows="10" cols="100">Tu piši...</textarea><br><br>
                    Učitaj sliku za članak <input name="slika" type="file" /><br>
                    <input type="submit" name="submit" value="Objavi vijest">
                </form>
                </div>
                <?php
            }
        else{
            if(isset($_POST['naslov'])){
                $tekst = addslashes($_POST['tekst']);
                $sql = "INSERT INTO vijesti (naslov, tekst, datum, odobren) VALUES ('".$_POST['naslov']."', '".$tekst."', '".date("Y-m-d")."', 1)";
                $c->query($sql);
                
                $sql = "SELECT id FROM vijesti WHERE id=(SELECT max(id) FROM vijesti)";
                $r = $c->query($sql);
                $i = $r->fetch_assoc();
                $id = $i['id'];
                
                if (count($_FILES) > 0){
                    if (is_uploaded_file($_FILES['slika']['tmp_name'])) {
                        $slikaPodaci = addslashes(file_get_contents($_FILES['slika']['tmp_name']));

                        $sql = "INSERT INTO slike(slika, vijest) VALUES('".$slikaPodaci."', ".$id.")";
                        $c->query($sql);
                    }
                }
            }
            
            if(isset($_POST['id'])){
                $ntekst = addslashes($_POST['ntekst']);
                $sql = "UPDATE vijesti SET naslov='".$_POST['nnaslov']."', tekst='".$ntekst."', datum='".$_POST['ndatum']."' WHERE id=".$_POST['id'];
                $c->query($sql);
                if (count($_FILES) > 0){
                    if (is_uploaded_file($_FILES['nslika']['tmp_name'])) {
                        $slikaPodaci = addslashes(file_get_contents($_FILES['nslika']['tmp_name']));

                        $sql = "INSERT INTO slike(slika, vijest) VALUES('".$slikaPodaci."', ".$_POST['id'].")";
                        $c->query($sql);
                    }
                }
            }
            
            if(isset($_GET['z'])){
                if($_GET['z'] == 'd'){
                    $sql = "UPDATE vijesti SET arhiva=1 WHERE id=".$_GET['id'];
                    $c->query($sql);
                }
                else if($_GET['z'] == 'n'){
                    $sql = "UPDATE vijesti SET arhiva=0 WHERE id=".$_GET['id'];
                    $c->query($sql);
                }
                
            }
            
            echo '<div class="administracija"><h3>Vijesti</h3>';
            echo '<h4>Nearhivirane vijesti</h4>';
            $sql = "SELECT * from vijesti";
            $r = $c->query($sql);
            while ($row = $r->fetch_assoc()){
                if($row['arhiva'] == 0){
                echo $row['naslov']." - - <a href='uredivanje.php?x=9&id=".$row['id']."'>Uredi</a> - - <a href='uredivanje.php?x=9&z=d&id=".$row['id']."'>Arhiviraj</a><br>";
                }
            }
            echo '<h4>Arhivirane vijesti</h4>';
            $r = $c->query($sql);
            while ($row = $r->fetch_assoc()){
                if($row['arhiva'] == 1){
                echo $row['naslov']." - - <a href='uredivanje.php?x=9&id=".$row['id']."'>Uredi</a> - - <a href='uredivanje.php?x=9&z=n&id=".$row['id']."'>Vrati</a><br>";
                }
            }
            echo "<br><button type='button' style='padding: 5px;'><a href='uredivanje.php?x=9&d=d'>Dodaj vijest</a></button>";
            echo '</div>';
        }
        ?>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
<?php $c->close(); ?>