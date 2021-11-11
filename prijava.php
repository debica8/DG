<?php include 'kod.php'; ?>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prva zadaća</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    <body>
        <?php include_once 'navigacija.php'; ?>
        <div>
            <?php
            if(isset($_POST['ime'])){
                $br = 1;
                $korisnicko = substr($_POST['ime'], 0, 1).substr($_POST['prezime'], 0, 1).$br;
                $sql = "SELECT korisnicko FROM korisnik WHERE korisnicko='".$korisnicko."'";
                $r = $c->query($sql);
                $k = $r->fetch_assoc();
                while ($r->num_rows > 0){
                    $korisnicko = strtoupper(substr($_POST['ime'], 0, 1)).strtoupper(substr($_POST['prezime'], 0, 1)).$br;
                    $sql = "SELECT korisnicko FROM korisnik WHERE korisnicko='".$korisnicko."'";
                    $r = $c->query($sql);
                    $k = $r->fetch_assoc();
                    $br++;
                }
                $loz = password_hash($_POST['lozinka'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO korisnik VALUES ('".$_POST['ime']."', '".$_POST['prezime']."', '".$korisnicko."', '".$_POST['email']."', '".$_POST['drzava']."', '".$_POST['grad']."', '".$_POST['ulica']."', '".$_POST['datum']."', '".$loz."')";
                $c->query($sql);
            }
            else{
            ?>
            <div style="padding: 5%; padding-left: 35%">
            <form method="POST" action="#">
                E-mail adresa:<br>
                <input type="email" name="email"><br>
                Lozinka:<br>
                <input type="password" name="lozinka"><br>
                <input type="submit" name="submit" value="Prijava">
            </form>
            <?php
            }
            ?>
        </div>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
<?php $c->close(); ?>