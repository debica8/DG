<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <header>
            <?php
            $json = file_get_contents('https://www.metaweather.com/api/location/851128/');
            $_data = json_decode($json, true);
            ?>
            <img src="slike/banner.jpg" />
            <nav>
                <ul>
                  <li><a href="navigacija.php?x=1">Početna stranica</a></li>
                  <li><a href="navigacija.php?x=2">Vijesti</a></li>
                  <li><a href="navigacija.php?x=3">Kontakt</a></li>
                  <li><a href="navigacija.php?x=4">O nama</a></li>
                  <li><a href="navigacija.php?x=5">Galerija</a></li>
                  <?php if(!isset($_SESSION['uloga'])){ echo '<li><a href="navigacija.php?x=6">Registracija</a></li>'; } ?>
                  <?php if(!isset($_SESSION['uloga'])){ echo '<li><a href="navigacija.php?x=7">Prijava</a></li>'; } ?>
                  <?php if(isset($_SESSION['uloga']) && $_SESSION['uloga'] == 'Administrator'){ echo '<li><a href="navigacija.php?x=8">Administracija</a></li>'; } ?>
                  <?php if(isset($_SESSION['uloga']) && $_SESSION['uloga'] == 'Editor'){ echo '<li><a href="navigacija.php?x=9">Uređivanje</a></li>'; } ?>
                  <?php if(isset($_SESSION['uloga']) && $_SESSION['uloga'] == 'User'){ echo '<li><a href="navigacija.php?x=10">Napiši vijest</a></li>'; } ?>
                  <li><a href="https://www.metoffice.gov.uk/weather/forecast/u25kdgqqt#?date=2021-12-01">Temperatura u Zagrebu: <?php echo $_data['consolidated_weather'][0]['the_temp'];  ?>°</a>
                </ul>
            </nav>
            <?php if(isset($_SESSION['korisnicko'])){ echo '<div class="odjava"><button class="gumb"><a href="odjava.php">Odjava</a></button></div>'; } ?>
        </header>
        <?php
        if(!isset($_GET['x']) || $_GET['x'] == 1){
            include_once 'index.php';
        }
        else if($_GET['x'] == 2){
            include_once 'vijesti.php';
        }
        else if($_GET['x'] == 3){
            include_once 'kontakt.php';
        }
        else if($_GET['x'] == 4){
            include_once 'o_nama.php';
        }
        else if($_GET['x'] == 5){
            include_once 'galerija.php';
        }
        else if($_GET['x'] == 6){
            include_once 'registracija.php';
        }
        else if($_GET['x'] == 7){
            include_once 'prijava.php';
        }
        else if($_GET['x'] == 8){
            include_once 'administracija.php';
        }
        else if($_GET['x'] == 9){
            include_once 'uredivanje.php';
        }
        else if($_GET['x'] == 10){
            include_once 'korisnicko.php';
        }
        else if($_GET['x'] == 11){
            include_once 'prijavaKontroler.php';
        }
        ?>
    </body>
</html>
