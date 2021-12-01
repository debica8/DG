<?php include 'kod.php'; ?>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tetobitna</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    <body>
        <?php include_once 'navigacija.php'; ?>
        <div>
            <?php
            if(isset($_POST['ime'])){
                $sql = "SELECT email FROM korisnik WHERE email='".$_POST['email']."'";
                $r = $c->query($sql);
                if($r->num_rows > 0){
                    echo '<h2 style="color: red; padding-left: 39%;">Već postoji korisnik s ovom email adresom!</h2>';
                }
                else{
                    $br = 1;
                    $korisnicko = substr($_POST['ime'], 0, 1).substr($_POST['prezime'], 0, 1).$br;
                    $sql = "SELECT korisnicko FROM korisnik WHERE korisnicko='".$korisnicko."'";
                    $r = $c->query($sql);
                    while ($r->num_rows > 0){
                        $korisnicko = strtoupper(substr($_POST['ime'], 0, 1)).strtoupper(substr($_POST['prezime'], 0, 1)).$br;
                        $sql = "SELECT korisnicko FROM korisnik WHERE korisnicko='".$korisnicko."'";
                        $r = $c->query($sql);
                        $br++;
                    }
                    $loz = password_hash($_POST['lozinka'], PASSWORD_DEFAULT);
                    $sql = "INSERT INTO korisnik VALUES ('".$_POST['ime']."', '".$_POST['prezime']."', '".$korisnicko."', '".$_POST['email']."', '".$_POST['drzava']."', '".$_POST['grad']."', '".$_POST['ulica']."', '".$_POST['datum']."', '".$loz."', 'User', 0)";
                    $c->query($sql);
                }
            }
            if(isset($_GET['p'])){
                if($_GET['p'] == 'o'){
                    echo '<h2 style="color: red; padding-left: 37%;">Korisnik još nije odobren od strane administratora!</h2>';
                }
                else if($_GET['p'] == 'l'){
                    echo '<h2 style="color: red; padding-left: 43%;">Unesena je netočna lozinka!</h2>';
                }
                else if($_GET['p'] == 'e'){
                    echo '<h2 style="color: red; padding-left: 36%;">Nema korisničkog računa s unesenom email adresom!</h2>';
                }
            }
            ?>
            <div class="forma">
            <form method="POST" action="navigacija.php?x=11">
                E-mail adresa:<br>
                <input type="email" name="email"><br>
                Lozinka:<br>
                <input type="password" name="lozinka"><br>
                <input type="submit" name="submit" value="Prijava">
            </form>
            </div>
        </div>
    </body>
    <footer>
        Copyright © 2021. Deborah Gomerčić <a href="https://github.com/debica8/DG"><img src="slike/github.png" style="width: 20px;"/></a>
    </footer>
</html>
<?php $c->close(); ?>