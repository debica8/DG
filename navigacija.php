<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <header>
            <img src="slike/banner.jpg" />
            <nav>
                <ul>
                  <li><a href="navigacija.php?x=1">Početna stranica</a></li>
                  <li><a href="navigacija.php?x=2">Vijesti</a></li>
                  <li><a href="navigacija.php?x=3">Kontakt</a></li>
                  <li><a href="navigacija.php?x=4">O nama</a></li>
                  <li><a href="navigacija.php?x=5">Galerija</a></li>
                  <li><a href="navigacija.php?x=6">Registracija</a></li>
                  <li><a href="navigacija.php?x=7">Prijava</a></li>
                  <li><a href="navigacija.php?x=8">Administracija</a></li>
                </ul>
            </nav>
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
        ?>
    </body>
</html>
