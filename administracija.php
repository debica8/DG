<?php include 'kod.php'; ?>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tetobitna</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    <body>
        <?php
        include_once 'navigacija.php';
        if(!$_SESSION['uloga'] == 'Admin'){
            header("Location: index.php");
        }
        if(isset($_GET['email']) && !isset($_GET['ok'])){
            $sql = "SELECT * from korisnik WHERE email='".$_GET['email']."'";
            $kor = $c->query($sql);
            $korisnik = $kor->fetch_assoc();
            ?>
            <div class="forma">
                <form method="POST" action="administracija.php?x=8">
                Ime:<br>
                <input type="text" name="ime" value="<?php echo $korisnik['ime'] ?>"><br>
                Prezime:<br>
                <input type="text" name="prezime" value="<?php echo $korisnik['prezime'] ?>"><br>
                <input type="hidden" name="semail" value="<?php echo $korisnik['email'] ?>">
                E-mail adresa:<br>
                <input type="email" name="email" value="<?php echo $korisnik['email'] ?>"><br>
                Država:<br>
                <select name="drzava" id="drzava">
                    <?php
                    $sql = "SELECT ime2 FROM drzave";
                    $r = $c->query($sql);
                    if ($r->num_rows > 0) {
                        while($row = $r->fetch_assoc()){
                            if($korisnik['drzava'] == $row['ime2']){
                                echo '<option value="'.$row['ime2'].'" selected>'.$row['ime2'].'</option>';
                            }
                            else{
                                echo '<option value="'.$row['ime2'].'">'.$row['ime2'].'</option>';
                            }
                        }
                    }
                    ?>
                </select><br>
                Grad:<br>
                <input type="text" name="grad" value="<?php echo $korisnik['grad'] ?>"><br>
                Ulica:<br>
                <input type="text" name="ulica" value="<?php echo $korisnik['ulica'] ?>"><br>
                Datum rođenja:<br>
                <input type="date" name="datum" value="<?php echo $korisnik['datum'] ?>"><br>
                Uloga:<br>
                <select name="uloga">
                    <option value="Administrator" <?php if($korisnik['uloga'] == "Administrator") {echo 'selected';} ?>>Administrator</option>
                    <option value="Editor" <?php if($korisnik['uloga'] == "Editor") {echo 'selected';} ?>>Editor</option>
                    <option value="User" <?php if($korisnik['uloga'] == "User") {echo 'selected';} ?>>User</option>
                </select>
                <input type="submit" name="submit" value="Spremi promjene">
            </form>
            </div>
            <?php
        }
        else if(isset($_GET['id']) && !isset($_GET['o'])){
            if ($_GET['a'] == 'u'){
                if(isset($_GET['sid'])){
                    $sql = "DELETE FROM slike WHERE id=".$_GET['sid'];
                    $c->query($sql);
                }
                
                $sql = "SELECT * from vijesti WHERE id=".$_GET['id'];
                $vij = $c->query($sql);
                $vijest = $vij->fetch_assoc();
                ?>
                <div class="forma">
                <form method="POST" action="administracija.php?x=8" enctype="multipart/form-data">
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
                    echo '<a href="administracija.php?x=8&a=u&id='.$_GET['id'].'&sid='.$slika['id'].'">Obriši sliku</a>';
                    echo '</div>';
                }
                echo '<br>';
            }
            else if ($_GET['a'] == 'b'){
                $sql = "DELETE FROM vijesti WHERE id=".$_GET['id'];
                if ($c->query($sql) === TRUE) {
                    echo "Vijest je uspješno obrisana. <a href='administracija.php?x=8'>Natrag</a>";
                }
                $sql = "DELETE FROM slike WHERE vijest=".$_GET['id'];
                $c->query($sql);
            }
        }
        else if (isset ($_GET['d'])){
                ?>
                <div class="forma">
                <form method="POST" action="administracija.php?x=8" enctype="multipart/form-data">
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
            if(isset($_POST['email'])){
                $sql = "UPDATE korisnik SET ime='".$_POST['ime']."', prezime='".$_POST['prezime']."', email='".$_POST['email']."', drzava='".$_POST['drzava']."', grad='".$_POST['grad']."', ulica='".$_POST['ulica']."', datum='".$_POST['datum']."', uloga='".$_POST['uloga']."' WHERE email='".$_POST['semail']."'";
                $c->query($sql);
                if (count($_FILES) > 0){
                    if (is_uploaded_file($_FILES['nslika']['tmp_name'])) {
                        $slikaPodaci = addslashes(file_get_contents($_FILES['nslika']['tmp_name']));

                        $sql = "INSERT INTO slike(slika, vijest) VALUES('".$slikaPodaci."', ".$_POST['id'].")";
                        $c->query($sql);
                    }
                }
            }
            
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
            
            if(isset($_GET['o'])){
                $sql = "UPDATE vijesti SET odobren=1 WHERE id=".$_GET['id'];
                $c->query($sql);
            }
            
            if(isset($_GET['ok'])){
                $sql = "UPDATE korisnik SET odobren=1 WHERE email='".$_GET['email']."'";
                $c->query($sql);
            }
            
            echo '<div class="administracija"><h3>Korisnici</h3>';
            echo '<h4>Odobreni korisnici</h4>';
            $sql = "SELECT * FROM korisnik";
            $r = $c->query($sql);
            while ($row = $r->fetch_assoc()){
                if($row['odobren'] == 1){
                    echo $row['ime']." ".$row['prezime']." | ".$row['email']." - - <a href='administracija.php?x=8&email=".$row['email']."'>Uredi</a><br>";
                }
            }
            echo '<h4>Neodobreni korisnici</h4>';
            $r = $c->query($sql);
            while ($row = $r->fetch_assoc()){
                if($row['odobren'] == 0){
                    echo $row['ime']." ".$row['prezime']." | ".$row['email']." - - <a href='administracija.php?x=8&email=".$row['email']."'>Uredi</a> - - <a href='administracija.php?x=8&ok=o&email=".$row['email']."'>Odobri</a><br>";
                }
            }
            
            echo '</div><div class="administracija"><h3>Vijesti</h3>';
            echo '<h4>Odobrene vijesti</h4>';
            $sql = "SELECT * from vijesti";
            $r = $c->query($sql);
            while ($row = $r->fetch_assoc()){
                if($row['odobren'] == 1){
                echo $row['naslov']." - - <a href='administracija.php?x=8&a=u&id=".$row['id']."'>Uredi</a> - - <a href='administracija.php?x=8&a=b&id=".$row['id']."'>Obriši</a><br>";
                }
            }
            echo '<h4>Neodobrene vijesti</h4>';
            $r = $c->query($sql);
            while ($row = $r->fetch_assoc()){
                if($row['odobren'] == 0){
                echo $row['naslov']." - - <a href='administracija.php?x=8&a=u&id=".$row['id']."'>Uredi</a> - - <a href='administracija.php?x=8&a=b&id=".$row['id']."'>Obriši</a> - - <a href='administracija.php?x=8&o=o&id=".$row['id']."'>Odobri</a><br>";
                }
            }
            echo "<br><button type='button' style='padding: 5px;'><a href='administracija.php?x=8&d=d'>Dodaj vijest</a></button>";
            echo '</div>';
        }
        ?>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
<?php $c->close(); ?>