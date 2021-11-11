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
        if(isset($_GET['email'])){
            $sql = "SELECT * from korisnik WHERE email='".$_GET['email']."'";
            $kor = $c->query($sql);
            $korisnik = $kor->fetch_assoc();
            ?>
            <div class="forma">
            <form method="POST" action="">
                Ime:<br>
                <input type="text" name="ime" value="<?php echo $korisnik['ime'] ?>"><br>
                Prezime:<br>
                <input type="text" name="prezime" value="<?php echo $korisnik['prezime'] ?>"><br>
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
        if(isset($_GET['id'])){
            $sql = "SELECT * from vijesti WHERE id=".$_GET['id'];
            $vij = $c->query($sql);
            $vijest = $vij->fetch_assoc();
            ?>
            <div class="forma">
            <form method="POST" action="">
                Naslov:<br>
                <input type="text" name="naslov" value="<?php echo $vijest['naslov'] ?>"><br>
                Tekst:<br>
                <textarea id="tekst" name="tekst" rows="10" cols="100">
                    <?php echo $vijest['tekst'] ?>
                </textarea><br>
                Datum:<br>
                <input type="date" name="datum" value="<?php echo $vijest['datum'] ?>"><br>
                <input type="submit" name="submit" value="Spremi promjene">
            </form>
            </div>
            <?php
        }
        else{
            echo '<div class="administracija"><h3>Korisnici</h3>';
            $sql = "SELECT * from korisnik";
            $r = $c->query($sql);
            while ($row = $r->fetch_assoc()){
                echo $row['ime']." ".$row['prezime']." | ".$row['email']." - - <a href='administracija.php?email=".$row['email']."'>Uredi</a><br>";
            }
            echo '</div><div class="administracija"><h3>Vijesti</h3>';
            $sql = "SELECT * from vijesti";
            $r = $c->query($sql);
            while ($row = $r->fetch_assoc()){
                echo $row['naslov']." - - <a href='administracija.php?id=".$row['id']."'>Uredi</a><br>";
            }
            echo '</div>;';
        }
        ?>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>